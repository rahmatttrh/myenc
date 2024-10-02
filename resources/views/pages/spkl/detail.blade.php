@extends('layouts.app')
@section('title')
SPKL Detail
@endsection
@section('content')

<style>
   @media print {
   header, footer, nav, aside, .sidebar, .main-header, .hide {
      display: none;
   }

   .main-panel {
      width: 100%;
   }

   @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

}
</style>

<div class="page-inner">
   <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-11">
         <div class="row hide align-items-center">
            <div class="col">
               <h6 class="page-pretitle">
                  @if ($spkl->status == 0)
                     Draft
                     @elseif($spkl->status == 1)
                     Approval SPV
                     @elseif($spkl->status == 2)
                     Approval Manager
                     @elseif($spkl->status == 3)
                     Verifikasi HRD
                     @elseif($spkl->status == 4)
                     Complete
                   @endif
               </h6>
               <h5 class="page-title">{{$spkl->code}}</h5>
               
            </div>
            <div class="col-auto">
               {{-- <a href="#" class="btn btn-light btn-border">
                  Download
               </a> --}}
               @if (auth()->user()->hasRole('Karyawan'))
                   @if ($spkl->status == 0)
                     <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#modal-spkl-send">
                        <i class="fa fa-rocket"></i>
                        Send
                     </a>
                     <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#modal-spkl-delete">
                        <i class="fa fa-trash"></i>
                        Delete
                     </a>
                     
                   @endif
               @endif

               @if (auth()->user()->hasRole('Supervisor'))
                  @if ($spkl->status == 1)
                  <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-spkl-approve-supervisor">
                     <i class="fa fa-check"></i>
                     Approve Spv
                  </a>
                  @endif
               @endif

               @if (auth()->user()->hasRole('Manager'))
                  @if ($spkl->status == 1 || $spkl->status == 2)
                  <a href="#" class="btn btn-primary ml-2" data-toggle="modal" data-target="#modal-spkl-approve-manager">
                     <i class="fa fa-check"></i>
                     Approve Manager
                  </a>
                  @endif
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
                           <img src="{{asset('img/logo/enc2.jpg')}}"  alt="company logo"><br>
                           <p>FM.PS.HRD.12</p>
                           
                        </div>
                        <div class="text-right">
                           <h3><b>FORMULIR</b></h3>
                           <h3><b>SURAT PERINTAH KERJA LEMBUR</b></h3>
                        </div>
                     </div>
                    
                     {{-- <div class="separator-solid"></div> --}}
                     <hr>
                     <p>Dengan ini kami memberikan tugas kerja lembur kepada :</p>

                     <div class="row">
                        <div class="col-6">
                           <div class="row">
                              <div class="col-3">Nama</div>
                              <div class="col-9">: {{$spkl->employee->biodata->first_name}} {{$spkl->employee->biodata->last_name}}</div>
                           </div>
                           <div class="row">
                              <div class="col-3">NIK</div>
                              <div class="col-9">: {{$spkl->employee->nik}}</div>
                           </div>
                           <div class="row">
                              <div class="col-3">Jabatan</div>
                              <div class="col-9">: {{$spkl->employee->position->name}}</div>
                           </div>
                           <div class="row">
                              <div class="col-3">Departmen</div>
                              <div class="col-9">: {{$spkl->employee->department->name}}</div>
                           </div>
                           <div class="row">
                              <div class="col-3">Pekerjaan</div>
                              <div class="col-9">: {{$spkl->desc}}</div>
                           </div>
                        </div>
                        <div class="col-6">
                           <div class="row">
                              <div class="col-4">Hari/Tanggal</div>
                              <div class="col-8">: {{formatDayDate($spkl->date)}}</div>
                           </div>
                           <div class="row">
                              <div class="col-4">Waktu</div>
                              <div class="col-8">: {{formatTime($spkl->employee->contract->shift->out)}} s/d {{formatTime($spkl->end)}}</div>
                           </div>
                           <div class="row">
                              <div class="col-4">Lama lembur</div>
                              <div class="col-8">: {{formatTime($spkl->total)}} Jam</div>
                           </div>
                           <div class="row">
                              <div class="col-4">Lokasi </div>
                              <div class="col-8">: {{$spkl->loc}}</div>
                           </div>
                        </div>
                     </div>
                     
                     
                     
                     
                     <br>
                     <br>
                     <p>Demikian untuk dilaksanakan. <br>Jakarta, {{formatDateB($spkl->date)}}</p>
                     
                     {{-- <div class="row">
                        <div class="col-md-12">
                           <div class="invoice-detail">
                              <div class="invoice-top">
                                 <h3 class="title"><strong>Order summary</strong></h3>
                              </div>
                              <div class="invoice-item">
                                 <div class="table-responsive">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <td><strong>Item</strong></td>
                                             <td class="text-center"><strong>Price</strong></td>
                                             <td class="text-center"><strong>Quantity</strong></td>
                                             <td class="text-right"><strong>Totals</strong></td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>BS-200</td>
                                             <td class="text-center">$10.99</td>
                                             <td class="text-center">1</td>
                                             <td class="text-right">$10.99</td>
                                          </tr>
                                          <tr>
                                             <td>BS-400</td>
                                             <td class="text-center">$20.00</td>
                                             <td class="text-center">3</td>
                                             <td class="text-right">$60.00</td>
                                          </tr>
                                          <tr>
                                             <td>BS-1000</td>
                                             <td class="text-center">$600.00</td>
                                             <td class="text-center">1</td>
                                             <td class="text-right">$600.00</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-center"><strong>Subtotal</strong></td>
                                             <td class="text-right">$670.99</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-center"><strong>Shipping</strong></td>
                                             <td class="text-right">$15</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-center"><strong>Total</strong></td>
                                             <td class="text-right">$685.99</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>	
                           <div class="separator-solid  mb-3"></div>
                        </div>	
                     </div> --}}
                     <br>
                     <div class="page-divider"></div>
                     <table>
                        <tbody>
                           <tr>
                              <th>Request by : <br> Atasan Langsung</th>
                              <th>Approved by : <br> GM/Manager</th>
                              <th>Employee</th>
                           </tr>
                           <tr>
                              <td style="height: 80px" class="text-center px-4">
                                 @if ($spkl->status >= 2)
                                     <span class="text-info  "><b>APPROVED</b></span><br>
                                     <small class="text-info">{{formatDateTime($spkl->app_spv)}}</small>
                                 @endif
                              </td>
                              <td class="text-center px-4">
                                 @if ($spkl->status >= 3)
                                     <span class="text-info "><b>APPROVED</b></span><br>
                                     <small class="text-info">{{formatDateTime($spkl->app_man)}}</small>
                                 @endif
                              </td>
                              <td class="text-center px-4">
                                 {{-- @if ($spkl->status >= 3) --}}
                                     <span class="text-muted ">CREATED BY</span><br>
                                     <small class="text-muted">{{formatDateTime($spkl->created_at)}}</small>
                                 {{-- @endif --}}
                              </td>
                           </tr>
                           <tr>
                              <td>Nama : {{$spv->biodata->first_name}} {{$spv->biodata->last_name}}</td>
                              <td>Nama : {{$manager->biodata->first_name}} {{$manager->biodata->last_name}}</td>
                              <td>Nama : {{$spkl->employee->biodata->first_name}} {{$spkl->employee->biodata->last_name}}</td>
                           </tr>
                        </tbody>
                     </table>

                  </div>
                  <div class="card-footer">
                     {{-- <div class="row">
                        <div class="col-sm-7 col-md-5 mb-3 mb-md-0 transfer-to">
                           <h5 class="sub">Bank Transfer</h5>
                           <div class="account-transfer">
                              <div><span>Account Name:</span><span>Syamsuddin</span></div>
                              <div><span>Account Number:</span><span>1234567890934</span></div>
                              <div><span>Code:</span><span>BARC0032UK</span></div>
                           </div>
                        </div>
                        <div class="col-sm-5 col-md-7 transfer-total">
                           <h5 class="sub">Total Amount</h5>
                           <div class="price">$685.99</div>
                           <span>Taxes Included</span>
                        </div>
                     </div> --}}
                     {{-- <div class="separator-solid"></div> --}}
                     <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                        Notes
                     </h6>
                     <p class="text-muted mb-0">
                        We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-spkl-send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">
            Send this SPKL Form to SPV/Manager?
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <a href="{{route('employee.spkl.send', enkripRambo($spkl->id))}}" class="btn btn-primary">Send</a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-spkl-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">
            Delete this SPKL Form ?
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <a href="{{route('employee.spkl.delete', enkripRambo($spkl->id))}}" class="btn btn-danger">Delete</a>
         </div>
      </div>
   </div>
</div>


<div class="modal fade" id="modal-spkl-approve-supervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">
            Approve this SPKL ?
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <a href="{{route('spkl.approve.supervisor', enkripRambo($spkl->id))}}" class="btn btn-primary">Approve</a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-spkl-approve-manager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">
            Approve this SPKL ?
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <a href="{{route('spkl.approve.manager', enkripRambo($spkl->id))}}" class="btn btn-primary">Approve</a>
         </div>
      </div>
   </div>
</div>

@endsection