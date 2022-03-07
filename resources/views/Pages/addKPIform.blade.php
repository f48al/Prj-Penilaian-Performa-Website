@extends('master')

@section('title', 'Form Penambahan KPI')

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

    {{-- main content --}}
    <div class="container mt-5">
        <div class="row">
            <h2>Form Penambahan KPI</h2>
        </div>
        <div class="row mt-3" style="font-size: 13px">
            <div class="col">
                <span class="text-secondary" style="cursor: pointer" onclick="upload()">
                    Import file
                    <img src="{{ asset('plugin/images/2_1_addkpiform-page/u300.svg') }}" class="img-icon" alt="upload-file">
                </span>
            </div>
        </div>
        <div class='row table-responsive mt-3' style="font-size: 10px;">
            <table id="table_id" class="table table-sm table-bordered border-light table-striped align-middle w-100">
                <thead class="table-success text-center">
                    <tr class="align-middle">
                        <th scope="col">Perspektif <small class="text-danger">*</small></th>
                        <th scope="col">Tujuan Strategis <small class="text-danger">*</small></th>
                        <th scope="col">Indikator Kunci Kerja <small class="text-danger">*</small></th>
                        <th scope="col">Glosary <small class="text-danger">*</small></th>
                        <th scope="col">Formula <small class="text-danger">*</small></th>
                        <th scope="col">Tahun Kinerja <small class="text-danger">*</small></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select class="form-control gradient-border py-1 w-100" id="perspektif" name="perspektif" required>
                                <option value="Customer">Customer</option>
                                <option value="Financial">Financial</option>
                                <option value="Internal Bisnis Proses">Internal Bisnis Proses</option>
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control gradient-border py-1 w-100" id="tujuanStrategis" name="tujuanStrategis" placeholder="Tambahkan..." required>
                        </td>
                        <td>
                            <input type="text" class="form-control gradient-border py-1 w-100" id="indikatorKunciKerja" name="indikatorKunciKerja" placeholder="Tambahkan..." required>
                        </td>
                        <td>
                            <input type="text" class="form-control gradient-border py-1 w-100" id="glosary" name="glosary" placeholder="Tambahkan..." required>
                        </td>
                        <td>
                            <select class="form-control gradient-border py-1 w-100" id="formula" name="formula" required>
                                <option value="Realisai/target (Posisi default)">Realisai/target (Posisi default)</option>
                                <option value="Realisai/target">Realisai/target</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control gradient-border py-1 w-100" id="tahunKinerja" name="tahunKinerja" required>
                                @for ($i = 2017; $i <= intval(date('Y')); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td style="cursor: pointer;" onclick="removeRow(this)">
                            <img src="{{ asset('plugin/images/2__listindikator-page/u177.svg') }}" class="img-icon" alt="cross-icon" id="remove_row"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <div class="text-center" style="font-size: 13px;">
                    <span class="text-primary" style="cursor: pointer;" onclick="addRow()">
                        <img src="{{ asset('plugin/images/2_1_addkpiform-page/u296.svg') }}" class="img-icon" alt="plus-icon" id="add_row"/>
                        Tambah Baris KPI
                    </span>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col text-center" style="font-size: 13px;">
                <button type="button" class="btn btn-primary py-1 px-4" style="border-radius: 15px" id="btn_save"><b>Save</b></button>
            </div>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal-upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <form id="form-upload">
                <div class="modal-content">
                    @csrf @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-uploadLabel">Upload File Excel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Silahkan upload file excel dengan format penulisan sesuai ketentuan.
                        </p>
                        <input type="file" class="form-control" id="file" name="file" accept=".xls, .xlsx">
                        <p style="font-size: 13px">
                            <small class="text-danger">
                                *Ketentuan file :<br>
                                - Kesalahan penulisan format akan mempengaruhi data. Cek kembali sebelum upload<br>
                                - Anda bisa menggunakan form di laman ini bila ragu dengan format penulisan<br>
                                - Maximal file size adalah 5 Mb<br>
                                - Nama file akan di-enkripsi untuk keamanan<br>
                                - Ekstensi file hanya untuk .xls dan .xlsx (excel format)<br>
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
    <script>
        function addRow() {
            const table = $('#table_id');
            const row = table.find('tbody tr:first').clone();

            if(table.find('tbody tr').length > 10) {
                showToast('<strong>Kolom yang bisa ditambahkan maksimal 10 kolom!</strong> demi menjaga stabilitas server', 'error');
                return;
            } else {
                row.find('input').val('');
                table.find('tbody').append(row);
                showToast('Berhasil menambah kolom', 'success');
            }
        }

        function removeRow(e) {
            const table = $('#table_id');
            const row = $(e).closest('tr');

            if(table.find('tbody tr').length > 1) {
                row.remove();
                showToast('Berhasil menghapus kolom', 'success');
            } else {
                row.find('input').val('');
                showToast('<strong>Kolom form pertama tidak boleh dihapus!</strong> tapi akan kami hapus isinya', 'error');
            }
        }

        $('#btn_save').click(function() {
            const table = $('#table_id');
            const data = [];

            table.find('tbody tr').each(function() {
                const row = $(this);
                const perspektif = row.find('#perspektif').val();
                const tujuanStrategis = row.find('#tujuanStrategis').val();
                const indikatorKunciKerja = row.find('#indikatorKunciKerja').val();
                const glosary = row.find('#glosary').val();
                const formula = row.find('#formula').val();
                const tahunKinerja = row.find('#tahunKinerja').val();

                data.push({
                    perspektif: perspektif,
                    tujuanStrategis: tujuanStrategis,
                    indikatorKunciKerja: indikatorKunciKerja,
                    glosary: glosary,
                    formula: formula,
                    tahunKinerja: tahunKinerja
                });
            });

            $.ajax({
                url: "{{ route('add-kpi.store') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: data
                },
                success: function(data) {
                    const table = $('#table_id');
                    table.find('tbody tr').each(function() {
                        const row = $(this);
                        row.find('input').val('');
                    });
                    showToast(`Berhasil menambahkan data!, <a class="link-light text-decoration-none" href="{{ route('add-kpi.index') }}"><b>lihat hasilnya</b></a>`, 'success');
                }
            });
        })

        function upload() {
            $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
            $('#modal-upload').modal('show');
        }

        $('#upload-btn').click(function() {
            $(this).prop('disabled', true).text('Mengupload file...');
            // upload file menggunakan ajax
            $.ajax({
                url: "{{ route('add-kpi.excel') }}",
                method: "POST",
                data: new FormData($('#form-upload')[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#modal-upload').modal('hide');
                    $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
                    $('#file').val('');
                    showToast(`Penambahan berhasil!, <a class="text-decoration-none link-light" href="{{ route('add-kpi.index') }}"><b>Lihat hasilnya</b></a>`, 'success')
                },
                error: function(data) {
                    $('#modal-upload').modal('hide');
                    $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
                    $('#file').val('');
                    showToast(data, 'error')
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
