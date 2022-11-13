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


    //show all itineraries of a trip and add the trip itself to the response
     public function itineraries(Trip $trip)
     {
          $itineraries = $trip->itineraries()->get();
         return response()->json([
             'trip' => $trip,
             'itineraries' => $itineraries
         ]);


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
        $trip_code = $this->generateTripCode();
        //add the trip code when creating a new trip
        $trip = Trip::create($request->validated() + ['trip_code' => $trip_code]);
        $trip->users()->attach($user->id);
        return new TripResource($trip);
    }

    //invite a collaborator to a trip with email validation and then associate the user with the trip with a successful response and 201 status code and return the initial of the user
    public function inviteCollaborator(StoreCollaboratorRequest $request, Trip $trip)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response([
                'message' => ['This email does not match our records.']
            ], 404);
        }


        $trip->users()->attach($user->id);
        return response([
            'message' => 'Collaborator added successfully. Email invitation sent to ' . $user->email,
            'initials' => $user->initials
        ], 201);
    }







    //show the collaborators of a trip
    public function collaborators(Trip $trip)
    {
        $users = $trip->users()->get();
        return UserResource::collection($users);
    }

    // send email invitation to a collaborator



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

    //show a single trip of the current authenticated user
    public function show(Trip $trip)
    {
        $user = Auth::user();
        $trip = $user->trips()->where('id', $trip->id)->firstOrFail();
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
            if($request->hasFile('trip_background_image')){
                $image = $request->file('trip_background_image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->resize(800, 400)->save($location);
                $trip->trip_background_image = $filename;
                $trip->save();
            }
            return new TripResource($trip);
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
    //check if the user is authenticated and check if the trip exists in the trip_user pivot table and then delete the trip
    public function destroy(Trip $trip)
    {
        $user = Auth::user();
        $trip = $user->trips()->where('id', $trip->id)->firstOrFail();
        $trip->delete();
        return response()->json(null, 204);
    }





    //show users on a trip
    public function users(Trip $trip)
    {
        return UserResource::collection($trip->users);
    }

  //generate trip code
    public function generateTripCode()
    {
        $user = Auth::user();
        $trip_code = '#' . strtoupper(substr($user->email, 0, 3) . str_pad($user->trips()->count() + 1, 3, '00', STR_PAD_LEFT));
        return $trip_code;
    }

   /* public function generateTripCode()
    {
        $user = Auth::user();
        $initials = strtoupper(substr($user->email, 0, 2));
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = $characters[rand(0, strlen($characters) - 1)];
        $trip_code = '#' . $initials . $randomString . $user->trips()->count();
        return $trip_code;
    }
*/


}



