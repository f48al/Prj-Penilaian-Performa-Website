@extends('master')

@section('title', 'Inbox Page')

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
    {{-- main content --}}
    <div class="container mt-5">
        <div class="row">
            <h2>Inbox Anda</h2>
        </div>
        <div class="row table-responsive mt-3" style="font-size: 13px;">
            <table id="table_id" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>Inbox</th>
                        <th>Tanggal</th>
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
        var table = $('#table_id').DataTable({
            processing: true,
            serverSide: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian.json"
            },
            ajax: "{{ route('inbox.index') }}",
            columns: [
                {
                    data: 'inbox',
                    name: 'inbox'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                }
            ]
        });
    </script>
@endsection
