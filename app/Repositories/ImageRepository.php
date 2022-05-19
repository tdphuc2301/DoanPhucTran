<?php
namespace App\Repositories;

use App\Models\Image;
use App\Repositories\AbstractEloquentRepository;

class ImageRepository extends AbstractEloquentRepository
{
    /**
     * @param Image $model
     * @return void
     */
    public function __construct(Image $model)
    {
        parent::__construct($model);
    }
}