<?php

return [
    '/' => [
        'method' => 'GET',
        'controller' => 'IndexController@index',
    ],
    '/first-task' => [
        'method' => 'GET',
        'controller' => 'IndexController@firstTask',
    ],
    '/second-task' => [
        'method' => 'GET',
        'controller' => 'IndexController@secondTask',
    ],
    '/api/users/create' => [
        'method' => 'POST',
        'controller' => 'ApiUsersController@create',
        'middleware' => ['ApiAuthMiddleware'],
    ],
    '/api/users/update' => [
        'method' => 'POST',
        'controller' => 'ApiUsersController@update',
        'middleware' => ['ApiAuthMiddleware'],
    ],
    '/api/users/delete' => [
        'method' => 'POST',
        'controller' => 'ApiUsersController@delete',
        'middleware' => ['ApiAuthMiddleware'],
    ],
];
