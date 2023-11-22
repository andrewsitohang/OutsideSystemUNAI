<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiByMahasiswaController extends Controller
{
    public function index () {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        $id_mahasiswa = $mahasiswa->id;

        $data_absen = Absensi::where('id_mahasiswa', $id_mahasiswa)->get();

        $data_absen_today = Absensi::where('id_mahasiswa', $id_mahasiswa)
                                ->whereDate('created_at', Carbon::today())
                                ->get();

        $is_absent_time = 

        $akses_absen = $data_absen_today->isEmpty();

        return view('mahasiswa.absensi', compact('data_absen', 'mahasiswa', 'akses_absen'));
    }

    public function show () {
        return view('mahasiswa.detail_absensi');
    }

    public function store (Request $request) {
        $request->validate([
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        $absensi = new Absensi();

        $absensi->latitude = $request->input('latitude');
        $absensi->longitude = $request->input('longitude');
        $absensi->kehadiran = 'hadir';
        $absensi->id_mahasiswa = Auth::guard('mahasiswa')->user()->id;

        $absensi->save();

        // return view('penjamin.fixed_permohonan_tempat_tinggal', compact('data_tempat_tinggal'));
        return redirect()->back();
    }
}
