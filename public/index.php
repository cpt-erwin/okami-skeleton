<?php

use Okami\Core\App;

require_once __DIR__ . '/../vendor/autoload.php';

// Initialize the superglobal variable $_ENV
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// Configure the app
$config = require __DIR__ . '/../src/config.php';
$app = new App(dirname(__DIR__), $config);

// Register events
$events = require __DIR__ . '/../src/events.php';
$events($app);

// Register routes
$routes = require __DIR__ . '/../src/routes.php';
$routes($app->router);

// Stat the application
$app->run();