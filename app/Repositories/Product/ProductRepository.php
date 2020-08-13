<?php
namespace App\Repositories\Product;

use App\Repositories\EloquentRepository;

class ProductRepository extends EloquentRepository implements ProductInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Product::class;
    }

    /**
     * Get 5 brand
     * @return mixed
     */
    public function getProduct()
    {
        return $this->_model::where('is_hot', 1)->where('quantity','>',0)->take(5)->get();
    }

    public function getTopHotProduct($top){
        return $this->_model::where('is_hot', 1)->where('is_deleted', 0)->where('quantity','>',0)->take($top)->get();
    }

    public function getTopNewProduct($top){
        return $this->_model::where('is_new', 1)->where('is_deleted', 0)->where('quantity','>',0)->take($top)->get();
    }

    public function getTopSaleProduct($top){
        return $this->_model::where('promotion_price', '!=', null)->where('is_deleted', 'false')->where('quantity','>',0)->take($top)->get();
    }
    public function getTotalProduct(){
        return $this->_model::where('is_deleted', 0)->where('quantity','>',0)->get()->count();
    }
    public function getByCategoryId($id){
        return $this->_model::where('is_deleted', 0)->where('category_id', $id)->where('quantity','>',0)->get();
    }
    public function getByBrandId($id){
        return $this->_model::where('is_deleted', 0)->where('brand_id', $id)->where('quantity','>',0)->get();
    }
    public function getByKeyword($keyword){
        return $this->_model::where('is_deleted', 0)->where('name', 'like', '%'.$keyword.'%')->where('quantity','>',0)->get();
    }
    public function getByPrice($min, $max){
        $products = $this->_model::where('is_deleted', 0)->where('quantity','>',0)->get();
        if($products->whereNull('promotion_price')){
            $products = $products->whereNull('promotion_price');
            if($min != null){
                if ($max != null){
                    $products = $products->where([['price','>=',$min],['price','<=',$max]])->get();
                }else{
                    $products = $products->where('price','>=',$min);
                }
            }elseif ($max != null){
                $products = $products->where('price','<=',$max)->get();
            }
        }else{
            $products = $products->whereNotNull('promotion_price');
            if($min != null){
                if ($max != null){
                    $products = $products->where([['promotion_price','>=',$min],['promotion_price','<=',$max]])->get();
                }else{
                    $products = $products->where('promotion_price','>=',$min)->get();
                }
            }elseif ($max != null){
                $products = $products->where('promotion_price','<=',$max)->get();
            }
        }
        return $products;
    }
}
