<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\ItineraryResource;
use App\Http\Resources\TripResource;
use App\Http\Resources\UserResource;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    //show all trips of a user
    public function index()
    {
        $trips = Trip::with('user_trip_id')->get();
        return TripResource::collection($trips);
    }

    //show all itineraries of a trip
    public function itineraries(Trip $trip)
    {
        $itineraries = $trip->itineraries()->get();
        return ItineraryResource::collection($itineraries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTripRequest  $request
     * @return TripResource
     */
   //create a new trip and add the user to it
    public function store(StoreTripRequest $request)
    {
        $trip = Trip::create($request->validated());
        $user_id = Auth::user()->id;
        $trip->user_trips()->attach($request->user()->id);
        return new TripResource($trip);
    }

    // add itineraries to a trip
    public function addItinerary(Trip $trip, StoreItineraryRequest $request)
    {
        $itinerary = $trip->itineraries()->create($request->validated());
        return new ItineraryResource($itinerary);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trip  $trip
     * @return TripResource
     */

    //show a trip
    public function show(Trip $trip)
    {
        return new TripResource($trip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTripRequest  $request
     * @param  \App\Models\Trip  $trip
     * @return TripResource
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        // update a trip
        $trip->update($request->validated());
        return new TripResource($trip);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\JsonResponse
     */
    //delete a trip
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return response()->json(null, 204);
    }

    //show users on a trip
    public function users(Trip $trip)
    {
        return UserResource::collection($trip->users);
    }
}



