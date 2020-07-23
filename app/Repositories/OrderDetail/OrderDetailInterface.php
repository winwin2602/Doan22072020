<?php
namespace App\Repositories\OrderDetail;

interface OrderDetailInterface
{
    public function getByOrderId($id);
}