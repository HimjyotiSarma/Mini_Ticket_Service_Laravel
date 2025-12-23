<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Ticket Routes

Route::middleware('auth:sanctum')->group(function () {

    // Admin-only
    Route::get('/tickets', [TicketController::class, 'index']);
    // User & Admin
    Route::post('/tickets', [TicketController::class, 'store']);
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']);
    Route::put('/tickets/{ticket}', [TicketController::class, 'update']);

    // User action
    Route::post('/tickets/{ticket}/close', [TicketController::class, 'close']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store']);
    Route::get('/tickets/{ticket}/replies', [ReplyController::class, 'index']);
});

