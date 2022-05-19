<?php
namespace App\Repositories;

use App\Models\MetaSeo;
use App\Repositories\AbstractEloquentRepository;

class MetaSeoRepository extends AbstractEloquentRepository
{
    /**
     * @param MetaSeo $model
     * @return void
     */
    public function __construct(MetaSeo $model)
    {
        parent::__construct($model);
    }
}