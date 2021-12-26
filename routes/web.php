<?php

use App\Controllers\AuthController;


//Auth
$app->router->get('/login', [new AuthController(), 'login']);
$app->router->post('/login', [new AuthController(), 'login']);

$app->router->get('/register', [new AuthController(), 'register']);
$app->router->post('/register', [new AuthController(), 'register']);