<?php

use App\Http\Controllers\Api\CarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::get('/info', function () {
//     return response()->json([
//         'App' => 'TA Car',
//         'Version' => '1.0',
//         'Author' => 'Gue',
//     ]);
// });

// Route::get('/hello', function () {
//     return 'Halo dari Laravel 12!';
// });

// Route::post('/hello', function () {
//     return response()->json([
//         'message' => 'Request POST berhasil diterima!',
//     ]);
// });

Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars', [CarController::class, 'store']);
Route::get('/cars/{id}', [CarController::class, 'show']);
Route::put('/cars/{id}', [CarController::class, 'update']);
Route::patch('/cars/{id}', [CarController::class, 'update']);
Route::delete('/cars/{id}', [CarController::class, 'destroy']);

