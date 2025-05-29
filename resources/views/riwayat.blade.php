<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Riwayat Obat - Pillmate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f6f6f6;
    }

    .nav-link.active {
      color: green !important;
      text-decoration: underline;
    }

    h2 {
      color: #b22222;
    }

    .riwayat-item {
      border: 2px solid #b22222;
      border-radius: 12px;
      padding: 15px 20px;
      background-color: white;
    }

    .tanggal {
      color: #555;
      font-size: 14px;
      font-weight: 500;
      white-space: nowrap;
    }

    .profile-img {
      height: 40px;
      width: 40px;
      border-radius: 50%;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <header class="d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-white">
    <div class="logo">
      <img src="pillmate-icon.png" alt="Pillmate Logo" height="40" />
    </div>
    <nav class="d-flex gap-4">
      <a href="/chatbot" class="nav-link active">Chatbot</a>
      <a href="/tambahObat" class="nav-link">Tambah Obat</a>
      <a href="/riwayat" class="nav-link">Riwayat</a>
      <a href="/profil" class="nav-link">Profil</a>
    </nav>
    <div class="d-flex align-items-center gap-2 fw-bold text-warning">
      <span>Nadiela</span>
      <img src="profile.jpg" alt="Foto Profil" class="profile-img" />
    </div>
  </header>

  <main class="container my-5" style="max-width: 800px;">
    <h2 class="mb-4">Riwayat Obat</h2>

    <div class="riwayat-item mb-3 d-flex justify-content-between flex-wrap">
      <div>
        <h5 class="mb-1">Paracetamol</h5>
        <p class="mb-0 text-muted">10 buah, sebelum makan, 2 buah sehari</p>
      </div>
      <div class="tanggal">20 Mei 2025</div>
    </div>

    <div class="riwayat-item mb-3 d-flex justify-content-between flex-wrap">
      <div>
        <h5 class="mb-1">Ibuprofen</h5>
        <p class="mb-0 text-muted">20 buah, sesudah makan, 3 buah sehari</p>
      </div>
      <div class="tanggal">20 Mei 2025</div>
    </div>

    <div class="riwayat-item mb-3 d-flex justify-content-between flex-wrap">
      <div>
        <h5 class="mb-1">Bisolvon</h5>
        <p class="mb-0 text-muted">50 mL, sesudah makan, 5 mL sehari</p>
      </div>
      <div class="tanggal">17 Mei 2025</div>
    </div>

    <div class="riwayat-item mb-3 d-flex justify-content-between flex-wrap">
      <div>
        <h5 class="mb-1">Actived</h5>
        <p class="mb-0 text-muted">60 mL, sesudah makan, 10 mL sehari</p>
      </div>
      <div class="tanggal">17 Mei 2025</div>
    </div>
  </main>
</body>
</html>
