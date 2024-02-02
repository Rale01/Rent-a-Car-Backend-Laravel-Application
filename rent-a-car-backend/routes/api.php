<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentalAgentController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;


//login i registracija
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//CARS
Route::get('cars', [CarController::class, 'index']);

Route::get('cars/{id}', [CarController::class, 'show']); 

//RENTALAGENTS
Route::resource('rentalagents', RentalAgentController::class);

//pretraga auta po imenu
Route::get('/search/cars', [SearchController::class, 'searchCars']);

//METODE ZA KOJE NAM TREBA LOGIN
Route::group(['middleware' => ['auth:sanctum']], function () {
    //TRANSACTIONS
    Route::patch('transactions/alterTheStatus/{id}', [TransactionController::class, 'updateStatus']);

    Route::post('transactions', [TransactionController::class, 'store']);
    
    Route::put('transactions/{id}', [TransactionController::class, 'update']); 
    
    Route::delete('transactions/{id}', [TransactionController::class, 'destroy']); 

    //CARS
    Route::post('cars', [CarController::class, 'store']);

    Route::put('cars/{id}', [CarController::class, 'update']); 

    Route::delete('cars/{id}', [CarController::class, 'destroy']); 

    Route::post('logout', [AuthController::class, 'logout']);

});
