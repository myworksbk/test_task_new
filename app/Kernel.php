<?php

namespace App;

use App\Router;
use App\Middleware\CORSMiddleware;

class Kernel
{
    private string $routePath = '../routes/web.php';

    public function handleRequest()
    {
        $middleware = new CORSMiddleware();

        $middleware->handle();
        
        $router = new Router();

        $router->load($this->routePath);

        $router->dispatch();
    }
}