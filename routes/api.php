<?php


use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk user yang sedang login
// Route::get('/me', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


Route::get('/users/paginated', [UserController::class, 'getAllPaginated']);
Route::apiResource('users', UserController::class);

Route::get('/stores/paginated', [StoreController::class, 'getAllPaginated']);
Route::apiResource('stores', StoreController::class);




