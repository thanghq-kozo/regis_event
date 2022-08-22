<?php

namespace App\Repositories\Inventory;

use App\Entities\Inventory;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
/**
 * Class InventoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InventoryRepositoryEloquent extends BaseRepository implements InventoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Inventory::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function search($string): Collection|array
    {
        return $this->model->where('product_name', 'like', '%' . $string . '%')->get();
    }
}
