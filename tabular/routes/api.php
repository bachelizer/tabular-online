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
use App\Http\Controllers\SubEventController;
use App\Http\Controllers\SubEventCriteriaController;
use App\Http\Controllers\SubEventScoreController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ActivityController;

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
Route::get('/report/individual-scoring/{eventId}/{userId}', [ReportController::class, 'individualJudgeScoring']);
Route::get('/report/score-summary/{eventId}', [ReportController::class, 'scoreSummary2']);
// Route::get('/report/score-summary/{eventId}', [ReportController::class, 'scoreSummary']);

// sub-event
Route::get('/event/sub-event/{eventId}', [SubEventController::class, 'fetch']);
Route::post('/event/sub-event', [SubEventController::class, 'store']);
Route::put('/event/sub-event/{id}', [SubEventController::class, 'update']);
Route::get('/event/sub-event/show/{id}', [SubEventController::class, 'show']);

// sub-event criteria
Route::get('/sub-event/s-c/{subEventId}', [SubEventCriteriaController::class, 'fetch']);
Route::post('/sub-event/s-c', [SubEventCriteriaController::class, 'store']);
Route::put('/sub-event/s-c/{id}', [SubEventCriteriaController::class, 'update']);
// Route::get('/sub-event/s-c/{id}', [SubeEventCriteriaController::class, 'show']);
Route::delete('/sub-event/s-c/show/{id}', [SubEventCriteriaController::class, 'destroy']);

// sub-event score
Route::get('/sub-criteria-scoring/{participantId}/{userId}/{subEventId}', [SubEventScoreController::class, 'show']);
Route::post('/sub-criteria-scoring', [SubEventScoreController::class, 'store']);

//announcement
Route::apiResource('announcement', AnnouncementController::class);

//activity
Route::apiResource('activity', ActivityController::class);