<?php

    namespace App\Services;

    use App\Repository\SiswaRepository;
    use App\Repository\SmkRepository;
    use Illuminate\Support\Facades\Storage;

    class SiswaServices {

        protected SiswaRepository $siswaRepository;
        protected SmkRepository $smkRepository;

        public function __construct(SiswaRepository $siswaRepository,  SmkRepository $smkRepository) {

            $this->siswaRepository = $siswaRepository;
            $this->smkRepository = $smkRepository;

        }


        public function tambah_siswa(array $data, $path) {

            return $this->siswaRepository->tambahSiswa($data, $path);

        }

        public function lihat_semua() {

            return $this->siswaRepository->viewAll();

        }

        public function hapus_siswa($id) {

            $data_siswa = $this->siswaRepository->viewSiswaById($id);

            $data_smk = $this->smkRepository->hapusSmk($data_siswa->id);

            if ($data_smk) {

                $data_smk->delete();

            }

            $data_siswa->delete();

            return $data_siswa;

        }

        public function cari_siswa($nama) {

            return $this->siswaRepository->searchSiswa($nama);

        }

        public function ambil_siswa($id) {

            return $this->siswaRepository->viewSiswaById($id);

        }

        public function edit_siswa($id, array $data, $path) {

            $data_siswa = $this->siswaRepository->viewSiswaById($id);

            $data_siswa->update([

                'nama' => $data['nama'],
                'kelas' => $data['kelas'],
                'jurusan' => $data['jurusan'],
                'gambar' => Storage::url($path)

            ]);

            return $data_siswa;

        }


    }








?>