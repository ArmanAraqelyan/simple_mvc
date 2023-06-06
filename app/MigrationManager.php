<?php

namespace App;

class MigrationManager
{
    private array $executedMigrations;

    public function __construct()
    {
        $this->executedMigrations = $this->getExecutedMigrations();
    }

    public function migrate(): void
    {
        $migrationFiles = $this->getMigrationFiles();

        foreach ($migrationFiles as $migrationFile) {
            $migration = $this->instantiateMigration($migrationFile);

            if (!$this->isMigrationExecuted($migration)) {
                $migration->up();
                $this->markMigrationAsExecuted($migration);
            }
        }
    }

    public function rollback(): void
    {
        $migrationFiles = array_reverse($this->getMigrationFiles());

        foreach ($migrationFiles as $migrationFile) {
            $migration = $this->instantiateMigration($migrationFile);

            if ($this->isMigrationExecuted($migration)) {
                $migration->down();
                $this->markMigrationAsNotExecuted($migration);
            }
        }
    }

    private function getMigrationFiles(): array
    {
        $migrationFiles = [];

        $files = scandir(__DIR__ . '/Migrations');

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $migrationFiles[] = __DIR__ . '/Migrations/' . $file;
            }
        }

        return $migrationFiles;
    }

    private function instantiateMigration($migrationFile)
    {
        require_once $migrationFile;

        $migrationClassName = basename($migrationFile, '.php');
        return new $migrationClassName();
    }

    private function isMigrationExecuted($migration): bool
    {
        return in_array(get_class($migration), $this->executedMigrations);
    }

    private function markMigrationAsExecuted($migration): void
    {
        $this->executedMigrations[] = get_class($migration);
        $this->saveExecutedMigrations();
    }

    private function markMigrationAsNotExecuted($migration): void
    {
        $key = array_search(get_class($migration), $this->executedMigrations);
        unset($this->executedMigrations[$key]);
        $this->saveExecutedMigrations();
    }

    private function getExecutedMigrations(): array
    {
        return [
        ];
    }

    private function saveExecutedMigrations()
    {
        // Save the list of executed Migrations to a storage (e.g., a database table)
        // You can use the $this->executedMigrations array to update the storage
    }
}
