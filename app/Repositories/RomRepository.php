<?php
namespace App\Repositories;

use App\Models\Rom;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class RomRepository extends AbstractEloquentRepository
{
    /**
     * @paRom Rom $model
     * @return void
     */
    public function __construct(Rom $model)
    {
        parent::__construct($model);
    }

    /**
     * @paRom int $id
     * @return Model|null
     */
    public function findRom(int $id): ?Model
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
     * @paRom array $searchCriteria
     * @return Model|null
     */
    public function paginateAllRom(array $searchCriteria): LengthAwarePaginator
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