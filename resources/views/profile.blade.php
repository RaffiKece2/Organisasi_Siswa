<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

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
            background: var(--navy);
            color: var(--ink);
            font-family: 'Inter', sans-serif;
        }

        body {
            background-image:
                radial-gradient(circle at 20% 10%, rgba(217,173,85,0.10), transparent 45%),
                radial-gradient(circle at 85% 90%, rgba(217,173,85,0.08), transparent 40%),
                linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 56px 20px;
        }

        .stage {
            width: 100%;
            max-width: 460px;
            perspective: 1200px;
        }

        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--brass-light);
            text-align: center;
            margin: 0 0 22px;
        }

        /* ---------- Membership card ---------- */
        .id-card {
            position: relative;
            background: var(--cream);
            border-radius: 20px;
            padding: 34px 30px 28px;
            box-shadow: 0 40px 80px -30px rgba(0,0,0,0.65);
            transform-style: preserve-3d;
            transition: transform 0.15s ease-out;
            overflow: hidden;
        }

        /* holographic sheen */
        .id-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(115deg, transparent 30%, rgba(255,255,255,0.35) 45%, rgba(217,173,85,0.25) 52%, transparent 65%);
            background-size: 220% 220%;
            background-position: 0% 0%;
            pointer-events: none;
            mix-blend-mode: overlay;
            animation: sheen 6s ease-in-out infinite;
        }

        @keyframes sheen {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
        }

        .id-card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 1px dashed var(--line);
            padding-bottom: 16px;
            margin-bottom: 22px;
        }

        .id-brand p:first-child {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin: 0 0 3px;
        }

        .id-brand p:last-child {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 15px;
            color: var(--navy);
            margin: 0;
        }

        .seal {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1.5px solid var(--brass);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .seal::before {
            content: '';
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1px solid var(--brass);
            background: radial-gradient(circle, transparent 0 55%, var(--brass) 56% 60%, transparent 61%);
        }

        .id-avatar {
            width: 78px;
            height: 78px;
            border-radius: 50%;
            background: var(--navy);
            background-image: linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
            color: var(--brass-light);
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0 18px;
            box-shadow: 0 12px 24px -10px rgba(28,43,74,0.55);
        }

        .id-name {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 24px;
            color: var(--ink);
            margin: 0 0 6px;
            line-height: 1.25;
        }

        .id-email {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12.5px;
            color: var(--ink-soft);
            margin: 0 0 24px;
            word-break: break-all;
        }

        .id-card-foot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px dashed var(--line);
            padding-top: 14px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--navy);
        }

        .status-pill .dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #4f8a5c;
        }

        .id-year {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            color: var(--ink-soft);
        }

        /* ---------- Actions ---------- */
        .actions {
            margin-top: 32px;
        }

        .actions form { margin: 0 0 12px; }

        .btn-primary {
            width: 100%;
            border: none;
            background: var(--brass);
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            font-size: 14.5px;
            padding: 13px 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-primary:hover { background: var(--brass-light); }
        .btn-primary:active { transform: translateY(1px); }
        .btn-primary:focus-visible { outline: 2px solid var(--cream); outline-offset: 3px; }

        .danger-zone {
            margin-top: 22px;
            padding-top: 20px;
            border-top: 1px solid rgba(246,241,228,0.14);
            text-align: center;
        }

        .danger-zone p {
            font-size: 12px;
            color: rgba(246,241,228,0.5);
            margin: 0 0 12px;
            line-height: 1.5;
        }

        .btn-danger {
            width: 100%;
            border: 1.5px solid rgba(214,120,120,0.5);
            background: transparent;
            color: #e6a3a3;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13.5px;
            padding: 11px 16px;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }

        .btn-danger:hover { background: var(--maroon); color: var(--cream); border-color: var(--maroon); }
        .btn-danger:focus-visible { outline: 2px solid #e6a3a3; outline-offset: 3px; }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
            .id-card { transform: none !important; }
        }
    </style>
</head>
<body>

    <div class="stage">
        <p class="eyebrow">Kartu Keanggotaan</p>

        <div class="id-card" id="idCard">

            @if(isset($data_akun))

                <div class="id-card-top">
                    <div class="id-brand">
                        <p>Organisasi Siswa</p>
                        <p>Kartu Anggota</p>
                    </div>
                    <div class="seal"></div>
                </div>

                <div class="id-avatar">{{ strtoupper(substr($data_akun->name ?? '', 0, 1)) }}</div>

                <h1 class="id-name">{{ $data_akun->name }}</h1>
                <p class="id-email">{{ $data_akun->email }}</p>

                <div class="id-card-foot">
                    <span class="status-pill"><span class="dot"></span>Anggota Aktif</span>
                    <span class="id-year">2026</span>
                </div>

            @endif

        </div>

        <div class="actions">
            <form action="/edit_profile">
                <button class="btn-primary">Ubah Profil</button>
            </form>

            @vite('resources/js/deleteProfile.js')

            <div class="danger-zone">
                <p>Menghapus akun akan menghilangkan seluruh data keanggotaan kamu secara permanen.</p>
                <form id="hapusProfile">
                    <button type="submit" class="btn-danger">Hapus Akun</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Cosmetic-only tilt effect on the membership card. Does not touch form/JS logic.
        (function () {
            const card = document.getElementById('idCard');
            const stage = card.parentElement;
            const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            if (prefersReduced) return;

            stage.addEventListener('mousemove', function (e) {
                const rect = card.getBoundingClientRect();
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                card.style.transform = `rotateY(${x * 8}deg) rotateX(${-y * 8}deg)`;
            });

            stage.addEventListener('mouseleave', function () {
                card.style.transform = 'rotateY(0deg) rotateX(0deg)';
            });
        })();
    </script>

</body>
</html>