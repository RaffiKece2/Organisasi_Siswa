<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\JurusanServices;

class JurusanController extends Controller
{

    protected JurusanServices $jurusanServices;


    public function __construct(JurusanServices $jurusanServices ) {

        $this->jurusanServices = $jurusanServices;


    }


    public function jurusan() {

        $jurusan = $this->jurusanServices->semua_jurusan();

        return view('jurusanSiswa', compact('jurusan'));

    }

    public function semuaJurusan($id) {


        $jurusan = $this->jurusanServices->ambil_jurusan($id);

        return response()->json([

            'data' => $jurusan->siswa,
            'ok' => true
        ]);

    }


    public function tambahJurusan(Request $request) {

        return response()->json([

            'data' => $this->jurusanServices->tambah_jurusan($request->all()),
            'ok' => true,

            'pesan' => 'jurusan berhasil ditambahkan'

        ]);

    }
    //
}
