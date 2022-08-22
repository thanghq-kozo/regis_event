<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class User extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->all();
    }

    public function store($attributes)
    {
        return $this->userService->create($attributes);
    }
}
