@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <h1>Login</h1>
    <p class="sub">Masuk untuk memantau data kehadiran.</p>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}" novalidate>
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   autocomplete="email" required autofocus>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password">Kata sandi</label>
            <input id="password" type="password" name="password"
                   class="@error('password') is-invalid @enderror"
                   autocomplete="current-password" required>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="row">
            <label class="check">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                Ingat saya
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
            @endif
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <p class="switch">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
@endsection