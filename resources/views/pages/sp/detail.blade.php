@extends('layouts.app')
@section('title')
SPKL Detail
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   @media print {

      header,
      footer,
      nav,
      aside,
      .sidebar,
      .main-header,
      .hide {
         display: none;
      }

      .main-panel {
         width: 100%;
      }

      @page {
         size: auto;
         /* auto is the initial value */
         margin: 0mm;
         /* this affects the margin in the printer settings */
      }

   }
</style>

<div class="page-inner">
   @if($sp->status == '101')
   <div class="row justify-content-center ">
      <div class="col-md-6">
         <div class="card">
            <div class="card-header bg-warning">
               <span class="">
                  Informasi !
               </span>
            </div>
            <div class="card-body">
               SP Di Tolak Manager ! <br>
               Alasan Penolakan : {{$sp->alasan_reject}}
            </div>
         </div>
      </div>
   </div>
   @endif
   <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-11">
         <div class="row hide align-items-center">
            <div class="col">

               <x-status.sp :sp="$sp" />
               {{-- @if ($sp->status == 0)
               Draft
               @elseif($sp->status == 1)
               Approval HRD
               @elseif($sp->status == 2)
               Employee Verification
               @elseif($sp->status == 3)
               Approval Manager
               @elseif($sp->status == 4)
               Active
               @elseif($sp->status == 5)
               Deactivated
               @endif --}}


               <h5 class="page-title">{{$sp->code}}</h5>

            </div>
            <div class="col-auto">

               @if($sp->status == '0')
                  <!-- Start -->
                  <button class="btn btn-md btn-dark" data-toggle="modal" data-target="#modal-submit-{{$sp->id}}"><i class="fas fa-rocket"></i> Submit </button>
                  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-edit-{{$sp->id}}"><i class="fas fa-edit"></i> Edit </button>
            
                  <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-sp-delete">
                     <i class="fa fa-trash"></i> Delete
                  </a>
               @endif

               @if($sp->status == '1' && auth()->user()->hasRole('HRD|HRD-Spv'))
                  {{-- <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-app-hrd-{{$sp->id}}"><i class="fas fa-check"></i> Approve </button> --}}
                  <button data-target="#modalReject" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button>
               @endif

               @if($sp->status == '2' && auth()->user()->hasRole('Manager'))
                  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-app-manager-{{$sp->id}}"><i class="fas fa-check"></i> Approve </button>
                  <button data-target="#modalReject" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button>
               @endif
               @if($sp->status == '3' && auth()->user()->hasRole('Karyawan'))
                  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-app-employee-{{$sp->id}}"><i class="fas fa-check"></i> Confirm </button>
                  {{-- <button data-target="#modalReject" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button> --}}
               @endif

               
               
               
               
               
               @if($sp->status == '1' && auth()->user()->hasRole('Karyawan'))
                  @if($sp->status == '2' && auth()->user()->getEmployeeId() == $sp->employee_id)
                     <!-- Start -->
                     <button class="btn btn-md btn-success" data-toggle="modal" data-target="#modal-app-employee-{{$sp->id}}"><i class="fas fa-check"></i> Confirm </button>

                     <div class="modal fade" id="modal-app-employee-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <form method="POST" action="{{route('sp.app.employee', enkripRambo($sp->id))}}" enctype="multipart/form-data">
                                 @csrf
                                 @method('PUT')
                                 <input type="hidden" name="id" value="{{$sp->id}}">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Employee</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body">
                                    Confirm {{$sp->code}}
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success ">
                                       Confirm
                                    </button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>

                     <!-- End Approved -->

                     
                  @endif
               @endif

               @if($sp->status == '1' && auth()->user()->hasRole('Manager'))
               @if($sp->status == '3' && auth()->user()->getEmployee()->id == $sp->employee->manager_id)
               <!-- Start -->
               <button class="btn btn-md btn-success" data-toggle="modal" data-target="#modal-submit-{{$sp->id}}"><i class="fas fa-check"></i> Approved </button>

               <div class="modal fade" id="modal-submit-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <form method="POST" action="{{route('sp.approved', enkripRambo($sp->id))}}" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <input type="hidden" name="id" value="{{$sp->id}}">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              Submit Surat Peringatan ini untuk priode

                              <?php echo   ' semester ' . $sp->semester . ' ' . $sp->tahun; ?>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-success ">
                                 Approved
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <!-- End Approved -->

               <!-- Reject -->
               <button data-target="#modalReject" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button>


               <!-- Modal Reject  -->
               <div class="modal fade" id="modalReject" data-bs-backdrop="static">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">

                        <!-- Bagian header modal -->
                        <div class="modal-header">
                           <h3 class="modal-title"> </h3>
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <form method="POST" action="{{route('sp.reject',$sp->id) }}" enctype="multipart/form-data">
                           @csrf
                           @method('PATCH')
                           <input type="hidden" name="id" value="{{$sp->id}}">

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
                              <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-danger">Reject</button>
                           </div>
                        </form>

                     </div>
                  </div>
               </div>

               <!-- End Modal Reject  -->

               <!-- End Reject -->
               @endif
               @endif

               @if($sp->status == '101')
               <!-- Start -->
               <button class="btn btn-md btn-warning" data-toggle="modal" data-target="#modal-submit-{{$sp->id}}"><i class="fas fa-rocket"></i> Sumbit Kembali </button>

               <div class="modal fade" id="modal-submit-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <form method="POST" action="{{route('sp.submit', enkripRambo($sp->id))}}" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <input type="hidden" name="id" value="{{$sp->id}}">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              Approved Surat Peringatan ini untuk priode

                              <?php echo   ' semester ' . $sp->semester . ' ' . $sp->tahun; ?>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-warning ">
                                 Submit
                              </button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>

               <!-- End -->
               @endif


               @if ($sp->status > 1)
               <button type="button" class="btn btn-light border" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  <i class="fa fa-print"></i>
                  Print
               </button>
               @endif
               

            </div>
         </div>
         {{-- <div class="page-divider hide"></div> --}}
         
         
             
         
         <div class="row">
            <div class="col-md-12">
               @if ($sp->status > 1)
               <x-sp.preview :sp="$sp" :gen="$gen" :user="$user" :hrd="$hrd" :manager="$manager" :suspect="$suspect" />
               <hr>
               @endif
               
            </div>
         </div>
      </div>
      @if (auth()->user()->hasRole('Karyawan'))
          @else
          <div class=" col-12 col-lg-10 col-xl-11 ">
            <div class="card card-invoice">
               <div class="card-header">
                  <b>SP {{$sp->level}} - {{$sp->employee->biodata->fullName()}}</b>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col">
                        <div class="row">
                           <div class="col-md-2">
                              <span>Date</span><br>
                              <span>Reason</span><br>
                              <span>Desc</span>
                           </div>
                           <div class="col-md-10">
                              <span>{{formatDate($sp->created_at)}}</span><br>
                              <span>{{$sp->reason}}</span><br>
                              <span>{{$sp->desc}}</span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        @if ($sp->status == 1 && auth()->user()->hasRole('HRD|HRD-Spv'))
                        <form action="{{route('sp.app.hrd', enkripRambo($sp->id))}}" method="POST">
                           @csrf
                           @method('PUT')
                           <input type="hidden" name="id" value="{{$sp->id}}">
                           <div class="form-group form-group-default">
                              <label>Berlaku</label>
                              <input type="date" class="form-control" name="date_from" required id="date_from" value="{{old('date_from')}}">
                           </div>
                           <div class="form-group form-group-default">
                              <label>Peraturan</label>
                              <input type="text" required class="form-control" name="rule" id="rule" value="{{old('rule')}}">
                           </div>
                           <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
                        @endif
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <div class="row">
                     @foreach ($approvals as $approval)
                     <div class="col-md-3">
                     <div class="btn border btn-block"><span>{{$approval->type}} <br>{{$approval->employee->biodata->fullname()}}</span><br>
                        <small>{{formatDateTime($approval->created_at)}}</small>
                     </div>
                  </div>
                     @endforeach
                     
                  
                     
                  </div>
                  
               </div>
            </div>
         </div>
      @endif
      
      @if ($sp->status < 2)
      <div class=" col-12 col-lg-10 col-xl-11 text-center text-muted ">
         <hr>
         Preview <br>
         <small>Data akan muncul setelah di verifikasi oleh HRD</small>

      </div>
      @endif
      
   </div>
</div>

<x-sp.modal.employee-approve :sp="$sp" />
<x-sp.modal.manager-approve :sp="$sp" />
<x-sp.modal.hrd-reject :sp="$sp" />
<x-sp.modal.edit :sp="$sp" :employees="$employees" />
<x-sp.modal.delete :sp="$sp" />
<x-sp.modal.submit :sp="$sp" />




@endsection