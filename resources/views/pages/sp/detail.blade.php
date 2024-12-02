@extends('layouts.app')
@section('title')
SP Detail
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
      .hide, .master, .discuss {
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
   @if($sp->status == '5')
   {{-- <div class="row justify-content-center ">
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
   </div> --}}
   @endif
   <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-11">
         <div class="row hide align-items-center">
            <div class="col">

               <x-status.sp :sp="$sp" />
               


               <h5 class="page-title">{{$sp->code}}</h5>

            </div>
            <div class="col-auto">

               @if (auth()->user()->hasRole('Leader|Supervisor|Manager|Asst. Manager'))
                  @if($sp->status == '0')
                     <!-- Start -->
                     <button class="btn btn btn-dark" data-toggle="modal" data-target="#modal-submit-{{$sp->id}}"><i class="fas fa-rocket"></i> Submit </button>
                     <button class="btn btn btn-primary" data-toggle="modal" data-target="#modal-edit-{{$sp->id}}"><i class="fas fa-edit"></i> Edit </button>
               
                     <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-sp-delete">
                        <i class="fa fa-trash"></i> Delete
                     </a>

                     <x-sp.modal.delete :sp="$sp" />
                     <x-sp.modal.edit :sp="$sp" :employees="$employees" />
                     <x-sp.modal.submit :sp="$sp" />
                  @endif
                  @if($sp->status == '2')
                     <!-- Start -->
                     <button class="btn btn btn-primary" data-toggle="modal" data-target="#modal-release-{{$sp->id}}"><i class="fas fa-rocket"></i> Send to Manager </button>
                     <x-sp.modal.release :sp="$sp" />
                     <button data-target="#modalRejectUser" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button>
                     {{-- <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-edit-{{$sp->id}}"><i class="fas fa-edit"></i> Edit </button>
               
                     <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-sp-delete">
                        <i class="fa fa-trash"></i> Delete
                     </a> --}}
                     
                  @endif
                  @if($sp->status == '202')
                     
                     <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-sp-close">
                         Close
                     </a>
                  @endif
               @endif

               @if($sp->status == '1' && auth()->user()->hasRole('HRD|HRD-Manager|HRD-Spv'))
                  {{-- <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-app-hrd-{{$sp->id}}"><i class="fas fa-check"></i> Approve </button> --}}
                  <button data-target="#modal-reject-hrd" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button>
                  {{-- <x-sp.modal.hrd-reject :sp="$sp" /> --}}
               @endif

               @if(auth()->user()->hasRole('HRD|HRD-Manager|HRD-Spv'))
               <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-complete-hrd">
                   Complete
               </a>
               <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-sp-delete">
                  <i class="fa fa-trash"></i> Delete
               </a>
               

               <x-sp.modal.delete :sp="$sp" />
               @endif

               @if (auth()->user()->hasRole('Manager'))
                  @if($sp->status == '3' ||  $sp->status == '101')
                     <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-app-manager-{{$sp->id}}"><i class="fas fa-check"></i> Approve </button>
                     <button data-target="#modalRejectManager" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-reply"></i> Reject</button>
                     {{-- <button data-target="#modalManagerDiscuss" data-toggle="modal" class="btn btn-md btn-dark "> Need Discuss</button> --}}
                     {{-- <x-sp.modal.manager-discuss :sp="$sp" /> --}}
                     <x-sp.modal.manager-approve :sp="$sp" />

                  @endif
                  @if($sp->status == '3')
                     
                     <button data-target="#modalManagerDiscuss" data-toggle="modal" class="btn btn-md btn-dark "> Need Discuss</button>
                     <x-sp.modal.manager-discuss :sp="$sp" />
                     
                  @endif
               @endif
               
               @if($sp->status == '4' && auth()->user()->hasRole('Karyawan|Supervisor'))
                  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-app-employee-{{$sp->id}}"><i class="fas fa-check"></i> Confirm </button>
                  <button data-target="#modal-complain-employee" data-toggle="modal" class="btn btn-md btn-danger "><i class="fa fa-edit"></i> Add Notes</button>
               @endif


               {{-- @if ($sp->status > 1 && $sp->status != 6) --}}
               <button type="button" class="btn btn-light border" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  <i class="fa fa-print"></i>
                  Print
               </button>
               {{-- @endif --}}
               

            </div>
         </div>
         {{-- <div class="page-divider hide"></div> --}}
         
         @if ($sp->status == 101)
             <div class="card discuss">
               <div class="card-header">
                  <div class="badge badge-warning mr-1"><b>!</b></div> <b>Manager has submited discussion proccess</b>
               </div>
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-2">
                        Invitation <br>
                        Date <br>
                        Desc
                     </div>
                     <div class="col">
                        @if ($sp->nd_for == 1)
                            Atasan Langsung
                            @elseif($sp->nd_for == 2)
                            Karyawan
                            @elseif($sp->nd_for == 3)
                            Atasan Langsung & Karyawan
                        @endif <br>
                        {{formatDateTime($sp->nd_date)}} <br>
                        {{$sp->nd_reason}}
                     </div>
                  </div>
               </div>
             </div>
         @endif

         @if($sp->status == '202')
            <div class="card ">
               <div class="card-header">
                  <div class="badge badge-danger mr-1"><b>!</b></div><b>{{$sp->employee->biodata->fullName()}} has submited a complain</b>
               </div>
               <div class="card-body">
                  <span>{{$sp->complain_reason}}</span>
               </div>
            </div>
         @endif

         @if($sp->status == '505')
            <div class="card ">
               <div class="card-header">
                  <div class="badge badge-danger mr-1"><b>!</b></div><b>Rejected by HRD</b>
               </div>
               <div class="card-body">
                  <span>{{$sp->alasan_reject}}</span>
               </div>
            </div>
         @endif
             
         
         <div class="row">
            <div class="col-md-12">
               @if ($sp->status > 1 && $sp->status != 505)
               <x-sp.preview :sp="$sp" :gen="$gen" :user="$user" :hrd="$hrd" :manager="$manager" :suspect="$suspect" />
               
               <hr>
               
               @endif
               
            </div>
         </div>
      </div>
      
      @if (auth()->user()->hasRole('Leader|Supervisor|Asst. Manager|Manager'))
          {{-- @else --}}
          <div class=" col-12 col-lg-10 col-xl-11 master">
            <div class="card card-invoice">
               <div class="card-header">
                  <b>Form SP {{$sp->level}}</b>
               </div>
               <div class="card-body">
                  @if (auth()->user()->hasRole('HRD|HRD-Manager|HRD-Spv'))
                        @if ($sp->status == 1 )
                        <form action="{{route('sp.app.hrd', enkripRambo($sp->id))}}" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <div class="row">
                              <div class="col">
                                 
                                    <input type="hidden" name="id" value="{{$sp->id}}">
                                    <div class="form-group form-group-default">
                                       <label>Employee</label>
                                       <input type="text" readonly class="form-control" name="date_from" required id="date_from" value="{{$sp->employee->biodata->fullName()}}">
                                    </div>
                                    <div class="row">
                                       <div class="col">
                                          <div class="form-group form-group-default">
                                             <label>Level*</label>
                                             <select class="form-control" required id="level" name="level">
                                                {{-- <option value="" selected disabled>Select level</option> --}}
                                                <option {{$sp->level == 'I' ? 'selected' : ''}} value="I">SP I</option>
                                                <option {{$sp->level == 'II' ? 'selected' : ''}} value="II">SP II</option>
                                                <option {{$sp->level == 'III' ? 'selected' : ''}} value="III">SP III</option>
                                             </select>
                        
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group form-group-default">
                                             <label>Tanggal </label>
                                             <input type="date" class="form-control" name="date_from" required id="date_from" value="{{$sp->created_at}}">
                                          </div>
                                       </div>
                                       {{-- <div class="col-md-7">
                                          
                                       </div> --}}
                                    </div>
                                    
                                    <div class="form-group form-group-default">
                                       <label>Alasan</label>
                                       <input type="text" required class="form-control" name="reason" id="reason" value="{{$sp->reason}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Peraturan yang dilanggar</label>
                                       <input type="text" required class="form-control" name="rule" id="rule" value="{{old('rule')}}">
                                    </div>
                                    {{-- <div class="form-group form-group-default">
                                       <label>File attachment</label>
                                       <input type="file" class="form-control" name="date_from" required id="date_from" value="{{$sp->date_from}}">
                                    </div> --}}
                                    <hr>
                                    <button type="submit" class="btn btn-primary">Approve</button>
                              
                              </div>
                              <div class="col">
                                 <div class="form-group form-group-default">
                                    <label>File attachment</label>
                                    <input type="file" class="form-control" name="file"  id="file" >
                                 </div>
                                 <div class="form-group form-group-default">
                                    <label>Kronologi</label>
                                    <textarea class="form-control" rows="6" name="desc" id="desc" >{{$sp->desc}}</textarea>
                                 </div>
                              </div>
                           </div>
                        </form>
                        
                        @else
                        <div class="row">
                     
                           <div class="col">
                              
                              <div class="row">
                                 <div class="col-md-2">
                                    {{-- <span>Employee</span><br> --}}
                                    <span>Date</span><br>
                                    <span>Reason</span><br>
                                    <span>Desc</span>
                                 </div>
                                 <div class="col-md-10">
                                    {{-- <span>{{$sp->employee->fullName()}}</span> <br> --}}
                                    <span>{{formatDate($sp->created_at)}}</span><br>
                                    <span>{{$sp->reason}}</span><br>
                                    <span>{{$sp->desc}}</span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endif
                     @else
                     <div class="row">
                     
                        <div class="col">
                           
                           <div class="row">
                              <div class="col-md-2">
                                 <span>NIK</span><br>
                                 <span>Name</span><br>
                                 <span>Date</span><br>
                                 <span>Reason</span><br>
                                 <span>Desc</span>
                              </div>
                              <div class="col-md-10">
                                 <span>{{$sp->employee->nik}}</span> <br>
                                 <span>{{$sp->employee->biodata->fullname()}}</span> <br>
                                 <span>{{formatDate($sp->created_at)}}</span><br>
                                 <span>{{$sp->reason}}</span><br>
                                 <span>{{$sp->desc}}</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endif
                  
                  
               </div>
               {{-- <div class="card-footer">
                  
                     @foreach ($approvals as $approval)
                     
                     <div class="btn border  text-left">
                        @if ($approval->level == 'user')
                        <span>{{$approval->type}}</span>
                            User
                            @elseif($approval->level == 'hrd')
                            Validation HRD
                            @elseif($approval->level == 'manager')
                            <span>{{$approval->type}}</span>
                            Manager
                            @elseif($approval->level == 'employee')
                            <span>{{$approval->type}}</span>
                            Employee
                        @endif <br>
                        {{$approval->employee->biodata->fullname()}} <br>
                        <small>{{formatDateTime($approval->created_at)}}</small>
                     </div>
                  
                     @endforeach
                     
                  
               
                  
                  
               </div> --}}
               <div class="card-footer">
                  <b class="mb-3">Attachment</b>
                  @if ($sp->file)
                  <iframe src="{{asset('storage/' . $sp->file)}}" width="100%" height="500px" scrolling="auto" frameborder="0"></iframe>
                  @else
                  <br>
                  <small>Empty</small>
                  @endif
                  
               </div>
            </div>
         </div>
      @endif

      
      
      @if ($sp->status < 2)
      <div class=" col-12 col-lg-10 col-xl-11 text-center text-muted master ">
         <hr>
         Preview <br>
         <small>Data akan muncul setelah di verifikasi oleh HRD</small>

      </div>
      @endif
      
   </div>
</div>


<div class="modal fade" id="modalRejectUser" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Bagian header modal -->
         <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Reject</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form method="POST" action="{{route('sp.reject.user') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id" value="{{$sp->id}}">

            <!-- Bagian konten modal -->
            <div class="modal-body">
               <div class="form-group form-group-default">
                  <label>Alasan Penolakannn</label>
                  <input type="text" class="form-control" name="alasan_reject" id="alasan_reject" value="{{old('alasan_reject')}}">
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

<div class="modal fade" id="modalRejectManager" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Bagian header modal -->
         <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Reject</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form method="POST" action="{{route('sp.reject.manager') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id" value="{{$sp->id}}">

            <!-- Bagian konten modal -->
            <div class="modal-body">
               <div class="form-group form-group-default">
                  <label>Alasan Penolakannn</label>
                  <input type="text" class="form-control" name="alasan_reject" id="alasan_reject" value="{{old('alasan_reject')}}">
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

<div class="modal fade" id="modal-complete-hrd" data-bs-backdrop="static">
   <div class="modal-dialog modal-md">
      <div class="modal-content">

         <!-- Bagian header modal -->
         <div class="modal-header">
            <h3 class="modal-title">Confirmation</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form method="POST" action="{{route('sp.complete.hrd') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="spId" id="spId"  value="{{$sp->id}}">

            <!-- Bagian konten modal -->
            <div class="modal-body">
               <div class="form-group form-group-default">
                  <label>Description (Optional)</label>
                  <input type="text" class="form-control" name="description" id="description" value="{{old('description')}}">
               </div>
               <div class="form-group form-group-default">
                  <label>Evidence</label>
                  <input type="file" class="form-control" name="evidence" required id="evidence" value="{{old('evidence')}}">
               </div>
               <hr>

               Klik 'Complete' untuk menyelesaikan alur proses SP pada sistem
               
            </div>

            <!-- Bagian footer modal -->
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Complete</button>
            </div>
         </form>

      </div>
   </div>
</div>


<x-sp.modal.close :sp="$sp" />
<x-sp.modal.employee-complain :sp="$sp" />
<x-sp.modal.employee-approve :sp="$sp" />
<x-sp.modal.hrd-reject :sp="$sp" />






{{-- <x-sp.modal.submit :sp="$sp" /> --}}





@endsection