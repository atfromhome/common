<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

use Illuminate\Contracts\Container\Container;

interface ContainerAwareInterface
{
    public function getContainer(): Container;

    /**
     * @return mixed
     */
    public function setContainer(Container $container);
}
