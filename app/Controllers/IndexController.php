<?php

namespace App\Controllers;

use App\Controllers\AbstractController;
use App\Repositories\GoodRepository;
use App\Repositories\PositionRepository;
use App\Repositories\UserRepository;
use App\Services\GoodService;
use App\Services\PositionService;
use App\Services\UserService;

class IndexController extends AbstractController
{
    public function index()
    {
        return $this->view('index');
    }
    
    public function firstTask()
    {
        $userService = new UserService(new UserRepository());
        $positionService = new PositionService(new PositionRepository());

        $users = $userService->getAllUsersWithPosition();
        $positions = $positionService->getAllPositions();

        return $this->view('first-task', compact('users', 'positions'));
    }
    
    public function secondTask()
    {
        $service = new GoodService(new GoodRepository());

        $goods = $service->getAllProductsWithFields();

        return $this->view('second-task', compact('goods'));
    }
}