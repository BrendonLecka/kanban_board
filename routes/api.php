<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\IssueController;
use App\Http\Controllers\Api\StateController;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('/issues', IssueController::class);
    Route::get('/states/{state}/issues', [StateController::class, 'issues']);
    Route::apiResource('/states', StateController::class);
    Route::apiResource('/boards', BoardController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});

