<?php

namespace Alexandresafarpaim\FeatureMaker;

use Illuminate\Support\ServiceProvider;

class FeatureMakerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadFeatureMigrations();

            $this->commands([
                \FeatureMaker\Commands\MakeFeatureCommand::class,
            ]);
        }
    }

    protected function loadFeatureMigrations(): void
    {
        $featuresPath = app_path('Features');

        if (!is_dir($featuresPath)) return;

        foreach (scandir($featuresPath) as $featureDir) {
            $migrationsPath = "$featuresPath/{$featureDir}/Migrations";
            if ($featureDir !== '.' && $featureDir !== '..' && is_dir($migrationsPath)) {
                $this->loadMigrationsFrom($migrationsPath);
            }
        }
    }
}