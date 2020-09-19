<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

interface ModelEventInterface
{
    /**
     * @return ModelInterface
     */
    public function getModel();
}
