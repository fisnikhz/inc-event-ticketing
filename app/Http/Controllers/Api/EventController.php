<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\Event\StoreEventRequest;
use App\Http\Requests\Api\Event\UpdateEventRequest;
use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventController extends ApiController
{
    use AuthorizesRequests;

    public function index()
    {
        $events = Event::with('venue')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->get();

        return $this->respondWithSuccess($events);
    }


    public function store(StoreEventRequest $request)
    {
        $this->authorize('create', Event::class);

        $validated = $request->validated();

        $event = auth()->user()->events()->create($validated);
        return $this->respondWithSuccess($event, 'Event created successfully.',201);
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);

        return $this->respondWithSuccess($event);
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);
        $validated = $request->validated();

        $event->update($validated);

        return $this->respondWithSuccess($event, 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return $this->respondWithSuccess($event, 'Event deleted successfully.');
    }
}
