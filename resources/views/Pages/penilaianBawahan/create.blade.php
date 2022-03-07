@extends('master')

@section('title', 'Penilaian Karyawan Page')

@section('style')
    <style>
        .gradient-border {
            width: 40%;
            border-image-slice: 1;
            border-image-source: linear-gradient(to left, rgba(9,170,230,1), rgba(124,229,43,1));
        }
    </style>
@endsection

@section('content')
    {{-- toast content --}}
    <div class="position-fixed top-0 end-0 p-3">
        <div class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    {{-- main conten --}}
    <div class="container mt-5" style="font-size: 13px;">
        <div class="row">
            <h5 class="fw-bold">Periode Tahun {{ $data->tahunKinerja }}</h5>
            <h3 class="fw-bold text-primary">Periode Kinerja {{ $triwulan }}</h3>
            <span>PTDKPI ID: {{ $data->dkpiid }}</span>
        </div>
        <div class="row my-4">
            <div class="col-md-4 mx-auto">
                <table class="table table-sm table-borderless text-white h-100">
                    <thead style="background-color: #027DB4">
                        <tr>
                            <th scope="col" colspan="2" class="text-center fw-bold">Nama Pegawai</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #169BD5">
                        <tr>
                            <th scope="row" style="width: 40%">Nama Pegawai</th>
                            <th class="fw-normal">{{ $data->profile->user->name }}</th>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 40%">NPK</th>
                            <th class="fw-normal">{{ $data->profile->NPK }}</th>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 40%">Nama Posisi</th>
                            <th class="fw-normal">{{ $data->profile->namaJabatan }}</th>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 40%">Unit Kerja</th>
                            <th class="fw-normal">{{ $data->profile->unitKerja }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4 mx-auto">
                <table class="table table-sm table-borderless text-white h-100">
                    <thead style="background-color: #027DB4">
                        <tr>
                            <th scope="col" colspan="2" class="text-center fw-bold">Atasan Penilai</th>
                        </tr>
                    </thead>
                    <tbody style="background-color: #169BD5">
                        <tr>
                            <th scope="row" style="width: 40%">Nama Pegawai</th>
                            <th class="fw-normal">Sara Parker</th>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 40%">NPK</th>
                            <th class="fw-normal">130899871</th>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 40%">Nama Posisi</th>
                            <th class="fw-normal">Deputi Direktur</th>
                        </tr>
                        <tr>
                            <th scope="row" style="width: 40%">Unit Kerja</th>
                            <th class="fw-normal">Deputi Direktur Bidang Teknologi Informasi</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <table id="table_id" class="table table-sm table-bordered border-light table-striped align-middle w-100 align-middle text-center">
                <thead style="background-color: #95F204" class="text-primary align-middle">
                    <tr>
                        <th>Perspektif</th>
                        <th>Tujuan Strategis</th>
                        <th>Indikator Unit Kerja</th>
                        <th>Bobot</th>
                        <th>Target</th>
                        <th style="width: 7%">Realisasi Karyawan</th>
                        <th style="width: 7%">Realisasi Atasan</th>
                        <th>Pencapaian</th>
                        <th>Skala</th>
                        <th>Skala x Bobot</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->targetKinerjas as $target_kinerja)
                        @if ($ke == '1')
                            @php $target_triwulan = $target_kinerja->targetTriwulan1; @endphp
                        @elseif($ke == '2')
                            @php $target_triwulan = $target_kinerja->targetTriwulan2; @endphp
                        @elseif($ke == '3')
                            @php $target_triwulan = $target_kinerja->targetTriwulan3; @endphp
                        @else
                            @php $target_triwulan = $target_kinerja->targetTriwulan4; @endphp
                        @endif
                        <tr>
                            <td>{{ $target_kinerja->draftKpiIndividu->perspektif }}</td>
                            <td>{{ $target_kinerja->draftKpiIndividu->tujuanStrategis }}</td>
                            <td>{{ $target_kinerja->draftKpiIndividu->indikatorKunciKerja }}</td>
                            <td>{{ $target_kinerja->bobot }}</td>
                            <td>{{ $target_triwulan->target }}</td>
                            <td>{{ $target_triwulan->realisasi_karyawan }}</td>
                            <td>
                                <input type="number" name="id" value="{{ $target_kinerja->id }}" readonly hidden>
                                <input type="number" class="form-control gradient-border py-1 w-100 realisasi_atasan" placeholder="..." required value="{{ $target_triwulan->realisasi_atasan }}">
                            </td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>
                                <a href="{{ asset($target_triwulan->filePendukung) }}" id="file_{{ $data->id }}" {{ !$target_triwulan->filePendukung ? 'hidden' : '' }} class="text-decoration-none" title="lihat file" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('plugin/images/1__home-page/u57.svg') }}" class="img-icon" style="cursor: pointer;"/>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row my-3">
            <div class="col text-center" style="font-size: 13px">
                <button type="button" class="btn btn-primary px-4 mx-3" style="border-radius: 15px" disabled><b>Simulasi</b></button>
                <button type="button" class="btn btn-success px-4 mx-3" style="border-radius: 15px" id="btn_save"><b>Save</b></button>
            </div>
        </div>
        <div class="row">
            <span class="fw-bold fs-6">Langkah Persetujuan</span>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-sm table-borderless">
                    <thead>
                        <tr class="align-middle text-primary" style="background-color: #F2F2F2">
                            <th scope="col">Pihak yang Menyetujui</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Response</th>
                            <th scope="col">Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">John Doe - Deputi Direktur</td>
                            <td>...</td>
                            <td>...</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td scope="row">Isabelle Clark - Asisten Deputi</td>
                            <td>...</td>
                            <td>...</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td scope="row">Ryan Markson - HCP</td>
                            <td>...</td>
                            <td>...</td>
                            <td>N/A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#btn_save').click(function() {
            $(this).attr('disabled', true).text('Saving...');

            const table = $('#table_id');
            async function sendAjax() {
                table.find('tbody tr').each(function() {
                    const row = $(this);
                    const data = {
                        'target_kinerja_id': row.find('[name="id"]').val(),
                        'realisasiAtasan': row.find('.realisasi_atasan').val(),
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('penilaian-bawahan.store', $ke) }}",
                        method: "POST",
                        data: data
                    });
                });
            }

            sendAjax().then(function() {
                showToast('Data berhasil disimpan', 'success');
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $("#btn_save").attr('disabled', false).text('Save');
            });
        });

        // type hanya bisa 'success' atau 'error'
        function showToast(content, type) {
            // setting toast
            $('.toast').toast({
                animation: true,
                autohide: false,
                delay: 3000
            });

            $('.toast-body').html(content);

            if(type == 'success') {
                if($('.toast').hasClass('bg-danger')) {
                    $('.toast')
                        .removeClass('bg-danger')
                        .addClass('bg-success')
                        .toast('show');
                } else {
                    $('.toast').toast('show');
                }
            } else if(type == 'error') {
                if($('.toast').hasClass('bg-success')) {
                    $('.toast')
                        .removeClass('bg-success')
                        .addClass('bg-danger')
                        .toast('show');
                } else {
                    $('.toast').toast('show');
                }
            } else {
                console.log('type tidak valid');
            }
        }
    </script>
@endsection
