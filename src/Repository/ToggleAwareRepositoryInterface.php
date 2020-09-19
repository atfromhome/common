<?php

declare(strict_types=1);

namespace FromHome\Common\Repository;

use FromHome\Common\Model\ToggleAwareInterface;

interface ToggleAwareRepositoryInterface
{
    public function toggle(ToggleAwareInterface $model, bool $isActive): bool;
}
