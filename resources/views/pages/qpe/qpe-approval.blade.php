@extends('layouts.app')
@section('title')
PE
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('qpe')}}">PE</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    @if($pba == null)
    <div class="alert alert-warning" role="alert">
        Silahkan isi nilai behavior !
    </div>
    @endif
    <div class="row ">
      <div class="col">
        @if (auth()->user()->hasRole('Karyawan'))
            <!-- Awal Action Karyawan -->

            <!-- Hanya karyawan tersebut yang bisa komplen -->
            @if(auth()->user()->employee->id == $pe->employe_id && ($kpa->pe->status == '1'|| $kpa->pe->status == '101' || $kpa->pe->status == '202') && $pe->complained == '0' )
            <div class="btn-group ml-auto">
                  <button data-target="#modalKomplain" data-toggle="modal" class="btn btn-md btn-warning "><i class="fa fa-comments"></i> Ajukan Komplain</button>
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
    </div>

    <div class="row" id="boxCreate">
        <div class="col-md-3">
            <x-qpe.performance-appraisal :kpa="$kpa" />
            <x-discipline :pd="$pd" />
        </div>
        <div class="col-md-9">
            @if (auth()->user()->hasRole('Manager') && ($kpa->pe->status == '1' || $kpa->pe->status == '202') )
            <div class="text-right mb-2">
               <div class="btn-group mr-auto">
                  @if($kpa->pe->status == '1')
                  <button data-target="#modalDiscuss" data-toggle="modal" class="btn btn-sm btn-dark "><i class="fa fa-users"></i> Need Discuss</button>

                  <!-- Modal Discuss  -->
                  <div class="modal fade" id="modalDiscuss" data-bs-backdrop="static">
                     <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                              <!-- Bagian header modal -->
                              <div class="modal-header">
                                 <h3 class="modal-title"> </h3>
                                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <form method="POST" action="{{route('qpe.discuss.patch', $pe->id) }}" enctype="multipart/form-data">
                                 @csrf
                                 @method('patch')
                                 <input type="hidden" name="id" value="{{$pe->id}}">
                                 <input type="hidden" name="nd_dibuat" value="{{ $user ? $user->biodata->fullName() : ''}}">
                                 <input type="hidden" name="nd_from" value="Manager">

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
                                                            <div class="col-md-6">
                                                                  <label for="" class="label-control">Tetapkan Tanggal Diskusi <span class="text-danger">*</span></label>
                                                                  <input required name="nd_date" type="date" class="form-control" min="<?php echo date('Y-m-d'); ?>">
                                                                  <br>
                                                                  <label for="" class="label-control">Di Tunjukan untuk <span class="text-danger">*</span></label>
                                                                  <select name="nd_for" id="" class="form-control">
                                                                     <option value="3">Karyawan dan Leader</option>
                                                                     <option value="2">Karyawan</option>
                                                                     <option value="1">Leader</option>
                                                                  </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                  <label for="" class="label-control">Alasan <span class="text-danger">*</span></label>
                                                                  <textarea name="nd_alasan" class="form-control" id="" rows="5" placeholder="isi alasan untuk berdiskusi disini" required></textarea>
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

                  <!-- End Modal Discuss  -->

                  @endif

                  @if($pba != null)
                  <button onclick="doneVerifikasi({{$kpa->id}})" class=" btn btn-sm btn-primary  "><i class="fa fa-check"></i> Approve</button>
                  <form id="done-validasi" action="{{route('qpe.approved', $pe->id)}}" method="POST"> @csrf @method('patch')</form>
                  @endif
                  <button data-target="#modalReject" data-toggle="modal" class="btn btn-sm btn-danger "><i class="fa fa-reply"></i> Reject</button>

               </div>
            </div>
               
            @endif
            <x-qpe.kpi-table :kpa="$kpa" :datas="$datas" :valueAvg="$valueAvg" :addtional="$addtional" :i="$i" />
            <div class="card shadow-none border">
               <div class="card-header bg-primary">
                   <small class=" text-white">Behavior</small>
               </div>
               @if($pba == null)

               <form action="{{route('qpe.behavior.store')}}" name="formBehavior" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">

                   @endif

                   @csrf
                   <input type="hidden" name="employe_id" value="{{$kpa->employe_id}}">
                   <input type="hidden" name="kpa_id" value="{{$kpa->id}}">
                   <input type="hidden" name="pe_id" value="{{$kpa->pe_id}}">
                   <div class="card-body p-0">
                       <div class="table-responsive">
                           <table class="displays table-sm ">
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
                                   @if($pba == null)
                                   @foreach($behaviors as $key => $behavior)
                                   <tr>
                                       <td>{{ ++$key }}</td>
                                       <td>{{ $behavior->objective }}</td>
                                       <td>{{ $behavior->description }}</td>
                                       <td>{{ $behavior->bobot }}</td>
                                       <td>
                                           <input type="text" style="width: 80px" name="valBehavior[{{ $behavior->id }}]" value="0" min="0.01" max="4" step="0.01">
                                           <br><span><small>*Max 4 point</small></span>
                                       </td>
                                       <td>
                                           <input type="text" style="width: 50px" name="acvBehavior[{{ $behavior->id }}]" readonly>
                                           <br><span>-</span>
                                       </td>
                                   </tr>
                                   @endforeach
                                   @else

                                   @foreach($pbads as $key => $pbda)
                                   <tr>
                                       <td>{{ ++$key }}</td>
                                       <td>
                                           <a href="#" data-target="#modalBehavior-{{$pbda->id}}" data-toggle="modal">{{ $pbda->behavior->objective }}</a>
                                       </td>
                                       <td>{{ $pbda->behavior->description }}</td>
                                       <td>{{ $pbda->behavior->bobot }}</td>
                                       <td>{{ $pbda->value }}</td>
                                       <td>{{ $pbda->achievement }}</td>
                                   </tr>

                                   <div class="modal fade" id="modalBehavior-{{$pbda->id}}" data-bs-backdrop="static">
                                       <div class="modal-dialog" style="max-width: 50%;">
                                           <div class="modal-content">
                                               <form method="POST" action="{{route('qpe.behavior.update',$pbda->id) }}" enctype="multipart/form-data">
                                                   @csrf
                                                   @method('patch')

                                                   <input type="hidden" name="id" value="{{$pbda->id}}">
                                                   <input type="hidden" name="kpa_id" value="{{$kpa->id}}">
                                                   <input type="hidden" name="pba_id" value="{{$pbda->pba_id}}">
                                                   <!-- Bagian header modal -->
                                                   <div class="modal-header bg-primary">
                                                       <h3 class="modal-title text-white">{{$pbda->behavior->objective}} </h3>
                                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                   </div>
                                                   <!-- Bagian konten modal -->
                                                   <div class="modal-body">
                                                       <div class="card-body">

                                                           <div class="form-group">
                                                               <label for="objective">Objective :</label>
                                                               <input type="text" class="form-control" id="objective" name="objective" value="{{ $pbda->behavior->objective }}" readonly>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="objective">Description :</label>
                                                               <textarea type="text" rows="5" class="form-control" id="objective" name="objective" readonly>{{ $pbda->behavior->description }}</textarea>
                                                           </div>
                                                           <div class="form-group">
                                                               <label for="weight">Weight :</label>
                                                               <input type="text" class="form-control" id="weight" name="weight" value="{{ $pbda->behavior->bobot }}" readonly>
                                                           </div>approv
                                                           @if($pba->status == '0' || $pba->status == '1')
                                                           <div class="form-group">
                                                               <label for="value">Value :</label>
                                                               <input type="text" class="form-control value" id="value" name="valBv" data-key="{{ $pbda->id }}" data-target="{{ $pbda->behavior->target }}" data-weight="{{ $pbda->behavior->weight }}" value="{{ old('value', $pbda->value) }}" autocomplete="off">
                                                           </div>
                                                           @endif
                                                           <div class="form-group">
                                                               <label for="achievement">Achievement :</label>
                                                               <input type="text" class="form-control" id="achievementBv-{{$pbda->id}}" name="achievement" value="{{ $pbda->achievement }}" readonly>
                                                           </div>

                                                       </div>

                                                   </div>

                                                   <!-- Bagian footer modal -->
                                                   <div class="modal-footer">
                                                       @if($pba->status == '0' || $pba->status == '1')
                                                       <button type="submit" class="btn btn-warning">Update</button>
                                                       <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                       @endif
                                                   </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>

                                   @endforeach


                                   @endif
                               </tbody>
                               <tfoot>
                                   <tr>
                                       <th colspan="5" class="text-right">Achievement</th>
                                       @if(isset($pba))
                                       <th><span id="totalAcvBehavior" name="totalAcvBehavior">{{$pba->achievement}}</span></th>
                                       @else
                                       <th><span id="totalAcvBehavior" name="totalAcvBehavior">-</span></th>
                                       @endif
                                   </tr>
                               </tfoot>
                           </table>
                       </div>
                   </div>
                   <div class="card-footer">
                       <div class="col-md-3 float-right mb-3">
                           @if($pba == null)
                           <button type="submit" class="btn btn-block btn-primary ">Save</button>
                           @endif
                       </div>
                   </div>
                   @if($pba == null)
               </form>
               @endif
           </div>
        </div>
    </div>



    <div class="row" id="boxDetail">
        <div class="col-md-3">
            <!-- Disipline -->
            



            <!--  -->
        </div>
        <div class="col-md-9">
            
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
                                    <textarea name="komentar" id="komentar" {{ ($pe->status != '1' && $pe->status != '0') ? 'readonly' : '' }} class="form-control komentar" rows="4" required placeholder="Tuliskan komentar anda disini disini!">{{$pe->komentar ?? ''}}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="form-control">Development & Training : </label>
                                    <textarea name="pengembangan" id="pengembangan" {{ ($pe->status != '1' && $pe->status != '0') ? 'readonly' : '' }} class="form-control pengembangan" rows="4" placeholder="Tuliskan alasan penolakan disini!">{{$pe->pengembangan ?? ''}}</textarea>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="form-group ">
                                        <b>File Bukti Persetujuan Karyawan <span class="text-danger">*</span> </b><br />
                                    </div>

                                    @if($pe->evidence)
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        @if($pe->status == '1' || $pe->status == '0')
                        <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i> Simpan</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>

    @php

    if($pd){

    $pdAchievement = $pd->contribute_to_pe;

    } else {

    $pdAchievement = 0;

    }

    if($pba) {
    $pbaAchievement = $pba->achievement;
    }else {
    $pbaAchievement = 0;
    }




    @endphp
    <!-- rangkuman nilai -->
    <div class="row">
        <div class="col-md-12">
            <x-summary-appraisal :pd-achievement="$pdAchievement" :datas="$datas" :kpa="$kpa" :behaviors="$behaviors" :pba="$pba" :pe="$pe" />

        </div>
    </div>


</div>

<!-- Modal Reject  -->
<div class="modal fade" id="modalReject" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Bagian header modal -->
            <div class="modal-header">
                <h3 class="modal-title"> </h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{route('kpa.verifikasi.reject',$kpa->id) }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="kpa_id" value="{{$kpa->id}}">

                <!-- Bagian konten modal -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-none border">
                                <div class="card-header d-flex">
                                    <div class="d-flex  align-items-center">
                                        <div class="card-title">Konfirmasi Reject</div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <label for="" class="label-control">Alasan Penolakan</label>
                                    <textarea name="alasan_reject" class="form-control" id="" cols="30" rows="10" placeholder="Isikan alasan penolakan disini"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- End Modal Reject  -->
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