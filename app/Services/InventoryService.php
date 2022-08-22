<?php

namespace App\Services;

use App\Repositories\Inventory\InventoryRepository;

class InventoryService
{
    protected InventoryRepository $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    public function all()
    {
        return $this->inventoryRepository->all();
    }

    public function create(array $attributes)
    {
        return $this->inventoryRepository->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        return $this->inventoryRepository->update($attributes, $id);
    }

    public function delete(array $ids)
    {
        return $this->inventoryRepository->whereIn('id', $ids)->delete();
    }

    public function search($string)
    {
        return $this->inventoryRepository->search($string);
    }
}
