@extends('layouts.guest')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Peminjaman</b>Alat</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register akun baru</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>

                <!-- NIM -->
                <div class="input-group mb-3">
                    <input type="text" name="nim" class="form-control" placeholder="NIM" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                    </div>
                </div>

                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>

                <!-- Nomor HP -->
                <div class="input-group mb-3">
                    <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="input-group mb-3">
                    <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Ulangi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('login') }}">Sudah punya akun?</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection@extends('layouts.guest')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>Peminjaman</b>Alat</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register akun baru</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Nama -->
                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>

                <!-- NIM -->
                <div class="input-group mb-3">
                    <input type="text" name="nim" class="form-control" placeholder="NIM" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-id-card"></span></div>
                    </div>
                </div>

                <!-- Email -->
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>

                <!-- Nomor HP -->
                <div class="input-group mb-3">
                    <input type="text" name="no_hp" class="form-control" placeholder="Nomor HP" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-phone"></span></div>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="input-group mb-3">
                    <textarea name="alamat" class="form-control" placeholder="Alamat" required></textarea>
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <!-- Konfirmasi Password -->
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Ulangi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <a href="{{ route('login') }}">Sudah punya akun?</a>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection