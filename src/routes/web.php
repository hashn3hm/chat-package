<?php

use Illuminate\Support\Facades\Route;
use Hasicode\Chats\Http\Controllers\ChatController;


Route::middleware(['web', 'auth', 'chat.participant']) // Use 'web' middleware and authentication
    ->group(function () {
        Route::get('/chats', [ChatController::class, 'index'])->name('chats.index'); // List chats
        Route::get('/chats/{chat}', [ChatController::class, 'show'])->name('chats.show'); // Chat details
    });
