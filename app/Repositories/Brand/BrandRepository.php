<?php
namespace App\Repositories\Brand;

use App\Repositories\EloquentRepository;

class BrandRepository extends EloquentRepository implements BrandInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Brand::class;
    }

    /**
     * Get 5 brand
     * @return mixed
     */
    public function getTopBrand($top)
    {
        return $this->_model::where('is_deleted', 0)->take($top)->get();
    }
    
}