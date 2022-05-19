<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository extends AbstractEloquentRepository
{
    /**
     * @param Category $model
     * @return void
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function findCategory(int $id): ?Model
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
    public function paginateAllCategory(array $searchCriteria): LengthAwarePaginator
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