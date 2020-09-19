<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use RuntimeException;
use Ramsey\Uuid\UuidInterface;
use FromHome\Common\Model\ModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Events\Dispatcher;
use FromHome\Common\Concerns\ApplicationAware;
use FromHome\Common\Model\ApplicationAwareInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class EloquentRepository extends Repository implements ApplicationAwareInterface
{
    use ApplicationAware;

    protected Builder $query;

    public function __construct(Model $model, Dispatcher $event)
    {
        parent::__construct($event);

        $this->query = $model->newQuery();
    }

    public function findUsingId(UuidInterface $uuid)
    {
        try {
            /** @var Model $model */
            return $this->query->findOrFail(
                $uuid->toString()
            );
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }

    public function findOneUsingColumn(string $column, $value)
    {
        try {
            /** @var Model $model */
            return $this->query->where($column, $value)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }

    public function findOneUsingColumns(array $columns)
    {
        try {
            /** @var Model $model */
            return $this->query->where($columns)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }

    public function findUsingColumn(string $column, $value)
    {
        return $this->query->where($column, $value)->get();
    }

    public function findUsingColumns(array $columns)
    {
        return $this->query->where($columns)->get();
    }

    protected function save(ModelInterface $model): ModelInterface
    {
        if ($model instanceof Model) {
            $model->save();

            return $model;
        }

        throw new RuntimeException('Model must be instance of ' . Model::class . ', ' . get_class($model) . ' given.');
    }
}
