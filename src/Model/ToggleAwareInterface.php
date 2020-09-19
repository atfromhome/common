<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

interface ToggleAwareInterface
{
    public function isActive(): bool;

    /**
     * @return mixed
     */
    public function setIsActive(bool $isActive);
}
