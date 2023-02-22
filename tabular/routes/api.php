<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('event', EventController::class);
// Route::get('/event',[EventController::class, 'index']);
// Route::post('/event',[EventController::class, 'store']);
// Route::get('/event/{id}',[EventController::class, 'show']);

Route::resource('participant', ParticipantController::class);
// Route::post('/participant',[ParticipantController::class, 'store']);
// Route::get('/participant/{id}',[ParticipantController::class, 'show']);
// Route::put('/participant/{id}',[ParticipantController::class, 'update']);
// Route::delete('/participant/{id}',[ParticipantController::class, 'destroy']);

Route::get('/role',[RoleController::class, 'index']);

Route::apiResource('user', UserController::class);
