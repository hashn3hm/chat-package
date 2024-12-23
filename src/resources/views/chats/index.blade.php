@extends('layouts.app')

@section('content')
    <h1>Chats</h1>
    <ul>
        @foreach ($chats as $chat)
            <li>
                <a href="{{ route('chats.show', $chat->id) }}">{{ $chat->name ?? 'Private Chat' }}</a>
            </li>
        @endforeach
    </ul>
@endsection
