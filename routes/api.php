<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\VenueController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Event routes
    Route::get('/all/events', [EventController::class, 'index']);
    Route::post('/store/event', [EventController::class, 'store']);
    Route::get('/find/events/{event}', [EventController::class, 'show']);
    Route::put('/update/events/{event}', [EventController::class, 'update']);
    Route::delete('/delete/events/{event}', [EventController::class, 'destroy']);

    // Venue routes
    Route::get('/all/venues', [VenueController::class, 'index']);
    Route::post('/store/venue', [VenueController::class, 'store']);
    Route::get('/find/venues/{venue}', [VenueController::class, 'show']);
    Route::put('/update/venues/{venue}', [VenueController::class, 'update']);
    Route::delete('/delete/venues/{venue}', [VenueController::class, 'destroy']);

    // Ticket routes
    Route::get('/all/tickets', [TicketController::class, 'index']);
    Route::post('/store/ticket', [TicketController::class, 'store'])->middleware('throttle:3,1');;
    Route::get('/find/tickets/{ticket}', [TicketController::class, 'show']);
    Route::put('/update/tickets/{ticket}', [TicketController::class, 'update']);
    Route::delete('/delete/tickets/{ticket}', [TicketController::class, 'destroy']);

    Route::get('search', SearchController::class);

    // Profile
    Route::put('/profile', [AuthController::class, 'updateProfile']);
});
