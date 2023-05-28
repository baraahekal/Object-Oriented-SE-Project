<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var \app\core\middlewares\BaseMiddleware[]
     **/
    protected array $middleWares = [];
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function registerMiddleWare(BaseMiddleware $middleware)
    {
        $this->middleWares[] = $middleware;
    }

    /**
     * @return array
     */
    public function getMiddleWares(): array
    {
        return $this->middleWares;
    }



}