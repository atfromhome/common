<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use FromHome\Common\Model\ModelInterface;
use FromHome\Common\Concerns\UuidPrimaryKey;
use FromHome\Common\Concerns\ModelUuidGetterSetter;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
abstract class Model extends Eloquent implements ModelInterface
{
    use UuidPrimaryKey;
    use ModelUuidGetterSetter;

    /**
     * @param mixed $value
     * @return $this
     */
    public function setUpdatedAt($value)
    {
        $this->setAttribute($this->getUpdatedAtColumn(), $value);

        return $this;
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function setCreatedAt($value)
    {
        $this->setAttribute($this->getCreatedAtColumn(), $value);

        return $this;
    }
}
