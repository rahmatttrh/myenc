@extends('layouts.app')
@section('title')
Create PE
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="/qpe">PE</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
    <div class="row" id="boxCreate">
        <div class="col-md-3">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <small class="">Give Performance Evaluation</small>
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
                            <label>Period</label>
                            <select class="form-control" name="priode" id="priode" readonly>
                                <option value="semester" selected>Semester</option>
                            </select>
                        </div>
                        <div class="form-group form-group-default">
                            <label>Semester</label>
                            <div class="row">
                                <div class="col">
                                    <select class="form-control form-select date" id="semester" name="semester">
                                        <option value="1">I</option>
                                        <option value="2">II</option>
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
                <div class="card-footer">
                    <!-- <a href="{{route('export.kpi')}}" target="_blank">Preview</a> -->
                </div>
            </div>
            <div class="card shadow-none border">
               <div class="card-header d-flex bg-primary">
                   <div class="d-flex  align-items-center">
                       <small class=" text-white">Discipline</small>
                   </div>

               </div>
               <div class="card-body">
                   <form>
                       @csrf
                       <div class="form-group form-group-default">
                           <label>Alpa</label>
                           <label for="" class="float-right">0</label>
                       </div>
                       <div class="form-group form-group-default">
                           <label>Ijin</label>
                           <label for="" class="float-right">0</label>
                       </div>
                       <div class="form-group form-group-default">
                           <label>Terlambat</label>
                           <label for="" class="float-right">0</label>
                       </div>
                       <div class="form-group form-group-default bg-success">
                           <label>Value</label>
                           <label for="" class="float-right">4</label>
                       </div>
                       <div class="form-group form-group-default bg-warning">
                           <label>Bobot</label>
                           <label for="" class="float-right">15</label>
                       </div>
                       <div class="form-group form-group-default bg-success">
                           <label> <b>Achievement</b></label>
                           <label for="" class="float-right">
                               <h3>15</h3>
                           </label>
                       </div>
                   </form>
               </div>
           </div>
        </div>
        <div class="col-md-9" id="boxKpi">

            <div class="card shadow-none border">
                <div class="card-header bg-primary">
                    {{-- <div class="card-title text-white"</div> --}}
                     <small class="text-white">Objective KPI</small>
                </div>
                @php
                use Carbon\Carbon;
                $today = Carbon::now()->format('Y-m-d'); // format tanggal YYYY-MM-DD
                @endphp

                <form action="{{route('qpe.store')}}" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">
                    @csrf
                    <input type="hidden" id="kpi_id" name="kpi_id">
                    <input type="hidden" id="employee_id" name="employe_id">
                    <input type="hidden" id="semester_id" name="semester">
                    <input type="hidden" id="tahun_id" name="tahun">
                    <input type="hidden" name="date" value="{{$today}}">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table id="tableCreate" class="displays table-sm  ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Objective</th>
                                        <th>Weight</th>
                                        <th>Target</th>
                                        <th style="width: 80px" >Value</th>
                                        <th style="width: 80px">Achievement</th>
                                        <th>Attachment (PDF)</th> <!-- Kolom Attachment -->
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot class="bg-primary">
                                    <tr>
                                        <th colspan="5" class="text-right">Achievement</th>
                                        <th id="totalAchievement"></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="col-md-3 float-right mb-3">
                            <button type="submit" class="btn btn-block btn-sm btn-primary ">Save</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card shadow-none border">
               <div class="card-header bg-primary">
                   <small class="text-white">Behavior</small>
               </div>
               <form action="" name="formBehavior" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">
                   @csrf
                   <input type="hidden" name="employe_id">
                   <input type="hidden" name="date">
                   <div class="card-body p-0">
                       <div class="table-responsive">
                           <table class="displays table-sm  ">
                               <thead>
                                   <tr>
                                       <th>No</th>
                                       <th>Objective</th>
                                       <th>Description</th>
                                       <th>Bobot</th>
                                       <th>Value</th>
                                       <th>Achievement</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach($behaviors as $behavior)
                                   <tr>
                                       <td>{{++$i}}</td>
                                       <td>{{$behavior->objective}}</td>
                                       <td>{{$behavior->description}}</td>
                                       <td class="text-center">{{$behavior->bobot}}</td>
                                       <td>
                                           <input type="text" style="width: 80px" name="valBehavior#{{$behavior->id}}" value="0" min="0.01" max="4" step="0.01">
                                           <br><span><small>*Max 4 point</small></span>
                                       </td>
                                       <td>
                                           <input type="text" style="width: 50px" name="acvBehavior#{{$behavior->id}}" readonly>
                                           <br><span>-</span>
                                       </td>
                                   </tr>
                                   @endforeach
                               </tbody>
                               <tfoot>
                                   <tr>
                                       <th colspan="5" class="text-right">Achievement</th>
                                       <th><span id="totalAcvBehavior" name="totalAcvBehavior"></span></th>
                                   </tr>
                               </tfoot>
                           </table>
                       </div>
                   </div>
                   <div class="card-footer">
                       <div class="col-md-3 float-right mb-3">
                           <button type="submit" class="btn btn-block btn-sm btn-primary ">Save</button>
                       </div>
                   </div>
               </form>
           </div>
        </div>
    </div>
    {{-- <div class="row" id="boxDetail">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-9">
            
        </div>
    </div> --}}
</div>

@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        // Function to get the value of a URL parameter
        function getURLParameter(name) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
        }

        // Get the value of the 'empId' parameter from the URL
        const empIdT = getURLParameter('empId');

        let empId = base64DecodeUnicode(empIdT);

        if (empId == '' || empId == null) {
            $('#boxDetail').hide();
            $('#boxKpi').hide();
        } else {
            $('#employe_id').val(empId);
        }

        $('#tahun_id').val($('#tahun').val());
        $('#semester_id').val($('#semester').val());

        // Baru
        // Function to validate the input value
        function validateInput(input) {
            var value = parseFloat($(input).val());
            var regex = /^\d+(\.\d{1,2})?$/;


            if (isNaN(value) || value < 0.01 || value > 4) {
                alert("Value must be between 0.01 and 4.");
                $(input).val("0");
            } else if (!regex.test(value.toFixed(2))) {
                alert("Value cannot have more than two decimal places.");
                value = value.toFixed(2);
            } else {
                value = value.toFixed(2);
            }

            $(input).val(value);

            return value;
        }

        // Function to update the total of acvBehavior values
        function updateTotalAcvBehavior() {
            var total = 0;
            $('input[name^="acvBehavior"]').each(function() {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('#totalAcvBehavior').text(total.toFixed(2));
        }

        // Event listener for input change
        $('input[name^="valBehavior"]').on('change', function() {
            var value = validateInput(this);
            var inputName = $(this).attr('name');
            var id = inputName.split('#')[1];

            var acv = ((value / 4) * 5).toFixed(2);

            $('input[name="acvBehavior#' + id + '"]').val(acv);


            // Update totalAcvBehavior whenever valBehavior changes
            updateTotalAcvBehavior();
        });

        // Optional: Add validation on form submit
        $('form[name="formBehavior"]').on('submit', function(event) {
            var isValid = true;
            $('input[name^="valBehavior"]').each(function() {
                var value = parseFloat($(this).val());
                if (isNaN(value) || value < 0.01 || value > 4) {
                    alert("Value must be between 0.01 and 4.");
                    $(this).val("0");
                    isValid = false;
                }
            });
            if (!isValid) {
                event.preventDefault();
            }
        });

        // end Baru


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

        $('#semester').change(function() {

            $('#semester_id').val($(this).val());
        });

        $('#tahun').change(function() {

            $('#tahun_id').val($(this).val());
        });

        $('#employe_id').change(function() {
            let employeeId = $(this).val();

            let empId = employeeId;

            if (empId != '' || empId != null) {
                $('#boxDetail').show();
                $('#boxKpi').show();
            }

            let param = base64EncodeUnicode(employeeId);

            // Tambahakn di url
            addURLParameter('empId', param);

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
                            "value": 1,
                            "min": 1,
                            "max": 4,
                            "step": "0.01" // Step untuk 2 digit desimal
                        }).on('keyup', function() {
                            var inputValue = $(this).val();

                            // Menghapus angka nol di depan input jika ada
                            inputValue = inputValue.replace(/^0+/, '');

                            if (inputValue > 4) {
                                inputValue = 4;
                            } else if (inputValue < 1 && inputValue != '') {
                                inputValue = 1;
                            }

                            $(this).val(inputValue);

                            calculateAchievement(rowData.id, rowData.target);
                            calculateTotalAchievement();
                        });

                        row.append($("<td>").append(input));
                        var achievementInput = $("<input>").attr({
                            "type": "text",
                            "class": "form-control text-bold",
                            "name": "achievement_" + rowData.id,
                            "value": Math.round(1 / 4 * rowData.weight),
                            "placeholder": "0",
                            "readonly": true
                        }).css("font-weight", "bold"); // Menambahkan style font-weight: bold

                        row.append($("<td>").append(achievementInput));

                        var attachmentInput = $("<input>").attr({
                            "type": "file",
                            "class": "form-control",
                            "name": `attachment[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            // "required": true, // Tambahkan atribut readonly
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

        function addURLParameter(param, value) {
            let url = new URL(window.location.href);
            url.searchParams.set(param, value);
            window.history.replaceState({}, '', url);
        }

        // Function to Base64 encode a Unicode string
        function base64EncodeUnicode(str) {
            // First we convert the string to a UTF-8 array of characters
            const utf8Bytes = new TextEncoder().encode(str);
            // Then we convert the array of bytes to a string of raw bytes
            const rawString = String.fromCharCode.apply(null, utf8Bytes);
            // Finally, we use btoa to encode the string of raw bytes to Base64
            return btoa(rawString);
        }

        // Function to Base64 decode a Unicode string
        function base64DecodeUnicode(str) {
            // First we use atob to decode the Base64 string to a string of raw bytes
            const binaryString = atob(str);
            // Then we create a Uint8Array from the string of raw bytes
            const bytes = new Uint8Array(binaryString.length);
            for (let i = 0; i < binaryString.length; i++) {
                bytes[i] = binaryString.charCodeAt(i);
            }
            // Finally, we use TextDecoder to convert the bytes back to a Unicode string
            return new TextDecoder().decode(bytes);
        }


    })
</script>
@endpush