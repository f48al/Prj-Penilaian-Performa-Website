@extends('master')

@section('title', 'Review Penyusunan')

@section('content')
    {{-- main content --}}
    <div class="container mt-5" style="font-size: 13px">
        <div class="row">
            <h3 class="fw-bold">Periode Tahun {{ $form->tahunKinerja }}</h3>
            <span>DKPI ID: {{ $form->dkpiid }}</span>
        </div>
        <div class="row my-4">
            <div class="col-md-4 mx-auto">
                <table class="table table-sm table-borderless text-white h-100">
                    <table class="table table-sm table-borderless text-white h-100">
                        <thead style="background-color: #027DB4">
                            <tr>
                                <th scope="col" colspan="2" class="text-center fw-bold">Nama Pegawai</th>
                            </tr>
                        </thead>
                        <tbody style="background-color: #169BD5">
                            <tr>
                                <th scope="row" style="width: 40%">Nama Pegawai</th>
                                <th class="fw-normal">{{ $profile->name }}</th>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 40%">NPK</th>
                                <th class="fw-normal">{{ $profile->NPK }}</th>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 40%">Nama Posisi</th>
                                <th class="fw-normal">{{ $profile->namaJabatan }}</th>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 40%">Unit Kerja</th>
                                <th class="fw-normal">{{ $profile->unitKerja }}</th>
                            </tr>
                        </tbody>
                    </table>
                </table>
            </div>
        </div>
    </div>
@endsection
