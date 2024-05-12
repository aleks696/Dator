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

Route::get('/create_user', [DatorController::class, 'create_user']);
Route::get('/profiles/{user_id}/like', [DatorController::class, 'like_profile']);
Route::get('/create_profile', [DatorController::class, 'create_profile']);
Route::post('/create_membership', [DatorController::class, 'create_membership']);
Route::put('/update_user/{id}', [DatorController::class, 'update_user']);
Route::put('/update_profile/{id}', 'App\Http\Controllers\DatorController@update_profile');
Route::put('/update_membership/{id}', 'App\Http\Controllers\DatorController@update_membership');

