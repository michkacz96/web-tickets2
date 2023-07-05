<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\CustomerRequests\StoreCustomerRequest;
use App\Http\Requests\V1\CustomerRequests\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        $includeEmails = $request->query('includeEmails');

        $customers = Customer::select();

        if($includeEmails){
            $customers = $customers->with('emails');
        }

        $customers = $customers->get();
        return $this->successResponse('Customers retrived successfully. Number of resources: '.count($customers), new CustomerCollection($customers));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id){
        if(is_null(Customer::find($id))){
            return response()->noContent();
        }

        $customer = Customer::where('id', $id);
        $includeEmails = $request->query('includeEmails');

        if($includeEmails){
            $customer = $customer->with('emails');
        }

        $customer = $customer->first();
        return $this->successResponse('Customer retrived successfully', new CustomerResource($customer));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request){
        return $this->successResponse('Customer created successfully', new CustomerResource(Customer::create($request->all())));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, int $id){
        $customer = Customer::find($id);

        if(is_null($customer)){
            return $this->errorResponse('Bad Request', 400);
        }

        $customer->update($request->all());
        return $this->successResponse('Customer updated successfully', new CustomerResource($customer));
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
