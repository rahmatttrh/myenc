@extends('layouts.app')
@section('title')
KPA
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">KPI</li>
        </ol>
    </nav>

    <div class="row" id="boxCreate">
        <div class="col-md-3">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Give Performance Apprasial</div>
                    </div>

                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group form-group-default">
                            <label>Employee</label>
                            <select class="form-control" name="employe_id" id="employe_id">
                                <option value="">--- Choose Employe ---</option>
                                @foreach ($employes as $employe)
                                <option value="{{$employe->id}}">{{$employe->biodata->first_name}} {{$employe->biodata->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-default">
                            <label>Month</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control form-select date" id="bulan" name="bulan">
                                        <option value="01" {{ date('m') == '02' ? 'selected' : '' }} {{ date('m') < '02' ? 'disabled' : '' }}>Januari</option>
                                        <option value="02" {{ date('m') == '03' ? 'selected' : '' }} {{ date('m') < '03' ? 'disabled' : '' }}>Februari</option>
                                        <option value="03" {{ date('m') == '04' ? 'selected' : '' }} {{ date('m') < '04' ? 'disabled' : '' }}>Maret</option>
                                        <option value="04" {{ date('m') == '05' ? 'selected' : '' }} {{ date('m') < '05' ? 'disabled' : '' }}>April</option>
                                        <option value="05" {{ date('m') == '06' ? 'selected' : '' }} {{ date('m') < '06' ? 'disabled' : '' }}>Mei</option>
                                        <option value="06" {{ date('m') == '07' ? 'selected' : '' }} {{ date('m') < '07' ? 'disabled' : '' }}>Juni</option>
                                        <option value="07" {{ date('m') == '08' ? 'selected' : '' }} {{ date('m') < '08' ? 'disabled' : '' }}>Juli</option>
                                        <option value="08" {{ date('m') == '09' ? 'selected' : '' }} {{ date('m') < '09' ? 'disabled' : '' }}>Agustus</option>
                                        <option value="09" {{ date('m') == '10' ? 'selected' : '' }} {{ date('m') < '10' ? 'disabled' : '' }}>September</option>
                                        <option value="10" {{ date('m') == '11' ? 'selected' : '' }} {{ date('m') < '11' ? 'disabled' : '' }}>Oktober</option>
                                        <option value="11" {{ date('m') == '12' ? 'selected' : '' }} {{ date('m') < '12' ? 'disabled' : '' }}>November</option>
                                        <option value="12" {{ date('m') == '01' ? 'selected' : '' }}>Desember</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <select class="form-control form-select date" id="tahun" name="tahun">
                                        <option value="{{ date('Y') }}">{{ date('Y') }}</option>
                                        <option value="{{ date('Y') -1 }}">{{ date('Y') -1 }}</option>
                                        <!-- Tambahkan opsi tahun sesuai kebutuhan -->
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow-none border">
                <div class="card-header">
                    <div class="col-md-1 float-right mb-3">
                        <button type="button" id="hide" class="btn btn-block btn-danger"><i class="fa fa-minus"></i> Hide </button>
                    </div>
                    <div class="card-title">Objective KPI</div>
                </div>
                <form action="{{route('kpa.store')}}" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">
                    @csrf
                    <input type="hidden" id="kpi_id" name="kpi_id">
                    <input type="hidden" id="employee_id" name="employe_id">
                    <input type="hidden" id="date" name="date">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tableCreate" class="displays table table-striped ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Objective</th>
                                        <th>Weight</th>
                                        <th>Target</th>
                                        <th>Value</th>
                                        <th>Achievement</th>
                                        <th>Attachment (PDF)</th> <!-- Kolom Attachment -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Achievement</th>
                                        <th id="totalAchievement"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-3 float-right mb-3">
                            <button type="submit" class="btn btn-block btn-primary ">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">List All Performance Apprasial</div>
                    </div>
                    <div class="btn-group btn-group-page-header ml-auto">
                        <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu">
                            <btn id="btnCreate" class="dropdown-item" style="text-decoration: none">Create</btn>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display basic-datatables table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Employe</th>
                                    <th>Date</th>
                                    <th>Achievement</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kpas as $kpa)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$kpa->employe->biodata->fullName()}}</td>
                                    <td>{{date('F Y', strtotime($kpa->date))  }}</td>
                                    <td><span class="badge badge-primary badge-lg"><b>{{$kpa->achievement}}</b></span></td>
                                    <td class="text-right">
                                        {{--<a href="{{route('kpa.edit', enkripRambo($kpa->id) )}}">Edit</a>--}}
                                        <a href="#" data-toggle="modal" data-target="#modal-delete-{{$kpa->id}}">Delete</a>
                                    </td>
                                </tr>
                                {{-- <x-modal.delete :id="$kpa->id" :body="$kpa->name" url="{{route('kpa.delete', enkripRambo($kpa->id))}}" /> --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        $('#boxCreate').hide();

        bulanPenilaian();

        $("#btnCreate").click(function() {

            $('#boxCreate').show();
            // Tambahkan kode lain yang ingin Anda eksekusi saat tombol diklik di sini
        });

        $("#hide").click(function() {

            $('#boxCreate').hide();
            // Tambahkan kode lain yang ingin Anda eksekusi saat tombol diklik di sini
        });

        $('.date').change(function() {
            bulanPenilaian();
        });

        $('#employe_id').change(function() {
            let employeeId = $(this).val();

            $('#employee_id').val(employeeId);

            $("#tableCreate tbody").empty();

            $.ajax({
                url: '/kpi/employe/' + employeeId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#kpi_id').val(data[0].kpi_id);

                    var table = $("#tableCreate tbody");
                    $.each(data, function(index, rowData) {
                        var row = $("<tr>").attr("id", "row_" + rowData.id); // Tambahkan ID indeks pada baris
                        row.append($("<td>").text(index + 1));
                        row.append($("<td>").text(rowData.objective));
                        row.append($("<td>").text(rowData.weight));
                        row.append($("<td>").text(rowData.target));
                        var input = $("<input>").attr({
                            "type": "text",
                            "class": "form-control",
                            "name": `qty[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            "value": 0,
                            "min": 0.01,
                            "max": rowData.target,
                            "step": "0.01" // Step untuk 2 digit desimal
                        }).on('input', function() {
                            // Menghapus angka nol di depan input jika ada
                            var inputValue = $(this).val();
                            inputValue = inputValue.replace(/^0+/, '');
                            $(this).val(inputValue);

                            calculateAchievement(rowData.id, rowData.target);
                            calculateTotalAchievement();
                        });

                        row.append($("<td>").append(input));
                        var achievementInput = $("<input>").attr({
                            "type": "text",
                            "class": "form-control text-bold",
                            "name": "achievement_" + rowData.id,
                            "placeholder": "0",
                            "readonly": true
                        }).css("font-weight", "bold"); // Menambahkan style font-weight: bold

                        row.append($("<td>").append(achievementInput));

                        var attachmentInput = $("<input>").attr({
                            "type": "file",
                            "class": "form-control",
                            "name": `attachment[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            "required": true, // Tambahkan atribut readonly
                            "accept": ".pdf" // Hanya izinkan file PDF
                        });

                        row.append($("<td>").append(attachmentInput));


                        table.append(row);
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });

        });

        function validasiInput(index) {

            var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val());

        }

        function calculateAchievement(index, target) {

            // validasi dulu
            // validasiInput(index);

            var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val()) || 0; // Menggantikan dengan nilai 0 jika null atau kosong
            // var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val()) || 0.1; // Ganti 0 dengan 0.1 jika null atau kosong

            // var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val());

            // if (isNaN(inputVal) || inputVal <= 0) {
            //     inputVal = 0; // Set nilai ke 0.1 jika kosong atau bernilai 0
            //     $(`input[name="qty[${index}]"]`).val(inputVal)
            // }

            var targetVal = parseFloat($(`#tableCreate tbody #row_${index} td:eq(3)`).text());
            var weightVal = parseFloat($(`#tableCreate tbody #row_${index} td:eq(2)`).text());

            if (!isNaN(inputVal) && inputVal >= 0.1 && inputVal <= target) {
                var result = (inputVal / targetVal) * weightVal;
                $(`input[name="achievement_${index}"]`).val(Math.round(result));
            } else {
                $(`input[name="achievement_${index}"]`).val("Invalid Input");
            }
        }

        function calculateTotalAchievement() {
            var totalAchievement = 0;
            $("input[name^='achievement_']").each(function() {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    totalAchievement += value;
                }
            });

            $("#totalAchievement").text(totalAchievement.toFixed(2));
        }

        // Fungsi untuk mengosongkan tabel
        function clearTable() {
            $("#tableCreate tbody").empty();
        }

        function bulanPenilaian() {
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();

            let date = tahun + '-' + bulan + '-01';

            $('#date').val(date);

        }

    })
</script>
@endpush