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
         <li class="breadcrumb-item" aria-current="page">Transaction</li>
         <li class="breadcrumb-item active" aria-current="page">PDF</li>
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
                     <th colspan="4" class="bg-white">Payslip</th>
                  </tr>
                  <tr style="padding: 0px!">
                     <th colspan="4" class="text-center bg-white p0" style="padding: 0px !important;" >RINCIAN IURAN</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td colspan="4" style="padding: 0px !important;" >BAGIAN I - Perusahaan</td>
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
                     <td style="padding: 0px !important;"colspan="2">NOVEMBER 2024</td>
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
                     <td style="padding: 0px !important;" style="padding: 0px !important;">152</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">993884848</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">B</td>
                     <td style="padding: 0px !important;">Penambahan tenaga kerja</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">2</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">444646</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">C</td>
                     <td style="padding: 0px !important;">Pengurangan tenaga kerja</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">152</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">993884848</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">D</td>
                     <td style="padding: 0px !important;">Perubahan Upah</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;"></td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">E</td>
                     <td style="padding: 0px !important;">Jumlah (A+B+C)</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">157</td>
                     <td style="padding: 0px !important;" style="padding: 0px !important;">209883883</td>
                  </tr>
                  

               </tbody>
               
            </table>
            <table>
               <tbody>
                  <tr>
                     <td style="padding: 0px !important;" colspan="8">BAGIAN III : Rincian Iuran bulan ini</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" colspan="5">Program</td>
                     <td style="padding: 0px !important;">Perusahaan</td>
                     <td style="padding: 0px !important;">Karyawan</td>
                     <td style="padding: 0px !important;">-</td>
                  </tr>
                  <tr>
                     <td style="padding: 0px !important;" colspan="2">(1)</td>
                     <td style="padding: 0px !important;">% Iuran</td>
                     <td style="padding: 0px !important;">Jmlh Peg</td>
                     <td style="padding: 0px !important;">Total Upah</td>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;"></td>
                     <td style="padding: 0px !important;"></td>
                  </tr>
                  <tr>
                     <td></td>
                     <td>Iuran Ekanuri HW (612312444)</td>
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
                  </tr>
                  <tr>
                     <td></td>
                     <td>TOTAL/td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
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

{{--  --}}


@endsection