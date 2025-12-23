<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Ticket;
use Gate;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $replies = $ticket->replies()->with('user:id,name,role')->latest()->get();
        if($replies->isEmpty()) {
            return response()->json(['message' => 'No replies found for this ticket.'], 404);
        };
        return response()->json($replies);
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
    public function store(Request $request, Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $request->validate([
            'message' => 'required|string',
        ]);

        $reply = $ticket->replies()->create([
            'message' => $request->message,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($reply->load('user:id,name,role'), 201);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reply $reply)
    {
        //
    }
}
