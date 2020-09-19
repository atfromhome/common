<?php

declare(strict_types=1);

namespace FromHome\Common\Concerns;

use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;
use Ramsey\Uuid\UuidInterface;

trait ModelUuidGetterSetter
{
    public function getId(): ?UuidInterface
    {
        /** @var string|null $value */
        $value = $this->getAttribute('id');

        return $value ? Uuid::fromString($value) : null;
    }

    public function setId(UuidInterface $uuid)
    {
        $self = $this->setAttribute('id', $uuid->toString());

        Assert::isInstanceOf($self, self::class);

        return $self;
    }
}
