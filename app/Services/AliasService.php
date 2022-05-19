<?php
namespace App\Services;

use App\Repositories\AliasRepository;
use Illuminate\Database\Eloquent\Model;

class AliasService
{
    private $aliasRepository;
    /**
     * @param AliasRepository $aliasRepository
     * @return void
     */
    public function __construct(AliasRepository $aliasRepository)
    {
        $this->aliasRepository = $aliasRepository;
    }

    /**
     * @param string $alias
     * @return Model|null
     */
    public function findOneByAlias(string $alias): ?Model{
        return $this->aliasRepository->findOneByAlias($alias);
    }

    /**
     * @param array $data
     * @return null|Model
     */
    public function createAlias(array $data): ?Model{
        return $this->aliasRepository->save($data);
    }

    /**
     * @param array $primaryData
     * @param array $data
     * @return null|Model
     */
    public function createOrUpdateAlias(array $primaryData, array $data): ?Model{
        return $this->aliasRepository->updateOrCreate($primaryData, $data);
    }

    /**
     * @param string $alias
     * @param array $model
     * @return bool
     */
    public function checkExist(string $alias, array $model=[]): bool
    {
        return $this->aliasRepository->checkExist($alias, $model);
    }
}