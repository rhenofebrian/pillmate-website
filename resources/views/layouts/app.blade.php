<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pillmate')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<style>
    .no-underline a{
        text-decoration: none;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-4 d-flex justify-content-between">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('web-icon/pillmate-icon.png') }}" alt="Logo" width="70" height="70">
        </a>

        <nav class="no-underline d-flex justify-content-center gap-5">
            <a href="{{ route(name: 'chatbot') }}" class="text-light-emphasis">Chatbot</a>
            <a href="{{ route(name: 'tambah-obat') }}" class="text-light-emphasis">Tambah Obat</a>
            <a href="{{ route(name: 'riwayat') }}" class="text-light-emphasis">Riwayat</a>
            <a href="{{ route(name: 'profile') }}" class="text-light-emphasis">Profile</a>
        </nav>

        <div>
            <img src="{{ asset('web-icon/profile.png') }}" alt="" width="50" >
        </div>
    </nav>
 

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>