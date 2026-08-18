<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <title>Masuk</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=IBM+Plex+Mono:wght@400;500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #1c2b4a;
            --navy-light: #2c3f66;
            --cream: #f6f1e4;
            --paper: #fffdf8;
            --brass: #b8892b;
            --brass-light: #d9ad55;
            --ink: #2a2a28;
            --ink-soft: #6b6558;
            --maroon: #8b3a3a;
            --line: #ded5bd;
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            padding: 0;
            min-height: 100%;
            background: var(--cream);
            color: var(--ink);
            font-family: 'Inter', sans-serif;
        }

        body {
            background-image:
                radial-gradient(circle at 1px 1px, rgba(28,43,74,0.07) 1px, transparent 0);
            background-size: 22px 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .wrap {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 0;
            background: var(--paper);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 30px 60px -20px rgba(28,43,74,0.35);
        }

        /* ---------- LEFT: card-scan panel ---------- */
        .panel-left {
            background: var(--navy);
            background-image: linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
            padding: 44px 34px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }

        .brand-eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--brass-light);
            margin: 0 0 6px;
        }

        .brand-title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 26px;
            line-height: 1.25;
            color: var(--cream);
            margin: 0 0 30px;
        }

        .scan-frame {
            background: var(--cream);
            border-radius: 14px;
            padding: 22px 20px 18px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 18px 34px -14px rgba(0,0,0,0.55);
            transform: rotate(-2.5deg);
        }

        .scan-frame::before {
            content: '';
            position: absolute;
            top: 14px;
            right: 16px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid var(--brass);
            background: radial-gradient(circle, transparent 0 40%, var(--brass) 41% 43%, transparent 44%);
        }

        /* scanning beam */
        .scan-frame::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            height: 34px;
            background: linear-gradient(180deg, transparent, rgba(184,137,43,0.28), transparent);
            animation: sweep 3.2s ease-in-out infinite;
        }

        @keyframes sweep {
            0%   { top: -34px; }
            50%  { top: 100%; }
            100% { top: -34px; }
        }

        .scan-card-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px dashed var(--line);
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .scan-card-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 9.5px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--ink-soft);
        }

        .scan-avatar {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            background: var(--navy);
            color: var(--brass-light);
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .scan-email {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12.5px;
            color: var(--ink);
            margin: 0 0 16px;
            min-height: 16px;
            word-break: break-all;
        }

        .scan-card-foot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px dashed var(--line);
            padding-top: 10px;
        }

        .scan-status {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--ink-soft);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .scan-status .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--brass);
        }

        .perf {
            display: flex;
            justify-content: space-between;
            margin-top: 22px;
            padding: 0 6px;
        }

        .perf span {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: rgba(246,241,228,0.18);
        }

        .panel-note {
            font-size: 12.5px;
            line-height: 1.6;
            color: rgba(246,241,228,0.6);
            margin-top: 34px;
        }

        /* ---------- RIGHT: form panel ---------- */
        .panel-right {
            padding: 48px 46px;
        }

        .form-eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--brass);
            margin: 0 0 8px;
        }

        .form-title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 30px;
            margin: 0 0 8px;
            color: var(--navy);
        }

        .form-sub {
            font-size: 14px;
            color: var(--ink-soft);
            margin: 0 0 30px;
        }

        #notif {
            margin: 0 0 18px;
            font-size: 13.5px;
            font-weight: 500;
            display: none;
            padding: 10px 14px;
            border-radius: 8px;
        }

        #notif.show { display: block; }
        #notif.ok { background: #e7f0e6; color: #35603f; }
        #notif.err { background: #f4e6e6; color: var(--maroon); }

        .field { margin-bottom: 20px; }

        .field label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 7px;
        }

        .field input {
            width: 100%;
            border: none;
            border-bottom: 2px solid var(--line);
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            color: var(--ink);
            padding: 8px 2px 10px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .field input::placeholder { color: #b7ae99; }
        .field input:focus { border-bottom-color: var(--brass); }
        .field input:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        .field-error {
            margin: 6px 0 0;
            font-size: 12.5px;
            color: var(--maroon);
            min-height: 15px;
        }

        .btn-primary {
            width: 100%;
            border: none;
            background: var(--navy);
            color: var(--cream);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            letter-spacing: 0.02em;
            padding: 14px 18px;
            border-radius: 9px;
            cursor: pointer;
            margin-top: 6px;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-primary:hover { background: var(--navy-light); }
        .btn-primary:active { transform: translateY(1px); }
        .btn-primary:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 26px 0 20px;
            color: var(--ink-soft);
            font-size: 12px;
            font-family: 'IBM Plex Mono', monospace;
        }

        .divider::before, .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .btn-secondary {
            width: 100%;
            border: 1.5px solid var(--navy);
            background: transparent;
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            padding: 12.5px 18px;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .btn-secondary:hover { background: var(--navy); color: var(--cream); }
        .btn-secondary:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        @media (max-width: 800px) {
            .wrap { grid-template-columns: 1fr; }
            .panel-left { order: 2; padding: 34px 30px 40px; }
            .panel-right { order: 1; padding: 40px 28px 12px; }
            .scan-frame { transform: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
        }
    </style>
</head>
<body>

    <div class="wrap">

        <!-- LEFT: card scan / verification panel -->
        <section class="panel-left">
            <div>
                <p class="brand-eyebrow">Organisasi Siswa</p>
                <h1 class="brand-title">Verifikasi<br>Kartu Anggota</h1>

                <div class="scan-frame" id="scanFrame">
                    <div class="scan-card-head">
                        <span class="scan-card-label">Kartu Anggota</span>
                        <span class="scan-card-label">2026</span>
                    </div>

                    <div class="scan-avatar" id="scanAvatar">?</div>
                    <p class="scan-email" id="scanEmail">email@sekolah.id</p>

                    <div class="scan-card-foot">
                        <span class="scan-status"><span class="dot"></span>Memindai identitas</span>
                    </div>
                </div>

                <div class="perf">
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>

            <p class="panel-note">Masukkan email dan kata sandi akun keanggotaan kamu untuk masuk ke sistem.</p>
        </section>

        <!-- RIGHT: login form -->
        <section class="panel-right">
            <p class="form-eyebrow">Masuk</p>
            <h2 class="form-title">Selamat datang kembali</h2>
            <p class="form-sub">Masuk dengan akun keanggotaan sekolah kamu.</p>

            <p id="notif"></p>

            <form id="loginPage">

                @csrf

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" placeholder="Email...." type="email" autocomplete="email">
                    <p class="field-error" id="errorEmail"></p>
                </div>

                <div class="field">
                    <label for="password">Kata sandi</label>
                    <input id="password" placeholder="Password...." type="password" autocomplete="current-password">
                    <p class="field-error" id="errorPassword"></p>
                </div>

                <button type="submit" class="btn-primary">Masuk</button>

            </form>

            <div class="divider">belum punya akun</div>

            <form action="/">
                <button class="btn-secondary">Daftar</button>
            </form>
        </section>

    </div>

    @vite('resources/js/login.js')

    <script>
        // Live preview: reflects the typed email + shows initials on the scan card.
        // Purely cosmetic — does not interfere with the real submit logic in login.js.
        (function () {
            const email = document.getElementById('email');
            const scanAvatar = document.getElementById('scanAvatar');
            const scanEmail = document.getElementById('scanEmail');

            function initialsFromEmail(value) {
                const name = value.split('@')[0];
                if (!name) return '?';
                const parts = name.replace(/[._-]+/g, ' ').trim().split(/\s+/).filter(Boolean);
                if (parts.length === 0) return '?';
                if (parts.length === 1) return parts[0][0].toUpperCase();
                return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
            }

            function updateScan() {
                const val = email.value.trim();
                scanEmail.textContent = val || 'email@sekolah.id';
                scanAvatar.textContent = initialsFromEmail(val);
            }

            email.addEventListener('input', updateScan);
        })();
    </script>

</body>
</html>