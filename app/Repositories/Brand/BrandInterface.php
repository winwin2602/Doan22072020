<?php
namespace App\Repositories\Brand;

interface BrandInterface
{
    /**
     * Get 5 brand
     * @return mixed
     */
    public function getTopBrand($top);
}