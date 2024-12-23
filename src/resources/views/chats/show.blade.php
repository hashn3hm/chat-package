@extends('layouts.app')

@section('content')
<h1>{{ $chat->name ?? 'Chat' }}</h1>
<ul>
    @foreach($chat->messages as $message)
        <li><strong>{{ $message->user->name }}:</strong> {{ $message->content }}</li>
    @endforeach
</ul>
<form method="POST" action="{{ url('api/chats/' . $chat->id . '/messages') }}">
    @csrf
    <textarea name="content" required></textarea>
    <button type="submit">Send</button>
</form>
@endsection
