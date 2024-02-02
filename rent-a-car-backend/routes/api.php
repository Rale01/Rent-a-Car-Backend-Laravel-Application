<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;


//login i registracija
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//CARS
Route::get('cars', [CarController::class, 'index']);

Route::get('cars/{id}', [CarController::class, 'show']); 

//METODE ZA KOJE NAM TREBA LOGIN
Route::group(['middleware' => ['auth:sanctum']], function () {
  
    //CARS
    Route::post('cars', [CarController::class, 'store']);

    Route::put('cars/{id}', [CarController::class, 'update']); 

    Route::delete('cars/{id}', [CarController::class, 'destroy']); 

    Route::post('logout', [AuthController::class, 'logout']);

});
