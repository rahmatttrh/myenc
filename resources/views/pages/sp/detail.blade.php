@extends('layouts.app')
@section('title')
SPKL Detail
@endsection
@section('content')

<style>

html { -webkit-print-color-adjust: exact; }
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
               <h5 class="page-title">{{$sp->code}}</h5>
               
            </div>
            <div class="col-auto">
               {{-- <a href="#" class="btn btn-light btn-border">
                  Download
               </a> --}}
               
               
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
                     
                     <div class="text-center mt-2">
                        <h3>SURAT PERINGATAN I</h3>
                        <span>{{$sp->code}}</span>
                     </div>
                    
                     {{-- <div class="separator-solid"></div> --}}
                     <hr>
                     <p>Kepada Yth.</p>

                     <div class="row">
                        <div class="col-12">
                           <div class="row">
                              <div class="col-md-3">Nama</div>
                              <div class="col-md-9">: {{$spkl->employee->biodata->first_name}} {{$spkl->employee->biodata->last_name}}</div>
                           </div>
                           <div class="row">
                              <div class="col-md-3">NIK</div>
                              <div class="col-md-9">: {{$spkl->employee->nik}}</div>
                           </div>
                           <div class="row">
                              <div class="col-md-3">Jabatan</div>
                              <div class="col-md-9">: {{$spkl->employee->position->name}}</div>
                           </div>
                           <div class="row">
                              <div class="col-md-3">Departmen/Divisi</div>
                              <div class="col-md-9">: {{$spkl->employee->department->name}}</div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">Sehubugan dengan pelanggaran yang Saudara/i lakukan, yaitu :</div>
                              {{-- <div class="col-md-9">: {{$spkl->desc}}</div> --}}
                           </div>

                           <div class="row mb-4 mt-2">
                              <div class="col"></div>
                           </div>
                        </div>
                        
                     </div>
                     
                     
                     
                     
                     
                     <br>
                     <p>Maka sesuai dengan peraturan yang berlaku (Peraturan Perusahaan Pasal 45 Ayat 1 Butir 1) kepada Saudari diberikan sanksi berupa  SURAT PERINGATAN I.</p>

                     <p>Setelah Saudara/i menerima SURAT PERINGATAN I ini, diharapkan Saudara/i dapat merubah sikap Saudari dan kembali bekerja dengan baik.</p>

                     <p>Surat peringatan ini berlaku selama 6 bulan, Efektif tanggal {{formatDate($sp->date_from)}} s/d {{formatDate($sp->date_to)}}.</p>

                     <p>Apabila ternyata Saudari kembali berbuat sesuatu kesalahan atau pelanggaran yang dapat diberikan sanksi, maka kepada Saudari akan diberikan sanksi yang lebih keras dan dapat berakibat pemutusan hubungan kerja antara perusahaan dengan Saudari.</p>

                     <p>Semoga dapat dimengerti dan dimaklumi.</p>
                     
                     
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
                              <td style="height: 80px"></td>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td>Nama :</td>
                              <td>Nama :</td>
                              <td>Nama :</td>
                              <td>Nama :</td>
                           </tr>
                        </tbody>
                     </table>
                     
                     
                  </div>
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