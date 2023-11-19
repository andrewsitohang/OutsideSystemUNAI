{{-- @extends('layouts.main')
<title>UNAI Outside System</title>

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')
    
<div class="row common-font-color">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">

            <div class="grid-margin">
                <div class="card bs-gray-200 fw-bold">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            Permohonan mahasiswa luar asrama
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="m-5">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Mahasiswa</th>
                                        <th class="text-center">Tanggal Pengajuan</th>
                                        <th class="text-center">Detail</th>
                                        <th class="text-center">Status Penjaminan</th>
                                        <th class="text-center">Status Luar Asrama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($daftar_pengajuan_mahasiswa as $pengajuan_mahasiswa)
                                    <tr>
                                        <td class="align-middle">{{ $index }}</td>
                                        <td class="align-middle">{{ $pengajuan_mahasiswa->mahasiswa->nama }}</td>
                                        <td class="align-middle">{{ $pengajuan_mahasiswa->created_at->format('d/m/Y H:i:s') }}</td>
                                        <td class="align-middle">
                                                <a href="/penjamin/persetujuan-mahasiswa/{{ $pengajuan_mahasiswa->id }}" class="btn btn-primary">Detail</a>
                                            </td>
                                            @if ($pengajuan_mahasiswa->status_penjamin == 'disetujui')
                                            <td class="align-middle">
                                                <span class="bg-success p-2 rounded-3 text-white text-center">
                                                    Disetujui
                                                    </span>
                                                </td>
                                            @elseif ($pengajuan_mahasiswa->status_penjamin == 'ditolak')
                                                <td class="align-middle">
                                                    <span class="bg-danger p-2 rounded-3 text-center">
                                                        Ditolak
                                                    </span>
                                                </td>
                                                @else
                                                <td class="align-middle">
                                                    <span class="bg-warning p-2 rounded-3 text-white text-center">
                                                        Pending
                                                    </span>
                                                </td>
                                                @endif
                                            @if ($pengajuan_mahasiswa->status == 'disetujui')
                                                <td class="align-middle">
                                                    <span class="bg-success p-2 rounded-3 text-white text-center">
                                                        Disetujui
                                                    </span>
                                                </td>
                                                @elseif ($pengajuan_mahasiswa->status == 'ditolak')
                                                <td class="align-middle">
                                                    <span class="bg-danger p-2 rounded-3 text-white text-center">
                                                        Ditolak
                                                    </span>
                                                </td>
                                                @else
                                                <td class="align-middle">
                                                    <span class="bg-warning p-2 rounded-3 text-white text-center">
                                                        Pending
                                                    </span>
                                                </td>
                                                @endif
                                            </tr>
                                            @php
                                            $index++;
                                            @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            @if ($daftar_pengajuan_mahasiswa->count() === 0)
                                <h4 class="my-4 text-center fw-bold">
                                    Belum ada mahasiswa
                                </h4>
                            @endif                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection --}}


@extends('layouts.main')
<title>UNAI Outside System</title>

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')

<div class="row common-font-color">
    <div class="stretch-card">
        <div class="row flex-grow-1">   
            <div style="max-width: 100%;">
                <div class="card bs-gray-200 fw-bold">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            DATA PENGAJUAN LUAR ASRAMA
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="m-5">
                    <div class="row">
                            <div class="col-6">
                                <form action="/biro/formulir-penjamin">
                                    <div class="input-group mb-3">
                                        <!-- <input type="text" class="form-control" placeholder="Masukkan nama penjamin..." name="search" id="search" value="{{ request('search') }}"> -->
                                        <input type="text" class="form-control" placeholder="Masukkan nama penjamin..." name="search" id="search">
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                                <select name="status" id="status" class="form-control form-select">
                                    <option value="">Status Tinggal</option>
                                    <option value="Semua">Semua</option>
                                    <option value="Orang Tua">Orang Tua</option>
                                    <option value="Saudara">Saudara</option>
                                    <option value="Dosen">Dosen</option>
                                    <option value="Married">Married</option>
                                    <option value="Profesi Ners">Profesi Ners</option>
                                    <option value="Skripsi">Skripsi</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <select name="status" id="status" class="form-control form-select">
                                    <option value="">Status Penjaminan</option>
                                    <option value="">Semua</option>
                                    <option value="Disetujui">Disetujui</option>
                                    <option value="Pending">Mengunggu persetujuan</option>
                                    <option value="Ditolak">Ditolak</option>
                                    <option value="Tanpa Penjamin">Ditolak</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi">
                            </div>
                        </div>
                        <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">NIM</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Jurusan</th>
                                        <th class="text-center">Tanggal Pengajuan</th>
                                        <th class="text-center">Status Tinggal</th>
                                        <th class="text-center">Status Penjaminan</th>
                                        <th class="text-center">Status Luar Asrama</th>
                                        <th class="text-center">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($daftar_pengajuan_luar_asrama as $pengajuan_luar_asrama)
                                    <tr>
                                        <td class="align-middle">{{ $i }}</td>
                                        <td class="align-middle">{{ $pengajuan_luar_asrama->mahasiswa->nim }}</td>
                                        <td class="align-middle">{{ $pengajuan_luar_asrama->mahasiswa->nama }}</td>
                                        <td class="align-middle">{{ $pengajuan_luar_asrama->jurusan }}</td>
                                        <td class="align-middle">{{ $pengajuan_luar_asrama->created_at }}</td>
                                        <td class="align-middle">{{ $pengajuan_luar_asrama->status_tinggal }}</td>
                                        @if ($pengajuan_luar_asrama->status_penjamin == 'disetujui')
                                            <td class="align-middle">
                                                <span class="bg-success p-2 rounded-3 text-white text-center">
                                                    Disetujui
                                                </span>
                                            </td>
                                        @elseif ($pengajuan_luar_asrama->status_penjamin == 'ditolak')
                                            <td class="align-middle">
                                                <span class="bg-danger p-2 rounded-3 text-white text-center">
                                                    Ditolak
                                                </span>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <span class="bg-warning p-2 rounded-3 text-white text-center">
                                                    Pending
                                                </span>
                                            </td>
                                        @endif
                                        @if ($pengajuan_luar_asrama->status == 'disetujui')
                                            <td class="align-middle">
                                                <span class="bg-success p-2 rounded-3 text-white text-center">
                                                    Disetujui
                                                </span>
                                            </td>
                                        @elseif ($pengajuan_luar_asrama->status == 'ditolak')
                                            <td class="align-middle">
                                                <span class="bg-danger p-2 rounded-3 text-white text-center">
                                                    Ditolak
                                                </span>
                                            </td>
                                        @else
                                            <td class="align-middle">
                                                <span class="bg-warning p-2 rounded-3 text-white text-center">
                                                    Pending
                                                </span>
                                            </td>
                                        @endif
                                        <td class="align-middle">
                                            <a href="/biro/persetujuan-luar-asrama/{{ $pengajuan_luar_asrama->id }}" class="btn btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @php
                                        $i++;
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- <div class="col-md-4 grid-margin">
        <div class="card">
            <div class="card-header text-center">
                Tanggal         
    <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-header text-center">
                        Status Permohonan Tempat Tinggal
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">                            
                            <div class="bg-success p-2 rounded-3 text-white text-center">
                                Disetujui
                            </div>

                            
                            <div class="bg-danger p-2 rounded-3 text-white text-center">
                                Ditolak
                            </div>


                            <div class="bg-warning p-2 rounded-3 text-white text-center">
                                Menunggu Persetujuan
                            </div>
                            
                        </li>
                    </ul>
                    <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi">
                </div>
            </div>
            <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi">
        </div>
    </div> -->
</div>

@endsection
