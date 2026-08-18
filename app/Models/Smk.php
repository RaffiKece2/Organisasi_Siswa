<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smk extends Model
{
    protected $table = 'smk';

    protected $fillable = [

        'siswa_id',
        'jurusan_id'

    ];
    //
}
