<?php
    namespace App\Repository;

    use App\Models\Jurusan;


    class JurusanRepository {

        public function getJurusanByName($nama) {

            return Jurusan::where('jurusan', $nama)->first();
        }

        public function getJurusan($id) {

            return Jurusan::with('siswa')->findOrFail($id);

        }

        public function viewJurusanAll() {

            return Jurusan::all();

        }

        public function tambahJurusan(array $data) {


            $getInput = [

                'jurusan' => $data['jurusan']

            ];

            return Jurusan::create($getInput);

        }

    }







?>