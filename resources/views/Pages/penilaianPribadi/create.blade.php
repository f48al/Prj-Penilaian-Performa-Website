@extends('master')

@section('title', 'Penilaian Pribadi Page')

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
    <div class="container mt-5" style="font-size: 13px;">
        <div class="row">
            <h5 class="fw-bold">Penilain Pribadi</h5>
            <h3 class="fw-bold text-primary">Periode Kinerja {{ $triwulan }}</h3>
            <span>Tahun {{ $tahun.' ('.$periode.')' }}</span>
        </div>
        <div class="row mt-4">
            <table id="table_id" class="table table-sm table-bordered border-light table-striped align-middle w-100">
                <thead class="table-success text-center">
                    <tr class="aling-middle">
                        <th>Perspektif</th>
                        <th>Tujuan Strategis</th>
                        <th>Indikator Kunci Kerja</th>
                        <th style="width: 7%">Bobot</th>
                        <th style="width: 7%">Target</th>
                        <th style="width: 7%">Realisasi Karyawan</th>
                        <th style="width: 7%">Realisasi Atasan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        @if ($ke == '1')
                            @php $target_triwulan = $data->targetTriwulan1; @endphp
                        @elseif($ke == '2')
                            @php $target_triwulan = $data->targetTriwulan2; @endphp
                        @elseif($ke == '3')
                            @php $target_triwulan = $data->targetTriwulan3; @endphp
                        @else
                            @php $target_triwulan = $data->targetTriwulan4; @endphp
                        @endif
                        <tr class="text-center">
                            <td>{{ $data->draftKpiIndividu->perspektif }}</td>
                            <td>{{ $data->draftKpiIndividu->tujuanStrategis }}</td>
                            <td>{{ $data->draftKpiIndividu->indikatorKunciKerja }}</td>
                            <td>{{ $data->bobot }}</td>
                            <td>{{ $target_triwulan->target }}</td>
                            <td>
                                <input type="number" name="id" value="{{ $data->id }}" readonly hidden>
                                <input type="number" class="form-control gradient-border py-1 w-100 realisasi_karyawan" placeholder="..." required value="{{ $target_triwulan->realisasiKaryawan }}">
                            </td>
                            <td>
                                <input type="number" class="form-control gradient-border py-1 w-100" placeholder="..." disabled value="{{ $target_triwulan->realisasiAtasan }}">
                            </td>
                            <td>
                                <a href="{{ asset($target_triwulan->filePendukung) }}" id="file_{{ $data->id }}" {{ !$target_triwulan->filePendukung ? 'hidden' : '' }} class="text-decoration-none" title="lihat file" target="_blank" rel="noopener noreferrer">
                                    <img src="{{ asset('plugin/images/1__home-page/u57.svg') }}" class="img-icon" style="cursor: pointer;"/>
                                </a>
                                <img src="{{ asset('plugin/images/1__home-page/u58.svg') }}" class="img-icon" onclick="upload({{ $data->id }}, false)" style="cursor: pointer;" title="upload / re-upload"/>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row my-3">
            <div class="col text-center" style="font-size: 13px">
                <button type="button" class="btn btn-primary py-1 px-4" style="border-radius: 15px" id="btn_save"><b>Submit</b></button>
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

    {{-- modal --}}
    <div class="modal fade" id="modal-upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <form id="form-upload" enctype="multipart/form-data">
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
                        <input type="text" name="target_kinerja_id" id="target_kinerja_id" hidden>
                        <input type="file" class="form-control" id="filePendukung" name="filePendukung" accept=".doc,.docx,.pdf">
                        <p style="font-size: 13px">
                            <small class="text-danger">
                                *Ketentuan file :<br>
                                - Maximal file size adalah 25 Mb<br>
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
    <script>
        function upload(target_kinerja_id) {
            $('#target_kinerja_id').val(target_kinerja_id);
            $('#modal-upload').modal('show').on('hidden.bs.modal', function () {
                $(this).find('input').not('[name="_token"]').val('');
                $('#upload-btn').prop('disabled', false).text('Selesai, upload file');
            });
        }

        $('#upload-btn').click(function() {
            $(this).prop('disabled', true).text('Mengupload file...');

            // upload file menggunakan ajax
            $.ajax({
                url: "{{ route('penilaian-pribadi.store', [Request::segment(3), $ke]) }}",
                method: "POST",
                data: new FormData($('#form-upload')[0]),
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) {
                    $('#file_' + data.target_kinerja_id).attr('href', data.file_pendukung).attr('hidden', false);
                    $('#modal-upload').modal('hide');
                    showToast('File berhasil diupload', 'success');
                },
                error: function(data) {
                    $('#modal-upload').modal('hide');
                    showToast('File gagal diupload, pastikan properti file sesuai ketentuan', 'danger');
                }
            })
        })

        $('#btn_save').click(async function() {
            $(this).attr('disabled', true).text('Submiting...');

            const table = $('#table_id');
            await table.find('tbody tr').each(function() {
                const row = $(this);
                const data = {
                    'target_kinerja_id': row.find('[name="id"]').val(),
                    'realisasiKaryawan': row.find('.realisasi_karyawan').val(),
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('penilaian-pribadi.store', $ke) }}",
                    method: "POST",
                    data: data,
                });
            });
            $("html, body").animate({scrollTop: 0}, "slow");
            showToast('Data berhasil disimpan', 'success');
            $(this).attr('disabled', false).text('Simpan');
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
