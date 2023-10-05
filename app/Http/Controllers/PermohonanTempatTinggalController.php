<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanDataPenjamin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermohonanTempatTinggalController extends Controller
{
    public function index()
    {
        return view('penjamin.permohonan_tempat_tinggal');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alamat' => 'required|string|max:255',
            'foto_tempat_tinggal' => 'required'|'file'|'max:2048',
            'longitude' => 'required',
            'latitude' => 'required',
            'kapasitas' => 'required|integer',
        ]);

        $data_tempat_tinggal = new PengajuanDataPenjamin();

        $data_tempat_tinggal->alamat = $request->input('alamat');
        $data_tempat_tinggal->latitude = $request->input('latitude');
        $data_tempat_tinggal->longitude = $request->input('longitude');
        // $data_tempat_tinggal->foto_tempat_tinggal = $request->input('foto_tempat_tinggal');
        $data_tempat_tinggal->foto_tempat_tinggal = $request->fotoTempatTinggal->store('pengajuan_data_tempat_tinggal');
        $data_tempat_tinggal->kapasitas = $request->input('kapasitas');
        $data_tempat_tinggal->id_penjamin = Auth::id();

        $data_tempat_tinggal->save();

        // return redirect()->route('/');

        dd('berhasil');
    }
}
