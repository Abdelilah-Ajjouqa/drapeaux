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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/countries', [CountryController::class, 'index'])->name("index");
    Route::post('/country', [CountryController::class, 'store'])->name("store");
    Route::get('/country/{id}', [CountryController::class, 'show'])->name("show");
    Route::post('/country/{id}', [CountryController::class, 'update'])->name("update");
    Route::post('/country/{id}', [CountryController::class, 'destroy'])->name("destroy");

    // flags 
    Route::post('/country/{id}/flag', [CountryController::class, 'uploadFlag']);
    Route::get('/country/{id}/flag', [CountryController::class, 'getFlag']);
});