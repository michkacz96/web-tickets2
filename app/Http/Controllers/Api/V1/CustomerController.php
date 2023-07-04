<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){
        return Customer::all();
    }

    public function show(int $id){
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response()->noContent();
        }

        return $customer;
    }
}
