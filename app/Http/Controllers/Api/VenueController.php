<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Venue\StoreVenueRequest;
use App\Http\Requests\Api\Venue\UpdateVenueRequest;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends APIController
{
    public function index()
    {
        $venues = Venue::all();
        return $this->respondWithSuccess($venues);
    }

    public function store(StoreVenueRequest $request)
    {
        $validated = $request->validated();

        $venue = Venue::create($validated);

        return $this->respondWithSuccess($venue, 'Venue created successfully.',201);
    }

    public function show(Venue $venue)
    {
        return $this->respondWithSuccess($venue);
    }

    public function update(UpdateVenueRequest $request, Venue $venue)
    {

        $validated = $request->validated();

        $venue->update($validated);

        return $this->respondWithSuccess($venue, 'Venue updated successfully.',200);
    }


    public function destroy(Venue $venue)
    {
        $venue->delete();

        return $this->respondWithSuccess([],"Venue deleted successfully.");

    }
}
