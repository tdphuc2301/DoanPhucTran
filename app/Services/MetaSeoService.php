<?php

namespace App\Services;

use App\Repositories\MetaSeoRepository;
use Illuminate\Database\Eloquent\Model;

class MetaSeoService
{
    private $metaSeoRepository;
    /**
     * @param MetaSeoRepository $metaSeoRepository
     * @return void
     */
    public function __construct(MetaSeoRepository $metaSeoRepository)
    {
        $this->metaSeoRepository = $metaSeoRepository;
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createMetaSeo(array $data): ?Model
    {
        return $this->metaSeoRepository->save($data);
    }

    /**
     * @param array $primaryData
     * @param array $data
     * @return null|Model
     */
    public function createOrUpdateMetaSeo(array $primaryData, array $data): ?Model
    {
        return $this->metaSeoRepository->updateOrCreate($primaryData, $data);
    }
}
