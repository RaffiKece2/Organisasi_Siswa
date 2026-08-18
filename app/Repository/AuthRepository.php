<?php

    namespace App\Repository;


    use App\Models\User;
    use Illuminate\Support\Facades\Hash;


    class AuthRepository {


        public function daftarAkun(array $data) {

            $getInput = [

                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password'])

            ];


            return User::create($getInput);

        }

        public function getUserByName($nama) {

            $data_user = User::where('name', $nama)->first();

            return $data_user;

        }


    }








?>