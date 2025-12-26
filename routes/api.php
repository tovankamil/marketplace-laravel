<?php


use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route untuk user yang sedang login
// Route::get('/me', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::get('/users/paginated', [UserController::class, 'getAllPaginated']);
    // ->middleware('auth:sanctum');

// Resource route untuk user (menghasilkan: index, store, show, update, destroy)
Route::apiResource('users', UserController::class);
// ->middleware('auth:sanctum');


