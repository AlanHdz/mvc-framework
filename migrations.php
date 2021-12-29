<?php
use Dotenv\Dotenv;
use App\Core\Application;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;


require_once __DIR__.'/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'driver' => $_ENV['DB_DRIVER'],
        'database' => $_ENV['DB_DATABASE'],
        'host' => $_ENV['DB_HOST'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];


$app = new Application(__DIR__, $config);

$app->db->capsule->setEventDispatcher(new Dispatcher(new Container));
$app->db->capsule->setAsGlobal();
$app->db->capsule->bootEloquent();

$app->db->applyMigrations();