@extends('layouts.main')
<title>UNAI Outside System</title>

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
@endpush

@section('content')

<div class="row common-font-color">
    <div class="stretch-card">
        <div class="row flex-grow-1">

            <div class="grid-margin">
                <div class="card bs-gray-200 fw-bold">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            Absensi Mahasiswa Outside
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="m-5 row">
                        <div class="table-responsive col-md-8 mt-3">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Detail</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1
                                    @endphp
                                    @foreach ($data_absen as $absen)
                                    <tr>
                                        <td class="align-middle">{{ $index }}</td>
                                        <td class="align-middle">{{ $absen->mahasiswa->nim }}</td>
                                        <td class="align-middle">{{ $absen->mahasiswa->nama }}</td>
                                        <td class="align-middle"><button type="button" class="btn btn-primary" onclick="window.location.href='/mhs/daftar-absensi-mahasiswa/{{ $absen->id }}'">Detail</button></td>
                                        <td class="align-middle">{{ $absen->created_at }}</td>
                                        <td class="align-middle">
                                            @if ($absen->kehadiran == 'Hadir')
                                            <span class="bg-success p-2 rounded-3 text-white text-center">
                                                Hadir
                                            </span>
                                            @elseif ($absen->kehadiran == 'Izin')
                                            <span class="bg-warning p-2 rounded-3 text-white text-center">
                                                Izin
                                            </span>
                                            @else
                                            <span class="bg-danger p-2 rounded-3 text-white text-center">
                                                Absen
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                        $index += 1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4 mt-3">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Tanggal</h5>
                                    <label for="jenisFilter" class="mb-1">Pilih Filter Tanggal</label>
                                    <select id="jenisFilter" class="form-select mb-4" aria-label="Default select example">
                                        <option>Berdasarkan tanggal</option>
                                        <option>Berdasarkan interval tanggal</option>
                                    </select>
                            
                                    <div id="tanggal" class="">
                                        <label for="tanggalInput" class="mb-1">Pilih Filter Tanggal</label>
                                        <input type="text" id="tanggalInput" class="form-control mb-2" placeholder="Pilih Tanggal" value="2023-08-17"/>
                                        <button class="btn btn-primary mb-3" id="simpanButton1">
                                            Tetapkan
                                        </button>    
                                    </div>
                                    
                                    <div id="intervalTanggal" class="d-none">
                                        <label for="tanggalAwal" class="mb-1">Pilih Tanggal Awal</label>
                                        <input type="text" id="tanggalAwal" class="form-control mb-2" placeholder="Pilih Tanggal"/>
                                        <label for="tanggalAkhir" class="mb-1">Pilih Tanggal Akhir</label>
                                        <input type="text" id="tanggalAkhir" class="form-control mb-2" placeholder="Pilih Tanggal"/>
                                        <button class="btn btn-primary" id="simpanButton2">
                                            Tetapkan
                                        </button>    
                                    </div>                                                            
                                </div>
                            </div>
                            <div class="card mb-3">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Untuk membuat kalender

    flatpickr("#tanggalInput", {
        enableTime: false,
        dateFormat: "Y-m-d",
    });

    flatpickr("#tanggalAwal", {
        enableTime: false,
        dateFormat: "Y-m-d",
    });

    flatpickr("#tanggalAkhir", {
        enableTime: false,
        dateFormat: "Y-m-d",
    });

    // Untuk select jenis filter

    document.getElementById('jenisFilter').addEventListener('change', function () {
        let selectedOption = this.value;

        document.getElementById('tanggal').classList.add('d-none');
        document.getElementById('intervalTanggal').classList.add('d-none');

        if (selectedOption === 'Berdasarkan tanggal') {
            document.getElementById('tanggal').classList.remove('d-none');
        } else if (selectedOption === 'Berdasarkan interval tanggal') {
            document.getElementById('intervalTanggal').classList.remove('d-none');
        }
    });

});
</script>

@endsection
