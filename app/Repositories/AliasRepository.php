<?php

namespace App\Repositories;

use App\Models\Alias;
use App\Repositories\AbstractEloquentRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AliasRepository extends AbstractEloquentRepository
{
    /**
     * @param Alias $model
     * @return void
     */
    public function __construct(Alias $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $alias
     * @return Model|null
     */
    public function findOneByAlias(string $alias): ?Model
    {
        return $this->findOneBy(['alias' => $alias], function (Builder $builder) {
            return $builder->with(['model']);
        });
    }

    /**
     * @param string $alias
     * @param array $model
     * @return bool
     */
    public function checkExist(string $alias, array $model = []): bool
    {
        if($model){
            $alias = $this->findOneBy(['alias' => $alias], function (Builder $builder) use ($model) {
                $builder->where(function ($query) use ($model) {
                    $query->where('model_id', '!=', $model['model_id'])->orWhere('model_type', '!=', $model['model_type']);
                });
            });
        }else{
            $alias = $this->findOneByAlias($alias);
        }
        return $alias ? true : false;
        
    }
}
