<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCollaboratorRequest;
use App\Http\Requests\StoreItineraryRequest;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Http\Resources\ItineraryResource;
use App\Http\Resources\TripResource;
use App\Http\Resources\UserResource;
use App\Models\Trip;
use App\Models\User;
use App\Models\TripUser;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    //show all trips of the logged in user by querying the UserTrips pivot table and use the user_id field to access the trips table
    public function index()
    {
        $user = Auth::user();
        $trips = $user->trips()->get();
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
   //create a new trip and attach it to the authenticated user with and record the trip id and user id in the trip_user pivot table allow the user to create  multiple trips
    public function store(StoreTripRequest $request)
    {
        $user = Auth::user();
        $trip = Trip::create($request->all());
        $trip->users()->attach($user->id);
        return new TripResource($trip);
    }

    //invite a collaborator to a trip with email and validate the email  and then associate the collaborator with the trip
    public function inviteCollaborator(StoreCollaboratorRequest $request, Trip $trip)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $trip->users()->attach($user->id);
            //return the initials of the collaborator with a success message
            return response()->json([
                'initials' => $user->initials,
                'message' => 'Collaborator added successfully'
            ], 200);
        }
        return response()->json(['message' => 'User not found'], 404);
    }




    // send email invitation


    //remove collaborators from a trip by taking using only email and then detach the collaborators from the trip
    public function removeCollaborators(StoreTripRequest $request, Trip $trip)
    {
        $trip->users()->detach($request->email, ['trip_id' => $trip->id]);
        return new TripResource($trip);
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
        // check if the user is the owner of the trip and then update the trip with an image
        if($trip->id === Auth::user()->id){
            $trip->update($request->validated());
            if($request->hasFile('image')){
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(800, 400)->save($location);
                $trip->image = $filename;
                $trip->save();
            }
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trip  $trip
     * @return \Illuminate\Http\JsonResponse
     */
    //check if the user is authorized to delete the trip and then delete the trip with all the itineraries and the user_trips pivot table entries and return a json response
    public function destroy(Trip $trip)
    {
        if($trip->id === Auth::user()->id){
            $trip->delete();
            return response()->json(['success' => 'Trip deleted successfully'], 200);
        }
        else{
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    //show users on a trip
    public function users(Trip $trip)
    {
        return UserResource::collection($trip->users);
    }
}



