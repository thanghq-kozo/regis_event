<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'first_name_surname' => 'required|string',
            'last_name_surname' => 'required|string',
            'gender' => 'required|numeric',
            'phone' => 'required|numeric|digits:10',
            'hobby' => 'required|string',
            'address' => 'required|string',
        ]);
        $id = $request['id'];
        $data = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'first_name_surname' => $request['first_name_surname'],
            'last_name_surname' => $request['last_name_surname'],
            'gender' => $request['gender'],
            'phone' => $request['phone'],
            'hobby' => $request['hobby'],
            'address' => $request['address'],
        ];
        return $this->userService->update($data, $id);
    }
}
