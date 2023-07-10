<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDataTempatTinggal extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
    
    public function penjamin ()
    {
        return $this->belongsTo(Penjamin::class);
    }

    public function pegawai ()
    {
        return $this->belongsTo(BiroKemahasiswaan::class);
    }
}
