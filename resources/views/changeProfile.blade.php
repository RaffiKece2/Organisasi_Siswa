<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
            max-width: 360px;
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 32px 28px 26px;
            box-shadow: 0 20px 44px -26px rgba(28,43,74,0.35);
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
            font-size: 22px;
            color: var(--navy);
            margin: 0 0 26px;
        }

        .field { margin-bottom: 22px; }

        .field label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 8px;
        }

        #nama {
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

        #nama::placeholder { color: #b7ae99; }
        #nama:focus { border-bottom-color: var(--brass); }
        #nama:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        .btn-primary {
            width: 100%;
            border: none;
            background: var(--navy);
            color: var(--cream);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14.5px;
            padding: 12.5px 16px;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-primary:hover { background: var(--navy-light); }
        .btn-primary:active { transform: translateY(1px); }
        .btn-primary:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        .back-wrap { margin-top: 10px; }

        .back-btn {
            width: 100%;
            border: 1.5px solid var(--navy);
            background: transparent;
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13.5px;
            padding: 10.5px 16px;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.18s ease, color 0.18s ease;
        }

        .back-btn:hover { background: var(--navy); color: var(--cream); }
        .back-btn:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>

    <p id="notif"></p>

    @vite('resources/js/profile.js')

    <div class="card">
        <p class="eyebrow">Organisasi Siswa</p>
        <h1>Edit profil</h1>

        <form id="editProfile">

            <div class="field">
                <label for="nama">Nama</label>
                <input id="nama" placeholder="Nama...." type="text" autocomplete="name">
            </div>

            <button type="submit" class="btn-primary">Simpan perubahan</button>

        </form>

        <div class="back-wrap">
            <form action="/dashboard">
                <button class="back-btn">Dashboard</button>
            </form>
        </div>
    </div>

</body>
</html>