<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\WorkstationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'getAll']);
Route::get('/track', [TrackController::class, 'getAll']);
Route::get('/tracks', [TrackController::class, 'getFirst']);
Route::put('/tracks', [TrackController::class, 'setActive']);
Route::post('/tracks', [TrackController::class, 'store']);
Route::get('/room/{room}', [RoomController::class, 'getById']);
Route::get('/rooms', [RoomController::class, 'getAll']);
Route::post('/rooms', [RoomController::class, 'store']);
Route::put('/rooms', [RoomController::class, 'update']);
Route::delete('/room/{room}', [RoomController::class, 'destroy']);
Route::post('/workstation', [WorkstationController::class, 'store']);
Route::put('/workstation', [WorkstationController::class, 'update']);
Route::put('/ws', [WorkstationController::class, 'updateJSON']);
Route::delete('/workstation/{workstation}', [WorkstationController::class, 'destroy']);
Route::get('/track/{track}', [TrackController::class, 'getById']);
