<?php

declare(strict_types=1);

namespace FromHome\Common\Concerns;

use Webmozart\Assert\Assert;

trait ModelMetaAware
{
    public function getMeta(): array
    {
        /** @var array|null $meta */
        $meta = $this->getAttribute('meta');

        return $meta === null ? [] : $meta;
    }

    public function setMeta(array $value): self
    {
        $self = $this->setAttribute('meta', $value);

        Assert::isInstanceOf($self, self::class);

        return $self;
    }
}
