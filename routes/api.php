<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->name("register");
Route::post('/login', [AuthController::class, 'login'])->name("login");
Route::post('/logout', [AuthController::class, 'logout'])->middleware("auth:sanctum");


Route::middleware('auth:sunctum')->group(function(){
    Route::get('/countries', [CountryController::class, 'index'])->name("index");
    Route::get('/countries/{id}', [CountryController::class, 'show'])->name("show");
});