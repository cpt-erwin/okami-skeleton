<?php

namespace Okami\Core;

use Okami\Core\Middlewares\Middleware;

/**
 * Class Controller
 *
 * @author Michal Tuček <michaltk1@gmail.com>
 * @package Okami\Core
 */
class Controller
{
    private string $layout = 'main';
    public string $action = '';


    /**
     * @var Middleware[]
     */
    protected array $middlewares = [];

    public function render(string $view, array $params = [])
    {
        return App::$app->view->renderView($view, $params);
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function registerMiddleware(Middleware $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}