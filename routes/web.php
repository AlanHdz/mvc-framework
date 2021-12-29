<?php

use App\Controllers\AuthController;
use App\Controllers\SiteController;


//Auth
$app->router->get('/', [new SiteController, 'index']);
$app->router->get('/login', [new AuthController(), 'login']);
$app->router->post('/login', [new AuthController(), 'loginPost']);

$app->router->get('/register', [new AuthController(), 'register']);
$app->router->post('/register', [new AuthController(), 'registerPost']);