<?php

namespace App\Repositories;

use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepository
{
    /**
     * Find a resource by id
     * 
     * @param  $id
     * @param array|null $relations
     * @return Model|null
     */
    public function findOne($id, array $withRelations = null): ?Model; 

    /**
     * Find a resource by criteria
     *
     * @param array $criteria
     * @param Closure|null $builder
     * @return Model|null
     */
    public function findOneBy(array $criteria, Closure $builder = null): ?Model;

    /**
     * Search All resources by criteria
     *
     * @param array $searchCriteria
     * @param Closure|null $builder
     * @param Bool $paginate
     * @param Bool $getValue
     * @return Collection
     */
    public function findBy(array $searchCriteria = [], Closure $builder = null, $paginate = true, $getValue = true);

    /**
     * Search All resources by any values of a key
     *
     * @param string $key
     * @param array $values
     * @return Collection
     */
    public function findIn(string $key, array $values): ?Collection;

    /**
     * Save a resource
     *
     * @param array $data
     * @return Model
     */
    public function save(array $data): ?Model;

    /**
     * Update a resource
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): ?Model;

    /**
     * Delete a resource
     *
     * @param Model $model
     * @return mixed
     */
    public function delete(Model $model): ?bool;
}