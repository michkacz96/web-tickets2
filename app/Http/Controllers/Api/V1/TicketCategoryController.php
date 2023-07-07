<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\BaseApiController;
use App\Http\Requests\V1\TicketCategoryRequests\StoreTicketCategoryRequest;
use App\Http\Requests\V1\TicketCategoryRequests\UpdateTicketCategoryRequest;
use App\Http\Resources\V1\TicketCategoryCollection;
use App\Http\Resources\V1\TicketCategoryResource;
use App\Models\TicketCategory;

class TicketCategoryController extends BaseApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TicketCategory::all();
        return $this->successResponse('Ticket categories retrived successfully. Number of resources: '.count($categories), new TicketCategoryCollection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketCategoryRequest $request)
    {
        return $this->successResponse('Ticket category created successfully', new TicketCategoryResource(TicketCategory::create($request->all())));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $category = TicketCategory::find($id);

        if(is_null($category)){
            return response()->noContent();
        }

        return $this->successResponse('Ticket category retrived successfully', new TicketCategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketCategoryRequest $request, int $id)
    {
        $ticket = TicketCategory::find($id);

        if(is_null($ticket)){
            return $this->errorResponse('Bad Request', 400);
        }

        $ticket->update($request->all());
        return $this->successResponse('Ticket category updated successfully', new TicketCategoryResource($ticket));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $ticket = TicketCategory::find($id);

        if(is_null($ticket)){
            return response()->noContent();
        }

        if($ticket->delete()){
            return $this->successResponse('Ticket category deleted successfully', null);
        }
    }
}
