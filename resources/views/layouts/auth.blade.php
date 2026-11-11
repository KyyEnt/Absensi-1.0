<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') – Tappy</title>
    <style>
        :root {
            --bg: #121417;
            --panel: #181b20;
            --line: #3a4049;
            --text: #f2f4f7;
            --muted: #a3acb9;
            --accent: #2fd18b;
            --ink: #06281a;
            --danger: #ff6b6b;
            color-scheme: dark;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: radial-gradient(800px 460px at 50% 30%, #1c2530, var(--bg));
            color: var(--text);
            font: 16px/1.6 "Trebuchet MS", "Segoe UI", system-ui, sans-serif
        }

        a {
            color: inherit;
            text-decoration: none
        }

        a:focus-visible,
        input:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 2px
        }

        .top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            border-bottom: 1px solid var(--line)
        }

        .logo {
            font-weight: 900;
            font-size: 1.6rem;
            letter-spacing: .03em
        }

        .back {
            color: var(--muted);
            font-weight: 700
        }

        .back:hover {
            color: var(--text)
        }

        main {
            flex: 1;
            display: grid;
            place-items: center;
            padding: 32px 20px
        }

        .card {
            width: 100%;
            max-width: 420px;
            background: var(--panel);
            border: 1.5px solid var(--line);
            border-radius: 20px;
            padding: 32px
        }

        h1 {
            margin: 0 0 6px;
            font-size: 1.7rem;
            font-weight: 900
        }

        .sub {
            margin: 0 0 24px;
            color: var(--muted)
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 700;
            font-size: .95rem
        }

        .field {
            margin-bottom: 18px
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 13px 14px;
            border-radius: 10px;
            border: 1.5px solid var(--line);
            background: var(--bg);
            color: var(--text);
            font: inherit
        }

        input:focus {
            border-color: var(--accent)
        }

        input.is-invalid {
            border-color: var(--danger)
        }

        .error {
            margin: 6px 0 0;
            color: var(--danger);
            font-size: .88rem
        }

        .alert {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid var(--danger);
            color: var(--danger);
            font-size: .92rem
        }

        .status {
            margin-bottom: 18px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid var(--accent);
            color: var(--accent);
            font-size: .92rem
        }

        .row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            font-size: .92rem
        }

        .check {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--muted);
            margin: 0;
            font-weight: 400
        }

        .check input {
            accent-color: var(--accent);
            width: 17px;
            height: 17px
        }

        .btn {
            width: 100%;
            padding: 14px;
            border: 0;
            border-radius: 12px;
            background: var(--accent);
            color: var(--ink);
            font: inherit;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 5px 0 #1a9e68;
            transition: transform .08s, box-shadow .08s
        }

        .btn:hover {
            transform: translateY(2px);
            box-shadow: 0 3px 0 #1a9e68
        }

        .btn:active {
            transform: translateY(5px);
            box-shadow: none
        }

        .switch {
            margin: 22px 0 0;
            text-align: center;
            color: var(--muted);
            font-size: .95rem
        }

        .switch a,
        .row a {
            color: var(--accent);
            font-weight: 700
        }

        .switch a:hover,
        .row a:hover {
            text-decoration: underline
        }
    </style>
</head>

<body>
    <header class="top">
        <a href="{{ url('/') }}" class="logo">TAPPY</a>
        <a href="{{ url('/') }}" class="back">Kembali ke beranda</a>
    </header>

    <main>
        <div class="card">
            @yield('content')
        </div>
    </main>
</body>

</html>
