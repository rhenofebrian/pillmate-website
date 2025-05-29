<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PillMate - Daftar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <style>
    body {
      background-color: #fcfcfc;
    }
    .logo img {
      width: 40px;
      margin-right: 10px;
    }
    .back-arrow {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      color: gold;
      cursor: pointer;
    }
    .btn-yellow {
      background-color: #f9d65c;
      font-weight: bold;
    }
    .btn-yellow:hover {
      background-color: #f7cc3a;
    }
  </style>
</head>
<body>
  <div class="back-arrow">&#8592;</div>
  <div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
      <div class="col-md-6 d-flex justify-content-center align-items-center mb-4 mb-md-0">
        <img src="doctor-illustration.png" alt="Dokter Ilustrasi" class="img-fluid" style="max-width: 300px;">
      </div>
      <div class="col-md-6">
        <div class="mb-3 d-flex align-items-center">
          <img src="pillmate-logo.png" alt="PillMate">
          <h1 class="ms-2">Pill<span class="text-success">Mate</span></h1>
        </div>
        <h2 class="text-danger">Mulai Pantau Konsumsi Obatmu</h2>
        <form>
          <div class="mb-3">
            <input type="email" class="form-control" placeholder="contoh@gmail.com" required>
          </div>
          <div class="mb-3">
            <input type="text" class="form-control" placeholder="08xxxxxxxx" required>
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" placeholder="isi disini" required>
          </div>
          <button type="submit" class="btn btn-yellow w-100">Log In</button>
        </form>
        <div class="text-center mt-3">
          Sudah memiliki akun? <a href="#" class="text-success text-decoration-none">Masuk</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>