<?php

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/stuff", function() {
    return ["a" => 1];
});

Route::prefix('/user')->group(function () {
    Route::post('/register', RegisterController::class)->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth.jwt');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth.jwt');
    Route::get('/current-user', [AuthController::class, 'me'])->middleware('auth.jwt');
});

Route::prefix('/car')->group(function() {
    Route::get('/all', [CarController::class, 'getAll'])->middleware('auth.jwt');
    Route::get('/{id}', [CarController::class, 'getByID'])->middleware('auth.jwt');
    Route::get('/category/{id_kategori}', [CarController::class, 'getCarsByCategory'])->middleware('auth.jwt');
    Route::get('/status/{id_status}', [CarController::class, 'getCarsByStatusID'])->middleware('auth.jwt');
    Route::post('/add', [CarController::class, 'addNew'])->middleware('auth.jwt')->middleware('role:admin');
    Route::patch('/update/{id}', [CarController::class, 'update'])->middleware('auth.jwt')->middleware('role:admin');
    Route::delete('/delete/{id}', [CarController::class, 'deleteCar'])->middleware('auth.jwt')->middleware('role:admin');
});
