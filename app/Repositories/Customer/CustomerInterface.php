<?php
namespace App\Repositories\Customer;

interface CustomerInterface
{
    public function getCustomerByUserId($id);
}