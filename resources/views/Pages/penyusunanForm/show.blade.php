@extends('master')

@section('title', 'DraftKPI-page')

@section('content')
    {{-- main content --}}
    <div class="container mt-5" style="font-size: 13px;">
        <div class="row">
            <h3 class="fw-bold">Periode Tahun {{ $form->tahunKinerja }}</h3>
            <span>DKPI ID: {{ $form->dkpiid }}</span>
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
                            <th class="fw-normal">{{ $profile->user->name }}</th>
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
            <table id="table_id" class="table table-sm table-bordered border-light table-striped align-middle w-100">
                <thead class="table-success text-center">
                    <tr class="align-middle">
                        <th>Indikator Kunci Kerja</th>
                        <th>Perspektif</th>
                        <th>Tujuan Strategis</th>
                        <th style="width: 7%">Skala</th>
                        <th style="width: 7%">Bobot</th>
                        <th style="width: 7%">Target Triwulan I</th>
                        <th style="width: 7%">Target Triwulan II</th>
                        <th style="width: 7%">Target Triwulan III</th>
                        <th style="width: 7%">Target Triwulan IV</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($targets as $target)
                    <tr class="text-center">
                        <td>{{ $target->draftKpiIndividu->indikatorKunciKerja }}</td>
                        <td>{{ $target->draftKpiIndividu->perspektif }}</td>
                        <td>{{ $target->draftKpiIndividu->tujuanStrategis }}</td>
                        <td>{{ $target->skala }}%</td>
                        <td>{{ $target->bobot }}</td>
                        <td>{{ $target->targetTriwulan1->target }}</td>
                        <td>{{ $target->targetTriwulan2->target }}</td>
                        <td>{{ $target->targetTriwulan3->target }}</td>
                        <td>{{ $target->targetTriwulan4->target }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end">
                            <span class="fw-bold">
                                Total Bobot: <span class="{{ $targets->sum('bobot') == 100 ? 'text-success' : 'text-danger' }}">{{ $targets->sum('bobot') }}</span>
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row my-3">
            <div class="col text-end">
                <a class="link-danger fw-bold fs-6" href="{{ route('penyusunan-kpi.edit', $form->dkpiid) }}">Edit Indikator</a>
            </div>
        </div>
        <div class="row justify-content-center mb-2">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="catatan" class="form-label fw-bold">Catatan</label>
                    <textarea class="form-control" name="catatan" rows="3" disabled>{{ $form->catatan }}</textarea>
                </div>
            </div>
        </div>
        @hasanyrole('HCP|Kepala Unit Kerja')
            <div class="row my-3">
                <div class="col text-center">
                    <button class="btn btn-danger px-4 mx-3" style="border-radius: 15px" disabled>Revisi</button>
                    <a class="btn btn-primary px-4 mx-3" role="button" href="{{ route('review-penyusunan.update', $form->idPenyusunanKPI) }}" style="border-radius: 15px">Approve</a>
                </div>
            </div>
        @endhasanyrole
        <div class="row">
            <span class="fw-bold fs-6">Alur Penyusunan KPI</span>
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
