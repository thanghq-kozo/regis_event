<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|required_with:confirm_password',
            'confirm-password' => 'required|min:6|required_with:password|same:password',
            'name' => 'required|string',
        ]);
        $data = [
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'name' => $request['name'],
        ];
        return $this->adminService->create($data);
    }
}
