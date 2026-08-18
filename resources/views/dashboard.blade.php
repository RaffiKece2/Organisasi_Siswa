<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
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
            --green: #35603f;
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

        a { color: inherit; }

        /* ---------- Toast notification ---------- */
        #notif {
            position: fixed;
            top: 20px;
            right: 20px;
            left: auto;
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

        #notif.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        #notif.ok { border-left-color: #6fae7b; }
        #notif.err { border-left-color: var(--maroon); }

        @media (max-width: 640px) {
            #notif { left: 16px; right: 16px; max-width: none; }
        }

        /* ---------- Top bar ---------- */
        .topbar {
            position: sticky;
            top: 0;
            z-index: 50;
            background: var(--navy);
            background-image: linear-gradient(160deg, var(--navy) 0%, var(--navy-light) 100%);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-mark {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--brass);
            color: var(--navy);
            font-family: 'Fraunces', serif;
            font-weight: 700;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .brand-text .eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--brass-light);
            margin: 0 0 2px;
        }

        .brand-text .title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 19px;
            color: var(--cream);
            margin: 0;
        }

        .navbar {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .navbar form { margin: 0; }

        .nav-btn {
            border: 1px solid rgba(246,241,228,0.22);
            background: rgba(246,241,228,0.06);
            color: var(--cream);
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            font-weight: 500;
            padding: 9px 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.18s ease, border-color 0.18s ease;
            white-space: nowrap;
        }

        .nav-btn:hover { background: rgba(246,241,228,0.14); border-color: rgba(246,241,228,0.4); }
        .nav-btn:focus-visible { outline: 2px solid var(--brass-light); outline-offset: 2px; }

        .logout-btn {
            border: none;
            background: var(--brass);
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 13px;
            padding: 9px 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.18s ease;
        }

        .logout-btn:hover { background: var(--brass-light); }
        .logout-btn:focus-visible { outline: 2px solid var(--cream); outline-offset: 2px; }

        /* ---------- Page body ---------- */
        .page {
            max-width: 1180px;
            margin: 0 auto;
            padding: 36px 32px 60px;
        }

        .greeting-eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--brass);
            margin: 0 0 6px;
        }

        h1.greeting {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 30px;
            color: var(--navy);
            margin: 0 0 34px;
        }

        .layout {
            display: grid;
            grid-template-columns: 340px 1fr;
            gap: 26px;
            align-items: start;
        }

        /* ---------- Tambah siswa card ---------- */
        .card {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 26px 24px;
        }

        .card-title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 19px;
            color: var(--navy);
            margin: 0 0 4px;
        }

        .card-sub {
            font-size: 13px;
            color: var(--ink-soft);
            margin: 0 0 22px;
        }

        .field { margin-bottom: 17px; }

        .field label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 7px;
        }

        .field input[type="text"] {
            width: 100%;
            border: none;
            border-bottom: 2px solid var(--line);
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            color: var(--ink);
            padding: 7px 2px 9px;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .field input[type="text"]::placeholder { color: #b7ae99; }
        .field input[type="text"]:focus { border-bottom-color: var(--brass); }
        .field input:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        /* ---------- Modern file upload ---------- */
        .file-field {
            position: relative;
            border: 1.5px dashed var(--line);
            border-radius: 12px;
            padding: 20px 16px;
            background: var(--cream);
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .file-field:hover { border-color: var(--brass); background: #fbf5e9; }

        .file-field.drag-over {
            border-color: var(--brass);
            background: #fbf1de;
            transform: scale(1.01);
        }

        .file-field.has-file {
            border-style: solid;
            border-color: var(--brass);
            background: var(--paper);
            padding: 12px 16px;
        }

        .file-field input[type="file"] {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-field-empty {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            pointer-events: none;
        }

        .file-field-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--paper);
            border: 1.5px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .file-field:hover .file-field-icon,
        .file-field.drag-over .file-field-icon {
            border-color: var(--brass);
            background: #fbf1de;
        }

        .file-field-icon svg {
            width: 17px;
            height: 17px;
            stroke: var(--brass);
        }

        .file-field-text {
            font-size: 12.5px;
            color: var(--ink-soft);
            line-height: 1.4;
        }

        .file-field-text b { color: var(--navy); font-weight: 600; }

        .file-field-hint {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            color: #b7ae99;
        }

        .file-field-preview {
            display: none;
            align-items: center;
            gap: 12px;
            text-align: left;
            pointer-events: none;
        }

        .file-field.has-file .file-field-empty { display: none; }
        .file-field.has-file .file-field-preview { display: flex; }

        .file-field-thumb {
            width: 44px;
            height: 44px;
            border-radius: 9px;
            object-fit: cover;
            background: var(--cream);
            box-shadow: 0 0 0 1px var(--line);
            flex-shrink: 0;
        }

        .file-field-info { min-width: 0; flex: 1; }

        .file-field-name {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--navy);
            margin: 0 0 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-field-size {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            color: var(--ink-soft);
            margin: 0;
        }

        .file-field-change {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--brass);
            flex-shrink: 0;
        }

        .field-error {
            margin: 6px 0 0;
            font-size: 12px;
            color: var(--maroon);
            min-height: 14px;
        }

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
            margin-top: 4px;
            transition: background 0.2s ease, transform 0.1s ease;
        }

        .btn-primary:hover { background: var(--navy-light); }
        .btn-primary:active { transform: translateY(1px); }
        .btn-primary:focus-visible { outline: 2px solid var(--brass); outline-offset: 3px; }

        /* ---------- Student directory ---------- */
        .directory-head {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        #tampilan_siswa {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 16px;
        }

        .siswa-card {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 16px;
            position: relative;
        }

        .siswa-card::before {
            content: '';
            position: absolute;
            top: 12px;
            right: 12px;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 1.5px solid var(--brass);
            background: radial-gradient(circle, transparent 0 40%, var(--brass) 41% 43%, transparent 44%);
            opacity: 0.7;
        }

        .siswa-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--cream);
            box-shadow: 0 0 0 1px var(--line);
            margin-bottom: 12px;
            background: var(--cream);
        }

        .siswa-card p {
            margin: 0 0 4px;
            font-size: 13px;
            color: var(--ink-soft);
        }

        .siswa-card p b,
        .siswa-card p strong {
            color: var(--ink);
            font-weight: 600;
        }

        .siswa-card .siswa-nama {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 16px;
            color: var(--navy);
            margin: 0 0 6px;
        }

        .siswa-actions {
            display: flex;
            gap: 8px;
            margin-top: 14px;
            border-top: 1px dashed var(--line);
            padding-top: 12px;
        }

        .siswa-actions form { margin: 0; flex: 1; }

        .btn-mini {
            width: 100%;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--navy);
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-weight: 600;
            padding: 7px 8px;
            border-radius: 7px;
            cursor: pointer;
            transition: background 0.18s ease, color 0.18s ease, border-color 0.18s ease;
        }

        .btn-mini:hover { background: var(--navy); color: var(--cream); border-color: var(--navy); }

        .btn-mini.danger { color: var(--maroon); border-color: #e6cfcf; }
        .btn-mini.danger:hover { background: var(--maroon); color: var(--cream); border-color: var(--maroon); }

        .empty-state {
            grid-column: 1 / -1;
            border: 1.5px dashed var(--line);
            border-radius: 14px;
            padding: 34px 20px;
            text-align: center;
            color: var(--ink-soft);
            font-size: 13.5px;
        }

        @media (max-width: 860px) {
            .layout { grid-template-columns: 1fr; }
            .topbar { padding: 16px 20px; }
            .page { padding: 28px 18px 50px; }
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; }
        }
    </style>
</head>
<body>

    <p id="notif"></p>

    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">OS</div>
            <div class="brand-text">
                <p class="eyebrow">Organisasi Siswa</p>
                <p class="title">Dashboard Anggota</p>
            </div>
        </div>

        <nav class="navbar">
            <form action="/profile/{{ auth()->id() }}" method="GET">
                <button class="nav-btn">Profile</button>
            </form>

            <form action="/tambah_jurusanPage">
                <button class="nav-btn">Tambah Jurusan</button>
            </form>

            <form action="/jurusan_page">
                <button class="nav-btn">Jurusan Siswa</button>
            </form>

            <form action="/notification_page">
                <button class="nav-btn">Notifikasi</button>
            </form>

            <form action="/search_page" method="GET">
                <button class="nav-btn">Pencarian Siswa</button>
            </form>

            <form id="Keluar">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </nav>
    </header>

    <div class="page">

        <p class="greeting-eyebrow">Selamat datang</p>
        <h1 class="greeting">Halooo 👋</h1>

        <div class="layout">

            <!-- Tambah siswa -->
            <section class="card">
                <h2 class="card-title">Tambah siswa</h2>
                <p class="card-sub">Masukkan data siswa baru ke daftar anggota.</p>

                <form id="tambahSiswa">

                    <div class="field">
                        <label for="file">Gambar siswa</label>
                        <div class="file-field" id="fileField">
                            <input id="file" type="file" accept=".png,.jpg,.jpeg">

                            <div class="file-field-empty">
                                <span class="file-field-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="17 8 12 3 7 8"></polyline>
                                        <line x1="12" y1="3" x2="12" y2="15"></line>
                                    </svg>
                                </span>
                                <p class="file-field-text"><b>Klik untuk pilih</b> atau seret gambar ke sini</p>
                                <p class="file-field-hint">PNG, JPG, JPEG</p>
                            </div>

                            <div class="file-field-preview">
                                <img class="file-field-thumb" id="fileThumb" alt="">
                                <div class="file-field-info">
                                    <p class="file-field-name" id="fileName"></p>
                                    <p class="file-field-size" id="fileSize"></p>
                                </div>
                                <span class="file-field-change">Ganti</span>
                            </div>
                        </div>
                        <p class="field-error" id="errorFile"></p>
                    </div>

                    <div class="field">
                        <label for="nama">Nama</label>
                        <input id="nama" placeholder="Nama...." type="text" autocomplete="off">
                        <p class="field-error" id="errorNama"></p>
                    </div>

                    <div class="field">
                        <label for="kelas">Kelas</label>
                        <input id="kelas" placeholder="Kelas...." type="text" autocomplete="off">
                        <p class="field-error" id="errorKelas"></p>
                    </div>

                    <div class="field">
                        <label for="jurusan">Jurusan</label>
                        <input id="jurusan" placeholder="Jurusan...." type="text" autocomplete="off">
                        <p class="field-error" id="errorJurusan"></p>
                    </div>

                    <button type="submit" class="btn-primary">Tambah siswa</button>

                </form>
            </section>

            <script>
                // Cosmetic-only: drag & drop highlight + filename/thumbnail preview
                // for the #file input. Does not replace or intercept dashboard.js —
                // the real input's .files is untouched, so form submission works the same.
                (function () {
                    const fileField = document.getElementById('fileField');
                    const fileInput = document.getElementById('file');
                    const fileThumb = document.getElementById('fileThumb');
                    const fileName = document.getElementById('fileName');
                    const fileSize = document.getElementById('fileSize');

                    function formatSize(bytes) {
                        if (bytes < 1024) return bytes + ' B';
                        if (bytes < 1024 * 1024) return (bytes / 1024).toFixed(0) + ' KB';
                        return (bytes / (1024 * 1024)).toFixed(1) + ' MB';
                    }

                    function showPreview(file) {
                        if (!file) {
                            fileField.classList.remove('has-file');
                            return;
                        }
                        fileName.textContent = file.name;
                        fileSize.textContent = formatSize(file.size);
                        const reader = new FileReader();
                        reader.onload = e => { fileThumb.src = e.target.result; };
                        reader.readAsDataURL(file);
                        fileField.classList.add('has-file');
                    }

                    fileInput.addEventListener('change', function () {
                        showPreview(this.files[0]);
                    });

                    ['dragenter', 'dragover'].forEach(evt => {
                        fileField.addEventListener(evt, e => {
                            e.preventDefault();
                            fileField.classList.add('drag-over');
                        });
                    });

                    ['dragleave', 'drop'].forEach(evt => {
                        fileField.addEventListener(evt, e => {
                            e.preventDefault();
                            fileField.classList.remove('drag-over');
                        });
                    });

                    fileField.addEventListener('drop', function (e) {
                        const dropped = e.dataTransfer.files;
                        if (dropped.length) {
                            fileInput.files = dropped;
                            showPreview(dropped[0]);
                        }
                    });
                })();
            </script>

            @vite('resources/js/dashboard.js')

            <!-- Daftar siswa -->
            <section>
                <div class="directory-head">
                    <h2 class="card-title" style="margin:0;">Daftar siswa</h2>
                </div>

                <div id="tampilan_siswa">

                    @forelse($siswa as $pelajar)

                        <div id="siswa-{{ $pelajar->id }}" class="siswa-card">
                            <img src="{{ $pelajar->gambar }}" width="50" height="50">
                            <p class="siswa-nama">{{ $pelajar->nama }}</p>
                            <p>Kelas: <strong>{{ $pelajar->kelas }}</strong></p>
                            <p>Jurusan: <strong>{{ $pelajar->jurusan }}</strong></p>

                            <div class="siswa-actions">
                                <form action="/editPage/{{ $pelajar->id }}">
                                    <button class="btn-mini">Edit</button>
                                </form>

                                <button type="button" class="btn-mini danger hapusSiswa" data-id="{{ $pelajar->id }}">Hapus</button>
                            </div>
                        </div>

                    @empty

                        <div class="empty-state">Belum ada siswa yang terdaftar.</div>

                    @endforelse

                </div>
            </section>

        </div>

    </div>

    @vite('resources/js/deleteSiswa.js')

</body>
</html>