<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PillMate - Daftar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background-color: #fcfcfc; }
    .logo img { width: 40px; margin-right: 10px; }
    .btn-warning{font-weight: bold;}
  </style>
</head>
<body>
  <div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100">
      <div class="col-md-6 d-flex justify-content-center align-items-center mb-4 mb-md-0">
        <img src="{{ asset('web-icon/register-icon.png') }}" alt="Dokter Ilustrasi" class="img-fluid" style="max-width: 300px;">
      </div>
      <div class="col-md-6">
        <div class="text-center">
          <img src="{{ asset('web-icon/pillmate-icon.png') }}" alt="PillMate">
        </div>
        <h2 class="text-danger mb-3">Mulai Pantau Konsumsi Obatmu</h2>
        
        <form method="POST" action="{{ route('register') }}">
          @csrf
          <div class="mb-3">
              <label>Email:</label>
              <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
              @error('email') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-3">
              <label>Phone Number:</label>
              <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}">
              @error('phone_number') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-3">
              <label>Password:</label>
              <input type="password" name="password" class="form-control" required>
              @error('password') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-3">
              <label>Konfirmasi Password:</label>
              <input type="password" name="password_confirmation" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-warning w-100">Register</button>
        </form>
        
        <div class="text-center mt-3">
          Sudah memiliki akun? <a href="{{ route('login.form') }}" class="text-success text-decoration-none">Masuk</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
