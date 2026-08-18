<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\SiswaServices;
use App\Services\SmkServices;
use Throwable;
use App\Http\Requests\SiswaRequest;

class SiswaController extends Controller
{

    protected SiswaServices $siswaServices;
    protected SmkServices $smkServices;

    public function __construct(SiswaServices $siswaServices, SmkServices $smkServices) {

        $this->siswaServices = $siswaServices;
        $this->smkServices = $smkServices;

    }

    public function dashboard() {

        $siswa = $this->siswaServices->lihat_semua();

        return view('dashboard',compact('siswa'));

    }

    public function searchPage() {

        $siswa = $this->siswaServices->lihat_semua();

        return view('search', compact('siswa'));

    }


    public function tambahSiswa(SiswaRequest $request) {

        $file = $request->file('file');

        $path = $file->store('upload', 'public');

        $siswa = $this->siswaServices->tambah_siswa($request->all(),$path);
        $this->smkServices->buat_smk($request->all());

        try {
            
        if ($siswa) {
            return response()->json([

                'message' => 'siswa berhasil ditambahkan',
                'siswa' => $siswa,
                'ok' => true
            ]);

        }else {

            return response()->json([

                'message' => 'siswa gagal ditambahkan',
                'ok' => false

            ]);

        }

        }catch (Throwable $e) {

            return response()->json([

                'message' => 'oi data lu mana anj',
                'ok' => false

            ]);

        }


    }

    public function hapusSiswa($id) {

        return response()->json([

            'ok' => true,
            'data' => $this->siswaServices->hapus_siswa($id)
        ]);

    }
    
    
    public function cariSiswa(Request $request) {


        try {

            $nama_siswa = $request->query('search');
            $siswa = $this->siswaServices->cari_siswa($nama_siswa);

            return response()->json([

                'ok' => true,
                'data' => $siswa

            ]);

        }catch (Throwable $e) {

            return response()->json([

                'ok' => false,

            ]);

        }


    }


    public function editPage($id) {

        $data_siswa = $this->siswaServices->ambil_siswa($id);

        return view('siswa', compact('data_siswa'));
    
    }

    public function editSiswa($id, SiswaRequest $request) {

        $file = $request->file('file');
        $path = $file->store('upload', 'public');

        $data_siswa = $this->siswaServices->edit_siswa($id,$request->all(), $path);

        $pesan = "siswa berhasil di ubah";

        return view('siswa', compact('pesan','data_siswa'));



    }
    //
}
