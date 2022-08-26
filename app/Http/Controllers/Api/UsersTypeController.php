<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UsersType;
use App\Http\Requests\StoreUsersTypeRequest;
use App\Http\Requests\UpdateUsersTypeRequest;

class UsersTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreUsersTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUsersTypeRequest $request)
    {
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsersType  $usersType
     * @return \Illuminate\Http\Response
     */
    public function show(UsersType $usersType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUsersTypeRequest  $request
     * @param  \App\Models\UsersType  $usersType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUsersTypeRequest $request, UsersType $usersType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersType  $usersType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersType $usersType)
    {
        //
    }
}
