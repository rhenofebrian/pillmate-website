<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PillMate - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #f9f9f9; }
    .login-btn { font-weight: bold; }   
    .bottom-text a { color: green; font-weight: bold; text-decoration: none; }
  </style>
</head>
<body>
  <div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex justify-center items-center container mt-5">
      <div class="row align-items-center">
        <div class="col-md-6 text-center mb-4 mb-md-0">
          <img src="{{ asset('web-icon/login-icon.png') }}" alt="Login Icon" class="img-fluid" style="max-width: 80%;">
        </div>
        
        <div class="col-md-6">
          <div class="text-center mb-4">
            <img src="{{ asset('web-icon/pillmate-icon.png') }}" alt="pillMate" width="100" height="100">
          </div>
          <h2 class="text-danger mb-3">Selamat Datang Kembali!</h2>
  
          @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
  
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label fw-bold">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="contoh@gmail.com" required value="{{ old('email') }}">
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label fw-bold">Kata Sandi</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="isi di sini" required>
              @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <button type="submit" id="loginBtn" class="btn login-btn btn-warning w-100">Log In</button>
          </form>
  
          <div class="bottom-text text-center mt-3">
            Belum memiliki akun? <a href="{{ route('register.form') }}">Daftar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const form = document.querySelector('form');
    const loginBtn = document.getElementById('loginBtn');

    form.addEventListener('submit', function() {
      loginBtn.disabled = true;
      loginBtn.innerText = 'Sedang memuat data...';
    });
  </script>
</body>
</html>
