<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jurusan</title>

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
            background: var(--cream);
            color: var(--ink);
            font-family: 'Inter', sans-serif;
        }

        body {
            background-image: radial-gradient(circle at 1px 1px, rgba(28,43,74,0.07) 1px, transparent 0);
            background-size: 22px 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        /* ---------- Toast notification ---------- */
        #notif {
            position: fixed;
            top: 20px;
            right: 20px;
            max-width: 340px;
            margin: 0;
            padding: 14px 18px 14px 16px;
            border-radius: 10px;
            background: var(--navy);
            color: var(--cream);
            font-size: 13.5px;
            font-weight: 500;
            line-height: 1.45;
            box-shadow: 0 16px 30px -10px rgba(28,43,74,0.45);
            border-left: 4px solid var(--brass);
            display: none;
            opacity: 0;
            transform: translateY(-8px);
            transition: opacity 0.25s ease, transform 0.25s ease;
            z-index: 999;
        }

        #notif.show { display: block; opacity: 1; transform: translateY(0); }
        #notif.ok { border-left-color: #6fae7b; }
        #notif.err { border-left-color: var(--maroon); }

        @media (max-width: 640px) {
            #notif { left: 16px; right: 16px; max-width: none; }
        }

        /* ---------- Card ---------- */
        .card {
            width: 100%;
            max-width: 400px;
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 18px;
            padding: 40px 32px 34px;
            text-align: center;
            box-shadow: 0 30px 60px -24px rgba(28,43,74,0.35);
            opacity: 0;
            transform: translateY(18px);
            animation: card-in 0.55s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        @keyframes card-in {
            to { opacity: 1; transform: translateY(0); }
        }

        /* ---------- Animated badge icon ---------- */
        .badge-wrap {
            position: relative;
            width: 72px;
            height: 72px;
            margin: 0 auto 22px;
        }

        .badge-ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: 1.5px dashed var(--brass-light);
            animation: spin 14s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .badge {
            position: absolute;
            inset: 10px;
            border-radius: 50%;
            background: var(--navy);
            background-image: linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 22px -10px rgba(28,43,74,0.6);
            animation: pop-in 0.6s 0.15s cubic-bezier(0.34, 1.56, 0.64, 1) backwards, breathe 3.2s 0.8s ease-in-out infinite;
        }

        @keyframes pop-in {
            0% { transform: scale(0.4); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes breathe {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .badge svg {
            width: 26px;
            height: 26px;
            stroke: var(--brass-light);
        }

        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--brass);
            margin: 0 0 8px;
        }

        h1 {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 24px;
            color: var(--navy);
            margin: 0 0 8px;
        }

        .sub {
            font-size: 13.5px;
            color: var(--ink-soft);
            margin: 0 0 28px;
        }

        .field {
            text-align: left;
            margin-bottom: 22px;
        }

        .field label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 8px;
        }

        #jurusan {
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

        #jurusan::placeholder { color: #b7ae99; }
        #jurusan:focus { border-bottom-color: var(--brass); }
        #jurusan:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        .btn-primary {
            width: 100%;
            border: none;
            background: var(--navy);
            color: var(--cream);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 15px;
            padding: 13px 16px;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-primary:hover { background: var(--navy-light); }
        .btn-primary:active { transform: translateY(1px) scale(0.99); }
        .btn-primary:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        .back-wrap { margin-top: 14px; }

        .back-btn {
            width: 100%;
            border: 1.5px solid var(--navy);
            background: transparent;
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 11px 16px;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.18s ease, color 0.18s ease;
        }

        .back-btn:hover { background: var(--navy); color: var(--cream); }
        .back-btn:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
            .card { opacity: 1; transform: none; }
            .badge { opacity: 1; transform: none; }
        }
    </style>
</head>
<body>

    <p id="notif"></p>

    <div class="card">

        <div class="badge-wrap">
            <div class="badge-ring"></div>
            <div class="badge">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
            </div>
        </div>

        <p class="eyebrow">Organisasi Siswa</p>
        <h1>Tambah jurusan</h1>
        <p class="sub">Tambahkan jurusan baru ke daftar sekolah.</p>

        <form id="tambahJurusan">

            @csrf

            <div class="field">
                <label for="jurusan">Jurusan</label>
                <input id="jurusan" placeholder="Jurusan...." type="text" autocomplete="off">
            </div>

            <button type="submit" class="btn-primary">Tambah jurusan</button>

        </form>

        <div class="back-wrap">
            <form action="/dashboard">
                <button class="back-btn">Dashboard</button>
            </form>
        </div>

    </div>

    @vite('resources/js/jurusan.js')

</body>
</html>