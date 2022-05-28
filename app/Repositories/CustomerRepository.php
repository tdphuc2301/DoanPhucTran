<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerRepository extends AbstractEloquentRepository
{
    /**
     * @param Customer $model
     * @return void
     */
    public function __construct(Customer $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findCustomer(int $id): ?Model
    {
        return $this->findOneBy(['id' => $id], function (Builder $builder) {
            return $builder->with([
                'images' => function ($q) {
                    $q->orderBy('index', 'ASC');
                },
                'metaseo',
                'alias',
            ]);
        });
    }

    /**
     * @param array $searchCriteria
     * @return Model|null
     */
    public function paginateAllCustomer(array $searchCriteria): LengthAwarePaginator
    {
        return $this->findBy(
            $searchCriteria,
            function (Builder $builder) {
                return $builder->with([
                    'images' => function ($q) {
                        $q->orderBy('index', 'ASC');
                    },
                ]);
            }
        );
    }
}