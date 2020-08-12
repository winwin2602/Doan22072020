<?php
namespace App\Repositories\OrderDetail;

interface OrderDetailInterface
{
    public function getByOrderId($id);
    public function revenueByDay($date);
    public function revenueByWeek($date_from,$date_to);
    public function revenueByMonth($month);
}
