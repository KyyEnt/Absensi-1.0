<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>Tappy – Tap, Track, Done.</title>
    <style>
        :root {
            --bg: #121417;
            --panel: #181b20;
            --line: #3a4049;
            --text: #f2f4f7;
            --muted: #a3acb9;
            --accent: #2fd18b;
            --ink: #06281a;
            color-scheme: dark;
            box-sizing: border-box;
            padding-top: env(safe-area-inset-top, 0px);
            padding-bottom: env(safe-area-inset-bottom, 0px);
        }

        *,
        *::before,
        *::after {
            box-sizing: inherit
        }

        html {
            scroll-behavior: smooth;
            scroll-padding-top: 76px
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font: 16px/1.65 "Trebuchet MS", "Segoe UI", system-ui, sans-serif
        }

        a {
            color: inherit;
            text-decoration: none
        }

        a:focus-visible {
            outline: 3px solid var(--accent);
            outline-offset: 3px
        }

        .wrap {
            max-width: 1040px;
            margin: 0 auto;
            padding: 0 24px
        }

        header {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(18, 20, 23, .94);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--line)
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 68px
        }

        .logo {
            font-weight: 900;
            font-size: 1.6rem;
            letter-spacing: .03em
        }

        .links {
            display: flex;
            align-items: center;
            gap: 4px
        }

        .links a {
            padding: 8px 14px;
            border-radius: 8px;
            font-weight: 700;
            color: var(--muted)
        }

        .links a:hover {
            color: var(--text);
            background: var(--panel)
        }

        .links .login {
            background: var(--accent);
            color: var(--ink);
            margin-left: 6px
        }

        .links .login:hover {
            background: #5be3a9;
            color: var(--ink)
        }

        section {
            min-height: 100vh;
            min-height: 100svh;
            display: flex;
            align-items: center;
            padding: 96px 0
        }

        #home {
            justify-content: center;
            text-align: center;
            position: relative;
            background: radial-gradient(800px 460px at 50% 45%, #1c2530, var(--bg))
        }

        h1 {
            font-size: clamp(3rem, 10vw, 6.5rem);
            line-height: 1;
            margin: 0 0 20px;
            font-weight: 900;
            letter-spacing: -.02em
        }

        #home p {
            color: var(--muted);
            font-size: 1.15rem;
            margin: 0 auto 32px;
            max-width: 480px
        }

        .btn {
            display: inline-block;
            padding: 15px 34px;
            border-radius: 12px;
            font-weight: 800;
            background: var(--accent);
            color: var(--ink);
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

        .scroll {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--muted);
            font-size: .9rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px
        }

        .scroll b {
            width: 2px;
            height: 28px;
            background: linear-gradient(var(--accent), transparent);
            animation: drop 1.6s ease-in-out infinite
        }

        @keyframes drop {
            0% {
                transform: scaleY(0);
                transform-origin: top
            }

            50% {
                transform: scaleY(1);
                transform-origin: top
            }

            51% {
                transform-origin: bottom
            }

            100% {
                transform: scaleY(0);
                transform-origin: bottom
            }
        }

        @media (prefers-reduced-motion:reduce) {
            .scroll b {
                animation: none
            }

            html {
                scroll-behavior: auto
            }
        }

        .title {
            font-size: clamp(1.6rem, 3.5vw, 2.1rem);
            font-weight: 900;
            margin: 0 0 32px;
            padding-bottom: 12px;
            border-bottom: 2px solid var(--text);
            display: inline-block;
            min-width: min(100%, 360px)
        }

        #about .box {
            border: 1.5px solid var(--line);
            border-radius: 20px;
            background: var(--panel);
            padding: 36px
        }

        #about p {
            margin: 0 0 16px;
            max-width: 68ch;
            color: #d5dae2
        }

        #about .lead {
            font-weight: 800;
            font-size: 1.15rem;
            color: var(--text)
        }

        #about .mission {
            margin: 0;
            color: var(--accent);
            font-weight: 800
        }

        #fakta {
            background: var(--panel)
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px
        }

        .stat {
            border: 1.5px solid var(--line);
            border-radius: 18px;
            padding: 32px 20px;
            text-align: center;
            background: var(--bg)
        }

        .stat b {
            display: block;
            font-size: clamp(2rem, 5vw, 3rem);
            line-height: 1.1;
            color: var(--accent)
        }

        .stat span {
            font-weight: 700;
            color: var(--muted)
        }

        .feat {
            display: grid;
            grid-template-columns: 1fr 1fr
        }

        .feat>div {
            padding: 22px 28px;
            border-bottom: 1px solid var(--line)
        }

        .feat>div:nth-child(odd) {
            border-right: 1px solid var(--line);
            padding-left: 0
        }

        .feat>div:nth-child(even) {
            padding-right: 0
        }

        .feat>div:nth-last-child(-n+2) {
            border-bottom: 0
        }

        .feat h3 {
            margin: 0 0 6px;
            font-size: 1.15rem
        }

        .feat p {
            margin: 0;
            color: var(--muted);
            font-size: .95rem
        }

        footer {
            background: var(--panel);
            border-top: 1px solid var(--line);
            padding: 48px 0
        }

        .foot {
            display: grid;
            grid-template-columns: 1fr 1.4fr;
            gap: 40px;
            align-items: start
        }

        footer .logo {
            display: block;
            margin-bottom: 16px;
            font-size: 2rem
        }

        .map {
            height: 150px;
            border: 1.5px solid var(--line);
            border-radius: 18px;
            display: grid;
            place-items: center;
            color: var(--muted);
            font-weight: 700;
            background: linear-gradient(90deg, transparent 49%, #242a33 50%, transparent 51%) 0 0/60px 60px, linear-gradient(transparent 49%, #242a33 50%, transparent 51%) 0 0/60px 60px, var(--bg)
        }

        .map span {
            background: var(--bg);
            padding: 4px 12px;
            border-radius: 999px;
            border: 1px solid var(--line)
        }

        .addr h4 {
            margin: 0 0 8px;
            font-size: 1.1rem
        }

        .addr p {
            margin: 0 0 6px;
            color: var(--muted)
        }

        .copy {
            margin-top: 40px;
            color: var(--muted);
            font-size: .9rem;
            text-align: center
        }

        @media (max-width:760px) {
            .links a:not(.login) {
                padding: 8px 8px;
                font-size: .9rem
            }

            .feat,
            .foot {
                grid-template-columns: 1fr
            }

            .feat>div,
            .feat>div:nth-child(odd),
            .feat>div:nth-child(even) {
                border-right: 0;
                padding: 18px 0;
                border-bottom: 1px solid var(--line)
            }

            .feat>div:last-child {
                border-bottom: 0
            }

            #about .box {
                padding: 24px
            }

            .stats {
                gap: 12px
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="wrap" aria-label="Navigasi utama">
            <a href="#home" class="logo">TAPPY</a>
            <div class="links">
                <a href="#tentang">Tentang</a>
                <a href="#fakta">Fakta</a>
                <a href="#fitur">Fitur</a>
                <a href="/login" class="login">Login</a>
            </div>
        </nav>
    </header>

    <main>
        <section id="home">
            <div class="wrap">
                <h1>Tap, track, done.</h1>
                <p>Sistem absensi RFID yang cepat, praktis, dan efisien.</p>
                <a href="#tentang" class="btn">Pelajari Tappy</a>
            </div>
            <a href="#tentang" class="scroll" aria-label="Gulir ke bawah">Scroll<b></b></a>
        </section>

        <section id="tentang">
            <div class="wrap">
                <h2 class="title">Tentang</h2>
                <div class="box">
                    <p class="lead">Tappy — Tap, Track, Done.</p>
                    <p>Tappy adalah sistem absensi berbasis RFID yang dirancang untuk membuat proses pencatatan
                        kehadiran menjadi lebih cepat, praktis, dan efisien. Dengan teknologi RFID dan integrasi
                        perangkat IoT, pengguna cukup menempelkan kartu RFID pada reader untuk mencatat kehadiran.</p>
                    <p>Tappy menghadirkan pengalaman absensi digital yang sederhana dengan pencatatan data terpusat,
                        sehingga petugas dapat memantau dan mengelola kehadiran dengan lebih mudah.</p>
                    <p class="mission">Our mission: Making attendance simple, smart, and seamless.</p>
                </div>
            </div>
        </section>

        <section id="fakta">
            <div class="wrap">
                <h2 class="title">Fakta</h2>
                <div class="stats">
                    <div class="stat"><b>250+</b><span>Pengguna Terdaftar</span></div>
                    <div class="stat"><b>12.500+</b><span>Catatan Kehadiran</span></div>
                    <div class="stat"><b>99%</b><span>Keberhasilan Pembacaan RFID</span></div>
                    <div class="stat"><b>24/7</b><span>Pemantauan Sistem</span></div>
                </div>
            </div>
        </section>

        <section id="fitur">
            <div class="wrap">
                <h2 class="title">Fitur</h2>
                <div class="feat">
                    <div>
                        <h3>Presensi RFID</h3>
                        <p>Pengguna cukup menempelkan kartu RFID pada reader untuk melakukan pencatatan kehadiran.</p>
                    </div>
                    <div>
                        <h3>Dasbor Kehadiran</h3>
                        <p>Menampilkan ringkasan data kehadiran, seperti jumlah hadir, izin, terlambat, dan tidak hadir,
                            sesuai data yang tersedia.</p>
                    </div>
                    <div>
                        <h3>History Kehadiran</h3>
                        <p>Memudahkan petugas melihat catatan kehadiran berdasarkan tanggal dan pengguna.</p>
                    </div>
                    <div>
                        <h3>Manajemen Pengguna</h3>
                        <p>Membantu admin mengelola data pengguna dan menghubungkannya dengan kartu RFID masing-masing.
                        </p>
                    </div>
                    <div>
                        <h3>Time &amp; Date Logging</h3>
                        <p>Mencatat waktu dan tanggal ketika absensi berhasil dilakukan, jika perangkat dan sistem sudah
                            terintegrasi dengan benar.</p>
                    </div>
                    <div>
                        <h3>Attendance Reports</h3>
                        <p>Membantu petugas meninjau dan merekap data kehadiran untuk periode tertentu. Ekspor laporan
                            dapat ditambahkan jika dibutuhkan.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="wrap">
            <div class="foot">
                <div>
                    <a href="#home" class="logo">TAPPY</a>
                    <div class="map" role="img" aria-label="Tempat peta lokasi"><span>Maps</span></div>
                </div>
                <div class="addr">
                    <h4>Alamat</h4>
                    <p>Jl. Contoh No. 123, Bandar Lampung, Lampung</p>
                    <p>Email: halo@tappy.example</p>
                    <p>Telepon: (0721) 000-000</p>
                    <p>Jam layanan: Senin–Jumat, 08.00–16.00 WIB</p>
                </div>
            </div>
            <p class="copy">© 2026 Tappy. Making attendance simple, smart, and seamless.</p>
        </div>
    </footer>
</body>

</html>
