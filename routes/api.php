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

Route::get('/login_register_user', [DatorController::class, 'login_register_user']);
Route::get('/create_profile/{id}', [DatorController::class, 'create_profile']);
Route::post('/get_user_info/{id}', [DatorController::class, 'get_user_info']);
Route::post('/create_membership/{id}', [DatorController::class, 'create_membership']);
Route::post('/get_profiles', [DatorController::class, 'get_profiles']);
Route::get('/profiles/{user_id}/like', [DatorController::class, 'request_like_profile']);
Route::get('/profiles/{user_id}/user_id_likes', [DatorController::class, 'get_mutual_likes']);
Route::put('/update_user/{id}', [DatorController::class, 'update_user']);
Route::put('/update_profile/{id}', [DatorController::class, 'update_profile']);
Route::put('/update_membership/{id}', [DatorController::class, 'update_membership']);
