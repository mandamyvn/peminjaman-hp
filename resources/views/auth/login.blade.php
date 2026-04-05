@extends('layouts.guest')

@section('content')
<div class="login-box">
 <div class="login-logo">
    <a href="#" class="login-title">
        <span class="title-bold">PEMINJAMAN</span> <span class="title-accent">HP</span>
    </a>
</div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="input-group mb-3">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus
                           placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="input-group mb-3">
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror"
                           name="password"
                           required
                           autocomplete="current-password"
                           placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="btnLogin" class="btn btn-primary btn-block">
                            Sign In
                        </button>
                    </div>
                </div>
            </form>

            {{-- AUDIO --}}
           <audio id="loginSound">
    <source src="{{ asset('audio/suara.wav') }}" type="audio/wav">
</audio>

            {{-- Forgot & Register --}}
            @if (Route::has('password.request'))
                <p class="mb-1 mt-2">
                    <a href="{{ route('password.request') }}">I forgot my password</a>
                </p>
            @endif

            @if (Route::has('register'))
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">
                        Register akun baru
                    </a>
                </p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
/* ================= BACKGROUND ================= */
body.login-page {
    background: url('{{ asset('img/backgroundhp.png') }}') no-repeat center center fixed;
    background-size: cover;
}

/* Overlay gelap */
body.login-page::before {
    content: "";
    position: fixed;
    inset: 0;
    background: rgba(10, 25, 40, 0.55);
    z-index: -1;
}

/* ================= LOGIN TITLE ================= */
.login-title {
    font-size: 32px;
    font-weight: 900;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-decoration: none;
}

.login-title .title-bold {
    color: #ffffff;
    text-shadow: 0 4px 10px rgba(0,0,0,.7);
}

.login-title .title-accent {
    color: #fbbf24;
    text-shadow: 0 4px 10px rgba(0,0,0,.7);
}

/* ================= LOGIN BOX ================= */
.login-box {
    width: 380px;
}

/* ================= CARD GLASS EFFECT ================= */
.card {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.3);
    box-shadow: 0 20px 40px rgba(0,0,0,0.45);
}

.login-card-body {
    background: transparent;
    color: #ffffff;
}

.login-box-msg,
.login-card-body label,
.login-card-body a {
    color: #f1f5f9;
}

.form-control {
    background: rgba(255,255,255,0.9);
    border-radius: 8px;
}

.btn-primary {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    border: none;
    font-weight: 600;
    border-radius: 8px;
}

.btn-primary:hover {
    opacity: .9;
}

@media (max-width: 576px) {
    .login-box {
        width: 90%;
    }
}
</style>
@endsection

@section('scripts')
<script>
document.getElementById('btnLogin').addEventListener('click', function (e) {
    e.preventDefault(); // tahan submit

    const sound = document.getElementById('loginSound');
    sound.play();

    setTimeout(() => {
        document.getElementById('loginForm').submit();
    }, 500); // delay biar suara sempat bunyi
});
</script>
@endsection