<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pillmate Chatbot</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f6f6f6;
      color: #333;
    }

    header {
      background-color: white;
      border-bottom: 1px solid #ccc;
    }

    .chatbox {
      background: white;
      border: 2px solid #b22222;
      border-radius: 10px;
      padding: 15px;
      font-size: 16px;
      margin-bottom: 15px;
    }

    .btn-yellow {
      background-color: #ffdc6d;
      font-weight: bold;
      border-radius: 10px;
    }

    .nav-link.active {
      color: green !important;
      text-decoration: underline;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
</head>
<body>
  <header class="d-flex justify-content-between align-items-center p-3 px-4">
    <div class="logo">
      <img src="pillmate-icon.png" alt="Pillmate Logo" height="40" />
    </div>
    <nav class="d-flex gap-4">
      <a href="#" class="nav-link active">Chatbot</a>
      <a href="#" class="nav-link">Tambah Obat</a>
      <a href="#" class="nav-link">Riwayat</a>
      <a href="#" class="nav-link">Profil</a>
    </nav>
    <div class="d-flex align-items-center gap-2 fw-bold text-warning">
      <span>Nadiela</span>
      <img src="profile.jpg" alt="Foto Profil" class="profile-img" />
    </div>
  </header>

  <main class="container text-center py-5">
    <h1 class="text-danger mb-4">Halo, Pillmaters!!</h1>
    <div class="mx-auto" style="max-width: 400px;">
      <div class="chatbox">
        <p>Perkenalkan saya adalah Pillmate chatbot</p>
      </div>
      <div class="chatbox">
        <p>Ceritakan keluhan Anda dan saya akan membantu memberikan analisis awal. 💊✨</p>
      </div>
