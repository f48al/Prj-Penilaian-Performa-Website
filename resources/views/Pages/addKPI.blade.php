@extends('master')

@section('title') Penambahan KPI @endsection

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
            <h2>Penambahan KPI</h2>
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
        <div class="d-flex justify-content-center my-3">
            <a href="{{ route('add-kpi.form') }}" class="link-success">
                <img src="{{ asset('plugin/images/2__listindikator-page/u208.svg') }}" alt="add-icon" class="img-logo">
                <span class="ml-2">Indikator KPI</span>
            </a>
        </div>
        <div class="row table-responsive mt-3" style="font-size: 13px">
            <table id="table_id" class="table table-striped table-hover w-100">
                <thead>
                    <tr>
                        <th>Perspektif</th>
                        <th>Tujuan Strategis</th>
                        <th>Indikator Kunci Kerja</th>
                        <th>Glosary</th>
                        <th>Formula</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" id="modal-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <form id="form-edit">
                <div class="modal-content">
                    @csrf @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-editLabel">
                            <img src="{{ asset('plugin/images/2__listindikator-page/u175.svg') }}" class="img-icon mb-1"/>
                            Edit KPI
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="font-size: 13px;">
                        <input type="text" id="iddKPI" hidden>
                        <div class="row my-3">
                            <div class="col">
                                <label for="indikatorKunciKerja" class="form-label">Indikator Kunci Kerja <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="indikatorKunciKerja" id="indikatorKunciKerja" required>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label for="tujuanStrategis" class="form-label">Tujuan Strategis <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="tujuanStrategis" id="tujuanStrategis" required>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col">
                                <label for="glosary" class="form-label">Glosary <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="glosary" id="glosary" required>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-6">
                                <label for="perspektif" class="form-label">Perspektif <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="perspektif" id="perspektif" required>
                            </div>
                            <div class="col-6">
                                <label for="formula" class="form-label">Formula <small class="text-danger">*</small></label>
                                <input type="text" class="form-control" name="formula" id="formula" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-success" id="edit-btn">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modal-destroy" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h4>Yakin ingin menghapus data ini?</h4>
                Data yang sudah dihapus tidak bisa kembali
            </div>
            <div class="modal-footer justify-content-center gap-3">
                <button type="button" class="btn btn-danger" data-destroy-id="" id="destroy-btn">Ya, Hapus Data</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $('#year').change(function() {
            window.location.replace("{{ url('addKPI') }}/" + $(this).val());
        });

        var table = $('#table_id').DataTable({
            processing: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Indonesian.json"
            },
            ajax: {
                url: "{{ route('add-kpi.index', $year) }}",
                type: "GET",
                dataSrc: "original.data"
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
                    data: 'glosary',
                    name: 'glosary'
                },
                {
                    data: 'formula',
                    name: 'formula'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // function untuk mengedit data
        function edit(iddKPI) {
            $.ajax({
                url: "{{ url('/editKPI') }}/" + iddKPI,
                type: "GET",
            }).done(function(data) {
                for (const key in data) {
                    if (Object.hasOwnProperty.call(data, key)) {
                        const e = data[key];

                        $('#'+ key).val(e);
                    }
                }

                $('#modal-edit').modal('show');
            })
        }

        $('#modal-edit').on('hidden.bs.modal', function() {
            $('#form-edit').trigger('reset');
        })

        $('#edit-btn').click(function() {
            $(this).prop('disabled', true).text('Menyimpan perubahan...');
            const iddKPI = $('#iddKPI').val();

            $.ajax({
                url: "{{ url('/editKPI') }}/"+ iddKPI,
                type: "PATCH",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $('#form-edit').serialize(),
                success: function(data) {
                    $('#modal-edit').modal('hide');
                    $('#edit-btn').prop('disabled', false).text('Simpan Perubahan');
                    table.ajax.reload();
                    showToast('Perubahan berhasil disimpan!', 'success');
                },
                error: function(data) {
                    $('#modal-edit').modal('hide');
                    $('#edit-btn').prop('disabled', false).text('Simpan Perubahan');
                    table.ajax.reload();
                    showToast('<b>Terjadi kesalahan!</b>', 'error');
                }
            })
        })

        // function untuk menghapus data
        function destroy(iddKPI) {
            $('#modal-destroy').find('#destroy-btn').attr('data-destroy-id', iddKPI);
            $('#modal-destroy').modal('show');
        }

        $('#destroy-btn').click(function() {
            const iddKPI = $(this).attr('data-destroy-id');

            if(iddKPI) {
                $.ajax({
                    url: "{{ url('/deleteKPI') }}/" + iddKPI,
                    type: "DELETE",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function(data) {
                    showToast('<strong>KPI berhasil dihapus!</strong>', 'success');
                    table.ajax.reload();
                }).fail(function(err) {
                    showToast('<strong>Terjadi kesalahan!</strong>', 'error');
                    table.ajax.reload();
                }).always(function() {
                    $('#modal-destroy').modal('hide');
                })
            }

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
