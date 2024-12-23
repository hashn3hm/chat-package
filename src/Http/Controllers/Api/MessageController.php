<?php

namespace Hasicode\Chats\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Hasicode\Chats\Models\Message;

class MessageController extends Controller
{
    public function index($chatId)
    {
        $messages = Message::where('chat_id', $chatId)->with('user')->get();
        return response()->json($messages);
    }

    public function store(Request $request, $chatId)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'type' => 'string|in:text,image,file',
        ]);

        $message = Message::create([
            'chat_id' => $chatId,
            'user_id' => auth()->id(),
            'content' => $validated['content'],
            'type' => $validated['type'] ?? 'text',
        ]);

        return response()->json($message, 201);
    }
}
