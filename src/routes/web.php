<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\StampController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;

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



Route::middleware('verified')->group(function(){
    Route::get('/', [RegisteredUserController::class, 'index']);
});

Route::post('/startwork', [StampController::class, 'startWork']);
Route::post('/endwork', [StampController::class, 'endWork']);
Route::post('/startrest', [RestController::class, 'startRest']);
Route::post('/endrest', [RestController::class, 'endRest']);
Route::get('/attendance', [AttendanceController::class, 'index']);
Route::get('/attendance/before', [AttendanceController::class, 'before']);
Route::get('/attendance/after', [AttendanceController::class, 'after']);
Route::get('/user/attendance', [AttendanceController::class, 'userAttendance']);