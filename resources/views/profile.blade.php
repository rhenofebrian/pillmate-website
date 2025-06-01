@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-4">
    <div class="row align-items-center">

        <div class="col-md-3 text-center">
            @if($user->avatar)
                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar" class="img-fluid rounded-circle mb-3" style="max-width: 150px;">
            @else
                <img src="{{ asset('web-icon/profile.png') }}" alt="Avatar Default" class="img-fluid rounded-circle mb-3" width="120">
            @endif
        </div>

        <div class="col-md-9">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           value="{{ old('username', $user->username ?? '') }}" placeholder="Masukkan username" disabled>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Nomor Handphone</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" 
                           value="{{ old('phone_number', $user->phone_number ?? '') }}" placeholder="Masukkan nomor handphone" disabled>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" value="********" disabled>
                </div>

                <div class="d-flex justify-around gap-2">
                    <button type="button" id="edit-btn" class="btn btn-primary">Edit</button>
                    <button type="submit" id="save-btn" class="btn btn-success d-none">Simpan Perubahan</button>
                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </button>
                </div>
            </form>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>

<script>
    const editBtn = document.getElementById('edit-btn');
    const saveBtn = document.getElementById('save-btn');

    // Input yang ingin di-enable saat edit
    const usernameInput = document.getElementById('username');
    const phoneInput = document.getElementById('phone_number');

    editBtn.addEventListener('click', () => {
        usernameInput.disabled = false;
        phoneInput.disabled = false;

        editBtn.classList.add('d-none'); // sembunyikan tombol Edit
        saveBtn.classList.remove('d-none'); // tampilkan tombol Simpan
    });
</script>
@endsection
