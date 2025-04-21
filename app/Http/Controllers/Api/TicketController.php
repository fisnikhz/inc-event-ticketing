<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Ticket\StoreTicketRequest;
use App\Mail\TicketBookedMail;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class TicketController extends APIController
{
    use AuthorizesRequests;


    public function index()
    {
        $tickets = auth()->user()->tickets()->get();
        return $this->respondWithSuccess($tickets);
    }

    public function store(StoreTicketRequest $request)
    {
        $event = Event::with('venue', 'tickets')->findOrFail($request->event_id);

        if ($event->available_seats <= 0) {
            return response()->json(['message' => 'No seats available.'], 400);
        }

        $lastSeat = $event->tickets()->max('seat_number') ?? 0;

        $ticket = auth()->user()->tickets()->create([
            'event_id' => $event->id,
            'price' => $event->price,
            'seat_number' => $lastSeat + 1,
            'booked_at' => now(),
        ]);

        Mail::to(auth()->user()->email)->send(new TicketBookedMail($ticket));

        return $this->respondWithSuccess($ticket);
    }


    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $ticket->load('event.venue');

        return $this->respondWithSuccess($ticket);

    }


    public function update(StoreTicketRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $validated = $request->validated();
        $ticket->update($validated);

        return $this->respondWithSuccess($ticket);
    }

    public function destroy(Ticket $ticket)
    {

        $this->authorize('delete', $ticket);

        $ticket->delete();

        return $this->respondWithSuccess([], 'Ticket deleted.');
    }
}
