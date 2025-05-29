<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tambah Obat - Pillmate</title>
  <!-- Bootstrap CDN -->
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

    .nav-link.active {
      color: green !important;
      text-decoration: underline;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .form-control, .form-select {
      border: 2px solid #f0c541;
      border-radius: 8px;
    }

    .form-select.red-border {
      border-color: #b22222;
    }

    .btn-yellow {
      background-color: #ffdc6d;
      font-weight: bold;
      border-radius: 10px;
      font-size: 16px;
    }

    h2 {
      color: #b22222;
    }
  </style>
</head>
<body>
  <header class="d-flex justify-content-between align-items-center px-4 py-3">
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

  <main class="container py-5">
    <h2 class="mb-3">Pilih jenis obat :</h2>
    <select class="form-select red-border mb-4">
      <option>Tablet / Kapsul</option>
      <option>Cair / Sirup</option>
      <option>Salep / Topikal</option>
    </select>

    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <label class="form-label">Nama Obat</label>
        <input type="text" class="form-control" placeholder="Masukkan nama obat" />
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Dikonsumsi</label>
        <select class="form-select">
          <option>Sebelum Makan</option>
          <option>Sesudah Makan</option>
          <option>Saat Makan</option>
        </select>
      </div>
    </div>

    <div class="row mb-4">
      <div class="col-md-6 mb-3">
        <label class="form-label">Jumlah Obat</label>
        <div class="input-group">
          <input type="number" class="form-control" placeholder="Masukkan jumlah obat" />
          <span class="input-group-text">buah</span>
        </div>
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Dosis</label>
        <div class="d-flex align-items-center gap-2">
          <input type="number" class="form-control" style="max-width: 80px;" placeholder="1/2/3/..." />
          <span>buah</span>
          <span style="font-size: 18px;">×</span>
          <input type="number" class="form-control" style="max-width: 80px;" placeholder="1/2/3/..." />
          <span>hari</span>
        </div>
      </div>
    </div>

    <button class="btn btn-yellow w-100 mt-4">Lanjutkan</button>
  </main>
</body>
</html>