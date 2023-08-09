@extends('layouts.app')
@section('title')
KPA
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('kpa')}}">KPA</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                            <label><b>Employee</b></label>
                            {{$kpa->employe->biodata->fullName()}}
                        </div>
                        <div class="form-group form-group-default">
                            <label>Month</label>
                            {{ date('M Y', strtotime($kpa->date))}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow-none border">
                <div class="card-header">
                    <div class="card-title">Objective KPI</div>
                </div>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td><a href=""> {{$data->kpidetail->objective}} </a></td>
                                    <td> {{$data->kpidetail->weight}}</td>
                                    <td> {{$data->kpidetail->target}}</td>
                                    <td> {{$data->value}}</td>
                                    <td class="text-right"> <b>{{$data->achievement}}</b></td>
                                    <td> <a href="{{$data->evidence}}">Lihat</a> </td>
                                    <td>Edit</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right">Achievement</th>
                                    <th class="text-right" id="totalAchievement">{{$kpa->achievement}}</th>
                                </tr>
                            </tfoot>
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

        bulanPenilaian();

        // let employeeId = "<?= $kpa->employe_id ?>";

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