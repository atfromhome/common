<?php

declare(strict_types=1);

namespace FromHome\Common\Repository;

use Ramsey\Uuid\UuidInterface;
use FromHome\Common\Model\ModelInterface;

interface ModelRepositoryInterface
{
    /**
     * @return mixed
     */
    public function create(ModelInterface $model);

    /**
     * @param string[] $attributes
     * @return mixed
     */
    public function update(ModelInterface $model, array $attributes);

    /**
     * @return mixed
     */
    public function findUsingId(UuidInterface $uuid);

    /**
     * @return mixed
     */
    public function findOneUsingColumns(array $columns);

    /**
     * @return mixed
     */
    public function findUsingColumns(array $columns);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function findOneUsingColumn(string $column, $value);

    /**
     * @param mixed $value
     * @return mixed
     */
    public function findUsingColumn(string $column, $value);
}
