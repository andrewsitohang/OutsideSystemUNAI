@extends('layouts.main')
<title>UNAI Outside System</title>

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet"/>
    <title>UNAI Outside System</title>
@endpush

@section('content')
<div class="row common-font-color">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">

            <div class="grid-margin">

                <div class="card bs-gray-200 fw-bold">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline">
                            DATA PENGAJUAN PENJAMIN
                        </div>
                    </div>
                </div>
                <div class="card">
                    <form action="/mhs/pengajuan-penjamin" method="post">
                    @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="kode_penjamin">Masukkan Kode Penjamin</label>
                                </div>
                                <div class="col-md-8">
                                    <div>
                                        <input type="text" id="kode_penjamin" name="kode_penjamin" class="form-control">
                                    </div>
                                    <div class="row">
                                        <small>Masukkan kode penjamin dengan benar! Kesalahan sebanyak 5 kali akan mengakibatkan pengajuan outside anda tidak dapat dilanjutkan.</small>
                                        @if(isset($pesan))
                                            <small class="text-danger">{{ $pesan }}</small>
                                        @endif
                                        @if (isset($error))
                                            <small class="text-danger">{{ $error }}</small>
                                        @endif
                                        <small class="fw-bolder">Tersisa {{ $mahasiswa->percobaan }} kali percobaan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-success" id="simpanButton">
                                        Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBub2pKear-jyRCDPs60bPSWIUANAi3UCo"></script>
<script src="{{ asset('js/locationDetector.js') }}"></script>
<script src="{{ asset('js/imgPreview.js') }}"></script>
<script>
    document.getElementById('autoclose').addEventListener('change', function() {
        var simpanButton = document.getElementById('simpanButton');
        simpanButton.disabled = !this.checked;
    });
</script>

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endpush
@endsection
