<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\SupportTicketRequests\StoreSupportTicketRquest;
use App\Http\Resources\V1\SupportTicketCollection;
use App\Http\Resources\V1\SupportTicketResource;
use App\Models\SupportTicket;

class SupportTicketController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = SupportTicket::all();
        return $this->successResponse('Ticket categories retrived successfully. Number of resources: '.count($tickets), new SupportTicketCollection($tickets));
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
    public function show(int $id)
    {
        $ticket = SupportTicket::find($id);

        if(is_null($ticket)){
            return $this->errorResponse("Resource not found");
        }

        return $this->successResponse('Ticket retrived successfully', new SupportTicketResource($ticket));
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
