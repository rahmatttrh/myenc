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


               @if ($sp->status == 0)
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
               @endif


               <h5 class="page-title">{{$sp->code}}</h5>

            </div>
            <div class="col-auto">

               @if($sp->status == '0')
                  <!-- Start -->
                  <button class="btn btn-md btn-warning" data-toggle="modal" data-target="#modal-submit-{{$sp->id}}"><i class="fas fa-rocket"></i> Submit </button>
                  <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#modal-edit-{{$sp->id}}"><i class="fas fa-edit"></i> Edit </button>
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
                                 Submit SP <br>
                                 Send to HRD


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

               <div class="modal fade" id="modal-edit-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <form method="POST" action="{{route('sp.update')}}" enctype="multipart/form-data">
                           @csrf
                           @method('PUT')
                           <input type="hidden" name="id" id="id" value="{{$sp->id}}">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Edit Form SP</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <div class="modal-body">
                              <div class="form-group form-group-default">
                                 <label>Employee</label>
                                 <select class="form-control employee" required id="employee" name="employee">
                                    <option value="" selected disabled>Select Employee</option>
                                    @foreach ($employees as $emp)
                                    <option {{$sp->employee_id == $emp->id ? 'selected' : '' }} value="{{$emp->id}}">{{$emp->biodata->first_name}} {{$emp->biodata->last_name}} </option>
                                    @endforeach
                                 </select>

                              </div>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Level</label>
                                       <select class="form-control" required id="level" name="level">
                                          <option value="" selected disabled>Select level</option>
                                          <option {{$sp->level == 'I' ? 'selected' : ''}} value="I">SP I</option>
                                          <option {{$sp->level == 'II' ? 'selected' : ''}} value="II">SP II</option>
                                          <option {{$sp->level == 'II' ? 'selected' : ''}} value="III">SP III</option>
                                       </select>

                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group form-group-default">
                                          <label>Level</label>
                                          <select class="form-control" required id="level" name="level">
                                             <option value="" selected disabled>Select level</option>
                                             <option {{$sp->level == 'I' ? 'selected' : ''}} value="I">SP I</option>
                                             <option {{$sp->level == 'II' ? 'selected' : ''}} value="II">SP II</option>
                                             <option {{$sp->level == 'II' ? 'selected' : ''}} value="III">SP III</option>
                                          </select>
                     
                                       </div>
                                    </div>
                                 </div>

                                 {{-- <div class="col-md-6">
                                    <small class="text-muted">Masa berlaku SP adalah 6 bulan</small>
                                    <hr>
                                 </div> --}}
                                 {{-- <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Berlaku sampai</label>
                                       <input type="date" class="form-control"  name="date_to" id="date_to">
                                    </div>
                                 </div> --}}
                              </div>

                              <div class="form-group form-group-default">
                                 <label>Peraturan Perusahaan</label>
                                 <input type="text" class="form-control" name="rule" id="rule" value="{{$sp->rule}}">
                              </div>

                              <div class="form-group form-group-default">
                                 <label>Desc</label>
                                 <textarea class="form-control" name="desc" id="desc">{{$sp->desc}}</textarea>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>

                  <!-- End -->

                  <a href="#" class="btn btn-danger " data-toggle="modal" data-target="#modal-sp-delete">
                     <i class="fa fa-trash"></i> Delete
                  </a>
               @endif

               @if($sp->status == '1' && auth()->user()->hasRole('HRD'))
                  <!-- Start -->
                  <button class="btn btn-md btn-success" data-toggle="modal" data-target="#modal-app-hrd-{{$sp->id}}"><i class="fas fa-check"></i> Approve </button>

                  <div class="modal fade" id="modal-app-hrd-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                        <div class="modal-content">
                           <form method="POST" action="{{route('sp.app.hrd', enkripRambo($sp->id))}}" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="id" value="{{$sp->id}}">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Approval HRD</h5>
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
                                    Approve
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


               <button type="button" class="btn btn-light border" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  <i class="fa fa-print"></i>
                  Print
               </button>

            </div>
         </div>
         {{-- <div class="page-divider hide"></div> --}}
         <div class="row">
            <div class="col-md-12">
               <div class="card card-invoice">
                  {{-- <div class="card-header">
                     <div class="invoice-header">
                        
                        <div class="invoice-logo">
                           <img src="{{asset('img/logo/enc2.jpg')}}" alt="company logo">
               </div>
            </div>
            <div class="invoice-desc">
               Bandung, West Java, Indonesia<br>
               Fax 621113
            </div>
         </div> --}}
         <div class="card-body pt-4 px-4">
            <div class="d-flex justify-content-between">
               <div>
                  <img src="{{asset('img/logo/enc2.jpg')}}" alt="company logo"><br>
                  {{-- <p>FM.PS.HRD.12</p> --}}

               </div>
               <div class="text-right">
                  <h3><b>SURAT PERINGATAN {{$sp->level}}</b></h3>
                  <b>{{$sp->code}}</b>
               </div>
            </div>
            {{-- <div class="text-center mt-2">
               <h3><b>SURAT PERINGATAN {{$sp->level}}</b></h3>
            <span>{{$sp->code}}</span>
         </div> --}}

         {{-- <div class="separator-solid"></div> --}}
         <hr>
         <br>
         <p>Kepada Yth.</p>

         <div class="row">
            <div class="col-12">
               <div class="row">
                  <div class="col-2">Nama</div>
                  <div class="col-10">: {{$sp->employee->biodata->fullName()}}</div>
               </div>
               <div class="row">
                  <div class="col-2">NIK</div>
                  <div class="col-10">: {{$sp->employee->nik}}</div>
               </div>
               <div class="row">
                  <div class="col-2">Jabatan</div>
                  <div class="col-10">: {{$sp->employee->position->name}}</div>
               </div>
               <div class="row">
                  <div class="col-2">Departemen/Divisi</div>
                  <div class="col-10">: {{$sp->employee->department->name}}</div>
               </div>
               <div class="row mt-4">
                  <div class="col-12">Sehubugan dengan pelanggaran yang {{$gen}} lakukan, yaitu :</div>
                  {{-- <div class="col-md-9">: {{$spkl->desc}}
               </div> --}}
            </div>
            <br>
            <div class="row mb-4 mt-2">
               <div class="col">
                  <b>{{$sp->desc}}</b>
               </div>
            </div>
         </div>

      </div>





      <br>
      <p>Maka sesuai dengan peraturan yang berlaku (Peraturan Perusahaan {{$sp->rule}}) kepada {{$gen}} diberikan sanksi berupa SURAT PERINGATAN {{$sp->level}}.</p>

      <p>Setelah {{$gen}} menerima SURAT PERINGATAN {{$sp->level}} ini, diharapkan {{$gen}} dapat merubah sikap {{$gen}} dan kembali bekerja dengan baik.</p>

      <p>Surat peringatan ini berlaku selama 6 bulan, Efektif tanggal <b>{{formatDate($sp->date_from)}}</b> s/d <b>{{formatDate($sp->date_to)}}</b>.</p>

      <p>Apabila ternyata {{$gen}} kembali berbuat sesuatu kesalahan atau pelanggaran yang dapat diberikan sanksi, maka kepada <Saudara>
            <i></i> akan diberikan sanksi yang lebih keras dan dapat berakibat pemutusan hubungan kerja antara perusahaan dengan {{$gen}}.</p>

      <p>Semoga dapat dimengerti dan dimaklumi.</p>

      <br><br>
      <div class="page-divider"></div>
      <table>
         <tbody>
            <tr>
               <th>Diajukan oleh</th>
               <th>Disetujui oleh</th>
               <th>Diketahui oleh</th>
               <th>Diterima</th>
            </tr>
            <tr>
               <td style="height: 80px" class="text-info">
                  {{$sp->created_by->biodata->fullName()}}
                  @if ($sp->status >= 1)
                  <br>
                  {{formatDateTime($sp->release_at)}}
                  @endif

               </td>
               <td>
                  @if ($sp->status >= 2)
                  {{$sp->employee->manager->biodata->fullName()}} <br>
                  {{formatDateTime($sp->approved_at)}}
                  @endif

               </td>
               <td>
                  @if ($sp->status >= 3)
                  @endif

               </td>
               <td>
                  @if ($sp->status >= 4)
                  @endif
               </td>
            </tr>
            <tr>
               <td>Tanggal : {{formatDate($sp->releaset_at)}}</td>
               <td>Tanggal : {{$sp->approved_at ? formatDate($sp->approved_at) : ''}}</td>
               <td>Tanggal : {{$sp->approved_at ? formatDate($sp->approved_at) : ''}}</td>
               <td>Tanggal : {{$sp->approved_at ? formatDate($sp->approved_at) : ''}}</td>
            </tr>
         </tbody>
      </table>


   </div>
   <br><br>
   {{-- <div class="page-divider"></div> --}}
   {{-- <div class="card-footer">
                     
                     <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                        Notes
                     </h6>
                     <p class="text-muted mb-0">
                        We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!
                     </p>
                  </div> --}}
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="modal-sp-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">

            Delete this SP ? <br>
            {{$sp->code}}


         </div>
         <div class="modal-footer"><a href="{{route('sp.delete', enkripRambo($sp->id))}}" class="btn btn-danger">Delete</a>
         </div>
      </div>
   </div>
</div>

@endsection