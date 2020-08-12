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
    public function revenueByDay($date){
        $order_details = $this->_model::where('is_deleted', 0)->whereDate('created_at','=',$date)->with('products')->get();
        $revenue = 0;
        foreach ($order_details as $order_detail){
            if($order_detail->products['promotion_price']){
                $revenue += ($order_detail->quantity * $order_detail->products['promotion_price']);
            }else{
                $revenue += ($order_detail->quantity * $order_detail->products['price']);
            }
        }
        return $revenue;
    }
    public function revenueByWeek($date_from, $date_to)
    {
        $date_from = $date_from.' 00:00:00';
        $date_to = $date_to.' 00:00:00';
        $order_details = $this->_model::where('is_deleted', 0)->where([['created_at','>=',$date_from],['created_at','<=',$date_to]])->with('products')->get();
        $revenue = 0;
        foreach ($order_details as $order_detail){
            if($order_detail->products['promotion_price']){
                $revenue += ($order_detail->quantity * $order_detail->products['promotion_price']);
            }else{
                $revenue += ($order_detail->quantity * $order_detail->products['price']);
            }
        }
        return $revenue;
    }
    public function revenueByMonth($month)
    {
        $order_details = $this->_model::where('is_deleted', 0)->whereMonth('created_at','=',$month)->with('products')->get();
        $revenue = 0;
        foreach ($order_details as $order_detail){
            if($order_detail->products['promotion_price']){
                $revenue += ($order_detail->quantity * $order_detail->products['promotion_price']);
            }else{
                $revenue += ($order_detail->quantity * $order_detail->products['price']);
            }
        }
        return $revenue;
    }
}
