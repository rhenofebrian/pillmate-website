<?php

// app/Http/Controllers/ChatController.php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatbotController extends Controller
{
      public function index()
    {
        $user = Auth::user();
        if ($user) {    
            return view("chatbot",);
        }
    }
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required',
        ]);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Kamu adalah asisten kesehatan ringan. Jangan beri diagnosis serius. Jawab secara singkat dan ramah.',
                ],
                [
                    'role' => 'user',
                    'content' => 'Saya mengalami keluhan: ' . $request->message,
                ],
            ],
        ]);

        return response()->json(['reply' => $response['choices'][0]['message']['content']]);
    }
}

