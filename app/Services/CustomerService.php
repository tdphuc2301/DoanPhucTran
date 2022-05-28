<?php

namespace App\Services;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Exceptions\UploadImageException;
use App\Http\Services\UploadImageService;
use App\Models\customer;
use App\Models\User;
use App\Repositories\CustomerRepository;
use App\Repositories\ImageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class CustomerService
{
    private $customerRepository;
    private $imageRepository;
    private $uploadImageService;
    /**
     * @param CustomerRepository $customerRepository
     * @param UploadImageService $uploadImageService
     * @param ImageRepository $imageRepository
     * @return void
     */
    public function __construct(
        CustomerRepository $customerRepository,
        UploadImageService $uploadImageService,
        ImageRepository $imageRepository
    ) {
        $this->customerRepository = $customerRepository;
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
        $fillableProperties = $this->customerRepository->getFillableProperties();
        foreach ($data as $key => $value) {
            if (in_array($key, $fillableProperties)) {
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
        return $this->customerRepository->paginateAllcustomer(
            $searchCriteria,
            null
        );
    }

    /**
     * @param int|null $status
     * @return Collection|null
     */
    public function getAllCustomer(?int $status=null): ?Collection{
        $filter = [];
        if($status){
            $filter['status'] = $status;
        }
        $searchCriteria = [
            'sort' => 'name',
            "filter" => $filter
        ];
        return $this->customerRepository->findBy(
            $searchCriteria, null, false
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findCustomer(int $id): ?Model
    {
        return $this->customerRepository->findOne($id, ['images', 'metaseo', 'alias', 'user']);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createCustomer(array $data): ?Model
    {
        if (!empty($data['id'])) {
            $customer = $this->customerRepository->findOne($data['id']);
            $data['address'] = $data['search_address'];
            $data['long'] = $data['longitude'];
            $data['lat'] = $data['latitude'];
            $customer = $this->customerRepository->update($customer, $data);
        } else {
            $user = new User();
            $user->name = $data['name'];
            $user->username = $data['username'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);
            $user->role_id = 4;
            $user->save();
            
            $customer = $this->customerRepository->save([
                'name' => $data['name'],
                'address' => $data['search_address'],
                'long' => $data['longitude'],
                'lat' => $data['latitude'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'point' => $data['point'],
                'type_id' => $data['type_id'],
                'user_id' => $user->id,
                'index' => $data['index'] ?? config('common.default_index'),
                'description' => $data['description'] ?? '',
                'status' => $data['status'] ?? config('common.status.active')
            ]);
            
        }

        if (!empty($customer->id)) {
            // Create alias
            event(new InsertNewRecord($customer, $data['alias'] ?? $customer->name));
            if (!empty($data['remove_images'])) {
                $this->removeCustomerImage($customer, $data['remove_images']);
            }
            if (!empty($data['images'])) {
                foreach ($data['images'] as $index => $image) {
                    if (isUploadFile($image ?? null)) {
                        $this->updateCustomerImage($customer, $image, $index);
                    }
                }
            }
            // Create meta seo
            if (!empty($data['meta_seo'])) {
                event(new ChangeMetaSeo($customer, $data['meta_seo']));
            }
            return $customer;
        }
        return null;
    }

    /**
     * @param Customer $customer
     * @param UploadedFile $image
     * @param int $index
     * @return void
     */
    protected function updateCustomerImage(Customer $customer, UploadedFile $image, int $index = 1): void
    {
        $uploadImage = $this->uploadImageService
            ->setModule('customer')
            ->setWidth(config('image.resize.customer.width'))
            ->setHeight(config('image.resize.customer.height'))
            ->uploadImage($image, null, true);

        if ($uploadImage->isSuccess()) {
            $uploadImage = $uploadImage->getData();
            $this->removecustomerImage($customer, [$index]);
            $this->imageRepository->updateOrCreate(
                [
                    'model_id' => $customer->id,
                    'model_type' => get_class($customer),
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
     * @param Customer $customer
     * @param array $indexs
     * @return void
     */
    public function removeCustomerImage(Customer $customer, array $indexs = []): void
    {
        if ($indexs) {
            $images = $customer->getImagesByIndex($indexs);
        } else {
            $images = $customer->images;
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
        $customer = $this->customerRepository->findOne($id);
        if ($customer) {
            $this->customerRepository->update($customer, [
                'status' => $status
            ]);
            return true;
        }
        return false;
    }
}
