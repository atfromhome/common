<?php declare(strict_types=1);

namespace FromHome\Common\Tests\Unit\Concerns;

use Mockery as m;
use PHPUnit\Framework\TestCase;
use Illuminate\Contracts\Container\Container;
use FromHome\Common\Concerns\ApplicationAware;
use Illuminate\Contracts\Foundation\Application;

final class ApplicationAwareTest extends TestCase
{
    public function testItCanReturnApplication()
    {
        $class = new class() {
            use ApplicationAware;
        };

        $app = m::mock(Application::class);
        $class->setApplication($app);

        $this->assertSame($app, $class->getApplication());
    }

    public function testItCanReturnContainerSameAsApplication()
    {
        $class = new class() {
            use ApplicationAware;
        };

        $app = m::mock(Application::class);
        $class->setApplication($app);

        $this->assertSame($app, $class->getContainer());
        $this->assertSame($class->getApplication(), $class->getContainer());
    }

    public function testItCanReturnContainerSameAsApplicationWhenContainerSet()
    {
        $class = new class() {
            use ApplicationAware;
        };

        $app = m::mock(Application::class);
        $class->setContainer($app);

        $this->assertSame($app, $class->getContainer());
        $this->assertSame($class->getApplication(), $class->getContainer());
    }

    public function testItCanReturnContainer()
    {
        $class = new class() {
            use ApplicationAware;
        };

        $app = m::mock(Container::class);
        $class->setContainer($app);

        $this->assertSame($app, $class->getContainer());
    }
}
