<?php
    namespace App\Services;


    use App\Repository\JurusanRepository;


    class JurusanServices {

        protected JurusanRepository $jurusanRepository;

        public function __construct(JurusanRepository $jurusanRepository) {

            $this->jurusanRepository = $jurusanRepository;

        }


        public function tambah_jurusan(array $data) {

            
            return $this->jurusanRepository->tambahJurusan($data);

        }

        public function semua_jurusan() {

            return $this->jurusanRepository->viewJurusanAll();

        }

        public function ambil_jurusan($id) {

            return $this->jurusanRepository->getJurusan($id);

        }


    }








?>