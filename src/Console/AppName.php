<?php

declare(strict_types=1);

namespace FromHome\Common\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Composer;
use Symfony\Component\Finder\Finder;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

final class AppName extends Command
{
    /**
     * @var string
     */
    protected $name = 'app:name';

    /**
     * @var string
     */
    protected $description = 'Set the application namespace';

    protected Composer $composer;

    protected Filesystem $files;

    protected string $currentRoot;

    public function __construct(Composer $composer, Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
        $this->composer = $composer;
    }

    public function handle(): void
    {
        $this->currentRoot = trim($this->laravel->getNamespace(), '\\');

        $this->setAppDirectoryNamespace();
        $this->setBootstrapNamespaces();
        $this->setConfigNamespaces();
        $this->setComposerNamespace();
        $this->setDatabaseFactoryNamespaces();

        $this->info('Application namespace set!');

        $this->composer->dumpAutoloads();

        $this->call('optimize:clear');
    }

    protected function setAppDirectoryNamespace(): void
    {
        $files = Finder::create()
            ->in($this->laravel['path'])
            ->contains($this->currentRoot)
            ->name('*.php');

        foreach ($files as $file) {
            $this->replaceNamespace($file->getRealPath());
        }
    }

    protected function replaceNamespace(string $path): void
    {
        $search = [
            'namespace ' . $this->currentRoot . ';',
            $this->currentRoot . '\\',
        ];

        $replace = [
            'namespace ' . $this->argument('name') . ';',
            $this->argument('name') . '\\',
        ];

        $this->replaceIn($path, $search, $replace);
    }

    protected function setBootstrapNamespaces(): void
    {
        $search = [
            $this->currentRoot . '\\Http',
            $this->currentRoot . '\\Console',
            $this->currentRoot . '\\Exceptions',
        ];

        $replace = [
            $this->argument('name') . '\\Http',
            $this->argument('name') . '\\Console',
            $this->argument('name') . '\\Exceptions',
        ];

        $this->replaceIn($this->getBootstrapPath(), $search, $replace);
    }

    protected function setConfigNamespaces(): void
    {
        $this->setAppConfigNamespaces();
        $this->setAuthConfigNamespace();
        $this->setServicesConfigNamespace();
    }

    protected function setAppConfigNamespaces(): void
    {
        $search = [
            $this->currentRoot . '\\Providers',
            $this->currentRoot . '\\Http\\Controllers\\',
        ];

        $replace = [
            $this->argument('name') . '\\Providers',
            $this->argument('name') . '\\Http\\Controllers\\',
        ];

        $this->replaceIn($this->getConfigPath('app'), $search, $replace);
    }

    protected function setAuthConfigNamespace(): void
    {
        $this->replaceIn(
            $this->getConfigPath('auth'),
            $this->currentRoot . '\\User',
            $this->argument('name') . '\\User'
        );
    }

    protected function setServicesConfigNamespace(): void
    {
        $this->replaceIn(
            $this->getConfigPath('services'),
            $this->currentRoot . '\\User',
            $this->argument('name') . '\\User'
        );
    }

    protected function setComposerNamespace(): void
    {
        $this->replaceIn(
            $this->getComposerPath(),
            str_replace('\\', '\\\\', $this->currentRoot) . '\\\\',
            str_replace('\\', '\\\\', $this->argument('name')) . '\\\\'
        );
    }

    protected function setDatabaseFactoryNamespaces(): void
    {
        $files = Finder::create()
            ->in(database_path('factories'))
            ->contains($this->currentRoot)
            ->name('*.php');

        foreach ($files as $file) {
            $this->replaceIn(
                $file->getRealPath(),
                $this->currentRoot, $this->argument('name')
            );
        }
    }

    /**
     * @param string|array $search
     * @param string|array $replace
     * @noinspection PhpDocMissingThrowsInspection
     */
    protected function replaceIn(string $path, $search, $replace): void
    {
        if ($this->files->exists($path)) {
            /** @noinspection PhpUnhandledExceptionInspection */
            $this->files->put($path, str_replace($search, $replace, $this->files->get($path)));
        }
    }

    protected function getBootstrapPath(): string
    {
        return $this->laravel->bootstrapPath() . '/app.php';
    }

    protected function getComposerPath(): string
    {
        return base_path('composer.json');
    }

    protected function getConfigPath(string $name): string
    {
        return $this->laravel['path.config'] . '/' . $name . '.php';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The desired namespace'],
        ];
    }
}
