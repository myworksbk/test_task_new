<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Validations\UserValidation;

class ApiUsersController extends AbstractController
{
    public function create()
    {
        $data = UserValidation::validate($_POST);

        $service = new UserService(new UserRepository());

        $id = $service->createUser($data);

        echo $id;
    }

    public function update()
    {
        $data = UserValidation::validate($_POST);

        $service = new UserService(new UserRepository());

        $service->updateUser($data);
    }

    public function delete()
    {
        $service = new UserService(new UserRepository());

        $service->deleteUser(@$_POST['id']);
    }
}