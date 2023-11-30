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
                    <div class="m-5 row" id="absensiTable">
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
                                        <td class="align-middle"><button type="button" class="btn btn-primary" onclick="window.location.href='/mhs/daftar-absensi-mahasiswa/{{ $absen->id }}'">Detail</button></td>
                                    </tr>
                                    @php
                                        $index += 1;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $data_absen->links() }}
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
                            
                                    <div id="tanggal" class="{{ isset($tanggal_awal) || isset($tanggal_akhir) ? 'd-none' : '' }}">
                                        <form action="/mhs/daftar-absensi-mahasiswa/filter-tanggal" method="POST">
                                            @csrf
                                            <label for="tanggalInput" class="mb-1">Pilih Filter Tanggal</label>
                                            <input type="text" name="tanggalInput" id="tanggalInput" class="form-control mb-2" value="{{ isset($tanggal_input) ? $tanggal_input : '' }}" placeholder="Pilih Tanggal"/>
                                            <button type="submit" class="btn btn-primary" id="tetapkanTanggal">
                                                Tetapkan
                                            </button>    
                                        </form>
                                    </div>
                                    
                                    <div id="intervalTanggal" class="{{ isset($tanggal_awal) || isset($tanggal_akhir) ? '' : 'd-none' }}">
                                        <form action="/mhs/daftar-absensi-mahasiswa/filter-interval-tanggal" method="POST">
                                            @csrf    
                                            <label for="tanggalAwal" class="mb-1">Pilih Tanggal Awal</label>
                                            <input type="text" name="tanggalAwal" id="tanggalAwal" class="form-control mb-2" value="{{ isset($tanggal_awal) ? $tanggal_awal : '' }}" placeholder="Pilih Tanggal"/>
                                            <label for="tanggalAkhir" class="mb-1">Pilih Tanggal Akhir</label>
                                            <input type="text" name="tanggalAkhir" id="tanggalAkhir" class="form-control mb-2" value="{{ isset($tanggal_akhir) ? $tanggal_akhir : '' }}" placeholder="Pilih Tanggal"/>
                                            <button type="submit" class="btn btn-primary" id="tetapkanIntervalTanggal">
                                                Tetapkan
                                            </button>
                                        </form>
                                    </div>                                                            
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title text-center">Detail Absensi Semester</h5>
                        
                                    <div id="grafik_absensi" class="row my-3 me-5 d-flex justify-content-center align-items-center">
                                    </div>
                                    
                                    <div>
                                        <p>
                                            Jumlah hadir: {{ $summary['hadir'] }}
                                        </p>
                                        <p>
                                            Jumlah izin: {{ $summary['izin'] }}
                                        </p>
                                        <p>
                                            Jumlah absen: {{ $summary['absen'] }}
                                        </p>
                                    </div>
                                </div>
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
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates.length > 0) {
                flatpickr("#tanggalAkhir").set("minDate", selectedDates[0]);
            }
        }
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

// Untuk grafik absensi

let grafik_absensi = {
    series: [{{ $summary['hadir'] }}, {{ $summary['izin'] }}, {{ $summary['absen'] }}],
    chart: {
        width: 300,
        type: 'pie',
    },
    labels: ['Hadir', 'Izin', 'Absen'],
    colors:['#0f0', '#ff0', '#f00'],
    responsive: [{
        breakpoint: 480,
        options: {
            chart: {
                width: 300
            },
            legend: {
                position: 'bottom'
            }
        }
    }]
};

chart = new ApexCharts(document.querySelector("#grafik_absensi"), grafik_absensi);
chart.render();
</script>

@endsection
