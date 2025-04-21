<?php

namespace App\Http\Controllers\Api;

use App\Models\Event;
use Illuminate\Http\Request;

class SearchController extends ApiController
{
    public function __invoke(Request $request)
    {
        $eventName = $request->query('event');
        $venueName = $request->query('venue');

        $events = Event::with('venue')
            ->when($eventName, function ($query, $eventName) {
                $query->where('name', 'like', "%{$eventName}%");
            })
            ->when($venueName, function ($query, $venueName) {
                $query->whereHas('venue', function ($q) use ($venueName) {
                    $q->where('name', 'like', "%{$venueName}%");
                });
            })
            ->orderBy('date', 'asc')
            ->get();

        return $this->respondWithSuccess($events);

    }
}
