<?php

declare(strict_types=1);

namespace FromHome\Common\Model;

interface ModelBuilderInterface
{
    /**
     * @return mixed
     */
    public function makeFromArray(ModelInterface $model, array $attributes);
}
