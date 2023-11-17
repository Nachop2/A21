<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\ModuloController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public routes of authtication
// 
// 'App\Http\Controllers\Auth\LoginRegisterController::class'
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

// Public routes of Modulo
Route::controller(ModuloController::class)->group(function() {
    Route::get('/modulos', 'index');
    Route::get('/modulos/{id}', 'show');
    Route::get('/modulos/search/{name}', 'search');
});

// Protected routes of Modulo and logout
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);

    Route::controller(ModuloController::class)->group(function() {
        Route::post('/modulos', 'store');
        Route::post('/modulos/{id}', 'update');
        Route::delete('/modulos/{id}', 'destroy');
    });
});


// Non Auth related
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('modulos', Moduloontroller::class);
    });
    

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
