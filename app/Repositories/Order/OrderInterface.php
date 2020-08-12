<?php
namespace App\Repositories\Order;

interface OrderInterface
{
    public function getOrders();
    public function getTotalOrder();
}
