<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use App\Services\AuthServices;


class AuthController extends Controller
{

    protected AuthServices $authServices;

    public function __construct(AuthServices $authServices) {

        $this->authServices = $authServices;

    }


    public function register(RegisterRequest $request) {

        $status = $this->authServices->register($request->all());

        if ($status) {
            return response()->json([

                'message' => 'register berhasil',
                'ok' => true


            ]);

        }else {

            return response()->json([

                'ok'=> false

            ]);

        }

       
    
    }

    public function login(LoginRequest $request) {

        $data_login = $this->authServices->login($request->all());

        if ($data_login) {

            $request->session()->regenerate();
            
            return response()->json([

                'message' => 'login berhasil',
                'ok' => true

            ]);

        }else {

            return response()->json([

                'message' => 'login gagal',
                'ok' => false

            ]);

        }

    }


    public function logout(Request $request) {


        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return response()->json([

            'ok' => true

        ]);

    }
    //
}
