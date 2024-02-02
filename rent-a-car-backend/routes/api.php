<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


//login i registracija
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
