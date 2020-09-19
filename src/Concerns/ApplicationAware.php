<?php

declare(strict_types=1);

namespace FromHome\Common\Concerns;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Foundation\Application;

trait ApplicationAware
{
    protected Application $app;

    protected Container $container;

    public function getApplication(): Application
    {
        return $this->app;
    }

    public function setApplication(Application $application): void
    {
        $this->app = $application;

        $this->container = $application;
    }

    public function getContainer(): Container
    {
        return $this->container;
    }

    public function setContainer(Container $container): void
    {
        $this->container = $container;

        if ($container instanceof Application) {
            $this->app = $container;
        }
    }
}
