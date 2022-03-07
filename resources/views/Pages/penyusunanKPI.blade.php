@extends('master')

@section('title', 'Penyusunan KPI')

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <style>
        #year {
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

    {{-- main content --}}
    <div class="container mt-5">
        <div class="row">
            <h2>Penyusunan KPI Karyawan</h2>
        </div>
        <div class="row w-100">
            <label for="year">
                <small style="font-size: 13px">Periode kinerja pada</small>
            </label>
            <select name="year" id="year" class="form-control mx-2 py-1">
                @for ($i = 2017; $i <= intval(date('Y')); $i++)
                    <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>Tahun {{ $i }}</option>
                @endfor
            </select>
        </div>
        <div class="row table-responsive mt-3" style="font-size: 13px">
            <table id="table_id" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>NPK</th>
                        <th>Nama Pegawai</th>
                        <th>Nama Posisi</th>
                        <th>ID Draft KPI</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#year').change(function() {
            window.location.replace("{{ url('penyusunanKPI') }}/" + $(this).val());
        });

        var table = $('#table_id').DataTable({
            processing: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian.json"
            },
            ajax: {
                url: "{{ route('penyusunan-kpi.index', $year) }}",
                type: "GET",
                dataSrc: "original.data"
            },
            columns: [
                {
                    data: 'NPK',
                    name: 'NPK'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'namaJabatan',
                    name: 'namaJabatan'
                },
                {
                    data: 'dkpiid',
                    name: 'dkpiid'
                },
                {
                    data: 'status_penyusunan',
                    name: 'status_penyusunan'
                }
            ]
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
