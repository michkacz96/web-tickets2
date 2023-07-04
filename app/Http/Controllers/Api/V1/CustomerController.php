<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\CustomerRequests\StoreCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;

class CustomerController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $customers = Customer::all();

        return $this->successResponse('Customers retrived successfully. Number of resources: '.count($customers), new CustomerCollection($customers));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id){
        $customer = Customer::find($id);

        if(is_null($customer)){
            return response()->noContent();
        }

        return $this->successResponse('Customer retrived successfully', new CustomerResource($customer));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request){
        return $this->successResponse('Customer created successfully', new CustomerResource(Customer::create($request->all())));
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
            return $this->successResponse('Customer deleted successfully', null);
        }
    }
}
