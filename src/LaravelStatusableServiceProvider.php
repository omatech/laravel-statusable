<?php

namespace Omatech\LaravelStatusable;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class LaravelStatusableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $status = __DIR__ . '/database/create_status_table.php.stub';
        $statusHistory = __DIR__ . '/database/create_status_history_table.php.stub';
        $this->publishes([
            $status => $this->getMigrationFileName(new Filesystem(), 'create_status_table'),
            $statusHistory => $this->getMigrationFileName(new Filesystem(), 'create_status_history_table'),
        ], 'laravel-statusable-publish');
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }

    /**
     * Returns existing migration file if found, else uses the current timestamp.
     *
     * @param Filesystem $filesystem
     * @param string $fileName
     * @return string
     */
    private function getMigrationFileName(Filesystem $filesystem, string $fileName): string
    {
        $timestamp = date('Y_m_d_His');
        return Collection::make($this->app->databasePath() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR)
            ->flatMap(function ($path) use ($filesystem, $fileName) {
                return $filesystem->glob($path . "*_{$fileName}.php");
            })->push($this->app->databasePath() . "/migrations/{$timestamp}_{$fileName}.php")
            ->first();
    }
}
