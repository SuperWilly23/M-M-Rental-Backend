<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\ReservasiController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/user')->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth.jwt');
    Route::get('/current-user', [AuthController::class, 'me'])->middleware('auth.jwt');
});

Route::middleware('auth:api')->group(function () {
    // Rute untuk UserController
    Route::get('/user/profile', [UserController::class, 'getProfile']);
    Route::put('/user/profile', [UserController::class, 'updateProfile']);

    // Rute untuk ReservasiController
    Route::get('/user/reservations', [ReservasiController::class, 'getReservations']);
    Route::post('/reservations/{id}/review', [ReservasiController::class, 'giveReview']);
});

Route::get('/getuser', [UserController::class, 'getData']);

