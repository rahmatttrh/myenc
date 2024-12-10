@extends('layouts.app')
@section('title')
Payslip PDF
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
         <li class="breadcrumb-item" aria-current="page">Transaction</li>
         <li class="breadcrumb-item active" aria-current="page">Payslip PDF</li>
      </ol>
   </nav>

   <div class="row hide mb-2">
      <div class="col">
         <a href="{{route('payroll.transaction.detail', enkripRambo($transaction->id))}}" class="btn btn-light border" ><i class="fa fa-backward"></i> Back</a>
         <button type="button" class="btn btn-light bolight border" onclick="javascript:window.print();">
            <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
            <i class="fa fa-print"></i>
            Print
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
            <table  class=" table table-sm no-hover" style="border-top: 1px solid rgb(219, 219, 219);">
               <thead>
                  <tr>
                     <th colspan="4" class="bg-white text-center"><b>PT EKANURI</b></th>
                  </tr>
                  <tr style="">
                     <th colspan="4" class="text-center bg-white" style="padding: 1px !important;" >SLIP GAJI</th>
                  </tr>
                  <tr style="">
                     <th colspan="4" class="text-center bg-white text-uppercase" style="padding: 1px !important;" >PERIODE {{$transaction->month}} {{$transaction->year}} </th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td colspan="4" style="padding: 0px !important;" >-</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;">No. Induk</td>
                     <td style="padding: 0px !important;">{{$transaction->employee->nik}}</td>
                     <td style="padding: 0px !important;" >Departement</td>
                     <td style="padding: 0px !important;" >{{$transaction->employee->department->name}}</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;">Nama</td>
                     <td style="padding: 0px !important;">{{$transaction->employee->biodata->fullName()}}</td>
                     <td style="padding: 0px !important;" >Jabatan</td>
                     <td style="padding: 0px !important;" >{{$transaction->employee->position->name}}</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" colspan="3"></td>
                  </tr>
                  
                  

               </tbody>
               
            </table>
            <div class="row">
               <div class="col-8">
                  <table>
                     <tbody>
                        {{-- <tr>
                           <td style="padding: 0px !important;" colspan="8">BAGIAN III : Rincian Iuran bulan ini</td>
                        </tr> --}}
                        <tr>
                           <td style="padding: 0px !important;" colspan="2" class="text-center text-uppercase p-2"><b>Pendapatan</b></td>
                           <td style="padding: 0px !important;" colspan="2" class="text-center text-uppercase p-2"><b>Potongan</b></td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Gaji Pokok</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->employee->payroll->pokok)}}</td>
                           <td style="padding: 0px !important;">Iuran BPJSTK</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->reductions->where('name', 'JHT')->where('type', 'employee')->first()->value)}}</td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Tunj. Jabatan</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->employee->payroll->tunj_jabatan)}}</td>
                           <td style="padding: 0px !important;">Iuran BPJSKesehatan</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->reductions->where('name', 'BPJS KS')->where('type', 'employee')->first()->value)}}</td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Tunj. Operasional</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->employee->payroll->tunj_ops)}}</td>
                           <td style="padding: 0px !important;">Iuran JP</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->reductions->where('name', 'JP')->where('type', 'employee')->first()->value)}}</td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Tunj. Kinerja</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->employee->payroll->tunj_kinerja)}}</td>
                           <td style="padding: 0px !important;">Absensi</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->reduction_absence)}}</td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Insentif</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->employee->payroll->insentif)}}</td>
                           <td style="padding: 0px !important;">Terlambat</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->reduction_late)}}</td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Uang Lembur</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->overtime)}}</td>
                           <td style="padding: 0px !important;">Pin Koperasi</td>
                           <td style="padding: 0px !important;"></td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Lain - Lain</td>
                           <td style="padding: 0px !important;"></td>
                           <td style="padding: 0px !important;">Iuran Sukarela</td>
                           <td style="padding: 0px !important;"></td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Tunjangan Tidak Tetap</td>
                           <td style="padding: 0px !important;"></td>
                           <td style="padding: 0px !important;">Iuran Koperasi ke</td>
                           <td style="padding: 0px !important;"></td>
                        </tr>
                        <tr>
                           <td colspan="4" style="height: 30px"></td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;">Pendapatan</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->overtime + $transaction->employee->payroll->total)}}</td>
                           <td style="padding: 0px !important;">Potongan</td>
                           <td style="padding: 0px !important;">{{formatRupiahB($transaction->reduction + $transaction->reduction_absence + $transaction->late)}}</td>
                        </tr>
                        <tr>
                           <td style="" colspan="4" class="text-center py-2"><b>GAJI BERSIH {{formatRupiah($transaction->total)}} (MANDIRI)</b></td>
                           
                        </tr>
                        
                     </tbody>
                     
                  </table>
               </div>
               <div class="col-4">
                  <table>
                     <tbody>
                        <tr>
                           <td style="padding: 0px !important;" colspan="2" class="text-center text-uppercase p-2"><b>Ketidakhadiran</b></td>
                        </tr>
                        <tr>
                           <td>Izin</td>
                           <td>{{count($izins)}}</td>
                        </tr>
                        <tr>
                           <td>Alpa</td>
                           <td>{{count($alphas)}}</td>
                        </tr>
                        <tr>
                           <td>Terlambat</td>
                           <td>{{count($lates)}}</td>
                        </tr>
                        <tr>
                           <td>-</td>
                        </tr>
                        <tr>
                           <td style="padding: 0px !important;" colspan="2" class="text-center text-uppercase p-2"><b>Lembur</b></td>

                        </tr>
                        <tr>
                           <td>Jml Jam</td>
                           <td>{{$overtimes->sum('hours')}}</td>
                        </tr>
                        <tr>
                           <td>Jml Piket</td>
                           <td>0</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
            
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

{{--  --}}


@endsection