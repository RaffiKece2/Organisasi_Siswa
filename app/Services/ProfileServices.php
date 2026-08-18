<?php

    namespace App\Services;

    use App\Repository\ProfileRepository;



    class ProfileServices {

        protected ProfileRepository $profileRepository;

        public function __construct(ProfileRepository $profileRepository) {

            $this->profileRepository = $profileRepository;

        }

        public function lihat_profile($id) {

            return $this->profileRepository->viewProfile($id);

        }

        public function ubah_profile(array $data) {

            $getInput = [

                'name' => $data['name']

            ];

            $data_user = auth()->user();

            $data_user->update($getInput);

            if ($data_user) {

                return response()->json([

                    'message' => 'nama berhasil di ubah',
                    'ok' => true

                ]);

            }else {

                return response()->json([

                    'message' => 'nama gagal diubah',
                    'ok' => false

                ]);

            }

        }


        public function hapus_profile() {

            $data_user = auth()->user();


            $data_user->delete();


            return $data_user;

        }

    }


?>