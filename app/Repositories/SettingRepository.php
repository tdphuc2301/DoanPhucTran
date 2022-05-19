<?php
namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\AbstractEloquentRepository;

class SettingRepository extends AbstractEloquentRepository
{
    /**
     * @param Setting $model
     * @return void
     */
    public function __construct(Setting $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $keys
     * @return bool|mixed|null
     */
    public function removeByKeys(array $keys): ?bool{
        return Setting::whereIn('key', $keys)->delete();
    }

    /**
     * @param array $data
     * @return bool|mixed|null
     */
    public function insertSettings(array $data) :?bool{
        return Setting::insert($data);
    }
}