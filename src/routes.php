<?php

use App\Controllers\AuthController;
use App\Controllers\SiteController;

return function (\Okami\Core\Routing\Router $router)
{
    $router->get('/', [SiteController::class, 'home']);

    $router->get('/contact', [SiteController::class, 'contact']);
    $router->post('/contact', [SiteController::class, 'contact']);

    $router->get('/login', [AuthController::class, 'login']);
    $router->post('/login', [AuthController::class, 'login']);

    $router->get('/register', [AuthController::class, 'register']);
    $router->post('/register', [AuthController::class, 'register']);

    $router->get('/logout', [AuthController::class, 'logout']);

    $router->get('/profile', [AuthController::class, 'profile'])->withMiddleware(\Okami\Core\Middlewares\AuthMiddleware::class);
};