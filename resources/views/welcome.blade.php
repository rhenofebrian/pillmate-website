<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pillmate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('web-icon/pillmate-icon.png') }}" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
            </a>
            <div class="d-flex gap-4" role="search">
                <a href="{{ route('login') }}" class="btn btn-light">Login</a>
                <a href="{{ route('register') }}" class="btn btn-warning">Register</a>
            </div>
        </div>
    </nav>
    <div class="px-5">
        <!-- Hero Section -->
        <div class="row g-4 align-items-center text-start">
            <div class="col-12 col-md-6 text-center">
                <img src="{{ asset('web-icon/hero-icon.png') }}" alt="hero-icon" class="img-fluid" style="max-width: 300px;">
            </div>
            <div class="col-12 col-md-6">
                <p class="text-danger fw-bold mb-2">Asisten pribadi untuk konsumsi obat — kapan saja, di mana saja.</p>
                <p>Kelola kesehatan Anda dengan pencatatan obat yang mudah, pengingat pintar, dan rekomendasi yang dipersonalisasi. PillMate membantu Anda tetap teratur dalam menjalani pengobatan, hanya dalam beberapa langkah.</p>
                <button type="button" class="btn btn-warning">Mulai Perjalanan Sehatmu</button>
            </div>
        </div>

        <div class="row g-4 mt-4">
            <div class="col-12 col-md-6">
                <div class="d-flex border border-danger p-3 flex-wrap">
                    <img src="{{ asset('web-icon/chatbot-icon.png') }}" alt="chatbot-icon" class="img-fluid" width="105" height="105">
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <p class="text-danger fw-bold mb-1">Chatbot Rekomendasi Obat</p>
                        <p>Membantu dalam mencari obat yang sesuai dengan gejala</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex border border-danger p-3 flex-wrap">
                    <img src="{{ asset('web-icon/history-icon.png') }}" alt="history-icon" class="img-fluid" width="120" height="120">
                    <div class="d-flex flex-column justify-content-center ms-3">
                        <p class="text-danger fw-bold mb-1">Riwayat Obat</p>
                        <p>Catat dan tampilkan obat yang pernah dikonsumsi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>