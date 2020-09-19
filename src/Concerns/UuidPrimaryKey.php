<?php

declare(strict_types=1);

namespace FromHome\Common\Concerns;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;
use FromHome\Common\Abstracts\Model;

trait UuidPrimaryKey
{
    /**
     * This function is used internally by Eloquent models to test if the model has auto increment value
     *
     * @returns bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * This function overwrites the default boot static method of Eloquent models. It will hook
     * the creation event with a simple closure to insert the UUID
     */
    public static function bootUuidPrimaryKey(): void
    {
        static::creating(function (Model $model): void {
            if (static::itHasUuid($model) === false) {
                $model->incrementing = false;

                $uuid = Uuid::uuid6();

                $model->attributes[$model->getKeyName()] = $uuid->toString();
            }
        });
    }

    /**
     * @psalm-suppress MixedAssignment
     */
    protected static function itHasUuid(Model $model): bool
    {
        if (isset($model->attributes[$model->getKeyName()])) {
            /** @var string $uuid */
            $uuid = $model->attributes[$model->getKeyName()];

            Assert::uuid($uuid);

            return true;
        }

        return false;
    }
}
