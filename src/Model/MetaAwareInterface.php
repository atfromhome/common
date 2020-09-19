<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

interface MetaAwareInterface
{
    public function getMeta(): array;

    /**
     * @return mixed
     */
    public function setMeta(array $value);
}
