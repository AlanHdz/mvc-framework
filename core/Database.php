<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{

    public Capsule $capsule;

    public function __construct(array $config) 
    {
        $this->capsule = new Capsule;
        $this->capsule->addConnection([
            'driver' => $config['driver'],
            'host' => $config['host'],
            'database' => $config['database'],
            'username' => $config['user'],
            'password' => $config['password'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]);
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigrations = [];
        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        foreach ($toApplyMigrations as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className();
            $this->log("Applying migration $migration");
            $instance->up($this->capsule);
            $this->log("Applied migration $migration");
            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            echo $this->log("All migrations are applied");
        }
    }

    public function createMigrationsTable()
    {
        if (!$this->capsule::schema()->hasTable('migrations')) {
            $this->capsule::schema()->create('migrations', function ($table) {
                $table->increments('id');
                $table->string('migration')->unique();
                $table->timestamps();
            });
        }
    }

    public function getAppliedMigrations()
    {
        $migrations = $this->capsule::table('migrations')
            ->select("migration")->pluck('migration')->toArray();
        return $migrations;
    }

    public function saveMigrations(array $migrations)
    {
        for ($i=0; $i < count($migrations); $i++) { 
            $this->capsule::insert("INSERT INTO migrations (migration) VALUES (?)", [$migrations[$i]]);
        }
    }

    protected function log($message)
    {
        echo '['.date('Y-m-d H:i:s').'] - ' . $message . PHP_EOL;
    }
}