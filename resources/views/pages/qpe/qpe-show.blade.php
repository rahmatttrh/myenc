@extends('layouts.app')
@section('title')
PE
@endsection
@section('content')

<div class="page-inner">
    <!-- Breadcrumb navigation -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('qpe') }}">PE</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row mr-6">
        @if (auth()->user()->hasRole('Karyawan'))
        <!-- Awal Action Karyawan -->

        <!-- Hanya karyawan tersebut yang bisa komplen -->

        @if(auth()->user()->employee->id == $pe->employe_id && ($kpa->pe->status == '1'|| $kpa->pe->status == '2' || $kpa->pe->status == '101' || $kpa->pe->status == '202') && $pe->complained == '0' )

        <div class="btn-group ml-auto">
            <button data-target="#modalKomplain" data-toggle="modal" class="btn btn-md btn-warning "><i class="fa fa-comments"></i> Komentar Karyawan</button>
        </div>

        <!-- Modal Komplain  -->
        <div class="modal fade" id="modalKomplain" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Bagian header modal -->
                    <div class="modal-header">
                        <h3 class="modal-title"> </h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST" action="{{route('qpe.complain.patch', $pe->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{$pe->id}}">

                        <!-- Bagian konten modal -->
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow-none border">
                                        <div class="card-header d-flex">
                                            <div class="d-flex  align-items-center">
                                                <div class="card-title">Konfirmasi </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="" class="label-control">Alasan Pengajuan Komplain <span class="text-danger">*</span></label>
                                                        <textarea name="complain_alasan" class="form-control" id="" rows="5" placeholder="isi alasan komplain" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian footer modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- End Modal Komplain  -->
        @endif

        <!-- Tombol Komplain karyawan  -->
        @if(auth()->user()->employee->id == $pe->employe_id && $pe->complained == '1' )
        <div class="btn-group ml-auto">
            <button data-target="#closeKomplain" data-toggle="modal" class="btn btn-xs btn-success "><i class="fa fa-flag"></i> Close Komplain</button>
        </div>

        <div class="modal fade" id="closeKomplain" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Bagian header modal -->
                    <div class="modal-header">
                        <h3 class="modal-title"> </h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="POST" action="{{route('qpe.closecomplain.patch', $pe->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{$pe->id}}">

                        <!-- Bagian konten modal -->
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow-none border">
                                        <div class="card-header d-flex">
                                            <div class="d-flex  align-items-center">
                                                <div class="card-title">Konfirmasi </div>
                                            </div>

                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h3>Apakah Anda yakin ingin menutup komplain tersebut?</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian footer modal -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Ya, Saya Yakin</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @endif

        <!-- Akhir Action Karyawan  -->
        @endif
    </div>

    <!-- Section for creating and detailing performance appraisal -->
    <div class="row" id="boxCreate">
        <div class="col-md-3">
            <!-- Performance appraisal component -->
            <!-- 
                File view ada di : 
                resources/views/components/qpe/file.blade.php
                File Controller nya ada di : 
                app/View/Components/File.php
            -->
            <x-qpe.performance-appraisal :kpa="$kpa" />
        </div>
        <div class="col-md-9">
            <!-- KPI table component -->
            <x-qpe.kpi-table :kpa="$kpa" :valueAvg="$valueAvg" :datas="$datas" :addtional="$addtional" :i="$i" />
        </div>
    </div>

    <div class="row" id="boxDetail">
        <div class="col-md-3">
            <!-- Discipline component -->
            <x-discipline :pd="$pd" />
        </div>
        <div class="col-md-9">
            <!-- Behavior form component -->
            <x-behavior-form :kpa="$kpa" :pba="$pba" :behaviors="$behaviors" :pbads="$pbads" />
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form method="POST" action="{{route('qpe.komentar.patch', $pe->id)}}">
                    @csrf
                    @method('patch')
                    <div class="card-header bg-primary text-white">
                        Komentar Evaluator
                    </div>
                    <div class=" card-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="form-control">Komentar <span class="text-danger">*</span> : </label>
                                    <textarea name="komentar" id="komentar" readonly class="form-control komentar" rows="4" required placeholder="Tuliskan komentar anda disini disini!">{{$pe->komentar ?? ''}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="form-control">Development & Training : </label>
                                    <textarea name="pengembangan" id="pengembangan" readonly class="form-control pengembangan" rows="4" placeholder="Tuliskan alasan penolakan disini!">{{$pe->pengembangan ?? ''}}</textarea>
                                </div>
                                @if($pe->evidence)
                                <div class="col-md-6 mt-3">
                                    <div class="form-group ">
                                        <b>File Bukti Persetujuan Karyawan <span class="text-danger">*</span> </b><br />
                                    </div>

                                    <!-- Button -->
                                    <a href="#" data-target="#modalEvidence" data-toggle="modal"><span class="fa fa-file"></span> Lihat File</a>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalEvidence" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <!-- Bagian header modal -->
                                                <div class="modal-header">
                                                    <h3 class="modal-title"> </h3>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Bagian konten modal -->
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card shadow-none border">
                                                                <div class="card-header d-flex">
                                                                    <div class="d-flex  align-items-center">
                                                                        <div class="card-title">File Evidence</div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        @if ($pe->evidence)
                                                                        <iframe src="{{ Storage::url($pe->evidence) }}" id="pdfPreview-{{$pe->id}}" width=" 100%" height="575px"></iframe>
                                                                        @else
                                                                        <p>No attachment available.</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Bagian footer modal -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Tutup</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal -->
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php
    // Calculate achievements for discipline and behavior
    $pdAchievement = $pd ? $pd->contribute_to_pe : 0;
    $pbaAchievement = $pba ? $pba->achievement : 0;
    @endphp

    <!-- Summary appraisal section -->
    <div class="row">
        <div class="col-md-12">
            <!-- Summary appraisal component -->
            <x-summary-appraisal :pd-achievement="$pdAchievement" :datas="$datas" :kpa="$kpa" :behaviors="$behaviors" :pba="$pba" :pe="$pe" />
        </div>
    </div>
</div>


@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        $('.boxPerbaikan').hide();

        // $('#invalidBtn').click(function() {
        //     console.log('test');
        // });
        $('.confirmBtn').hide();
        $('.cancelBtn').hide();

        $('.invalidBtn').click(function() {
            // Tindakan yang akan dijalankan saat tombol diklik
            $('.boxPerbaikan').show();
            $('.validBtn').hide();
            $('.invalidBtn').hide();

            $('.confirmBtn').show();
            $('.cancelBtn').show();
            // Menambahkan atribut 'required' ke elemen input

            $('.alasan_penolakan').prop('required', true);

            $('.act').val('invalid');
        });

        $('.cancelBtn').click(function() {
            // Tindakan yang akan dijalankan saat tombol diklik
            $('.boxPerbaikan').hide();
            $('.validBtn').show();
            $('.invalidBtn').show();

            $('.confirmBtn').hide();
            $('.cancelBtn').hide();

            // Menghapus atribut 'required' dari elemen input
            $('.alasan_penolakan').removeAttr('required');

            $('.act').val('valid');
        });

        // Update Behavior Value
        // Event listener for input change
        $('input[name^="valBv"]').on('change', function() {
            var value = validateInputNew(this);
            // var inputName = $(this).attr('name');
            // var id = inputName.match(/\[([0-9]+)\]/)[1]; // Extract ID from name

            var acv = Math.round(((value / 4) * 5));

            var key = parseFloat($(this).data('key'));

            $('#achievementBv-' + key).val(acv);


            // $('input[name="acvBehavior[' + id + ']"]').val(acv);

        });

        // Baru Behavior
        // Function to validate the input value
        function validateInputNew(input) {
            var value = parseFloat($(input).val());
            var regex = /^\d+(\.\d{1,2})?$/;

            if (isNaN(value) || value < 0.01 || value > 4) {
                if (value > 4) {
                    value = 4;
                } else {
                    value = 1;
                }
                alert("Value must be between 0.01 and 4.");
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
            var value = validateInputNew(this);
            var inputName = $(this).attr('name');
            var id = inputName.match(/\[([0-9]+)\]/)[1]; // Extract ID from name

            var acv = Math.round(((value / 4) * 5));

            $('input[name="acvBehavior[' + id + ']"]').val(acv);

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


        $('.attachment').on('change', function() {
            var input = $(this)[0];

            var key = $(this).data('key');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    showPdf(e.target.result, key);

                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        function showPdf(data, id) {
            $('#pdfPreview-' + id).attr('src', ''); // Mengosongkan atribut src
            $('#pdfPreview-' + id).attr('src', data); // Menetapkan atribut src dengan tampilan pratinjau baru
            $('#pdfPreview-' + id).show();
        }

        $('.value').on('input', function() {
            var inputValue = $(this).val();

            // Hapus angka 0 di depan jika ada
            inputValue = inputValue.replace(/^0+(?=\d)/, '');

            $(this).val(inputValue);

            var key = parseFloat($(this).data('key'));
            var targetValue = parseFloat($(this).data('target'));
            var weightValue = parseFloat($(this).data('weight'));



            validateInput($(this), targetValue);

            let achievementValue = Math.round(($(this).val() / targetValue) * weightValue);

            $('#achievement-' + key).val(achievementValue);

        });

        function calculateAchievement() {
            var value = parseFloat($('#value-addtional').val());
            var targetValue = parseFloat($('#target-addtional').val());
            var weightValue = parseFloat($('#weight-addtional').val());

            if (isNaN(value) || value <= 0.1) {
                value = 0;
                $('#value-addtional').val(value);
            }

            validateInput($('#value-addtional'), targetValue);

            let achievementValue = Math.round((value / targetValue) * weightValue);

            // Batasi nilai achievementValue menjadi rentang 1 hingga 20
            achievementValue = Math.min(Math.max(achievementValue, 1), 20);

            $('#achievement-addtional').val(achievementValue);
        }

        $('#value-addtional').on('input', function() {
            var inputValue = $(this).val().replace(/^0+(?=\d)/, '');
            $(this).val(inputValue);
            calculateAchievement();
        });

        $('#weight-addtional').on('input', function() {
            var weightValue = parseFloat($(this).val());

            // Jika weightValue kosong, set nilai menjadi 1
            if (isNaN(weightValue) || weightValue <= 0) {
                weightValue = 1;
                $('#weight-addtional').val(weightValue);
            }

            // Batasi nilai weightValue menjadi maksimal 20
            weightValue = Math.min(weightValue, 20);

            $('#weight-addtional').val(weightValue);

            calculateAchievement();
        });


        // Edit
        function calculateAchievementEdit() {
            var value = parseFloat($('#value-edit').val());
            var targetValue = parseFloat($('#target-edit').val());
            var weightValue = parseFloat($('#weight-edit').val());

            if (isNaN(value) || value <= 0.1) {
                value = 0;
                $('#value-edit').val(value);
            }

            validateInput($('#value-edit'), targetValue);

            let achievementValue = Math.round((value / targetValue) * weightValue);

            // Batasi nilai achievementValue menjadi rentang 1 hingga 20
            achievementValue = Math.min(Math.max(achievementValue, 1), 20);

            $('#achievement-edit').val(achievementValue);
        }

        $('#value-edit').on('input', function() {
            var inputValue = $(this).val().replace(/^0+(?=\d)/, '');
            $(this).val(inputValue);
            calculateAchievementEdit();
        });

        $('#weight-edit').on('input', function() {
            var weightValue = parseFloat($(this).val());

            // Jika weightValue kosong, set nilai menjadi 1
            if (isNaN(weightValue) || weightValue <= 0) {
                weightValue = 1;
                $('#weight-edit').val(weightValue);
            }

            // Batasi nilai weightValue menjadi maksimal 20
            weightValue = Math.min(weightValue, 20);

            $('#weight-edit').val(weightValue);

            calculateAchievementEdit();
        });

        $('.calculateAdd').on('input', function() {

            let weightAdd = $("#weight-addtional").val();
            let valueAdd = $("#value-addtional").val();

            console.log('test');

            let totalAdd = Math.round((valueAdd / 4) * weightAdd); // 4 DI AMBIL Dari nilai default target

            $('#achievement-addtional').val(totalAdd);
        });




        function validateInput(input, targetValue) {
            var inputValue = parseFloat(input.val());

            if (isNaN(inputValue) || inputValue < 0.1) {
                input.removeClass('is-valid');
                input.addClass('is-invalid');
            } else if (inputValue > targetValue) {
                input.val(targetValue);
                input.removeClass('is-invalid');
                input.addClass('is-valid');
            } else {
                input.removeClass('is-invalid');
                input.addClass('is-valid');
            }
        }

    })

    function hitungYuk() {
        return $('#value-addtional').val();
    }

    function doneValidasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Done",
                text: pesan + ",Yakin ingin menyelesaikan validasi ini ?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#done-validasi').submit();
                }
            });
    }

    function doneVerifikasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Konfirmasi",
                text: " Anda yakin ingin menyelesaikan verifikasi ini ?",
                icon: "info",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#done-validasi').submit();
                }
            });
    }


    function rejectValidasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Reject",
                text: pesan + ",Anda Yakin ingin mereject data ini ?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#reject-validasi').submit();
                }
            });
    }

    function resendingValidasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Konfirmasi",
                text: "Anda Yakin ingin mengirimkan kembali data ini?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#resending-validasi').submit();
                }
            });
    }
</script>
@endpush