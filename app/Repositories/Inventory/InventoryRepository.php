<?php

namespace App\Repositories\Inventory;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface InventoryRepository.
 *
 * @package namespace App\Repositories;
 */
interface InventoryRepository extends RepositoryInterface
{
    public function search($string);
}
