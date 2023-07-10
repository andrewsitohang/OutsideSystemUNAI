<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public function mahasiswa ()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function pegawai ()
    {
        return $this->belongsTo(BiroKemahasiswaan::class);
    }
}
