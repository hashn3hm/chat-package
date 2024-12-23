<?php

namespace Hasicode\Chats\Http\Controllers;

use Illuminate\Routing\Controller;
use Hasicode\Chats\Models\Chat;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with('participants')->get();
        return view('chats.index', compact('chats'));
    }

    public function show($chatId)
    {
        $chat = Chat::with('messages')->findOrFail($chatId);
        return view('chats.show', compact('chat'));
    }
}
