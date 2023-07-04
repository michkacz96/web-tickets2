<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerRequests\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return new CustomerCollection(Customer::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id){
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response()->noContent();
        }

        return new CustomerResource($customer);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request){
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id){
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response()->noContent();
        }

        if($customer->delete()){
            return response('Resource deleted succesfully');
        }
    }
}
