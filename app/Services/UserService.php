<?php

namespace App\Services;

use App\Repositories\User\UserRepository;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all()
    {
        return $this->userRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->userRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->userRepository->update($attributes, $id);
    }

    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }

    public function getUserById($id)
    {
        return $this->userRepository->where('id', $id)->get();
    }
}
