<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

abstract class FormRequest extends BaseFormRequest
{
    abstract public function rules(): array;

    abstract public function extractAttributes(): array;

    /**
     * @param mixed $default
     * @return mixed
     *
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function config(string $key, $default = null)
    {
        /** @var Repository $config */
        $config = $this->container->make(Repository::class);

        return $config->get($key, $default);
    }
}
