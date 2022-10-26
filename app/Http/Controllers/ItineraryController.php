<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\UpdateItineraryRequest;
use App\Models\Itinerary;
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */

    // create new itinerary with validation
public function store(StoreItineraryRequest $request)
    {
        $itinerary = Itinerary::create($request->validated());

        return new JsonResponse([
            'data' => $itinerary
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItineraryRequest $request, Itinerary $itinerary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itinerary  $itinerary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itinerary $itinerary)
    {
        //
    }
}
