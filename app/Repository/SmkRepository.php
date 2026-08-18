<?php

    namespace App\Repository;

    use App\Models\Smk;


    class SmkRepository {

        public function buatJurusan($data_siswa,$data_jurusan) {

            $getInput = [

                'siswa_id' => $data_siswa,
                'jurusan_id' => $data_jurusan

            ];

            return Smk::create($getInput);

        }

        public function hapusSmk($id) {

            return Smk::where('siswa_id', $id)->first();

        }

    }









?>