<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa</title>
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

        .card {
            width: 100%;
            max-width: 400px;
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
            margin: 0 0 22px;
        }

        .notice {
            font-size: 13px;
            color: var(--navy);
            background: #fbf1de;
            border-left: 3px solid var(--brass);
            border-radius: 6px;
            padding: 10px 12px;
            margin: 0 0 20px;
        }

        .field { margin-bottom: 18px; }

        .field label {
            display: block;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 8px;
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

        /* ---------- File dropzone ---------- */
        .file-field {
            position: relative;
            border: 1.5px dashed var(--line);
            border-radius: 12px;
            padding: 16px;
            background: var(--cream);
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .file-field:hover { border-color: var(--brass); background: #fbf5e9; }
        .file-field.drag-over { border-color: var(--brass); background: #fbf1de; }

        .file-field.has-file {
            border-style: solid;
            border-color: var(--brass);
            background: var(--paper);
            padding: 12px 14px;
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
            gap: 7px;
            pointer-events: none;
        }

        .file-field-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--paper);
            border: 1.5px solid var(--line);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .file-field-icon svg { width: 15px; height: 15px; stroke: var(--brass); }

        .file-field-text { font-size: 12px; color: var(--ink-soft); }
        .file-field-text b { color: var(--navy); font-weight: 600; }

        .file-field-preview {
            display: none;
            align-items: center;
            gap: 10px;
            text-align: left;
            pointer-events: none;
        }

        .file-field.has-file .file-field-empty { display: none; }
        .file-field.has-file .file-field-preview { display: flex; }

        .file-field-thumb {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
            background: var(--cream);
            box-shadow: 0 0 0 1px var(--line);
            flex-shrink: 0;
        }

        .file-field-name {
            font-size: 12px;
            font-weight: 600;
            color: var(--navy);
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .file-field-change {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 9.5px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: var(--brass);
            margin-left: auto;
            flex-shrink: 0;
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
            margin-top: 6px;
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

    <div class="card">
        <p class="eyebrow">Organisasi Siswa</p>
        <h1>Edit siswa</h1>

        @if (isset($pesan))
            <p class="notice">{{ $pesan }}</p>
        @endif

        @if (isset($data_siswa))

            <form action="/edit_siswa/{{ $data_siswa->id }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="field">
                    <label for="file">Gambar</label>
                    <div class="file-field" id="fileField">
                        <input id="file" name="file" type="file" accept=".png,.jpeg,.jpg">

                        <div class="file-field-empty">
                            <span class="file-field-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                            </span>
                            <p class="file-field-text"><b>Klik untuk pilih</b> atau seret gambar</p>
                        </div>

                        <div class="file-field-preview">
                            <img class="file-field-thumb" id="fileThumb" alt="">
                            <p class="file-field-name" id="fileName"></p>
                            <span class="file-field-change">Ganti</span>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label for="nama">Nama</label>
                    <input id="nama" name="nama" placeholder="Nama...." type="text" autocomplete="off">
                </div>

                <div class="field">
                    <label for="kelas">Kelas</label>
                    <input id="kelas" name="kelas" placeholder="Kelas...." type="text" autocomplete="off">
                </div>

                <div class="field">
                    <label for="jurusan">Jurusan</label>
                    <input id="jurusan" name="jurusan" placeholder="Jurusan...." type="text" autocomplete="off">
                </div>

                <button type="submit" class="btn-primary">Simpan perubahan</button>

            </form>

        @endif

        <div class="back-wrap">
            <form action="/dashboard">
                <button class="back-btn">Dashboard</button>
            </form>
        </div>
    </div>

    <script>
        // Cosmetic-only: drag & drop highlight + filename/thumbnail preview.
        // The real file input (name="file") is untouched, so the normal
        // multipart form submission still works exactly the same.
        (function () {
            const fileField = document.getElementById('fileField');
            if (!fileField) return;

            const fileInput = document.getElementById('file');
            const fileThumb = document.getElementById('fileThumb');
            const fileName = document.getElementById('fileName');

            function showPreview(file) {
                if (!file) { fileField.classList.remove('has-file'); return; }
                fileName.textContent = file.name;
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

</body>
</html>