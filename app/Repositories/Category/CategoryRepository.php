<?php
namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;

class CategoryRepository extends EloquentRepository implements CategoryInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\ProductCategory::class;
    }

    /**
     * Get 5 brand
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_model::take(5)->get();
    }
    
}