<?php
namespace App\Repositories\OrderDetail;

use App\Repositories\EloquentRepository;

class OrderDetailRepository extends EloquentRepository implements OrderDetailInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\OrderDetail::class;
    }
    public function getByOrderId($id){
        return $this->_model::where('order_id', $id)->where('is_deleted', 0)->with('products')->get();
    }
}