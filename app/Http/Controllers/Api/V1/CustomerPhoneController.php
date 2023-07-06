<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\CustomerPhoneRequests\StoreCustomerPhoneRequest;
use App\Http\Requests\V1\CustomerPhoneRequests\UpdateCustomerPhoneRequest;
use App\Http\Resources\V1\CustomerPhoneCollection;
use App\Http\Resources\V1\CustomerPhoneResource;
use App\Models\CustomerPhone;

class CustomerPhoneController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = CustomerPhone::all();

        return $this->successResponse('Customers\' phones retrived successfully. Number of resources: '.count($phones), new CustomerPhoneCollection($phones));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerPhoneRequest $request)
    {
        return $this->successResponse('Customer\'s phone created successfully', new CustomerPhoneResource(CustomerPhone::create($request->all())));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $phone = CustomerPhone::find($id);

        if(is_null($phone)){
            return response()->noContent();
        }

        return $this->successResponse('Customer\'s phone retrived successfully', new CustomerPhoneResource($phone));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerPhoneRequest $request, int $id)
    {
        $phone = CustomerPhone::find($id);

        if(is_null($phone)){
            return $this->errorResponse('Bad Request', 400);
        }

        $phone->update($request->all());
        return $this->successResponse('Customer\'s phone number updated successfully', new CustomerPhoneResource($phone));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $phone = CustomerPhone::find($id);

        if(is_null($phone)){
            return response()->noContent();
        }

        if($phone->delete()){
            return $this->successResponse('Customer\'s phone number deleted successfully', null);
        }
    }
}
