<?php

namespace FeatureMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFeatureCommand extends Command
{
    protected $signature = 'make:feature {name}';
    protected $description = 'Gera uma feature completa com base nos stubs';

    public function handle(): void
    {
        $name = Str::studly($this->argument('name'));
        $basePath = app_path("Features/{$name}");

        if (File::exists($basePath)) {
            $this->error("A feature '{$name}' já existe.");
            return;
        }

        File::makeDirectory($basePath . '/Controllers', 0755, true);
        File::makeDirectory($basePath . '/Models', 0755, true);
        File::makeDirectory($basePath . '/Requests', 0755, true);
        File::makeDirectory($basePath . '/Resources', 0755, true);
        File::makeDirectory($basePath . '/Migrations', 0755, true);

        $tableName = Str::snake(Str::pluralStudly($name));

        $this->generateFromStub('model', "$basePath/Models/{$name}.php", $name, $tableName);
        $this->generateFromStub('controller', "$basePath/Controllers/{$name}Controller.php", $name, $tableName);
        $this->generateFromStub('store-request', "$basePath/Requests/Store{$name}Request.php", $name, $tableName);
        $this->generateFromStub('update-request', "$basePath/Requests/Update{$name}Request.php", $name, $tableName);
        $this->generateFromStub('resource', "$basePath/Resources/{$name}Resource.php", $name, $tableName);
        $this->generateFromStub('collection', "$basePath/Resources/{$name}Collection.php", $name, $tableName);

        $migrationFile = date('Y_m_d_His') . '_create_' . $tableName + '_table.php';
        $this->generateFromStub('migration', "$basePath/Migrations/{$migrationFile}", $name, $tableName);

        $this->info("Feature '{$name}' criada com sucesso!");
    }

    protected function generateFromStub(string $stubName, string $destination, string $name, string $tableName): void
    {
        $stubPath = __DIR__ . "/../stubs/{$stubName}.stub";
        $stub = file_get_contents($stubPath);

        $content = str_replace(
            ['{{ name }}', '{{ name_lower }}', '{{ table_name }}'],
            [$name, Str::camel($name), $tableName],
            $stub
        );

        file_put_contents($destination, $content);
    }
}