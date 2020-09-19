<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use Illuminate\Contracts\Events\Dispatcher;
use FromHome\Common\Repository\ModelRepositoryInterface;

abstract class Repository implements ModelRepositoryInterface
{
    protected Dispatcher $event;

    public function __construct(Dispatcher $event)
    {
        $this->event = $event;
    }
}
