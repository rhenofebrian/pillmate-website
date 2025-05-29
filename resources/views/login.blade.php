<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PillMate - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <style>
    body {
      background: #f9f9f9;
    }
    .login-btn {
      background-color: #f9d65c;
      font-weight: bold;
    }
    .back-arrow {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      color: #f9d65c;
      cursor: pointer;
    }
    .bottom-text a {
      color: green;
      font-weight: bold;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="back-arrow">&#8592;</div>
  <div class="container mt-5">
    <div class="row align-items-center">
      <div class="col-md-6 text-center mb-4 mb-md-0">
        <img src="{{ asset('web-icon/login-icon.png') }}" alt="Login Icon" class="img-fluid" style="max-width: 80%;">
      </div>
      
      <div class="col-md-6">
        <div class="text-center mb-4">
          <img src="{{ asset('web-icon/pillmate-icon.png') }}" alt="pillMate" width="100" height="100">
        </div>
        <h2 class="text-danger mb-3">Selamat Datang Kembali!</h2>
        <form>
          <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" placeholder="contoh@gmail.com">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label fw-bold">Kata Sandi</label>
            <input type="password" class="form-control" id="password" placeholder="isi disini">
          </div>
          <button type="submit" class="btn login-btn w-100">
              <a href="/chatbot">Log In</a>
          </button>
        <form>
        <div class="bottom-text text-center mt-3">
          Belum memiliki akun? <a href="#">Daftar</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
