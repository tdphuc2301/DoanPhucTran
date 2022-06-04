<?php

namespace App\Services;

use App\Repositories\WebRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class WebService
{
    private $productRepository;

    /**
     * @param WebRepository $productRepository
     * @return void
     */
    public function __construct(
        WebRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function paginateAll(
        int $page,
        int $limit,
        array $data = [],
        string $sortKey,
        int $sortValue
    ): LengthAwarePaginator {
        $filter = [];
        $fillableProperties = $this->productRepository->getFillableProperties();
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
        return $this->productRepository->paginateAllProduct(
            $searchCriteria
        );
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findProduct(int $id): ?Model
    {
        return $this->productRepository->findProduct($id);
    }

    
}
