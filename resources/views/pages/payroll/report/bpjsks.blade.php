@extends('layouts.app')
@section('title')
Payroll Report BPJS KS
@endsection
@section('content')

<style>
   .hori-timeline .events {
    border-top: 3px solid #e9ecef;
}
.hori-timeline .events .event-list {
    display: block;
    position: relative;
    text-align: center;
    padding-top: 70px;
    margin-right: 0;
}
.hori-timeline .events .event-list:before {
    content: "";
    position: absolute;
    height: 36px;
    border-right: 2px dashed #dee2e6;
    top: 0;
}
.hori-timeline .events .event-list .event-date {
    position: absolute;
    top: 38px;
    left: 0;
    right: 0;
    width: 75px;
    margin: 0 auto;
    border-radius: 4px;
    padding: 2px 4px;
}
@media (min-width: 1140px) {
    .hori-timeline .events .event-list {
        display: inline-block;
        width: 24%;
        padding-top: 45px;
    }
    .hori-timeline .events .event-list .event-date {
        top: -12px;
    }
}
.bg-soft-primary {
    background-color: rgba(64,144,203,.3)!important;
}
.bg-soft-success {
    background-color: rgba(71,189,154,.3)!important;
}
.bg-soft-danger {
    background-color: rgba(231,76,94,.3)!important;
}
.bg-soft-warning {
    background-color: rgba(249,213,112,.3)!important;
}
.card {
    border: none;
    margin-bottom: 24px;
    -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
    box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
}


</style>

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   @media print {

      header,
      footer,
      nav,
      aside,
      .hide,
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

<style>
   .p0 {
      padding: 0px !important;
   }
</style>


<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll.transaction')}}">Transaction</a></li>
         <li class="breadcrumb-item" aria-current="page">{{$unitTransaction->unit->name}}</li>
         <li class="breadcrumb-item" aria-current="page">{{$unitTransaction->month}}</li>
         <li class="breadcrumb-item active" aria-current="page">Report BPJS Kesehatan </li>
      </ol>
   </nav>

   <div class="row hide mb-2">
      <div class="col">
         <a href="{{route('payroll.transaction.monthly.all', enkripRambo($unitTransaction->id))}}" class="btn btn-light border" ><i class="fa fa-backward"></i> Back</a>
         <button type="button" class="btn btn-light bolight border" onclick="javascript:window.print();">
            <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
            <i class="fa fa-print"></i>
            Print PDF
         </button>
      </div>
      <div class="col-auto">
         {{-- <button type="button" class="btn btn-light border" onclick="javascript:window.print();">
            <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
            <i class="fa fa-print"></i>
            Print
         </button> --}}
      </div>
   </div>
   

   
   
   

   

   <div class="card">
      {{-- <div class="card-header p-3  d-flex justify-content-between">
         <div>
            <h4 class="text-uppercase"><b>{{$unitTransaction->unit->name}}</b> {{$unitTransaction->month}} {{$unitTransaction->year}}</h4>
            <h1><b> {{formatRupiahB($unitTransaction->unit->getUnitTransaction($unitTransaction)->sum('total'))}}</b></h1>
            <small>STATUS : <span class="text-uppercase"> <x-status.unit-transaction :unittrans="$unitTransaction"/> </span></small> <br>
            
         </div>
             
      </div> --}}
      <div class="card-body p-0">
         
         {{-- <div class="table-responsive" style=""> --}}
            <table  >
               <thead>
                  <tr>
                     <th colspan="4 p-2" class="bg-white"><img src="{{asset('img/logo/bpjsks.png')}}" width="150px" alt=""></th>
                  </tr>
                  <tr style="padding: 0px!">
                     <th colspan="4" class="text-center bg-white p0" style="padding: 0px !important;" >RINCIAN IURAN</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td colspan="4" style="padding: 0px !important;"  >BAGIAN I - Perusahaan</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;">1</td>
                     <td style="padding: 0px !important;">NAMA INSTANSI/BADAN/PERUSAHAAN</td>
                     <td style="padding: 0px !important;" colspan="2">PT EKA NURI</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;">KODE BADAN USAHA</td>
                     <td style="padding: 0px !important;" colspan="2">01143486</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;">ALAMAT</td>
                     <td style="padding: 0px !important;" colspan="2">Jl. Hayam Wuruk No. 2XX, Jakarta Pusat</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;">TELP</td>
                     <td style="padding: 0px !important;" colspan="2">(021) 3459888</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" colspan="3"></td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;">2</td>
                     <td style="padding: 0px !important;">IURAN UNTUK BULAN</td>
                     <td style="padding: 0px !important;"colspan="2" class="text-uppercase">{{$reportBpjsKs->month}} 2024</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;">KODE VIRTUAL ACCOUNT</td>
                     <td style="padding: 0px !important;" colspan="2">903243459888</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;">BANK TEMPAT PEMBAYARAN IURAN</td>
                     <td style="padding: 0px !important;" colspan="2">MANDIRI</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" colspan="4">-</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" colspan="4">BAGIAN II : Rekapitulasi tenaga kerja dan upah</td>
                  </tr>
                  
                  <tr>
                     <td style="padding: 0px !important;" colspan="2" rowspan="2" class="text-center">Iuran</td>
                     <td style="padding: 0px !important;" colspan="2" class="text-center">Jumlah</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" class="text-center">Tenaga Kerja</td>
                     <td style="padding: 0px !important;" class="text-center">Upah (Rp.)</td>
                  </tr>

                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">A</td>
                     <td style="padding: 0px !important;">Bulan lalu</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">{{$reportBpjsKs->payslip_employee}}</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">{{formatRupiahB($reportBpjsKs->payslip_total)}}</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">B</td>
                     <td style="padding: 0px !important;">Penambahan tenaga kerja</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">C</td>
                     <td style="padding: 0px !important;">Pengurangan tenaga kerja</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">D</td>
                     <td style="padding: 0px !important;">Perubahan Upah</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">E</td>
                     <td style="padding: 0px !important;">Jumlah (A+B+C)</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                  </tr>
                  

               </tbody>
               
            </table>
            <table>
               <tbody>
                  <tr>
                     <td style="padding: 0px !important;" colspan="9">BAGIAN III : Rincian Iuran bulan ini</td>
                  </tr>
                  <tr>
                     {{-- <td style="padding: 0px !important;" colspan="5"></td>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;">Perusahaan</td>
                     <td style="padding: 0px !important;">Karyawan</td>
                     <td style="padding: 0px !important;">Jumlah Iuran</td>
                  </tr> --}}
                  <tr>
                     {{-- <td style="padding: 0px !important;" colspan="2">(1)</td> --}}
                     <td style="padding: 0px !important;" colspan="3" class="text-center">Program</td>
                     <td style="padding: 0px !important;" class="text-center">Tarif</td>
                     <td style="padding: 0px !important;" class="text-center">Tenaga <br> Kerja</td>
                     <td style="padding: 0px !important;" class="text-center" >Upah</td>
                     <td style="padding: 0px !important;" class="text-center" >Perusahaan</td>
                     <td style="padding: 0px !important;" class="text-center" >Karyawan</td>
                     <td style="padding: 0px !important;" class="text-center" >Jumlah Iuran</td>
                  </tr>
                  @php
                      $totalEmployee = 0;
                      $totalUpah = 0;
                      $totalIuranPerusahaan = 0;
                      $totalIuranKaryawan = 0;

                      $total = 0;
                      $totalAdditional = 0;
                  @endphp
                  @foreach ($locations as $loc)
                     @if ($loc->totalEmployee($unitTransaction->unit->id) > 0)
                     <tr>
                        <td rowspan="2"></td>
                        <td rowspan="2" class="text-center">{{$loc->name}}</td>
                        <td>Jaminan Kesehatan</td>
                        <td class="text-center">{{$unitTransaction->unit->reductions->where('name', 'BPJS KS')->first()->company + $unitTransaction->unit->reductions->where('name', 'BPJS KS')->first()->employee}} %</td>
                        <td class="text-center">{{count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction))}}</td>
                        <td class="text-right" >{{formatRupiahB($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total'))}}</td>
                        <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'BPJS KS', 'company'))}}</td>
                        <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'BPJS KS', 'employee'))}}</td>
                        <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'BPJS KS', 'company')+$loc->getDeduction($unitTransaction, 'BPJS KS', 'employee'))}}</td>
                     </tr>
                     <tr>
                        {{-- <td></td> --}}
                        <td>Iuran Tambahan</td>
                        <td class="text-center">1%</td>
                        <td class="text-center">-</td>
                        <td></td>
                        <td></td>
                        <td class="text-right"> {{formatRupiahB($loc->getDeductionAdditional($unitTransaction, 'employee'))}}</td>
                        <td class="text-right">{{formatRupiahB($loc->getDeductionAdditional($unitTransaction, 'employee'))}}</td>
                     </tr>
                     @php
                         
                        $totalEmployee += count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction));
                        $totalUpah += $loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total');
                        $totalIuranPerusahaan += $loc->getDeduction($unitTransaction, 'BPJS KS', 'company');
                        $totalIuranKaryawan += $loc->getDeduction($unitTransaction, 'BPJS KS', 'employee');

                         $total += $loc->getDeduction($unitTransaction, 'BPJS KS', 'company')+$loc->getDeduction($unitTransaction, 'BPJS KS', 'employee');
                         $totalAdditional += $loc->getDeductionAdditional($unitTransaction, 'employee');


                     @endphp
                     @endif
                  @endforeach
                  <tr>
                     <td colspan="2"></td>
                     <td><b>Total</b></td>
                     <td class="text-center"><b>{{$totalEmployee}}</b></td>
                     <td></td>
                     <td class="text-right"><b>{{formatRupiahB($totalUpah)}}</b></td>
                     <td class="text-right"><b>{{formatRupiahB($totalIuranPerusahaan)}}</b></td>
                     <td class="text-right"><b>{{formatRupiahB($totalIuranKaryawan)}}</b></td>
                     <td class="text-right"><b>{{formatRupiahB($total)}}</b></td>
                     
                  </tr>
                  
                {{--  <tr>
                     <td></td>
                     <td>Iuran Ekanuri KJ1-2 (612312444)</td>
                     <td>5,00%</td>
                     <td>15</td>
                     <td>8300099333</td>
                     <td>30000000</td>
                     <td>813999</td>
                     <td>4000292929</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Tambahan</td>
                     <td>1%</td>
                     <td>-</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Ekanuri KJ4 (612312444)</td>
                     <td>5,00%</td>
                     <td>15</td>
                     <td>8300099333</td>
                     <td>30000000</td>
                     <td>813999</td>
                     <td>4000292929</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Tambahan</td>
                     <td>1%</td>
                     <td>-</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Ekanuri KJ5 (612312444)</td>
                     <td>5,00%</td>
                     <td>15</td>
                     <td>8300099333</td>
                     <td>30000000</td>
                     <td>813999</td>
                     <td>4000292929</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td>813999</td>
                     <td>4000292929</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Non Employee (612312444)</td>
                     <td>5,00%</td>
                     <td>15</td>
                     <td>8300099333</td>
                     <td>30000000</td>
                     <td>813999</td>
                     <td>4000292929</td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Tambahan</td>
                     <td>1%</td>
                     <td>-</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr> --}}
                  <tr>
                     <td colspan="9">BAGIAN IV - Jumlah Seluruhnya</td>
                     
                  </tr>
                  <tr>
                     <td></td>
                     <td colspan="3">Jumlah seluruhnya (III-IV+V)</td>
                     
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-right"><b>{{formatRupiahB($total + $totalAdditional)}}</b></td>
                  </tr>
               </tbody>
               
            </table>

            <table>
               <tbody>
                  <tr>
                     <td colspan="">Jakarta,</td>
                  </tr>
                  <tr>
                     <td colspan="">Dibuat oleh,</td>
                     <td colspan="">-</td>
                     <td colspan="">Diperiksa oleh</td>
                     <td colspan=""></td>
                     <td colspan="">Disetujui oleh</td>
                  </tr>
                  <tr>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($hrd)
                        {{formatDateTime($hrd->created_at)}} 
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($manHrd)
                        {{formatDateTime($manHrd->created_at)}} 
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($manFin)
                        {{formatDateTime($manFin->created_at)}} 
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($gm)
                        {{formatDateTime($gm->created_at)}} 
                        @endif
                     </td>
                     <td colspan="" style="height: 80px" class="text-center">
                        @if ($bod)
                        {{formatDateTime($bod->created_at)}} 
                        @endif
                     </td>
                  </tr>
                  <tr>
                     <td>
                        @if ($hrd)
                           {{$hrd->employee->biodata->fullName()}}
                        @endif
                        
                     </td>
                     <td>
                        @if ($manHrd)
                           {{$manHrd->employee->biodata->fullName()}}
                        @endif
                     </td>
                     <td>
                        @if ($manFin)
                           {{$manFin->employee->biodata->fullName()}}
                        @endif
                     </td>
                     <td>
                        @if ($gm)
                           {{$gm->employee->biodata->fullName()}}
                        @endif
                        
                     </td>
                     <td>
                        @if ($bod)
                        {{$bod->employee->biodata->fullName()}}
                        @endif
                     </td>
                  </tr>
                  <tr>
                     <td>Payroll</td>
                     <td>HRD Manager</td>
                     <td>Manager Finance</td>
                     <td>GM Finance & Acc</td>
                     <td>Direktur</td>
                  </tr>
               </tbody>
            </table>
         {{-- </div> --}}
      </div>
   </div>


   <hr>

   <div class="card">
      <div class="card-body">
          {{-- <h4 class="card-title mb-5">Horizontal Timeline</h4> --}}

          
      </div>
   </div>
   
   
</div>

<div class="modal fade" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">

           
            
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">SIMPLE DATA</button> --}}
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            <a  href="{{route('employee.export.simple')}}" class="btn btn-info">SIMPLE DATA</a>
            <a  href="{{route('employee.export')}}" class="btn btn-primary">FULL DATA</a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-submit-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.submit.master.transaction')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Submit this Report and send to HRD Manager?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-hrd-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.approve.hrd')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Approve this Report and send to Manager Finance?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Approve</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-fin-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.approve.manfin')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Approve this Report and send to General Manager?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Approve</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-gm-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.approve.gm')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Approve this Report and send to Direksi/BOD?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Approve</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-approve-bod-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.approve.bod')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Approve this Payroll Report ?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Approve</button>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection