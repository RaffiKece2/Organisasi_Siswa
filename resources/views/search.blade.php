<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Siswa</title>
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

        .page {
            max-width: 760px;
            margin: 0 auto;
            padding: 56px 24px 60px;
        }

        .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--brass);
            margin: 0 0 8px;
            text-align: center;
        }

        h1 {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 28px;
            color: var(--navy);
            margin: 0 0 30px;
            text-align: center;
        }

        .search-box {
            position: relative;
            margin: 0 0 34px;
        }

        .search-box svg {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            width: 17px;
            height: 17px;
            stroke: var(--ink-soft);
        }

        #searchSiswa {
            width: 100%;
            border: 1.5px solid var(--line);
            background: var(--paper);
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--ink);
            padding: 13px 16px 13px 44px;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        #searchSiswa::placeholder { color: #b7ae99; }

        #searchSiswa:focus {
            border-color: var(--brass);
            box-shadow: 0 0 0 3px rgba(184,137,43,0.15);
        }

        #tampilan_siswa {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 14px;
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

        .back-wrap {
            text-align: center;
            margin-top: 40px;
        }

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

    <div class="page">

        <p class="eyebrow">Organisasi Siswa</p>
        <h1>Pencarian Siswa</h1>

        <div class="search-box">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="7"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input id="searchSiswa" placeholder="Cari nama, kelas, atau jurusan...." type="text">
        </div>

        <div id="tampilan_siswa">

            @forelse($siswa as $pelajar)

                <div id="siswa-{{ $pelajar->id }}" class="siswa-card">
                    <img src="{{ $pelajar->gambar }}" width="100" height="100">
                    <p class="siswa-nama">{{ $pelajar->nama }}</p>
                    <p>Kelas: {{ $pelajar->kelas }}</p>
                    <p>Jurusan: {{ $pelajar->jurusan }}</p>
                </div>

            @empty

                <div class="empty-state">Belum ada siswa yang terdaftar.</div>

            @endforelse

        </div>

        <div class="back-wrap">
            <form action="/dashboard">
                <button class="back-btn">Kembali ke Dashboard</button>
            </form>
        </div>

    </div>

    @vite('resources/js/search.js')

</body>
</html>