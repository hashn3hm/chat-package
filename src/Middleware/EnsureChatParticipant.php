<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Hasicode\Chats\Models\Chat;

class EnsureChatParticipant
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $chatId = $request->route('chat'); // Get chat ID from route
        $chat = Chat::find($chatId);

        if (!$chat || !$chat->participants()->where('user_id', auth()->id())->exists()) {
            return response()->json(['error' => 'Unauthorized'], 403); // Deny access
        }

        return $next($request); // Allow access
    }
}
