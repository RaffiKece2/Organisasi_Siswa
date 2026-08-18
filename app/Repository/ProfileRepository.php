<?php

    namespace App\Repository;

    use App\Models\User;


    class ProfileRepository {

        public function viewProfile($id) {

            return User::findOrFail($id);

        }


    }










?>