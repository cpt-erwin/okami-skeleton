<?php

namespace Okami\Core;

/**
 * Class Router
 *
 * @author Michal Tuček <michaltk1@gmail.com>
 * @package Okami\Core
 */
class Router
{
    public Request $request;
    public Response $response;
    public array $routes = [];

    /**
     * Router constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post(string $path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        if (is_array($callback)) {
            App::$app->setController(new $callback[0]()); // create instance of passed controller
            $callback[0] = App::$app->getController();
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView(string $view, array $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderContent(string $viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        $layout = App::$app->layout;
        if (App::$app->getController()) {
            $layout = App::$app->getController()->getLayout();
        }
        ob_start(); // This will stop everything from being displays but still buffers it
        /** @noinspection PhpIncludeInspection */
        include_once App::$ROOT_DIR . "/views/layouts/$layout.phtml";
        return ob_get_clean(); // Returns the content of the "display" buffer
    }

    protected function renderOnlyView(string $view, array $params)
    {
        foreach ($params as $param => $value) {
            $$param = $value; // If $param can be used as a variable name, then created one and fill it with the value
        }
        ob_start(); // This will stop everything from being displays but still buffers it
        /** @noinspection PhpIncludeInspection */
        include_once App::$ROOT_DIR . "/views/$view.phtml";
        return ob_get_clean(); // Returns the content of the "display" buffer
    }
}