<?php

declare(strict_types=1);

namespace FromHome\Common\Concerns;

use Webmozart\Assert\Assert;

trait ModelToggleAware
{
    public function isActive(): bool
    {
        $isActive = $this->getAttribute('is_active');

        Assert::boolean($isActive);

        return $isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $self = $this->setAttribute('is_active', $isActive);

        Assert::isInstanceOf($self, self::class);

        return $self;
    }
}
