@extends('master')

@section('title') HomePage @endsection

@section('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
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
            <h2>Periode Kinerja Triwulan {{ $triwulan }}</h2>
            <h4>{{ $triwulan_text }}</h4>
        </div>
        <div class="row table-responsive mt-3" style="font-size: 13px">
            <table id="table_id" class="table table-striped table-hover mt-5 w-100">
                <thead>
                    <tr>
                        <th>Perspektif</th>
                        <th>Tujuan Strategis</th>
                        <th>Indikator Kunci Kerja</th>
                        <th>Target</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal-upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <form id="form-upload">
                <div class="modal-content">
                    @csrf @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-uploadLabel">Upload File Pendukung</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Silahkan upload bukti file sebagai pendukung untuk menguatkan penilaian pada akhir triwulan mendatang.
                        </p>
                        <input type="text" name="_iddPenilaian" id="iddPenilaian" hidden>
                        <input type="file" class="form-control" id="filePendukung" name="filePendukung">
                        <p style="font-size: 13px">
                            <small class="text-danger">
                                *Ketentuan file :<br>
                                - Maximal file size adalah 100 Mb<br>
                                - Nama file akan di-enkripsi untuk keamanan<br>
                                - Ekstensi file akan dideteksi otomatis oleh sistem<br>
                                - Bila ditemukan kejanggalan, sistem akan memformat file ke '.rar'<br>
                                - Ukuran file mempengaruhi waktu upload<br>
                                - Pastikan memiliki koneksi yang stabil<br>
                            </small>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="upload-btn">Selesai, upload file</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        var table = $('#table_id').DataTable({
            processing: true,
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian.json"
            },
            ajax: {
                url: "{{ route('home-kinerja', ['triwulan' => $triwulan, 'year' => $year]) }}",
                type: "GET",
                dataSrc: "original.data",
            },
            columns: [
                {
                    data: 'perspektif',
                    name: 'perspektif'
                },
                {
                    data: 'tujuanStrategis',
                    name: 'tujuanStrategis'
                },
                {
                    data: 'indikatorKunciKerja',
                    name: 'indikatorKunciKerja'
                },
                {
                    data: 'skala',
                    name: 'skala'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        function upload(iddPenilaian) {
            $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
            $('#iddPenilaian').val(iddPenilaian);
            $('#modal-upload').modal('show');
        }

        $('#upload-btn').click(function() {
            $(this).prop('disabled', true).text('Mengupload file...');
            // upload file menggunakan ajax
            $.ajax({
                url: "{{ route('home-upload') }}",
                method: "POST",
                data: new FormData($('#form-upload')[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#modal-upload').modal('hide');
                    $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
                    $('#filePendukung').val('');
                    $('#iddPenilaian').val('');
                    table.ajax.reload();
                    showToast(`Penambahan file berhasil! <a class="text-decoration-none link-light" href="${data}"><b>Lihat/Download</b></a>`, 'success')
                },
                error: function(data) {
                    $('#modal-upload').modal('hide');
                    $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
                    $('#filePendukung').val('');
                    $('#iddPenilaian').val('');
                    table.ajax.reload();
                    showToast(data, 'danger')
                }
            });
        })

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
