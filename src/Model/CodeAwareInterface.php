<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

interface CodeAwareInterface extends ModelInterface
{
    public function getCode(): string;

    /**
     * @return mixed
     */
    public function setCode(string $code);
}
