<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\SupportTicketRequests\StoreSupportTicketRquest;
use App\Http\Resources\V1\SupportTicketResource;
use App\Models\SupportTicket;

class SupportTicketController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupportTicketRquest $request)
    {
        return $this->successResponse('Support ticket created successfully', new SupportTicketResource(SupportTicket::create($request->all())));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
