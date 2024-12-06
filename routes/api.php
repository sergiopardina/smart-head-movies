<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {
    Route::post('/all-movies/filters', [App\Http\Controllers\MovieController::class, 'allMovies']);
    Route::post('/movies/filters', [App\Http\Controllers\MovieController::class, 'index']);
    Route::apiResource('movies', App\Http\Controllers\MovieController::class)->except(['index']);
    Route::patch('/movies/state-update/{id}', [App\Http\Controllers\MovieController::class, 'stateUpdate']);

    Route::apiResource('genres', App\Http\Controllers\GenreController::class);

    Route::get('/states', [App\Http\Controllers\StateController::class, 'index']);
});
