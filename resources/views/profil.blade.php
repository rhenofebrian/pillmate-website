<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil - Pillmate</title>
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

    .profile-img {
      height: 40px;
      width: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .profile-picture {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      object-fit: cover;
    }

    .form-control {
      border: 2px solid #f5d670;
      border-radius: 8px;
    }

    .btn-yellow {
      background-color: #f5d670;
      font-weight: bold;
      font-size: 16px;
      border-radius: 10px;
    }

    .btn-logout {
      color: #b22222;
      font-weight: bold;
      text-decoration: none;
      display: block;
      text-align: center;
      margin-top: 20px;
    }

    .input-password {
      position: relative;
    }

    .toggle-password {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
      color: #888;
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

  <main class="container my-5">
    <div class="row g-5">
      <div class="col-md-4 text-center">
        <img src="profile.jpg" alt="Foto Pengguna" class="profile-picture mb-3" />
        <h5>Foto Profil</h5>
      </div>
      <div class="col-md-8">
        <form>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Pengguna</label>
            <input type="text" class="form-control" id="nama" value="Nadiela" />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" value="dela112@gmail.com" />
          </div>
          <div class="mb-3">
            <label for="telepon" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" id="telepon" value="08123456789" />
          </div>
          <div class="mb-3 input-password">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" class="form-control" id="password" value="passwordku" />
            <span class="toggle-password" onclick="togglePassword()">👁️</span>
          </div>
          <button type="submit" class="btn btn-yellow w-100 mt-4">Simpan</button>
        </form>
        <a href="#" class="btn-logout">Keluar</a>
      </div>
    </div>
  </main>

  <script>
    function togglePassword() {
      const input = document.getElementById('password');
      input.type = input.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>