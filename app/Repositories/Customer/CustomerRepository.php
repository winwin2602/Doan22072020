<?php
namespace App\Repositories\Customer;
use App\Repositories\EloquentRepository;

class CustomerRepository extends EloquentRepository implements CustomerInterface{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Customer::class;
    }

    public function getCustomerByUserId($id){
        return $this->_model::where('user_id', $id)->where('is_deleted', 0)->get()->first();
    }
}
