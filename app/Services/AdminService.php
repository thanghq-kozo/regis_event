<?php

namespace App\Services;

/**
 * @method where(string $string, $id)
 */
class AdminService
{
    protected AdminService $adminRepository;

    public function __construct(AdminService $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function all()
    {
        return $this->adminRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->adminRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->adminRepository->update($attributes, $id);
    }

    public function delete($id)
    {
        return $this->adminRepository->delete($id);
    }
}
