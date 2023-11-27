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
                            DATA MAHASISWA
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="m-5">
                        <div class="row">
                            <div class="col-12">
                                <form action="/biro/daftar-mahasiswa">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Masukkan nama mahasiswa..." name="search" id="search" value="{{ request('search') }}">
                                    </div>
                                </form>                                
                            </div>
                        </div>
                        @include('biro_kemahasiswaan._daftar_mahasiswa')
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // $(document).ready(function () {
    //     $('#search').on('keyup', function () {
    //         let search = $(this).val();

    //         if (search.length >= 3 || search.length === 0) { 
    //             $.get("{{ route('biro_kemahasiswaan.search_mahasiswa') }}", { search: search }, function (data) {
    //                 $('#search-results').html(data);
    //             });
    //         }
    //     });
    // });

    $(document).ready(function () {
        
    $('#search').on('keyup', function () {
        let search = $(this).val();
        updateSearchResults(search);
    });

    $('body').on('click', '.pagination a', function (e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        let search = $('#search').val();
        updateSearchResults(search, page);
    });

    $('form').submit(function (event) {
        event.preventDefault();
        let search = $('#search').val();
        updateSearchResults(search);
    });

    function updateSearchResults(search, page = 1) {
        if (search.length >= 3 || search.length === 0) {
            $.get("{{ route('biro_kemahasiswaan.search_mahasiswa') }}", { search: search, page: page }, function (data) {
                $('#search-results').html(data);
            });
        }
    }
});

</script>
@endsection