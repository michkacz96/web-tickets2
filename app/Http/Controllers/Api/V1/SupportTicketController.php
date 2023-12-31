<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\SupportTicketRequests\StoreSupportTicketRquest;
use App\Http\Requests\V1\SupportTicketRequests\UpdateSupportTicketRequest;
use App\Http\Resources\V1\SupportTicketCollection;
use App\Http\Resources\V1\SupportTicketResource;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class SupportTicketController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $includeTicketDetails = $request->query('includeDetails');

        $tickets = SupportTicket::select();

        if($includeTicketDetails){
            $tickets = $tickets->with('ticketDetails');
        }

        $tickets = $tickets->get();
        return $this->successResponse('Support tickets retrived successfully. Number of resources: '.count($tickets), new SupportTicketCollection($tickets));
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
    public function show(Request $request, int $id)
    {
        $includeTicketDetails = $request->query('includeDetails');

        $ticket = SupportTicket::where('id', $id);

        if(is_null($ticket->first())){
            return $this->errorResponse("Resource not found");
        }

        if($includeTicketDetails){
            $ticket = $ticket->with('ticketDetails');
        }

        $ticket = $ticket->first();
        return $this->successResponse('Support ticket retrived successfully', new SupportTicketResource($ticket));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupportTicketRequest $request, int $id)
    {
        $ticket = SupportTicket::find($id);

        if(is_null($ticket)){
            return $this->errorResponse('No resource to update');
        }

        $ticket->update($request->all());
        return $this->successResponse('Support ticket updated successfully', new SupportTicketResource($ticket));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $ticket = SupportTicket::find($id);

        if(is_null($ticket)){
            return response()->noContent();
        }

        if($ticket->delete()){
            return response()->noContent();
        }
    }
}
