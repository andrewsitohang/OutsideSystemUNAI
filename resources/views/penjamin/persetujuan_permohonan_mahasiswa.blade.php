@extends('layouts.main')
<title>UNAI Outside System</title>

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')

<div class="row common-font-color">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">

            <div class="col-md-8 grid-margin">
                <div class="card bs-gray-200 fw-bold">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            DATA MAHASISWA
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Nama
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->mahasiswa->nama }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                NIM
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->mahasiswa->nim }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Jurusan
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->mahasiswa->jurusan }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Angkatan
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->mahasiswa->angkatan }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Nomor Pribadi
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->mahasiswa->nomor_pribadi }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Nomor Orang Tua/Wali
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->mahasiswa->nomor_ortu_wali }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Status Penjamin
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->status_tinggal }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                Tahun Ajaran
                            </div>
                            <div class="col-md-8 fw-bold">
                                {{ $data_mahasiswa->tahun_ajaran }}
                            </div>
                        </div>
                    </div><hr>
                    @if (!($data_mahasiswa->status_penjamin === 'disetujui'))
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 fw-bold">
                                @if ($data_mahasiswa->status_penjamin === 'pending' || $data_mahasiswa->status_penjamin === 'ditolak')
                                    <form method="post" id="formSetujui" action="/penjamin/persetujuan-mahasiswa/{{ $data_mahasiswa->id }}/setujui" style="display: inline;">
                                        @csrf
                                        <button type="submit" id="btnSetujui" class="btn btn-success">Setujui</button>
                                    </form>
                                @endif
                                @if ($data_mahasiswa->status_penjamin === 'pending')
                                    <form method="post" id="formTolak" action="/penjamin/persetujuan-mahasiswa/{{ $data_mahasiswa->id }}/tolak" style="display: inline;">
                                        @csrf
                                        <button type="submit" id="btnTolak" class="btn btn-danger">Tolak</button>
                                    </form>
                                @endif
                            </div>
                        </div><hr>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4 grid-margin">
                <div class="card">
                    <div class="card-header text-center">
                        Status Penjaminan
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @if ($data_mahasiswa->status_penjamin === 'disetujui')
                            
                            <div class="bg-success p-2 rounded-3 text-white text-center">
                                Disetujui
                            </div>

                            @elseif ($data_mahasiswa->status_penjamin === 'ditolak')
                            
                            <div class="bg-danger p-2 rounded-3 text-white text-center">
                                Ditolak
                            </div>

                            @else

                            <div class="bg-warning p-2 rounded-3 text-white text-center">
                                Menunggu Persetujuan
                            </div>
                            
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header text-center">
                        Status Persetujuan Luar Asrama
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            @if ($data_mahasiswa->status === 'disetujui')
                            
                            <div class="bg-success p-2 rounded-3 text-white text-center">
                                Disetujui
                            </div>

                            @elseif ($data_mahasiswa->status === 'ditolak')
                            
                            <div class="bg-danger p-2 rounded-3 text-white text-center">
                                Ditolak
                            </div>

                            @else

                            <div class="bg-warning p-2 rounded-3 text-white text-center">
                                Menunggu Persetujuan
                            </div>
                            
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>   
    </div>
</div>

<script>
    window.addEventListener("load", function () {
        const btnSetujui = document.getElementById("btnSetujui");
        const formSetujui = document.getElementById("formSetujui");
        const btnTolak = document.getElementById("btnTolak");
        const formTolak = document.getElementById("formTolak");

        btnSetujui.addEventListener("click", function (event) {
            event.preventDefault();
            
            Swal.fire({
                title: "Yakin Ingin Menyetujui?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    formSetujui.submit();
                }
            });
        });

        btnTolak.addEventListener("click", function (event) {
            event.preventDefault();
            
            Swal.fire({
                title: "Yakin Ingin Menolak?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    formTolak.submit();
                }
            });
        });
    });
</script>

@endsection