<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\TicketDetailRequests\StoreTicketDetailRequest;
use App\Http\Requests\V1\TicketDetailRequests\UpdateTicketDetailRequest;
use App\Http\Resources\V1\TicketDetailCollection;
use App\Http\Resources\V1\TicketDetailResource;
use App\Models\TicketDetail;

class TicketDetailController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticketDetails = TicketDetail::all();
        return $this->successResponse('Tickets details retrived successfully. Number of resources: '.count($ticketDetails), new TicketDetailCollection($ticketDetails));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketDetailRequest $request)
    {
        return $this->successResponse('Message created successfully', new TicketDetailResource(TicketDetail::create($request->all())));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticketDetail = TicketDetail::find($id);

        if(is_null($ticketDetail)){
            return $this->errorResponse("Resource not found");
        }

        return $this->successResponse('Ticket detail retrived successfully', new TicketDetailResource($ticketDetail));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketDetailRequest $request, string $id)
    {
        $ticketDetail = TicketDetail::find($id);

        if(is_null($ticketDetail)){
            return $this->errorResponse('No resource to update');
        }

        $ticketDetail->update($request->all());
        return $this->successResponse('Ticket detail updated successfully', new TicketDetailResource($ticketDetail));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticketDetail = TicketDetail::find($id);

        if(is_null($ticketDetail)){
            return response()->noContent();
        }

        if($ticketDetail->delete()){
            return response()->noContent();
        }
    }
}
