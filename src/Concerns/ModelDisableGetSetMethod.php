<?php

declare(strict_types=1);

namespace FromHome\Common\Concerns;

use BadMethodCallException;

trait ModelDisableGetSetMethod
{
    public function __get($name): void
    {
        throw new BadMethodCallException('Call using magic __get is not allowed, using getAttribute instead.');
    }

    public function __set($name, $value): void
    {
        throw new BadMethodCallException('Call using magic __set is not allowed, using setAttribute instead.');
    }
}
