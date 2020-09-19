<?php

declare(strict_types=1);

namespace FromHome\Common\Tests\Unit\Concerns;

use BadMethodCallException;
use PHPUnit\Framework\TestCase;
use FromHome\Common\Concerns\ModelDisableGetSetMethod;

final class ModelDisableGetSetMethodTest extends TestCase
{
    public function testItThrowExceptionWhenGet(): void
    {
        $this->expectException(BadMethodCallException::class);
        $class = new class() {
            use ModelDisableGetSetMethod;
        };

        $class->value;
    }

    public function testItThrowExceptionWhenSet(): void
    {
        $this->expectException(BadMethodCallException::class);
        $class = new class() {
            use ModelDisableGetSetMethod;
        };

        $class->value = 'Foo Bar';
    }
}
