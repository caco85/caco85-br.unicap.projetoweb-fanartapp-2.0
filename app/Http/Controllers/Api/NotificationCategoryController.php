<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotificationCategory;
use App\Http\Requests\StoreNotificationCategoryRequest;
use App\Http\Requests\UpdateNotificationCategoryRequest;

class NotificationCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreNotificationCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotificationCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NotificationCategory  $notificationCategory
     * @return \Illuminate\Http\Response
     */
    public function show(NotificationCategory $notificationCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNotificationCategoryRequest  $request
     * @param  \App\Models\NotificationCategory  $notificationCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotificationCategoryRequest $request, NotificationCategory $notificationCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NotificationCategory  $notificationCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(NotificationCategory $notificationCategory)
    {
        //
    }
}
