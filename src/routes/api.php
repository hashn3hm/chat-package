<?php

use Illuminate\Support\Facades\Route;
use Hasicode\Chats\Http\Controllers\Api\MessageController;

Route::prefix('api/chats')
    ->middleware(['api', 'auth:sanctum', 'chat.participant']) // Use 'api' middleware and authentication
    ->group(function () {
        Route::get('{chat}/messages', [MessageController::class, 'index']); // Fetch messages
        Route::post('{chat}/messages', [MessageController::class, 'store']); // Send message
    });
