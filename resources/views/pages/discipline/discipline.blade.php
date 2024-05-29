@extends('layouts.app')
@section('title')
Discipline
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Discipline</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-none border">
                <div class="card-header">
                    <x-tab-discipline :activeTab="request()->route()->getName()" />
                </div>
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">List All Discipline assessment</div>
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
                                    <th>Bulan</th>
                                    <th>Employe</th>
                                    <th>Alpa</th>
                                    <th>Ijin</th>
                                    <th>Terlambat</th>
                                    <th>Achievement</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{dateToMonth($data->date)}}</td>
                                    <td>{{$data->employe->biodata->fullName()}}</td>
                                    <td>{{$data->alpa}}</td>
                                    <td>{{$data->ijin}}</td>
                                    <td>{{$data->terlambat}}</td>
                                    <td>
                                        <?php
                                        if ($data->achievement > 2) {
                                            # code...
                                            echo "<span class='badge badge-success'>";
                                        } else {
                                            # code...
                                            echo "<span class='badge badge-danger'>";
                                        }

                                        ?>

                                        {{$data->achievement}}</span>
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                                {{--
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{++$i}}</td>
                                <td><a href="{{route('kpa.edit', enkripRambo($kpa->id))}}"> {{$kpa->employe->biodata->fullName()}} </a></td>
                                <td>{{date('F Y', strtotime($kpa->date))  }}</td>
                                <td><span class="badge badge-primary badge-lg"><b>{{$kpa->achievement}}</b></span></td>
                                @if($kpa->status == 0)
                                <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                                @elseif($kpa->status == '1')
                                <td><span class="badge badge-warning badge-lg"><b>Validasi HRD</b></span></td>
                                @elseif($kpa->status == '2')
                                <td><span class="badge badge-success badge-lg"><b>Done</b></span></td>
                                @elseif($kpa->status == '101')
                                <td><span class="badge badge-danger badge-lg"><b>Di Reject</b></span></td>
                                @endif
                                <td class="text-right">
                                    @if($kpa->status == 0)
                                    <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$kpa->id}}"><i class="fas fa-rocket"></i> Submit</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{$kpa->id}}"><i class="fas fa-trash"></i> Delete</button>
                                    @else ($kpa->status == '1' || $kpa->status == '2')
                                    -
                                    @endif
                                </td>
                                </tr>
                                <x-modal.submit :id="$kpa->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($kpa->date))   " url="{{route('kpa.submit', enkripRambo($kpa->id))}}" />
                                <x-modal.delete :id="$kpa->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($kpa->date))   " url="{{route('kpa.delete', enkripRambo($kpa->id))}}" />
                                @endforeach

                                --}}
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