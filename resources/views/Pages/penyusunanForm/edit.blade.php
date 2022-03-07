@extends('master')

@section('title', 'Form Penyusunan')

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
                            <th class="fw-normal">{{ $profile->name }}</th>
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
                    @for ($i = 0; $i < 8; $i++)
                        <tr class="text-center">
                            <td>
                                <select class="form-control gradient-border py-1 w-100 indikatorKunciKerja" required>
                                    @for ($j = 0; $j < count($kpis); $j++)
                                        <option
                                            value="{{ $kpis[$j]->iddKPI }}"
                                            data-index="{{ $j }}"
                                            {{ $kpis[$j]->iddKPI == $targets[$i]->iddKPI ? 'selected' : '' }}
                                        >{{ $kpis[$j]->indikatorKunciKerja }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                            <td class="perspektif">{{ $targets[$i]->draftKpiIndividu->perspektif }}</td>
                            <td class="tujuanStrategis">{{ $targets[$i]->draftKpiIndividu->tujuanStrategis }}</td>
                            <td>
                                <select class="form-control gradient-border py-1 w-100 skala" required>
                                    <option value="100" {{ $targets[$i]->skala == 100 }}>100%</option>
                                    <option value="120" {{ $targets[$i]->skala == 120 }}>120%</option>
                                </select>
                                <input type="hidden" class="_id" value="{{ $targets[$i]->id}}">
                            </td>
                            <td>
                                <input type="number" class="form-control gradient-border py-1 w-100 bobot" placeholder="..." value="{{ $targets[$i]->bobot }}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control gradient-border py-1 w-100 targetTriwulan1" placeholder="..." value="{{ $targets[$i]->targetTriwulan1->target }}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control gradient-border py-1 w-100 targetTriwulan2" placeholder="..." value="{{ $targets[$i]->targetTriwulan2->target }}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control gradient-border py-1 w-100 targetTriwulan3" placeholder="..." value="{{ $targets[$i]->targetTriwulan3->target }}" required>
                            </td>
                            <td>
                                <input type="number" class="form-control gradient-border py-1 w-100 targetTriwulan4" placeholder="..." value="{{ $targets[$i]->targetTriwulan4->target }}" required>
                            </td>
                        </tr>
                    @endfor
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-end">
                            <span class="fw-bold">
                                Total Bobot:
                                <span id="total_bobot" class="{{$targets->sum('bobot') != 100 ?'text-danger' : 'text-success'}}">
                                    {{ $targets->sum('bobot') }}
                                </span>
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="row justify-content-md-center mt-3">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="catatan" class="form-label fw-bold">Catatan</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ $form->catatan }}</textarea>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col text-center" style="font-size: 13px">
                <button type="button" class="btn btn-danger py-1 px-4" style="border-radius: 15px" id="btn_edit"><b>Edit</b></button>
            </div>
        </div>
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

@section('script')
    <script>
        const total_bobot = $('#total_bobot');
        const kpis = {!! $kpis !!};

        $('.bobot').keyup(function() {
            const field = $('.bobot');
            let count = 0;

            $(field).each(function() {
                if ($(this).val()) count += parseInt($(this).val());
            });

            if(count != 100) {
                $('#total_bobot').removeClass('text-success').addClass('text-danger').text(count);
            } else {
                $('#total_bobot').removeClass('text-danger').addClass('text-success').text(count);
            }
        });

        $('.indikatorKunciKerja').change(function() {
            const i = $(this).find(':selected').data('index');

            $(this).closest('tr').find('.perspektif').text(kpis[i].perspektif);
            $(this).closest('tr').find('.tujuanStrategis').text(kpis[i].tujuanStrategis);
        });

        $('#btn_edit').click(function() {
            $(this).attr('disabled', true).text('Menyimpan perubahan...');

            const table = $('#table_id');
            const data = [];

            table.find('tbody tr').each(function() {
                const row = $(this);
                const id = row.find('._id').val();
                const iddkpi = row.find('.indikatorKunciKerja').val();
                const skala = row.find('.skala').val();
                const bobot = row.find('.bobot').val();
                const targetTriwulan1 = row.find('.targetTriwulan1').val();
                const targetTriwulan2 = row.find('.targetTriwulan2').val();
                const targetTriwulan3 = row.find('.targetTriwulan3').val();
                const targetTriwulan4 = row.find('.targetTriwulan4').val();

                data.push({
                    id: id,
                    iddkpi: iddkpi,
                    skala: skala,
                    bobot: bobot,
                    targetTriwulan1: targetTriwulan1,
                    targetTriwulan2: targetTriwulan2,
                    targetTriwulan3: targetTriwulan3,
                    targetTriwulan4: targetTriwulan4
                });
            });

            data.push({
                catatan: $('#catatan').val()
            });

            $.ajax({
                url: "{{ route('penyusunan-kpi.update', $form->idPenyusunanKPI) }}",
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                    data: data
                },
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    window.location.href = "{{ route('penyusunan-kpi.index') }}";
                },
                error: function(err) {
                    $('#btn_edit').attr('disabled', false).text('Gagal menyimpan..');
                    console.log(err);
                }
            })
        })
    </script>
@endsection
