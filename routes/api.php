<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\FanartController;
use App\Http\Controllers\Api\FanartCategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
//    Route::apiResource('/user', UserController::class);
    Route::apiResource('/fanart', FanartController::class);
    Route::apiResource('/fanartCategory', FanartCategoryController::class);
    Route::get('/user/show/{user}', [UserController::class, 'show']);
    Route::put('/user/{user}', [UserController::class, 'update']);

    //Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);
});


Route::post('/register', [UserController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
