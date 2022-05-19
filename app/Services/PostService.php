<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\Post;
use App\Repositories\ImageRepository;
use App\Repositories\PostRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    private $postRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param PostRepository $postRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        PostRepository $postRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->postRepository = $postRepository;
        $this->uploadImageService = $uploadImageService;
        $this->imageRepository = $imageRepository;
    }

    public function paginateAll(
        int $page,
        int $limit,
        array $data = [],
        string $sortKey,
        int $sortValue
    ): LengthAwarePaginator {
        $filter = [];
        $fillableProperties = $this->postRepository->getFillableProperties();
        foreach ($data as $key => $value) {
            if (in_array($key, $fillableProperties) && !is_null($value)) {
                $filter[$key] = $value;
            }
        }
        if(!empty($data['keyword'])){
            $filter['search'] = [
                'operator' => 'LIKE',
                'value' => "%". $data['keyword']. "%"
            ];
        }
        $searchCriteria = [
            'page' => $page,
            'limit' => $limit,
            'sort' => $sortValue ? $sortKey : "-$sortKey",
            "filter" => $filter,
        ];
        return $this->postRepository->paginateAllPost(
            $searchCriteria
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findPost(int $id): ?Model
    {
        return $this->postRepository->findPost($id);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createPost(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $post = $this->postRepository->findOne($data['id']);
            $post = $this->postRepository->update($post, $data);
        } else {
            $post = $this->postRepository->save([
                'name' => $data['name'],
                'short_content' => $data['short_content'] ?? '',
                'content' => $data['content'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
        }

        if (!empty($post->id)) {
            // Create alias
            event(new InsertNewRecord($post, $data['alias'] ?? $post->name));
            if (!empty($data['remove_images'])) {
                $this->removePostImage($post, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updatePostImage($post, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($post, $data['meta_seo']));
            }
            return $post;
        }
        return null;
    }

    /**
     * @param Post $post
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updatePostImage(Post $post, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('post')
            ->setWidth(config('image.resize.post.width'))
            ->setHeight(config('image.resize.post.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removePostImage($post, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $post->id,
                    'model_type' => get_class($post),
                    'index' => $index,
                ],
                [
                    'width' => $uploadImage['width'] ?? null,
                    'height' => $uploadImage['height'] ?? null,
                    'size' => $uploadImage['size'] ?? null,
                    'path' => $uploadImage['path'] ?? null,
                ]
            );
        } else {
            throw new UploadImageException($uploadImage->getMessage());
        }
    }

    /**
     * @param Post $post
     * @param array $indexs
     * @return void
     */
    public function removePostImage(Post $post, array $indexs = []): void
    {
        if ($indexs) {
            $images = $post->getImagesByIndex($indexs);
        } else {
            $images = $post->images;
        }
        /**
         * @param Image $image
         */
        foreach ($images as $image) {
            $this->uploadImageService->removeFile(public_path($image->path));
            $image->delete();
        }
    }

    /**
     * @param int $id
     * @param bool $status
     * @return bool
     */
    public function changeStatus(int $id, bool $status): bool
    {
        $post = $this->postRepository->findOne($id);
        if ($post) {
            $this->postRepository->update($post, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
