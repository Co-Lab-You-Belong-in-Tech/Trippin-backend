<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserTripRequest;
use App\Http\Requests\UpdateUserTripRequest;
use App\Models\UserTrip;

class UserTripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserTripRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserTripRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTrip  $userTrip
     * @return \Illuminate\Http\Response
     */
    public function show(UserTrip $userTrip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserTripRequest  $request
     * @param  \App\Models\UserTrip  $userTrip
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserTripRequest $request, UserTrip $userTrip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTrip  $userTrip
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTrip $userTrip)
    {
        //
    }
}
