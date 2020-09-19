<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

use Ramsey\Uuid\UuidInterface;

interface ModelInterface
{
    public function getId(): ?UuidInterface;

    /**
     * @return mixed
     */
    public function setId(UuidInterface $uuid);
}
