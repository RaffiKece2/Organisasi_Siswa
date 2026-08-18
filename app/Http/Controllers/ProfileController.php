<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ProfileServices;

class ProfileController extends Controller
{
    protected ProfileServices $profileServices;

    public function __construct(ProfileServices $profileServices) {

        $this->profileServices = $profileServices;

    }


    public function profile($id) {

        $data_akun = $this->profileServices->lihat_profile($id);

        return view('profile',compact('data_akun'));

    }

    public function editProfile(Request $request) {

        return $this->profileServices->ubah_profile($request->all());

    }

    public function hapusProfile() {

        $this->profileServices->hapus_profile();


        return response()->json([

            'ok' => true,

        ]);

    }

    




    //
}
