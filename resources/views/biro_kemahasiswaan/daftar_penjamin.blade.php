@extends('layouts.main')
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
                            DATA PERMOHONAN TEMPAT TINGGAL
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="m-5">
                        <div class="row">
                            <div class="col-10">
                                <form action="/biro/formulir-penjamin">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Masukkan nama penjamin..." name="search" id="search" value="{{ request('search') }}">
                                    </div>
                                </form>
                            </div>
                            <div class="col-2">
                            <form action="/biro/formulir-penjamin" method="GET">
                            <div class="form-group">
                                <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                                    <option value="" {{ request('status') == '' ? 'selected' : '' }}>All</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                </select>
                            </form>
                            </div>
                        </div>
                        @include('biro_kemahasiswaan._daftar_penjamin')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            var search = $(this).val();

            if (search.length >= 3) { 
                $.get("{{ route('biro_kemahasiswaan.search_penjamin') }}", { search: search }, function (data) {
                    $('#search-results').html(data);
                });
            }
            if (search.length == 0) { 
                $.get("{{ route('biro_kemahasiswaan.search_penjamin') }}", function (data) {
                    $('#search-results').html(data);
                });
            } else {
                $('#search-results').html(data);
            }
        });
        
        $('#status').on('change', function () {
            this.form.submit();
        });
    });
</script>
@endsection
