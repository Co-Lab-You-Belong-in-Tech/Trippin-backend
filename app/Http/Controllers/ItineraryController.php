<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Http\Resources\ItineraryResource;
use App\Models\Itinerary;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ItineraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $itineraries = Itinerary::all();

        return new JsonResponse([
            'data' => $itineraries
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreItineraryRequest  $request
     * @return ItineraryResource
     */

//  take in the trip id as parameter and create an itinerary and associate it with the authenticated user and the current trip id and record the trip id and user id in the user_trips pivot table

    public function store(StoreItineraryRequest $request, $trip_id) {
    $itinerary = new Itinerary();
    //validate the request
    $itinerary->fill($request->validated());
    $itinerary->user_id = Auth::id();
    $itinerary->trip_id = $trip_id;
    $itinerary->save();
    //record the trip id and user id in the user_trips pivot table
    $itinerary->users()->attach($itinerary->user_id, ['trip_id' => $itinerary->trip_id]);
    return new ItineraryResource($itinerary);
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return JsonResponse
     */

    // return the itinerary with the specified id
    public function show(Itinerary $itinerary)
    {
        return new JsonResponse([
            'data' => $itinerary
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateItineraryRequest  $request
     * @param  \App\Models\Itinerary  $itinerary
     * @return ItineraryResource
     */
    public function update(UpdateItineraryRequest $request, Itinerary $itinerary)
    {
        //update the itinerary with start time, end time and date and return the updated itinerary
        $itinerary->update($request->all());
        return new ItineraryResource($itinerary);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return JsonResponse
     */
    public function destroy(Itinerary $itinerary)
    {
        // delete the itinerary  and return a successful deleted message with 204 status code
        $itinerary->delete();
        return response()->json(
            //return a successful deleted message
            ['message' => 'Itinerary deleted successfully'],
            204);

    }
}
