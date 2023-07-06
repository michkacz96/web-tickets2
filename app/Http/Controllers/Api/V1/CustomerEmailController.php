<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\CustomerEmailRequests\StoreCustomerEmailRequest;
use App\Http\Requests\V1\CustomerEmailRequests\UpdateCustomerEmailRequest;
use App\Http\Resources\V1\CustomerEmailCollection;
use App\Http\Resources\V1\CustomerEmailResource;
use App\Models\CustomerEmail;

class CustomerEmailController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = CustomerEmail::all();

        return $this->successResponse('Customers\' emails retrived successfully. Number of resources: '.count($emails), new CustomerEmailCollection($emails));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerEmailRequest $request)
    {
        return $this->successResponse('Customer\'s email created successfully', new CustomerEmailResource(CustomerEmail::create($request->all())));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $email = CustomerEmail::find($id);

        if(is_null($email)){
            return response()->noContent();
        }

        return $this->successResponse('Customer\'s email retrived successfully', new CustomerEmailResource($email));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerEmailRequest $request, int $id)
    {
        $email = CustomerEmail::find($id);

        if(is_null($email)){
            return $this->errorResponse('Bad Request', 400);
        }

        $email->update($request->all());
        return $this->successResponse('Customer\'s email updated successfully', new CustomerEmailResource($email));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $email = CustomerEmail::find($id);

        if(is_null($email)){
            return response()->noContent();
        }

        if($email->delete()){
            return $this->successResponse('Customer\'s email deleted successfully', null);
        }
    }
}
