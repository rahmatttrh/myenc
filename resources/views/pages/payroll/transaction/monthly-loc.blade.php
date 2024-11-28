@extends('layouts.app')
@section('title')
Payroll Transaction
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll.transaction')}}">Transaction</a></li>
         <li class="breadcrumb-item active" aria-current="page">Monthly Location </li>
      </ol>
   </nav>


   <div class="card">
      <div class="card-header p-3  d-flex justify-content-between">
         <div>
            <h4 class="text-uppercase"><b>{{$unit->name}}</b> {{$unitTransaction->month}} {{$unitTransaction->year}}</h4>
            <h1><b> {{formatRupiahB($unit->getUnitTransaction($unitTransaction)->sum('total'))}}</b></h1>
            <small>STATUS : DRAFT</small> <br>
            
         </div>
         <div>
            <a href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}" class="btn btn-primary"> Submit</a>
            <a href="{{route('payroll.transaction.export', enkripRambo($unitTransaction->id))}}" class="btn btn-light border"><i class="fa fa-file"></i> Export Excel</a>
         </div>
         
          
             
      </div>
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
                        <td class="text-right text-truncate">{{formatRupiahB($loc->getUnitTransaction($unit->id, $unitTransaction)->sum('bruto'))}}</td>

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


   <hr>
   
   
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


@endsection