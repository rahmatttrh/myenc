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
         <li class="breadcrumb-item active" aria-current="page">Monthly Location  </li>
      </ol>
   </nav>


   <div class="card">
      <div class="card-header p-2 bg-primary text-white d-flex justify-content-between">
         <div>
            <h2 class="text-uppercase"><b>{{$unit->name}}</b> </h2>
            <small>{{$unitTransaction->month}} {{$unitTransaction->year}}</small> <br>
            <b>{{formatRupiah(0)}}</b>
         </div>
         <div>
            <a href="" class="btn btn-light">Print Out</a>
         </div>
         
          
             
      </div>
      <div class="card-body p-0">
         <div class="table-responsive" style="overflow-x: auto;">
            <table id="data" class=" table table-sm">
               <thead >
                  <tr class="text-white">
                     <th rowspan="2" class="text-white">Loc</th>
                     <th rowspan="2" class="text-white">Jml Pgw</th>
                     <th rowspan="2" class="text-center text-white">Gaji Bersih</th>
                     <th colspan="8" class="text-center text-white">Pendapatan</th>
                     <th colspan="5" class="text-center text-white">Potongan</th>
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
                     @if ($loc->totalEmployee() > 0)
                     <tr>
                        <td class="text-truncate"><a href="{{route('transaction.location', [enkripRambo($unitTransaction->id), enkripRambo($loc->id)])}}">{{$loc->name}}</a></td>
                        <td class="text-center text-truncate">{{count($loc->payrolls)}} / {{$loc->totalEmployee()}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->transactions->sum('total'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->payrolls->sum('pokok'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->payrolls->sum('tunj_jabatan'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->payrolls->sum('tunj_ops'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->payrolls->sum('tunj_kinerja'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->payrolls->sum('total'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah($loc->overtimes->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->sum('rate'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah(0)}}</td>
                        <td class="text-right text-truncate">{{formatRupiah(0)}}</td>
                        <td class="text-right text-truncate">{{formatRupiah(0)}}</td>
                        
                        <td class="text-right text-truncate">{{formatRupiah($loc->reductions->where('name', 'BPJS KS')->where('month', $unitTransaction->month)->where('year', $unitTransaction->year)->sum('value'))}}</td>
                        <td class="text-right text-truncate">{{formatRupiah(0)}}</td>
                        <td class="text-right text-truncate">{{formatRupiah(0)}}</td>
                        <td class="text-right text-truncate">{{formatRupiah(0)}}</td>
                        
                     </tr>
                     @endif
                  
                  @endforeach
                  
                  
                  
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