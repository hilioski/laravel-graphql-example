<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', Auth\JWTAuthController::class.'@login');
    Route::post('register', Auth\JWTAuthController::class.'@register');
    Route::post('logout', Auth\JWTAuthController::class.'@logout');
    Route::post('refresh', Auth\JWTAuthController::class.'@refresh');
});

Route::resource('/movies', MovieController::class);
Route::resource('/actors', ActorController::class);
