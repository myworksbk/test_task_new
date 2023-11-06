<?php

namespace App\Controllers;

abstract class AbstractController
{
    protected function view(string $viewName, array $data = []): void
    {
        extract($data);

        include_once ROOT_PATH . '/views/' . $viewName . '.php';
    }
}
