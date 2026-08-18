<?php

    namespace App\Services;

    use App\Repository\NotifikasiRepository;


    class NotifikasiServices {

        protected NotifikasiRepository $notifikasiRepository;

        public function __construct(NotifikasiRepository $notifikasiRepository) {

            $this->notifikasiRepository = $notifikasiRepository;

        }

        public function lihat_semua() {

            return $this->notifikasiRepository->viewAll();

        }


    }










?>