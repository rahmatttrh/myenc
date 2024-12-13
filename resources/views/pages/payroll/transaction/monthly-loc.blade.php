@extends('layouts.app')
@section('title')
Payroll Transaction
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

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         @if (auth()->user()->username == 'EN-2-001' || auth()->user()->username == '11304' || auth()->user()->username == 'EN-2-006' || auth()->user()->username == 'BOD-002' )
         @else
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll.transaction.monthly.all', enkripRambo($unitTransaction->id))}}">Transaction</a></li>
         @endif
         <li class="breadcrumb-item" aria-current="page">{{$unit->name}}</li>
         <li class="breadcrumb-item " aria-current="page">{{$unitTransaction->month}}</li>
         <li class="breadcrumb-item active" aria-current="page">Payslip Report </li>
      </ol>
   </nav>
   
   <div class="d-flex">
      @if (auth()->user()->username == 'EN-2-001'  )
      <a href="{{route('payroll.approval.hrd', enkripRambo($unitTransaction->id))}}" class="btn btn-light border mb-2  mr-2 "><i class="fa fa-backward"></i> Back</a>
      @elseif (auth()->user()->username == '11304' )
      <a href="{{route('payroll.approval.manfin', enkripRambo($unitTransaction->id))}}" class="btn btn-light border mb-2  mr-2 "><i class="fa fa-backward"></i> Back</a>
      @elseif (auth()->user()->username == 'EN-2-006' )
      <a href="{{route('payroll.approval.gm', enkripRambo($unitTransaction->id))}}" class="btn btn-light border mb-2  mr-2 "><i class="fa fa-backward"></i> Back</a>
      @elseif ( auth()->user()->username == 'BOD-002' )
      <a href="{{route('payroll.approval.bod', enkripRambo($unitTransaction->id))}}" class="btn btn-light border mb-2  mr-2 "><i class="fa fa-backward"></i> Back</a>
      
      @else
      <a href="{{route('payroll.transaction.monthly.all', enkripRambo($unitTransaction->id))}}" class="btn btn-light border mb-2  mr-2 "><i class="fa fa-backward"></i> Back</a>
      @endif

      
      <a class="btn  btn-light border mb-2" href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}"><i class="fa fa-file"></i> Export to Excel</a>
      
      {{-- Action Approval --}}
      @if (auth()->user()->username == 'EN-2-001' && $unitTransaction->status == 1)
      <div class="btn-group ml-2">
         <a href="#" class="btn btn-primary  mb-2 " data-target="#modal-approve-hrd-tu" data-toggle="modal">Approve</a>
         <a href="" class="btn btn-danger  mb-2">Reject</a>
      </div>
      @endif
      @if (auth()->user()->username == '11304' && $unitTransaction->status == 2)
      <div class="btn-group ml-2 mb-2">
         <a href="#" class="btn btn-primary" data-target="#modal-approve-fin-tu" data-toggle="modal">Approve</a>
         <a href="" class="btn btn-danger">Reject</a>
      </div>
      @endif

      @if (auth()->user()->username == 'EN-2-006' && $unitTransaction->status == 3)
      <div class="btn-group ml-2 mb-2">
         <a href="#" class="btn btn-primary" data-target="#modal-approve-gm-tu" data-toggle="modal">Approve</a>
         <a href="" class="btn btn-danger">Reject</a>
      </div>
      @endif

      @if (auth()->user()->username == 'BOD-002' && $unitTransaction->status == 4)
      <div class="btn-group ml-2 mb-2">
         <a href="#" class="btn btn-primary" data-target="#modal-approve-bod-tu" data-toggle="modal">Approve</a>
         <a href="" class="btn btn-danger">Reject</a>
      </div>
      @endif
   </div>
   

   <div class="card card-with-nav shadow-none border">
      <div class="card-header  d-flex justify-content-between ">
         <div class="mt-3">
            <h2 class="text-uppercase"><b>PAYSLIP REPORT </b> <br> {{$unit->name}} {{$unitTransaction->month}} {{$unitTransaction->year}} </h2>
            
            
         </div>
         
         <div class="text-right">
            <h2 class="mt-3"> <b>{{formatRupiahB($unit->getUnitTransaction($unitTransaction)->sum('total'))}}</b></h2>
            <small>Status : <span class="text-uppercase"> <x-status.unit-transaction :unittrans="$unitTransaction"/> </span></small>
         </div>
         
      </div>
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link show active" id="pills-payslip-tab-nobd" data-toggle="pill" href="#pills-payslip-nobd" role="tab" aria-controls="pills-payslip-nobd" aria-selected="true">Payslip Report</a> </li>
               @if (auth()->user()->username == 'EN-2-001' || auth()->user()->username == '11304' || auth()->user()->username == 'EN-2-006' || auth()->user()->username == 'BOD-002' )
               <li class="nav-item"> <a class="nav-link " id="pills-ks-tab-nobd" data-toggle="pill" href="#pills-ks-nobd" role="tab" aria-controls="pills-ks-nobd" aria-selected="true">BPJS Kesehatan</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-kt-tab-nobd" data-toggle="pill" href="#pills-kt-nobd" role="tab" aria-controls="pills-kt-nobd" aria-selected="true">BPJS Ketenagakerjaan</a> </li>
               @endif
            </ul>
         </div>
      </div>
      <div class="card-body">
         <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">

            <div class="tab-pane fade show active p-0" id="pills-payslip-nobd" role="tabpanel" aria-labelledby="pills-payslip-tab-nobd">
               {{-- <div class="mb-2">
                  
               </div> --}}
               <div class="table-responsive" style="overflow-x: auto;">
                  <table id="data" class=" table table-sm">
                     <thead >
                        <tr class="text-white">
                           <th rowspan="2" class="text-white">Loc</th>
                           <th rowspan="2" class="text-white">Jml Pgw</th>
                           
                           <th colspan="8" class="text-center text-white">Pendapatan</th>
                           <th colspan="5" class="text-center text-white">Potongan</th>
                           <th rowspan="2" class="text-center text-white">Gaji Bersih</th>
                        </tr>
                        <tr>
                           <th class="text-center text-white">Gaji Pokok</th>
                           <th class="text-center text-white">Tunj. Jabatan</th>
                           <th class="text-center text-white">Tunj. OPS</th>
                           <th class="text-center text-white">Tunj. Kinerja</th>
                           <th class="text-center text-white">Total Gaji</th>
                           <th class="text-center text-white">Lembur</th>
                           <th class="text-center text-white">Lain-Lain</th>
                           <th class="text-center text-white">Total Bruto</th>
                           <th class="text-center text-white">BPJS TK</th>
                           <th class="text-center text-white">BPJS KS</th>
                           <th class="text-center text-white">JP</th>
                           <th class="text-center text-white">Absen</th>
                           <th class="text-center text-white">Terlambat</th>
                           
                        </tr>
                     </thead>
      
                     <tbody>
                        @foreach ($locations as $loc)
                           @if ($loc->totalEmployee($unit->id) > 0)
                           <tr>
                              <td class="text-truncate"><a href="{{route('transaction.location', [enkripRambo($unitTransaction->id), enkripRambo($loc->id)])}}">{{$loc->name}}</a></td>
                              <td class="text-center text-truncate">{{count($loc->getUnitTransaction($unit->id, $unitTransaction))}}</td>
                              
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getValue($unit->id, $unitTransaction, 'Gaji Pokok'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getValue($unit->id, $unitTransaction,  'Tunj. Jabatan'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getValue($unit->id, $unitTransaction, 'Tunj. OPS'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getValue($unit->id, $unitTransaction, 'Tunj. Kinerja'))}}</td>
      
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getValueGaji($unit->id, $unitTransaction))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime'))}}</td>
                              <td class="text-right text-truncate">0</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getValueGaji($unit->id, $unitTransaction) + $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime'))}}</td>
      
                              {{-- Potongan --}}
                              <td class="text-right text-truncate">{{formatRupiahB(2/100 * $loc->getValueGaji($unit->id, $unitTransaction))}}</td>
                              
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getReduction($unit->id, $unitTransaction, 'BPJS KS'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getReduction($unit->id, $unitTransaction, 'JP'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_absence'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_late'))}}</td>
                              <td class="text-right text-truncate">{{formatRupiahB($loc->getUnitTransaction($unit->id, $unitTransaction)->sum('total'))}}</td>
                           </tr>
                           @endif
                        
                        @endforeach
      
                        @php
                           $totalPokok = 0;
                           $totalJabatan = 0;
                           $totalOps = 0;
                           $totalKinerja = 0;
                           $totalGaji = 0;
                           $totalOvertime = 0;
                           $totalBruto = 0;
                           $totalTk = 0;
                           $totalKs = 0;
                           $totalJp = 0;
                           $totalAbsence = 0;
                           $totalLate = 0;
                           $totalGrand = 0;
      
                           // $totalJabatan = 0;
                           foreach($locations as $loc){
                              $pokok =  $loc->getValue($unit->id, $unitTransaction, 'Gaji Pokok');
                              $jabatan = $loc->getValue($unit->id, $unitTransaction,  'Tunj. Jabatan');
                              $ops = $loc->getValue($unit->id, $unitTransaction, 'Tunj. OPS');
                              $kinerja = $loc->getValue($unit->id, $unitTransaction, 'Tunj. Kinerja');
                              $gaji = $loc->getValueGaji($unit->id, $unitTransaction);
                              $overtime = $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('overtime');
                              $bruto = $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('bruto');
                              $tk = 2/100 * $loc->getValueGaji($unit->id, $unitTransaction);
                              $ks = $loc->getReduction($unit->id, $unitTransaction, 'BPJS KS');
                              $jp = $loc->getReduction($unit->id, $unitTransaction, 'JP');
                              $abs = $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_absence');
                              $late = $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('reduction_late');
                              $total = $loc->getUnitTransaction($unit->id, $unitTransaction)->sum('total');
      
                              $totalPokok += $pokok;
                              $totalJabatan += $jabatan;
                              $totalOps += $ops;
                              $totalKinerja += $kinerja;
                              $totalGaji += $gaji;
                              $totalOvertime += $overtime;
                              $totalBruto += $bruto;
                              $totalTk += $tk;
                              $totalKs += $ks;
                              $totalJp += $jp;
                              $totalAbsence += $abs;
                              $totalLate += $late;
                              $totalGrand += $total;
      
                           }
      
                        @endphp
                        <tr>
                           <td colspan="2" class="text-right"><b> Total</b></td>
                           {{-- <td><b></b></td> --}}
                           <td class="text-right text-truncate"><b> {{formatRupiahB($totalPokok)}}</b></b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalJabatan)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalOps)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalKinerja)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalGaji)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalOvertime)}}</b></td>
                           <td class="text-right text-truncate"><b>0</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalBruto)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalTk)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalKs)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalJp)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalAbsence)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalLate)}}</b></td>
                           <td class="text-right text-truncate"><b>{{formatRupiahB($totalGrand)}}</b></td>
                        </tr>
                        
                        
                        
                     </tbody>
                  </table>
               </div>
               
            </div>

            <div class="tab-pane fade " id="pills-ks-nobd" role="tabpanel" aria-labelledby="pills-ks-tab-nobd">
               @if (auth()->user()->username == 'EN-2-001' || auth()->user()->username == '11304' || auth()->user()->username == 'EN-2-006' || auth()->user()->username == 'BOD-002' )
   
               <table  >
                  <thead>
                     <tr>
                        <th colspan="4" class="bg-white p-2"><img src="{{asset('img/logo/bpjsks.png')}}" width="150px" alt=""></th>
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
                        
                        $total = 0;
                        $totalAdditional = 0;
                     @endphp
                     @foreach ($locations as $loc)
                        @if ($loc->totalEmployee($unitTransaction->unit->id) > 0)
                        <tr>
                           <td rowspan="2"></td>
                           <td rowspan="2">{{$loc->name}}</td>
                           <td>Jaminan Kesehatan</td>
                           <td>5,00%</td>
                           <td>{{count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction))}}</td>
                           <td class="text-right" >{{formatRupiahB($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'BPJS KS', 'company'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'BPJS KS', 'employee'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'BPJS KS', 'company')+$loc->getDeduction($unitTransaction, 'BPJS KS', 'employee'))}}</td>
                        </tr>
                        <tr>
                           {{-- <td></td> --}}
                           <td>Iuran Tambahan</td>
                           <td>1%</td>
                           <td>-</td>
                           <td></td>
                           <td></td>
                           <td class="text-right"> {{formatRupiahB($loc->getDeductionAdditional($unitTransaction, 'employee'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeductionAdditional($unitTransaction, 'employee'))}}</td>
                        </tr>
                        @php
                           
                           $total += $loc->getDeduction($unitTransaction, 'BPJS KS', 'company')+$loc->getDeduction($unitTransaction, 'BPJS KS', 'employee');
                           $totalAdditional += $loc->getDeductionAdditional($unitTransaction, 'employee');
                        @endphp
                        @endif
                     @endforeach
                     
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
                        <td class="text-right">{{formatRupiahB($total + $totalAdditional)}}</td>
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
                        <td>@if ($manFin)
                           {{$manFin->employee->biodata->fullName()}}
                           
                        @endif</td>
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
               @endif
            </div>

            <div class="tab-pane fade " id="pills-kt-nobd" role="tabpanel" aria-labelledby="pills-kt-tab-nobd">
               
               <table  >
                  <thead>
                     <tr>
                        <th colspan="4" class="bg-white px-2 py-2"><img src="{{asset('img/logo/bpjskt.png')}}" width="150px" alt=""></th>
                     </tr>
                     <tr style="padding: 0px!">
                        <th colspan="4" class="text-center bg-white p0" style="padding: 0px !important;" >RINCIAN IURAN</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td colspan="4" style="padding: 0px !important;" class="bg-success" >BAGIAN I - Perusahaan</td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;" class="text-center">1</td>
                        <td style="padding: 0px !important;">NAMA INSTANSI/BADAN/PERUSAHAAN</td>
                        <td style="padding: 0px !important;" colspan="2">PT EKA NURI</td>
                     </tr>
                     {{-- <tr>
                        <td style="padding: 0px !important;"></td>
                        <td style="padding: 0px !important;">KODE BADAN USAHA</td>
                        <td style="padding: 0px !important;" colspan="2">01143486</td>
                     </tr> --}}
                     <tr>
                        <td style="padding: 0px !important;"></td>
                        <td style="padding: 0px !important;">ALAMAT</td>
                        <td style="padding: 0px !important;" colspan="2">Jl. Hayam Wuruk No. 2XX, Jakarta Pusat</td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;"></td>
                        <td style="padding: 0px !important;">Nomor Pendaftaran Perusahan (NPP) </td>
                        <td style="padding: 0px !important;" colspan="2">JJ001456</td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important; height: 20px" colspan="3" ></td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;" class="text-center">2</td>
                        <td style="padding: 0px !important;">Iuran untuk bulan / thn</td>
                        <td style="padding: 0px !important;"colspan="2" class="text-uppercase">{{$reportBpjsKt->month}} 2024</td>
                     </tr>
                    
                     <tr>
                        <td style="padding: 0px !important;" class="text-center">3</td>
                        <td style="padding: 0px !important;">Iuran disetor melalui  </td>
                        <td style="padding: 0px !important;" colspan="2">Bank MANDIRI</td>
                     </tr>
                     {{-- <tr>
                        <td style="padding: 0px !important;" colspan="4">-</td>
                     </tr> --}}
                     <tr>
                        <td style="padding: 0px !important;" colspan="4" class="bg-success">BAGIAN II : Rekapitulasi tenaga kerja dan upah</td>
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
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">A</td>
                        <td style="padding: 0px !important;">Bulan lalu</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">B</td>
                        <td style="padding: 0px !important;">Penambahan tenaga kerja</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">C</td>
                        <td style="padding: 0px !important;">Pengurangan tenaga kerja</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">D</td>
                        <td style="padding: 0px !important;">Perubahan Upah</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;"  class="text-center"></td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right"></td>
                     </tr>
                     <tr>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">E</td>
                        <td style="padding: 0px !important;">Jumlah (A+B+C)</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-center">0</td>
                        <td style="padding: 0px !important;" style="padding: 0px !important;" class="text-right">0</td>
                     </tr>
                     
   
                  </tbody>
                  
               </table>
               <table>
                  <tbody>
                     <tr>
                        <td style="padding: 0px !important;" colspan="9" class="bg-success">BAGIAN III : Rincian Iuran bulan ini</td>
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
                         
                        
   
                         $total = 0;
                         $totalAdditional = 0;
                         $page = 1;
                     @endphp
                     @foreach ($locations as $loc)
                        {{-- $totalEmployee = 0;
                        $totalUpah = 0;
                        $totalIuranPerusahaan = 0;
                        $totalIuranKaryawan = 0; --}}
                        
                        @if ($loc->totalEmployee($unitTransaction->unit->id) > 0)
                        <tr>
                           <td rowspan="5" class="text-center">{{++$page}}</td>
                           <td rowspan="5"  class="text-center">{{$loc->name}}</td>
                           <td>Jaminan Kecelakaan Kerja (JKK)</td>
                           <td  class="text-center">{{$unitTransaction->unit->reductions->where('name', 'JKK')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKK')->first()->employee}} %</td>
                           <td  class="text-center">{{count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction))}}</td>
                           <td class="text-right" >{{formatRupiahB($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JKK', 'company'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JKK', 'employee'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JKK', 'company')+$loc->getDeduction($unitTransaction, 'JKK', 'employee'))}}</td>
                        </tr>
                        <tr>
                           {{-- <td rowspan="5"></td>
                           <td rowspan="5"  class="text-center">{{$loc->name}}</td> --}}
                           <td>Jaminan Hari Tua (JHT)</td>
                           <td  class="text-center">{{$unitTransaction->unit->reductions->where('name', 'JHT')->first()->company + $unitTransaction->unit->reductions->where('name', 'JHT')->first()->employee}} %</td>
                           <td  class="text-center">{{count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction))}}</td>
                           <td class="text-right" >{{formatRupiahB($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JHT', 'company'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JHT', 'employee'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JHT', 'company')+$loc->getDeduction($unitTransaction, 'JHT', 'employee'))}}</td>
                        </tr>
                        <tr>
                           {{-- <td rowspan="5"></td>
                           <td rowspan="5"  class="text-center">{{$loc->name}}</td> --}}
                           <td>Jaminan Kematian (JKM)</td>
                           <td  class="text-center">{{$unitTransaction->unit->reductions->where('name', 'JKM')->first()->company + $unitTransaction->unit->reductions->where('name', 'JKM')->first()->employee}} %</td>
                           <td  class="text-center">{{count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction))}}</td>
                           <td class="text-right" >{{formatRupiahB($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JKM', 'company'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JKM', 'employee'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JKM', 'company')+$loc->getDeduction($unitTransaction, 'JKM', 'employee'))}}</td>
                        </tr>
                        <tr>
                           {{-- <td rowspan="5"></td>
                           <td rowspan="5"  class="text-center">{{$loc->name}}</td> --}}
                           <td>Jaminan Pensiun</td>
                           <td  class="text-center">{{$unitTransaction->unit->reductions->where('name', 'JP')->first()->company + $unitTransaction->unit->reductions->where('name', 'JP')->first()->employee}} %</td>
                           <td  class="text-center">{{count($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction))}}</td>
                           <td class="text-right" >{{formatRupiahB($loc->getUnitTransaction($unitTransaction->unit_id, $unitTransaction)->sum('total'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JP', 'company'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JP', 'employee'))}}</td>
                           <td class="text-right">{{formatRupiahB($loc->getDeduction($unitTransaction, 'JP', 'company')+$loc->getDeduction($unitTransaction, 'JP', 'employee'))}}</td>
                        </tr>
   
                        @php
                            $totalIuranPerusahaan = $loc->getDeduction($unitTransaction, 'JKK', 'company') + $loc->getDeduction($unitTransaction, 'JHT', 'company') + $loc->getDeduction($unitTransaction, 'JKM', 'company') + $loc->getDeduction($unitTransaction, 'jp', 'company');
                            $totalIuranKaryawan = $loc->getDeduction($unitTransaction, 'JKK', 'employee') + $loc->getDeduction($unitTransaction, 'JHT', 'employee') + $loc->getDeduction($unitTransaction, 'JKM', 'employee') + $loc->getDeduction($unitTransaction, 'jp', 'employee');
                              $grandTotal =  $totalIuranPerusahaan + $totalIuranKaryawan;
                        @endphp
   
                        <tr>
                           {{-- <td></td> --}}
                           <td>Jumlah (a+b+c+d)</td>
                           <td  class="text-center">1%</td>
                           <td  class="text-center">-</td>
                           <td></td>
                           <td class="text-right"> {{formatRupiahB($totalIuranPerusahaan)}}</td>
                           <td class="text-right"> {{formatRupiahB($totalIuranKaryawan)}}</td>
                           <td class="text-right">{{formatRupiahB($grandTotal)}}</td>
                        </tr>
                        @php
                            
                            $total += $grandTotal;
                        @endphp
                        @endif
   
                     @endforeach
                     
                     <tr>
                        <td colspan="9" class="bg-success">BAGIAN IV - Jumlah Seluruhnya</td>
                        
                     </tr>
                     <tr>
                        <td></td>
                        <td colspan="3">Jumlah seluruhnya (III-IV+V)</td>
                        
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-right">{{formatRupiahB($total)}}</td>
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
               
            </div>

            <div class="tab-pane fade " id="pills-allowances-nobd" role="tabpanel" aria-labelledby="pills-allowances-tab-nobd">
               
            </div>

            <div class="tab-pane fade " id="pills-commissions-nobd" role="tabpanel" aria-labelledby="pills-commissions-tab-nobd">
               
            </div>


         </div>

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

<div class="modal fade" id="modal-publish-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.publish')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Publish PaySlip dan tampilkan di Dashboard Karyawan?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Publish</button>
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
               <span>Approve this Payslip Report and send to General Manager?</span>
                  
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