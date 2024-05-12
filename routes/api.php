<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\DatorController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::prefix('api')->group(function () {
    Route::post('/check_user', [DatorController::class, 'check_user']);
    Route::post('/create', [DatorController::class, 'create_user']);
    // Route::post('/profiles/{user_id}/like', 'App\Http\Controllers\DatorController@like_profile');
    // Route::post('/create_profile', 'App\Http\Controllers\DatorController@create_profile');
    // Route::post('/create_membership', 'App\Http\Controllers\DatorController@create_membership');
    // Route::put('/update_user/{id}', 'App\Http\Controllers\DatorController@update_user');
    // Route::put('/update_profile/{id}', 'App\Http\Controllers\DatorController@update_profile');
    // Route::put('/update_membership/{id}', 'App\Http\Controllers\DatorController@update_membership');
// });
Route::get('testing', function (){
    return 'This is a test api';
});
