<?php

    namespace App\Services;


    use App\Repository\JurusanRepository;
    use App\Repository\SiswaRepository;

    use App\Repository\SmkRepository;


    class SmkServices {

        protected SmkRepository $smkRepository;
        protected JurusanRepository $jurusanRepository;
        protected SiswaRepository $siswaRepository;

        public function __construct(SmkRepository $smkRepository, JurusanRepository $jurusanRepository, SiswaRepository $siswaRepository) {

            $this->smkRepository = $smkRepository;
            $this->jurusanRepository = $jurusanRepository;
            $this->siswaRepository = $siswaRepository;

        }


        public function buat_smk(array $data) {

            $user = $this->siswaRepository->getSiswaByName($data['nama']);

            $jurusan = $this->jurusanRepository->getJurusanByName($data['jurusan']);


            return $this->smkRepository->buatJurusan($user->id,$jurusan->id);

            

            


            }

        




    }




?>