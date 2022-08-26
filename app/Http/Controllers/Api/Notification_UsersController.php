<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification_Users;
use App\Http\Requests\StoreNotification_UsersRequest;
use App\Http\Requests\UpdateNotification_UsersRequest;

class Notification_UsersController extends Controller
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
     * @param  \App\Http\Requests\StoreNotification_UsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotification_UsersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification_Users  $notification_Users
     * @return \Illuminate\Http\Response
     */
    public function show(Notification_Users $notification_Users)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotification_UsersRequest  $request
     * @param  \App\Models\Notification_Users  $notification_Users
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotification_UsersRequest $request, Notification_Users $notification_Users)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification_Users  $notification_Users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification_Users $notification_Users)
    {
        //
    }
}
