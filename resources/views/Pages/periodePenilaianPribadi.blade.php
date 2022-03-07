@extends('master')

@section('title', 'Penilaian KPI Pribadi')

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
            <h2>Penilaian Pribadi</h2>
        </div>
        <div class="row w-100">
            <label for="year">
                <small style="font-size: 13px">Periode Tahun {{ $year }}</small>
            </label>
            <select name="year" id="year" class="form-control mx-2 py-1">
                @for ($i = 2017; $i <= intval(date('Y')); $i++)
                    <option value="{{ $i }}" {{ $i == intval($year) ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="row table-responsive mt-3" style="font-size: 13px;">
            <table id="table_id" class="table table-striped table-hover text-center w-100">
                <thead class="text-primary" style="background-color: #95F204">
                    <tr>
                        <th>Periode Triwulan</th>
                        <th>ID Draft KPI</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="fw-bold">
                    <tr>
                        <td>Triwulan I</td>
                        <td>
                            <a href="{{ route('penilaian-pribadi.create', [$data->idPenyusunanKPI, '1']) }}" class="text-decoration-none">
                                {{ $data->dkpiid }}
                            </a>
                        </td>
                        <td>
                            @if ($data->status_triwulan1)
                                <span class="badge bg-success">Sudah</span>
                            @else
                            <span class="badge bg-danger">belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Triwulan II</td>
                        <td>
                            <a href="{{ route('penilaian-pribadi.create', [$data->idPenyusunanKPI, '2']) }}" class="text-decoration-none">
                                {{ $data->dkpiid }}
                            </a>
                        </td>
                        <td>
                            @if ($data->status_triwulan2)
                                <span class="badge bg-success">Sudah</span>
                            @else
                            <span class="badge bg-danger">belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Triwulan III</td>
                        <td>
                            <a href="{{ route('penilaian-pribadi.create', [$data->idPenyusunanKPI, '3']) }}" class="text-decoration-none">
                                {{ $data->dkpiid }}
                            </a>
                        </td>
                        <td>
                            @if ($data->status_triwulan3)
                                <span class="badge bg-success">Sudah</span>
                            @else
                            <span class="badge bg-danger">belum</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Triwulan IV</td>
                        <td>
                            <a href="{{ route('penilaian-pribadi.create', [$data->idPenyusunanKPI, '4']) }}" class="text-decoration-none">
                                {{ $data->dkpiid }}
                            </a>
                        </td>
                        <td>
                            @if ($data->status_triwulan4)
                                <span class="badge bg-success">Sudah</span>
                            @else
                            <span class="badge bg-danger">belum</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#year').change(function() {
            window.location.replace("{{ url('penilaianPribadi') }}/" + $(this).val());
        });
    </script>
@endsection
