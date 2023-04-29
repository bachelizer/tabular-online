<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;

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
Route::get('/event/by_status/{isActive}',[EventController::class, 'fetch']);
// Route::post('/event',[EventController::class, 'store']);
// Route::get('/event/{id}',[EventController::class, 'show']);

Route::resource('participant', ParticipantController::class);
Route::get('/participant/eventParticipants/{eventId}',[ParticipantController::class, 'index']);
// Route::get('/participant/{id}',[ParticipantController::class, 'show']);
// Route::put('/participant/{id}',[ParticipantController::class, 'update']);
// Route::delete('/participant/{id}',[ParticipantController::class, 'destroy']);

Route::get('/role',[RoleController::class, 'index']);
// Route::get('/role/{eventId}',[RoleController::class, 'fetchEventUser']);

Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
Route::get('/user/{eventId}',[UserController::class, 'fetchEventUser']);
Route::get('/user/signIn/{password}',[UserController::class, 'getUser']);
// Route::get('/participant/{id}',[UserController::class, 'fetchEventUser']);

Route::apiResource('criteria', CriteriaController::class);
Route::get('/criteria/event/{eventId}', [CriteriaController::class, 'fetchEventCriteria']);

Route::apiResource('score', ScoreController::class);
Route::get('/score/event/{eventId}', [ScoreController::class, 'getTotalPercentage']);
Route::get('/score/{participantId}/{userId}', [ScoreController::class, 'show']);


Route::post('/auth', [AuthController::class, 'signIn']);

// report
Route::post('/report/{eventId}', [ReportController::class, 'getScores']);
Route::post('/report/judges-scoring/{eventId}', [ReportController::class, 'getScoringJudge']);