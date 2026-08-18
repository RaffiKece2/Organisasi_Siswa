<?php
    namespace App\Repository;

    use App\Models\Siswa;
    use Illuminate\Support\Facades\Storage;
    



    class SiswaRepository {

        public function tambahSiswa(array $data, $path) {

            $getInput = [

                'nama' => $data['nama'],
                'jurusan' => $data['jurusan'],
                'kelas' => $data['kelas'],
                'gambar' => Storage::url($path)
                 

            ];

            return Siswa::create($getInput);


        }



        public function viewAll() {

            return Siswa::all();

        }

        public function viewSiswaById($id) {

            return Siswa::findOrFail($id);

        }

        public function getSiswaByName($name) {

            return Siswa::where('nama', $name)->first();
    
        }

        public function searchSiswa($namaSiswa) {

            return Siswa::where('nama', 'LIKE' , "%{$namaSiswa}%")->get();

        }


    }







?>