<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Siswa;

class Jurusan extends Model
{

    protected $table = 'jurusan';

    protected $fillable = [
        'jurusan'
    ];

    public function siswa() {

        return $this->belongsToMany(Siswa::class, 'smk', 'jurusan_id', 'siswa_id');

    }
    
    //
}
