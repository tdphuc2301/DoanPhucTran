<?php

namespace App\Repositories;

use Illuminate\Support\Carbon;
use Closure;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractEloquentRepository implements BaseRepository
{
    /**
     *
     * @var Model|Builder
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get Model instance
     *
     * @return Builder|Model
     */
    public function getModel(): ?Model
    {
        return $this->model;
    }

    /**
     * @param $id
     * @param array|null $relations
     * @return Builder|Model|object|null
     */
    public function findOne($id, array $withRelations = null): ?Model
    {
        $builder = null;
        if ($withRelations) {
            $builder = function (Builder $builder) use ($withRelations) {
                return $builder->with($withRelations);
            };
        }
        return $this->findOneBy([$this->model->getKeyName() => $id], $builder);
    }

    /**
     * @param array $criteria
     * @param Closure|null $builder
     * @return Builder|Model|object|null
     */
    public function findOneBy(array $criteria, Closure $builder = null): ?Model
    {
        $queryBuilder = $this->model->where($criteria);
        if (is_callable($builder)) {
            $builder($queryBuilder);
        }

        return $queryBuilder->first();
    }

    /**
     * @param array $searchCriteria
     * @param Closure|null $builder
     * @param bool $paginate
     * @param bool $getValue
     * @param mixed $isCount
     * @return LengthAwarePaginator|Builder|Builder[]|Collection | int
     */
    public function findBy(
        array $searchCriteria = [],
        Closure $builder = null,
        $paginate = true,
        $getValue = true,
        $isCount = false
    ) {
        $limit = !empty($searchCriteria['limit']) ? (int)$searchCriteria['limit'] : config('pagination.limit');
        $page = !empty($searchCriteria['page']) ? (int)$searchCriteria['page'] : config('pagination.start_page');
        $filter = $searchCriteria['filter'] ?? [];
        $sort = $searchCriteria['sort'] ?? null;
        $relations = $searchCriteria['relations'] ?? null;

        $queryBuilder = $this->model->where(function ($query) use ($filter) {
            $this->applySearchCriteriaInQueryBuilder($query, $filter);
        });
        if ($sort) {
            $this->applySortQueryBuilder($queryBuilder, $sort);
        }
        if (is_callable($builder)) {
            $builder($queryBuilder);
        }
        if($relations){
            $queryBuilder->with($relations);
        }
        if ($paginate) {
            return $queryBuilder->paginate($limit, ['*'], 'page', $page);
        }
        if ($isCount) {
            return $queryBuilder->count();
        }

        if (!$getValue) {
            return $queryBuilder;
        }

        return $queryBuilder->get();
    }

    public function applySearchCriteriaInQueryBuilder(Builder $queryBuilder, array $searchCriteria = []): Builder
    {
        foreach ($searchCriteria as $key => $value) {
            if (in_array($key, ['page', 'per_page', 'limit'])) {
                continue;
            }
            $casts = $this->model->getCasts();
            $datatimeCasts = array_filter($casts, function ($cast) {
                return $cast = 'datetime';
            });
            $datatimeFields = array_keys($datatimeCasts);
            if ($this->model->usesTimestamps()) {
                array_push($datatimeFields, $this->model->getCreatedAtColumn());
                array_push($datatimeFields, $this->model->getUpdatedAtColumn());
            }
            if (in_array($key, ['date']) && in_array($value['key'] ?? '', $datatimeFields)) {
                $fromDate = $value['from'] ?? '';
                $toDate = $value['to'] ?? '';
                if ($fromDate) {
                    $queryBuilder->where($value['key'], '>=', Carbon::parse($fromDate)->startOfDay());
                }
                if ($toDate) {
                    $queryBuilder->where($value['key'], '<=', Carbon::parse($toDate)->endOfDay());
                }

                continue;
            }

            if (is_array($value)) {
                $operator = $value['operator'] ?? null;
                $isValidOperator = in_array($operator, config('common.query_operator'));
                if ($operator && $isValidOperator) {
                    $queryValue = $value['value'] ?? null;
                    $queryBuilder->where($key, $operator, $queryValue);
                } else {
                    $queryBuilder->whereIn($key, $value);
                }
            } else {
                $queryBuilder->where($key, '=', $value);
            }
        }
        return $queryBuilder;
    }

    public function applySortQueryBuilder(Builder $queryBuilder, string $sortField = ''): Builder
    {
        if (strpos($sortField, '-') !== false) {
            $sortField = substr($sortField, 1);
            $queryBuilder->orderByDesc($sortField);
        } else {
            $queryBuilder->orderBy($sortField);
        }
        return $queryBuilder;
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function save(array $data): ?Model
    {
        return $this->model->create($data);
    }

    /**
     * @param Model $model
     * @param array $data
     * @return Builder|Model|object|null
     */
    public function update(Model $model, array $data): ?Model
    {
        $fillableProperties = $this->model->getFillable();

        foreach ($data as $key => $value) {
            if (in_array($key, $fillableProperties)) {
                $model->$key = $value;
            }
        }
        $model->save();

        // get updated model from database
        return $model->refresh();
    }

    /**
     * @param string $key
     * @param array $values
     * @return Builder[]|Collection
     */
    public function findIn(string $key, array $values): ?Collection
    {
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * @param Model $model
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }

    /**
     * @param array $data
     * @return bool|mixed|null
     */
    public function deleteBy(array $data): ?bool
    {
        return $this->model->where($data)->delete();
    }

    /**
     * @return $this|AbstractEloquentRepository
     */
    public function withoutGlobalScopes(): BaseRepository
    {
        $scopes = $this->model->getGlobalScopes();
        $scopes = array_keys($scopes);
        $this->model = $this->model->withoutGlobalScopes($scopes);

        return $this;
    }

    /**
     * @param array $data
     * @param array $primaryData
     * @return Builder|Model|object|null
     */
    public function updateOrCreate(array $primaryData, array $data): ?Model
    {
        $fillAbleProperties = $this->model->getFillable();

        $dataKey = array_filter(array_keys($data), function ($dt) use ($fillAbleProperties) {
            return in_array($dt, $fillAbleProperties);
        });
        $updateData = [];
        foreach ($data as $key => $dataUpdate) {
            if (in_array($key, $dataKey)) {
                $updateData[$key] = $dataUpdate;
            }
        }
        // get updated model from database
        return $this->model->updateOrCreate($primaryData, $updateData);
    }

    /**
     * @return Collection
     */
    public function findAll(): ?Collection
    {
        return $this->model->all();
    }

    /**
     * @param string|array $field
     * @param string $queryString
     * @return Collection
     */
    public function whereLike($field, string $queryString): ?Collection
    {
        return $this->model->whereLike($field, $queryString)->get();
    }

    /**
     * @param string|array $field
     * @param string $queryString
     * @return array
     */
    public function getFillableProperties(): array{
        return $this->model->getFillable();
    }
}
