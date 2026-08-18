<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Daftar Anggota</title>

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

        /* ---------- LEFT: live ID card panel ---------- */
        .panel-left {
            background: var(--navy);
            background-image:
                linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
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

        .id-card {
            background: var(--cream);
            border-radius: 14px;
            padding: 22px 20px 18px;
            position: relative;
            box-shadow: 0 18px 34px -14px rgba(0,0,0,0.55);
            transform: rotate(-2.5deg);
        }

        .id-card::before {
            content: '';
            position: absolute;
            top: 14px;
            right: 16px;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid var(--brass);
            background:
                radial-gradient(circle, transparent 0 40%, var(--brass) 41% 43%, transparent 44%);
        }

        .id-card-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px dashed var(--line);
            padding-bottom: 10px;
            margin-bottom: 14px;
        }

        .id-card-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 9.5px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--ink-soft);
        }

        .id-avatar {
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
            transition: all 0.2s ease;
        }

        .id-name {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 19px;
            color: var(--ink);
            margin: 0 0 3px;
            min-height: 24px;
            word-break: break-word;
        }

        .id-email {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11.5px;
            color: var(--ink-soft);
            margin: 0 0 16px;
            min-height: 16px;
            word-break: break-all;
        }

        .id-card-foot {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            border-top: 1px dashed var(--line);
            padding-top: 10px;
        }

        .id-no {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--navy);
            font-weight: 500;
        }

        .id-since {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 9.5px;
            color: var(--ink-soft);
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

        form + form { margin-top: 0; }

        @media (max-width: 800px) {
            .wrap { grid-template-columns: 1fr; }
            .panel-left { order: 2; padding: 34px 30px 40px; }
            .panel-right { order: 1; padding: 40px 28px 12px; }
            .id-card { transform: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>

    <div class="wrap">

        <!-- LEFT: live-updating member card -->
        <section class="panel-left">
            <div>
                <p class="brand-eyebrow">Organisasi Siswa</p>
                <h1 class="brand-title">Kartu Anggota<br>Sekolah</h1>

                <div class="id-card" id="idCard">
                    <div class="id-card-head">
                        <span class="id-card-label">Kartu Anggota</span>
                        <span class="id-card-label">2026</span>
                    </div>

                    <div class="id-avatar" id="idAvatar">?</div>
                    <p class="id-name" id="idName">Nama Anggota</p>
                    <p class="id-email" id="idEmail">email@sekolah.id</p>

                    <div class="id-card-foot">
                        <span class="id-no" id="idNo">NO. —</span>
                        <span class="id-since" id="idSince">Berlaku sejak —</span>
                    </div>
                </div>

                <div class="perf">
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                    <span></span><span></span><span></span><span></span><span></span>
                </div>
            </div>

            <p class="panel-note">Kartu di samping terisi otomatis sesuai data yang kamu masukkan di formulir. Nomor anggota diberikan setelah pendaftaran disetujui.</p>
        </section>

        <!-- RIGHT: registration form -->
        <section class="panel-right">
            <p class="form-eyebrow">Pendaftaran</p>
            <h2 class="form-title">Daftar jadi anggota</h2>
            <p class="form-sub">Isi data di bawah untuk membuat akun keanggotaan sekolah.</p>

            <p id="notif"></p>

            <form id="halamanRegister">

                @csrf

                <div class="field">
                    <label for="nama">Nama lengkap</label>
                    <input id="nama" placeholder="Nama...." type="text" autocomplete="name">
                    <p class="field-error" id="errorName"></p>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" placeholder="Email...." type="email" autocomplete="email">
                    <p class="field-error" id="errorEmail"></p>
                </div>

                <div class="field">
                    <label for="password">Kata sandi</label>
                    <input id="password" placeholder="Password...." type="password" autocomplete="new-password">
                    <p class="field-error" id="errorPassword"></p>
                </div>

                <button type="submit" class="btn-primary">Daftar sekarang</button>

            </form>

            <div class="divider">sudah punya akun</div>

            <form action="/login_page" method="GET">
                <button class="btn-secondary">Masuk</button>
            </form>
        </section>

    </div>

    @vite('resources/js/app.js')

    <script>
        // Live preview: fills the member card as the user types.
        // Purely cosmetic — does not interfere with the real submit logic in app.js.
        (function () {
            const nama = document.getElementById('nama');
            const email = document.getElementById('email');

            const idAvatar = document.getElementById('idAvatar');
            const idName = document.getElementById('idName');
            const idEmail = document.getElementById('idEmail');
            const idNo = document.getElementById('idNo');
            const idSince = document.getElementById('idSince');

            function initials(name) {
                const parts = name.trim().split(/\s+/).filter(Boolean);
                if (parts.length === 0) return '?';
                if (parts.length === 1) return parts[0][0].toUpperCase();
                return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
            }

            function randomNo() {
                return 'NO. ' + Math.floor(1000 + Math.random() * 9000);
            }

            function today() {
                const d = new Date();
                const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
                return 'Berlaku sejak ' + d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
            }

            let assignedNo = null;

            function updateCard() {
                const namaVal = nama.value.trim();
                const emailVal = email.value.trim();

                idAvatar.textContent = initials(namaVal);
                idName.textContent = namaVal || 'Nama Anggota';
                idEmail.textContent = emailVal || 'email@sekolah.id';

                if ((namaVal || emailVal) && !assignedNo) {
                    assignedNo = randomNo();
                    idSince.textContent = today();
                }
                idNo.textContent = assignedNo || 'NO. —';
                if (!namaVal && !emailVal) {
                    idSince.textContent = 'Berlaku sejak —';
                    assignedNo = null;
                }
            }

            nama.addEventListener('input', updateCard);
            email.addEventListener('input', updateCard);
        })();
    </script>

</body>
</html>