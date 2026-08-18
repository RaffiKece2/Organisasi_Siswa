<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

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
            max-width: 640px;
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

        #notifikasiPage {
            text-align: center;
            margin: 0 0 28px;
        }

        .btn-load {
            border: none;
            background: var(--navy);
            color: var(--cream);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 22px;
            border-radius: 9px;
            cursor: pointer;
            transition: background 0.18s ease, transform 0.1s ease;
        }

        .btn-load:hover { background: var(--navy-light); }
        .btn-load:active { transform: translateY(1px); }
        .btn-load:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        /* ---------- Notification list ---------- */
        #Notifikasi {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 40px;
        }

        .notif-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            background: var(--paper);
            border: 1px solid var(--line);
            border-left: 4px solid var(--brass);
            border-radius: 10px;
            padding: 14px 16px;
        }

        .notif-item.unread { border-left-color: var(--navy); background: #fbf7ec; }

        .notif-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--brass);
            margin-top: 6px;
            flex-shrink: 0;
        }

        .notif-body { flex: 1; min-width: 0; }

        .notif-text {
            margin: 0 0 4px;
            font-size: 14px;
            color: var(--ink);
            line-height: 1.5;
        }

        .notif-time {
            margin: 0;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--ink-soft);
        }

        .empty-state {
            border: 1.5px dashed var(--line);
            border-radius: 12px;
            padding: 32px 16px;
            text-align: center;
            color: var(--ink-soft);
            font-size: 13.5px;
        }

        .back-wrap { text-align: center; }

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
        <h1>Notifikasi</h1>

        <form id="notifikasiPage">
            <button type="submit" class="btn-load">Tampilkan semua notifikasi</button>
        </form>

        <div id="Notifikasi">
            <div class="empty-state">Klik "Tampilkan semua notifikasi" untuk melihat notifikasi kamu.</div>
        </div>

        <div class="back-wrap">
            <form action="/dashboard">
                <button class="back-btn">Dashboard</button>
            </form>
        </div>

    </div>

    @vite('resources/js/notifikasi.js')

</body>
</html>