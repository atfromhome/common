<?php

declare(strict_types=1);

namespace FromHome\Common\Abstracts;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

abstract class ServiceProvider extends LaravelServiceProvider
{
    protected function getMigrationFileName(string $fileName): string
    {
        $timestamp = date('Y_m_d_His');

        return $this->app->databasePath() . "/migrations/{$timestamp}_{$fileName}";
    }
}
