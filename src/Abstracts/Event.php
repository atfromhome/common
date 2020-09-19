<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use Illuminate\Queue\SerializesModels;
use FromHome\Common\Model\ModelEventInterface;

abstract class Event implements ModelEventInterface
{
    use SerializesModels;
}
