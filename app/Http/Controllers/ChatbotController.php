<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user) {    
            return view("chatbot");
        }
        
        return redirect("login");
    }
    
    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string|max:500',
            ]);
            
            $userMessage = $request->message;
            $user = Auth::user();
            $userName = $user ? $user->name : 'Pengguna';
            
            // Menggunakan Groq API yang sudah terintegrasi
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama3-8b-8192', // Model gratis dari Groq
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'Kamu adalah asisten kesehatan Pillmate yang ramah dan membantu. 
                        Berikan informasi kesehatan ringan yang akurat dan mudah dipahami dalam Bahasa Indonesia.
                        Jangan memberikan diagnosis medis yang serius atau resep obat spesifik.
                        Selalu sarankan konsultasi dengan dokter untuk keluhan serius.
                        Jawab dengan singkat, jelas, dan sopan.
                        Jika ditanya tentang obat, berikan informasi umum saja tanpa merekomendasikan dosis spesifik.'
                    ],
                    [
                        'role' => 'user',
                        'content' => "Halo, saya {$userName}. {$userMessage}"
                    ]
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                $botReply = $data['choices'][0]['message']['content'];
                
                Log::info('Groq API Response: ' . $botReply);
                
                return response()->json(['reply' => $botReply]);
            }
            
            throw new \Exception('Groq API error: ' . $response->body());
            
        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage());
            
            return response()->json([
                'error' => true,
                'reply' => 'Maaf, terjadi kesalahan saat memproses pesan Anda. Silakan coba lagi nanti.'
            ], 500);
        }
    }
}
