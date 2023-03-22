<?php

use App\Http\Controllers\InitializeVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;



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
Route::post('/gettoken', [CalendarController::class, 'getToken']);
Route::post('/booking', [BookingController::class, 'booking']);

Route::post('/sendverificationmail', [InitializeVerification::class, 'sendVerificationEmail']);
Route::get('/checkstatus/{token}', [InitializeVerification::class, 'verificationStatus']);
