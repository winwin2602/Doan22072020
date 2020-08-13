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
        $productsHaveNotPromotionPrice = $products->whereNull('promotion_price');
        $productsHavePromotionPrice = $products->whereNotNull('promotion_price');
        $arr = array();
        if($productsHaveNotPromotionPrice){
            if($min != null){
                if ($max != null){
                    $productsHaveNotPromotionPrice = $productsHaveNotPromotionPrice->whereBetween('price', [$min, $max]);
                }else{
                    $productsHaveNotPromotionPrice = $productsHaveNotPromotionPrice->where('price','>=',$min);
                }
            }elseif ($max != null){
                $productsHaveNotPromotionPrice = $productsHaveNotPromotionPrice->where('price','<=',$max);
            }else{
                $productsHaveNotPromotionPrice = $productsHaveNotPromotionPrice;
            }
            foreach ($productsHaveNotPromotionPrice as $product){
                $arr[] = $product;
            }
        }
        if($productsHavePromotionPrice){
            if($min != null){
                if ($max != null){
                    $productsHavePromotionPrice = $productsHavePromotionPrice->whereBetween('promotion_price', [$min, $max]);
                }else{
                    $productsHavePromotionPrice = $productsHavePromotionPrice->where('promotion_price','>=',$min);
                }
            }elseif ($max != null){
                $productsHavePromotionPrice = $productsHavePromotionPrice->where('promotion_price','<=',$max);

            }else{
                $productsHavePromotionPrice = $productsHavePromotionPrice;
            }
            foreach ($productsHavePromotionPrice as $product){
                $arr[] = $product;
            }
        }
        return $arr;
    }

}
