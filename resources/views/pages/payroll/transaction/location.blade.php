@extends('layouts.app')
@section('title')
Payroll Transaction Location
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll.transaction')}}">Transaction</a></li>
         <li class="breadcrumb-item active" aria-current="page">Location</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-3">
         <div class="card shadow-none border card-ligt">
            
            <div class="card-body">
                  <h3 class="text-uppercase">{{$unitTransaction->unit->name}}</h3>
                  
                  <hr class="bg-white">
                  <h4>{{$location->name}}</h4>
                   <h4 class="text-uppercase">{{$unitTransaction->month}} {{$unitTransaction->year}} </h4>
                  
                  
            </div>
         </div>
         <div class="card shadow-none border">
            <div class="card-body">
                  <h3>{{formatRupiahB($location->getUnitTransaction($unitTransaction->unit->id, $unitTransaction)->sum('total'))}}</h3>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  
                  <tr>
                     <th>Employee</th>
                     <th>Pendapatan</th>
                     <th>Gaji Bersih</th>
                     <th>Lembur</th>
                     {{-- <th>BPSJ KT</th> --}}
                     <th>Status</th>
                     {{-- <th>Action</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($transactions as $trans)
                  <tr>
                     <td>
                        <a href="{{route('payroll.transaction.detail', enkripRambo($trans->id))}}">{{$trans->employee->nik}} {{$trans->employee->biodata->fullName()}}</a>
                        
                     </td>
                     <td>{{formatRupiahB($trans->employee->payroll->total)}}</td>
                     <td>{{formatRupiahB($trans->total)}}</td>
                     <td>{{formatRupiahB($trans->overtime)}}</td>
                     {{-- <td>{{formatRupiah($trans->getBpjsKt())}}</td> --}}
                     <td>Draft</td>
                     
                  </tr>
                  @endforeach
                  
                  
                  
               </tbody>
            </table>
         </div>
         <hr>
         
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


@endsection