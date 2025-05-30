@extends('layouts.app')

@section('title', 'Chatbot - Pillmate')

@section('content')
<div class="chatbot-container px-5 py-5 d-flex align-items-center flex-column gap-4">
    <div class="chat-welcome mb-2">
        <img src="{{ asset('web-icon/welcoming.png') }}" alt="" width="170">
    </div>
    
    <div class="chat-intro d-flex flex-column gap-2">
        <img src="{{ asset('web-icon/chat1.png') }}" alt="" width="330">
        <img src="{{ asset('web-icon/chat2.png') }}" alt="" width="330">
        <button class="btn btn-warning mt-3">Lanjutkan</button>
    </div>
    
</div>
@endsection