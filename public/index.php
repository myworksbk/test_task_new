<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

define('ROOT_PATH', __DIR__ . '/..');
define('ERROR_LOG', ROOT_PATH . '/logs/errors.log');

try {
    $kernel = new \App\Kernel();

    $kernel->handleRequest();
} catch (\Throwable $th) {
    $content = date('m-d H:i:s') . ' | ' . $th->getMessage() . PHP_EOL;

    file_put_contents(ERROR_LOG, $content, FILE_APPEND);

    http_response_code(403);
}

