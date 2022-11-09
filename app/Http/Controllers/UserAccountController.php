<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser_AccountRequest;
use App\Http\Requests\UpdateUser_AccountRequest;
use App\Models\User_Profile;

class UserAccountController extends Controller
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
     * @param  \App\Http\Requests\StoreUser_AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser_AccountRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User_Profile  $user_Account
     * @return \Illuminate\Http\Response
     */
    public function show(User_Profile $user_Account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUser_AccountRequest  $request
     * @param  \App\Models\User_Profile  $user_Account
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser_AccountRequest $request, User_Profile $user_Account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User_Profile  $user_Account
     * @return \Illuminate\Http\Response
     */
    public function destroy(User_Profile $user_Account)
    {
        //
    }
}
