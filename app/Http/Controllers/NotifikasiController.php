<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\NotifikasiServices;

class NotifikasiController extends Controller
{

    protected NotifikasiServices $notifikasiServices;

    public function __construct( NotifikasiServices $notifikasiServices) {

        $this->notifikasiServices = $notifikasiServices;

    }


    public function notifikasi() {

        $data_notifikasi = $this->notifikasiServices->lihat_semua();


        return response()->json([

            'ok' => true,
            'data' => $data_notifikasi

        ]);

    }
    //
}
