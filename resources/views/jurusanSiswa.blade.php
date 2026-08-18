<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jurusan Siswa</title>
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
            background: var(--cream);
            color: var(--ink);
            font-family: 'Inter', sans-serif;
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

        /* ---------- Hero ---------- */
        .hero {
            background: var(--navy);
            background-image: linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
            padding: 46px 32px 64px;
            text-align: center;
        }

        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--brass-light);
            margin: 0 0 10px;
        }

        .hero h1 {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 32px;
            color: var(--cream);
            margin: 0 0 8px;
        }

        .hero p {
            font-size: 14px;
            color: rgba(246,241,228,0.65);
            margin: 0;
        }

        /* ---------- Body ---------- */
        .page {
            max-width: 980px;
            margin: -34px auto 0;
            padding: 0 24px 60px;
        }

        .jurusan-panel {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 20px 22px;
            box-shadow: 0 22px 44px -26px rgba(28,43,74,0.4);
            margin-bottom: 26px;
        }

        .panel-label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin: 0 0 12px;
        }

        .jurusan-row {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .tombolJurusan {
            border: 1.5px solid var(--line);
            background: var(--cream);
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13.5px;
            padding: 9px 18px;
            border-radius: 999px;
            cursor: pointer;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease, transform 0.1s ease;
        }

        .tombolJurusan:hover {
            border-color: var(--brass);
            background: #fbf1de;
        }

        .tombolJurusan:active { transform: translateY(1px); }
        .tombolJurusan:focus-visible { outline: 2px solid var(--brass); outline-offset: 2px; }

        .tombolJurusan.active {
            background: var(--navy);
            border-color: var(--navy);
            color: var(--cream);
        }

        /* ---------- Result grid ---------- */
        #isiSiswa {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
        }

        #isiSiswa:empty::before {
            content: 'Pilih jurusan di atas untuk melihat daftar siswanya.';
            grid-column: 1 / -1;
            display: block;
            border: 1.5px dashed var(--line);
            border-radius: 12px;
            padding: 34px 16px;
            text-align: center;
            color: var(--ink-soft);
            font-size: 13.5px;
        }

        .siswa-card {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
        }

        .siswa-card img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            object-fit: cover;
            background: var(--cream);
            box-shadow: 0 0 0 1px var(--line);
            margin-bottom: 10px;
        }

        .siswa-card p {
            margin: 0 0 3px;
            font-size: 12.5px;
            color: var(--ink-soft);
        }

        .siswa-card .siswa-nama {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 15px;
            color: var(--navy);
            margin: 0 0 5px;
        }

        .empty-state {
            grid-column: 1 / -1;
            border: 1.5px dashed var(--line);
            border-radius: 12px;
            padding: 30px 16px;
            text-align: center;
            color: var(--ink-soft);
            font-size: 13.5px;
        }

        .back-wrap { text-align: center; margin-top: 32px; }

        .back-btn {
            border: 1.5px solid var(--navy);
            background: transparent;
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13.5px;
            padding: 10px 22px;
            border-radius: 8px;
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

    <header class="hero">
        <p class="eyebrow">Organisasi Siswa</p>
        <h1>Jurusan Siswa</h1>
        <p>Pilih jurusan untuk melihat daftar siswa di dalamnya.</p>
    </header>

    @vite('resources/js/jurusanSiswa.js')

    <div class="page">

        @if(isset($jurusan))

            <section class="jurusan-panel">
                <p class="panel-label">Jurusan</p>
                <div class="jurusan-row">
                    @foreach($jurusan as $jurusanAll)
                        <button type="button" class="tombolJurusan" data-id="{{ $jurusanAll->id }}">{{ $jurusanAll->jurusan }}</button>
                    @endforeach
                </div>
            </section>

        @endif

        <div id="isiSiswa"></div>

        <div class="back-wrap">
            <form action="/dashboard">
                <button class="back-btn">Dashboard</button>
            </form>
        </div>

    </div>

</body>
</html>