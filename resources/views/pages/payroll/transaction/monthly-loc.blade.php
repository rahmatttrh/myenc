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
   
   

   <div class="card">
      <div class="card-header p-3  d-flex justify-content-between">
         <div>
            <h4 class="text-uppercase"><b>PAYSLIP {{$unit->name}}</b> {{$unitTransaction->month}} {{$unitTransaction->year}}</h4>
            <small>Status : <span class="text-uppercase"> <x-status.unit-transaction :unittrans="$unitTransaction"/> </span></small> <br>
            
         </div>
         <div class="d-flex">
            <div class="mr-2">   
               <h1> <b>{{formatRupiahB($unit->getUnitTransaction($unitTransaction)->sum('total'))}}</b></h1>
               {{-- @if (auth()->user()->hasRole("HRD|HRD-Payroll") && $unitTransaction->status == 0)
                  <a class="btn btn-primary" href="#" data-target="#modal-submit-tu" data-toggle="modal">Submit</a>
                  <hr>
               @endif --}}
            

            {{-- @if (auth()->user()->hasRole("HRD|HRD-Payroll") && $unitTransaction->status == 5)
                <a href="#" class="btn btn-success btn-block" data-target="#modal-publish-tu" data-toggle="modal">Publish</a>
            @endif --}}

            {{-- @if (auth()->user()->username == '11304' && $unitTransaction->status == 2)
               <a href="#" class="btn btn-primary" data-target="#modal-approve-fin-tu" data-toggle="modal">Approve</a>
               <a href="" class="btn btn-danger">Reject</a>
            @endif --}}

            
            </div>
            
            {{-- <a href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}" class="btn btn-light border"><i class="fa fa-file"></i> Export Report BPJS KT</a>
            <a href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}" class="btn btn-light border"><i class="fa fa-file"></i> Export Report BPJS KS</a>
            <a href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}" class="btn btn-light border"><i class="fa fa-file"></i> Export Excel</a> <br> --}}
            {{-- <a href="#" class="btn btn-primary" data-target="#modal-submit-tu" data-toggle="modal"> Submit</a> --}}
            {{-- <div class="dropdown">
               <button class="btn btn-light border dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 Option
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  
                 
                 <a class="dropdown-item" href="#">Report BPJS KS</a>
                 <a class="dropdown-item" href="#">Report BPJS KT</a>
                 <a class="dropdown-item" href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}">Export </a>
               </div>
            </div> --}}
         </div>
         
          
             
      </div>
      {{-- <div class="card-header">
         <div class="hori-timeline" dir="ltr">
            <ul class="list-inline events">
                
                <li class="list-inline-item event-list">
                    <div class="px-4">
                     
                     @if ($manhrd)
                        <div class="event-date bg-primary text-white">MANAGER HRD</div>
                        <h5 class="font-size-16">{{formatDateTime($manhrd->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">HRD MANAGER</div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                        
                    </div>
                </li>
                <li class="list-inline-item event-list">
                    <div class="px-4">
                     @if ($manfin)
                        <div class="event-date bg-primary text-white">MANAGER FINANCE</div>
                        <h5 class="font-size-16">{{formatDateTime($manfin->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">MANAGER FINANCE</div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                    </div>
                </li>
                <li class="list-inline-item event-list">
                    <div class="px-4">
                     @if ($gm)
                        <div class="event-date bg-primary text-white">GENERAL MANAGER</div>
                        <h5 class="font-size-16">{{formatDateTime($gm->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">GENERAL MANAGER</div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                    </div>
                </li>
                <li class="list-inline-item event-list">
                   <div class="px-4">
                     @if ($bod)
                        <div class="event-date bg-primary text-white">DIREKSI / BOD</div>
                        <h5 class="font-size-16">{{formatDateTime($bod->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">DIREKSI <br><br> </div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                   </div>
               </li>
                
            </ul>
         </div>
      </div> --}}
      <div class="card-body p-0">
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
   </div>


   @if (auth()->user()->username == 'EN-2-001' || auth()->user()->username == '11304' || auth()->user()->username == 'EN-2-006' || auth()->user()->username == 'BOD-002' )
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
                     <th colspan="4" class="bg-white"><img src="{{asset('img/logo/bpjs-kesehatan.png')}}" width="100px" alt=""></th>
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
   @endif
   


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