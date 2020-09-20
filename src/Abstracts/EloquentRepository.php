<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use RuntimeException;
use Ramsey\Uuid\UuidInterface;
use FromHome\Common\Model\ModelInterface;
use Illuminate\Contracts\Events\Dispatcher;
use FromHome\Common\Concerns\ApplicationAware;
use FromHome\Common\Model\ApplicationAwareInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class EloquentRepository extends Repository implements ApplicationAwareInterface
{
    use ApplicationAware;

    protected Model $model;

    public function __construct(Model $model, Dispatcher $event)
    {
        parent::__construct($event);

        $this->model = $model;
    }

    public function findUsingId(UuidInterface $uuid)
    {
        try {
            /** @var Model $model */
            return $this->model->newQuery()->findOrFail(
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
            return $this->model->newQuery()->where($column, $value)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }

    public function findOneUsingColumns(array $columns)
    {
        try {
            /** @var Model $model */
            return $this->model->newQuery()->where($columns)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return null;
        }
    }

    public function findUsingColumn(string $column, $value)
    {
        return $this->model->newQuery()->where($column, $value)->get();
    }

    public function findUsingColumns(array $columns)
    {
        return $this->model->newQuery()->where($columns)->get();
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
