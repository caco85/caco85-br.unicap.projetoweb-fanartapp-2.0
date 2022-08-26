<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FanartCategory;
use App\Http\Requests\StoreFanartCategoryRequest;
use App\Http\Requests\UpdateFanartCategoryRequest;
use App\Http\Resources\FanartCategoryResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class FanartCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FanartCategoryResource::collection(FanartCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFanartCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFanartCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FanartCategory  $fanartCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FanartCategory $fanartCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFanartCategoryRequest  $request
     * @param  \App\Models\FanartCategory  $fanartCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFanartCategoryRequest $request, FanartCategory $fanartCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FanartCategory  $fanartCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FanartCategory $fanartCategory)
    {
        //
    }
}
