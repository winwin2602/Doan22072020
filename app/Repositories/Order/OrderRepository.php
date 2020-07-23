<?php
namespace App\Repositories\Order;

use App\Repositories\EloquentRepository;

class OrderRepository extends EloquentRepository implements OrderInterface
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Order::class;
    }

    public function getOrders(){
        return $this->_model::where('is_deleted', 0)->with('customers')->get();
    }

    public function getTotalOrder(){
        return $this->_model::where('is_deleted', 0)->get()->count();
    }
}