<?php
    namespace App\Services;


    use App\Repository\AuthRepository;

    use Illuminate\Support\Facades\Auth;


    class AuthServices {

        protected AuthRepository $authRepository;


        public function __construct(AuthRepository $authRepository) {

            $this->authRepository = $authRepository;

        }

        public function register(array $data) {

            return $this->authRepository->daftarAkun($data);

        }

        public function login(array $data) {

            $getInput = [

                'email' => $data['email'],
                'password' => $data['password']

            ];
            

            return Auth::attempt($getInput);

        }


        public function logout() {

            Auth::logout();
        }
        


    }












?>