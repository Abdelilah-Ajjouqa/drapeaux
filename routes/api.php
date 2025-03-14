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
    Route::post('/countries', [CountryController::class, 'store'])->name("store");
    Route::get('/countries/{id}', [CountryController::class, 'show'])->name("show");
    Route::post('/countries/{id}', [CountryController::class, 'update'])->name("update");
    Route::post('/countries/{id}', [CountryController::class, 'destroy'])->name("destroy");

    // flags 
    Route::post('/countries/{id}/flag', [CountryController::class, 'uploadFlag']);
    Route::get('/countries/{id}/flag', [CountryController::class, 'getFlag']);
});