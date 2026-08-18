<?php
    namespace App\Repository;

    use App\Models\Notifikasi;


    class NotifikasiRepository {

        public function viewAll() {

            return Notifikasi::latest()->get();

        }


    }







?>