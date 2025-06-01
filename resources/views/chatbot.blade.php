@extends('layouts.app')

@section('title', 'Chatbot - Pillmate')

@section('styles')
<style>
    .chatbot-container {
        min-height: 85vh;
        background: #f8f9fa;
        border-radius: 15px;
    }

    .chat-area {
        height: 65vh;
        background: white;
        border-radius: 15px;
        border: 1px solid #dee2e6;
    }

    /* User messages - KANAN (Bootstrap) */
    .user-message {
        justify-content: flex-end !important;
    }

    .user-message .message-bubble {
        background: #007bff !important;
        color: white !important;
        border-radius: 18px 18px 4px 18px !important;
        max-width: 70%;
        margin-left: auto;
    }

    /* Bot messages - KIRI (Bootstrap) */
    .bot-message {
        justify-content: flex-start !important;
    }

    .bot-message .message-bubble {
        background: #e9ecef !important;
        color: #212529 !important;
        border-radius: 18px 18px 18px 4px !important;
        max-width: 70%;
        margin-right: auto;
    }

    .message-bubble {
        padding: 12px 16px;
        font-size: 14px;
        line-height: 1.4;
        word-wrap: break-word;
        white-space: pre-wrap;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .typing-indicator {
        justify-content: flex-start !important;
    }

    .typing-bubble {
        background: #e9ecef;
        border-radius: 18px 18px 18px 4px;
        padding: 12px 16px;
    }

    .typing-dot {
        width: 6px;
        height: 6px;
        background-color: #6c757d;
        border-radius: 50%;
        margin: 0 2px;
        animation: typing 1.4s infinite ease-in-out;
    }

    .typing-dot:nth-child(1) { animation-delay: 0s; }
    .typing-dot:nth-child(2) { animation-delay: 0.2s; }
    .typing-dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes typing {
        0%, 60%, 100% {
            transform: translateY(0);
            opacity: 0.4;
        }
        30% {
            transform: translateY(-6px);
            opacity: 1;
        }
    }

    .chat-input-form {
        border: 1px solid #ced4da;
        border-radius: 25px;
        background: white;
    }

    .chat-input {
        border: none;
        outline: none;
        border-radius: 25px;
        padding-right: 60px;
    }

    .send-button {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        background: #007bff;
        color: white;
        transition: all 0.3s ease;
    }

    .send-button:hover {
        background: #0056b3;
        transform: translateY(-50%) scale(1.05);
    }

    .send-button:disabled {
        background: #6c757d;
        cursor: not-allowed;
        transform: translateY(-50%);
    }

    .suggested-question {
        transition: all 0.2s ease;
        cursor: pointer;
        border-radius: 15px;
        font-size: 13px;
    }

    .suggested-question:hover {
        background: #e9ecef !important;
        border-color: #007bff !important;
        color: #007bff !important;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #28a745;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message-row {
        animation: fadeInUp 0.3s ease;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="chatbot-container p-4 mt-5">
                
                <!-- Welcome Section -->
                <div class="text-center mb-4" id="welcomeSection">
                    <img src="{{ asset('web-icon/welcoming.png') }}" alt="Welcome" class="img-fluid" style="max-width: 170px;">
                </div>
                
                <!-- Introduction Section -->
                <div class="text-center d-flex flex-column justify-items-center justify-content-center align-items-center" id="introSection">
                    <div class="mb-3 d-flex flex-column">
                        <img src="{{ asset('web-icon/chat1.png') }}" alt="Chat Introduction 1" class="img-fluid mb-2" style="max-width: 330px;">
                        <img src="{{ asset('web-icon/chat2.png') }}" alt="Chat Introduction 2" class="img-fluid" style="max-width: 330px;">
                    </div>
                    <button class="btn btn-success btn-lg px-4 py-2" id="startChatBtn">
                        <i class="bi bi-chat-dots me-2"></i>Mulai Konsultasi
                    </button>
                </div>
                
                <!-- Chat Interface (Initially Hidden) -->
                <div class="d-none" id="chatArea">
                    <!-- Chat Header -->
                    <div class="text-center mb-4 pb-3 border-bottom">
                        <h4 class="fw-bold text-dark mb-2">
                            <i class="bi bi-robot me-2"></i>Pillmate Chatbot
                        </h4>
                        <p class="text-muted mb-2">Asisten kesehatan AI yang siap membantu Anda</p>
                        <span class="badge bg-success-subtle text-success px-3 py-2">
                            <span class="status-dot me-2"></span>Online
                        </span>
                    </div>
                    
                    <!-- Chat Messages Area -->
                    <div class="chat-area overflow-auto p-3 mb-3" id="messagesContainer">
                        <!-- Initial bot messages -->
                        <div class="d-flex mb-3 message-row bot-message">
                            <div class="message-bubble">
                                Perkenalkan saya adalah Pillmate chatbot
                            </div>
                        </div>
                        
                        <div class="d-flex mb-3 message-row bot-message">
                            <div class="message-bubble">
                                Ceritakan keluhan Anda dan saya akan membantu memberikan analisis awal. 🔍
                            </div>
                        </div>
                        
                        <!-- Suggested questions -->
                        <div class="mt-3" id="suggestedQuestions">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="card border-secondary suggested-question" data-question="Aku mempunyai keluhan sakit kepala">
                                        <div class="card-body py-2 px-3">
                                            <small class="text-muted">Aku mempunyai keluhan sakit kepala</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card border-secondary suggested-question" data-question="Bagaimana cara mengatasi demam?">
                                        <div class="card-body py-2 px-3">
                                            <small class="text-muted">Bagaimana cara mengatasi demam?</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card border-secondary suggested-question" data-question="Apa yang harus dilakukan saat batuk?">
                                        <div class="card-body py-2 px-3">
                                            <small class="text-muted">Apa yang harus dilakukan saat batuk?</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card border-secondary suggested-question" data-question="Tips menjaga kesehatan harian">
                                        <div class="card-body py-2 px-3">
                                            <small class="text-muted">Tips menjaga kesehatan harian</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Typing indicator -->
                        <div class="d-none mb-3 message-row typing-indicator" id="typingIndicator">
                            <div class="typing-bubble d-flex align-items-center">
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                                <div class="typing-dot"></div>
                            </div>
                        </div>
                        
                        <!-- Disclaimer -->
                        <div class="alert alert-warning mt-4" role="alert">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Disclaimer:</strong> Asisten ini memberikan informasi umum dan bukan pengganti konsultasi dengan profesional kesehatan.
                        </div>
                    </div>
                    
                    <!-- Chat Input -->
                    <div class="position-relative" id="chatInputContainer">
                        <form id="chatForm">
                            @csrf
                            <div class="chat-input-form p-2 position-relative d-flex flex-row gap-2">
                                <input type="text" class="form-control chat-input" id="userMessage" placeholder="Ketik pesan Anda..." autocomplete="off">
                                <button type="submit" class="send-button" id="sendButton">
                                    <i class="bi bi-send-fill"></i>
                                </button>
                            </div>
                        </form>
                        <div class="text-center mt-2">
                            <small class="text-muted">Tekan Enter untuk mengirim</small>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const startChatBtn = document.getElementById('startChatBtn');
    const welcomeSection = document.getElementById('welcomeSection');
    const introSection = document.getElementById('introSection');
    const chatArea = document.getElementById('chatArea');
    const chatInputContainer = document.getElementById('chatInputContainer');
    const chatForm = document.getElementById('chatForm');
    const userMessage = document.getElementById('userMessage');
    const messagesContainer = document.getElementById('messagesContainer');
    const typingIndicator = document.getElementById('typingIndicator');
    const sendButton = document.getElementById('sendButton');
    const suggestedQuestions = document.getElementById('suggestedQuestions');
    
    // Start chat when button is clicked
    startChatBtn.addEventListener('click', function() {
        welcomeSection.classList.add('d-none');
        introSection.classList.add('d-none');
        chatArea.classList.remove('d-none');
        
        // Scroll to bottom and focus input
        scrollToBottom();
        userMessage.focus();
    });
    
    // Handle suggested questions
    suggestedQuestions.addEventListener('click', function(e) {
        const questionCard = e.target.closest('.suggested-question');
        if (questionCard) {
            const question = questionCard.getAttribute('data-question');
            sendMessage(question);
            suggestedQuestions.classList.add('d-none');
        }
    });
    
    // Handle form submission
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const message = userMessage.value.trim();
        if (message === '') return;
        
        sendMessage(message);
        userMessage.value = '';
    });
    
    function sendMessage(message) {
        // Hide suggested questions after first message
        suggestedQuestions.classList.add('d-none');
        
        // Disable input and button while processing
        userMessage.disabled = true;
        sendButton.disabled = true;
        sendButton.innerHTML = '<i class="bi bi-hourglass-split"></i>';
        
        // Add user message to chat (KANAN)
        addMessage('user', message);
        
        // Show typing indicator
        typingIndicator.classList.remove('d-none');
        typingIndicator.classList.add('d-flex');
        scrollToBottom();
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                         document.querySelector('input[name="_token"]')?.value || '';
        
        // Send message to server
        fetch('{{ route("chatbot.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                message: message
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            // Hide typing indicator
            typingIndicator.classList.add('d-none');
            typingIndicator.classList.remove('d-flex');
            
            // Add bot response to chat (KIRI)
            if (data.error) {
                addMessage('bot', data.reply || 'Maaf, terjadi kesalahan. Silakan coba lagi.');
            } else {
                addMessage('bot', data.reply);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            
            // Hide typing indicator
            typingIndicator.classList.add('d-none');
            typingIndicator.classList.remove('d-flex');
            
            // Add error message (KIRI)
            addMessage('bot', 'Maaf, terjadi kesalahan jaringan. Silakan periksa koneksi internet Anda dan coba lagi.');
        })
        .finally(() => {
            // Re-enable input and button
            userMessage.disabled = false;
            sendButton.disabled = false;
            sendButton.innerHTML = '<i class="bi bi-send-fill"></i>';
            userMessage.focus();
        });
    }
    
    // Function to add message to chat
    function addMessage(sender, content) {
        const messageRow = document.createElement('div');
        messageRow.className = `d-flex mb-3 message-row ${sender}-message`;
        
        const messageBubble = document.createElement('div');
        messageBubble.className = 'message-bubble';
        messageBubble.innerHTML = formatMessage(content);
        
        messageRow.appendChild(messageBubble);
        
        // Insert before disclaimer
        const disclaimer = messagesContainer.querySelector('.alert');
        messagesContainer.insertBefore(messageRow, disclaimer);
        
        scrollToBottom();
        
        // Debug log untuk memastikan posisi
        console.log(`Added ${sender} message:`, content);
        console.log(`Message classes:`, messageRow.className);
    }
    
    // Function to format message (convert newlines to <br>)
    function formatMessage(content) {
        return escapeHtml(content).replace(/\n/g, '<br>');
    }
    
    // Function to escape HTML
    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    
    // Function to scroll to bottom of chat
    function scrollToBottom() {
        setTimeout(() => {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 100);
    }
    
    // Enable/disable send button based on input
    userMessage.addEventListener('input', function() {
        sendButton.disabled = !userMessage.value.trim();
    });
    
    // Handle Enter key
    userMessage.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            chatForm.dispatchEvent(new Event('submit'));
        }
    });
    
    // Initial state
    sendButton.disabled = true;
});
</script>
@endsection
