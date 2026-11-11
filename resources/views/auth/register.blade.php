@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>
    <p class="sub">Buat akun Tappy untuk mulai mengelola absensi.</p>

    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <div class="field">
            <label for="name">Nama lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   class="@error('name') is-invalid @enderror"
                   autocomplete="name" required autofocus>
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   class="@error('email') is-invalid @enderror"
                   autocomplete="email" required>
            @error('email')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password">Kata sandi</label>
            <input id="password" type="password" name="password"
                   class="@error('password') is-invalid @enderror"
                   autocomplete="new-password" required>
            @error('password')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">Ulangi kata sandi</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   autocomplete="new-password" required>
        </div>

        <button type="submit" class="btn">Daftar</button>
    </form>

    <p class="switch">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
@endsection