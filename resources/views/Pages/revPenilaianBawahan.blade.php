@extends('master')

@section('title', 'Review Penilaian Page')

@section('style')
    <style>
        #year {
            width: 40%;
            border-image-slice: 1;
            border-image-source: linear-gradient(to left, rgba(9,170,230,1), rgba(124,229,43,1));
        }
    </style>
@endsection

@section('content')
    {{-- main content --}}
    <div class="container mt-5">
        <div class="row">
            <h2>Penilaian KPI Karyawan</h2>
        </div>
        <div class="row w-100">
            <label for="year">
                <small style="font=size: 13px;">Periode kinerja pada</small>
            </label>
            <select name="year" id="year" class="form-control mx-2 py-1">
                @for ($i = 2017; $i <= intval(date('Y')); $i++)
                    <option value="{{ $i }}" {{ $i == intval($year) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="row table-responsive mt-3" style="font-size: 13px">
            <table id="table_id" class="table table-striped table-bordered border-light table-hover align-middle text-center w-100">
                <thead class="text-primary" style="background-color: #95F204">
                    <tr>
                        <th>NPK</th>
                        <th>Nama Pegawai</th>
                        <th>Nama Posisi</th>
                        <th>Triwulan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="fw-bold">
                    @foreach ($datas as $data)
                        @php $form = $data->profile->formPenyusunanKpis->first() @endphp
                        <tr>
                            <td>{{ $data->profile->NPK }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->profile->namaJabatan }}</td>
                            <td>
                                <a href="{{ route('review-penilaian.show', [$form->idPenyusunanKPI, 1]) }}" class="text-decoration-none">Triwulan I</a><br/>
                                <a href="{{ route('review-penilaian.show', [$form->idPenyusunanKPI, 2]) }}" class="text-decoration-none">Triwulan II</a><br/>
                                <a href="{{ route('review-penilaian.show', [$form->idPenyusunanKPI, 3]) }}" class="text-decoration-none">Triwulan III</a><br/>
                                <a href="{{ route('review-penilaian.show', [$form->idPenyusunanKPI, 4]) }}" class="text-decoration-none">Triwulan IV</a>
                            </td>
                            <td>
                                @if($form->status_triwulan1)
                                    <span class="badge bg-success">Sudah</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                                <br/>

                                @if ($form->status_triwulan2)
                                    <span class="badge bg-success">Sudah</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                                <br/>

                                @if ($form->status_triwulan3)
                                    <span class="badge bg-success">Sudah</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                                <br/>

                                @if ($form->status_triwulan4)
                                    <span class="badge bg-success">Sudah</span>
                                @else
                                    <span class="badge bg-danger">Belum</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
