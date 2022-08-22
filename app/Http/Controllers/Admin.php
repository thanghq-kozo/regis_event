<?php

namespace App\Http\Controllers;

use App\Services\AdminService;

class Admin extends Controller
{
    protected AdminService $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return $this->adminService->all();
    }

    public function store($attributes)
    {
        return $this->adminService->create($attributes);
    }
}
