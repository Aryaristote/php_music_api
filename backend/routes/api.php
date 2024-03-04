<?php

use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\UserController;

Route::post('/login', [LoginController::class, 'login']); //Login route
Route::post('/register', [UserController::class, 'register']); // Register route

Route::get('/users', [UserController::class, 'index']); // Retrieve all users
Route::delete('/user', [UserController::class, 'delete'])->name('user.delete'); // Delete a user


Route::middleware('auth:sanctum')->put('/user', [UserController::class, 'update']); // Update a user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});// Retrieve one user
// Route::middleware('auth:sanctum')->post('/logout', [LoginController::class, 'logout']); // Logout route

Route::group(['middleware' => 'auth:sanctum'], function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [LoginController::class, 'logout']);
});

// Add favorites songs
Route::get('/favorites', [ApiController::class, 'getFavorites']);
Route::post('/add-to-favorites', [ApiController::class, 'addToFavorites']);
Route::post('/remove-from-favorites', [ApiController::class, 'removeFromFavorites']);

