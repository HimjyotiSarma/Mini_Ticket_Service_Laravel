<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Ticket::class);

        $tickets = Ticket::with('user')->latest()->get();
        return response()->json($tickets);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $ticket = Ticket::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id
        ]);
        return response()->json($ticket, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);

        return response()->json($ticket->load('user', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        Gate::authorize('update', $ticket);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:' . implode(',', [Ticket::STATUS_OPEN, Ticket::STATUS_IN_PROGRESS, Ticket::STATUS_CLOSED]),
        ]);

        if($request->has('status') && $request->status === Ticket::STATUS_CLOSED){
            return response()->json(['message' => 'Use the close endpoint to close a ticket.'], 400);
        }

        if ($request->has('title')) {
            $ticket->title = $request->title;
        }
        if ($request->has('description')) {
            $ticket->description = $request->description;
        }
        if ($request->has('status')) {
            $ticket->status = $request->status;
        }

        $ticket->save();

        return response()->json($ticket);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }

    /**
     * Close the specified ticket.
     */
    public function close(Ticket $ticket){
        Gate::authorize('update', $ticket);

        if($ticket->isClosed()){
            return response()->json(['message' => 'Ticket is already closed.'], 400);
        }

        $ticket->close();

        return response()->json($ticket);
    }
}
