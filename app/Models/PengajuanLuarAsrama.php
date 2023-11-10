<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanLuarAsrama extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function penjamin ()
    {
        return $this->belongsTo(Penjamin::class, 'id_penjamin');
    }

    public function pegawai ()
    {
        return $this->belongsTo(BiroKemahasiswaan::class);
    }

    public function mahasiswa ()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }
}
