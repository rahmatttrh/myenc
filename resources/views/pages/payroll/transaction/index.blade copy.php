@extends('layouts.app')
@section('title')
Payroll Transaction
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Transaction List</li>
      </ol>
   </nav>
   
   <div class="card shadow-none border">
      <div class="card-header">
         <a href="" class="btn btn-primary btn-sm" data-target="#modal-create-transaction" data-toggle="modal">Create Transaction</a>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th class="text-center" style="width: 30px">No</th>
                     {{-- @if (auth()->user()->hasRole('Administrator'))
                     <th>ID</th>
                     @endif --}}
                     <th>Name</th>
                     <th>Month</th>
                     {{-- <th>NIK</th> --}}
                     
                     <th class="text-truncate">Bisnis Unit</th>
                     <th>Pendapatan</th>
                     <th>Gaji Bersih</th>
                     <th>Status</th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($transactions as $trans)
                      <tr>
                        <td class="text-center">{{++$i}}</td>
                        
                        {{-- <td>{{$trans->employee->nik}}</td> --}}
                        <td><a href="{{route('payroll.transaction.detail', enkripRambo($trans->id))}}"> {{$trans->employee->nik}} {{$trans->employee->biodata->fullName()}}</a></td>
                        <td>{{$trans->month}}</td>
                        <td>{{$trans->employee->department->name}}</td>
                        <td>{{formatRupiah($trans->employee->payroll->total)}}</td>
                        <td>{{formatRupiah($trans->total)}}</td>
                        <td>Draft</td>
                      </tr>
                  @endforeach
               </tbody>
               
            </table>
         </div>
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

<div class="modal fade" id="modal-create-transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.transaction.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <div class="row">
                  <div class="col">

                  </div>
               </div>
               <div class="form-group form-group-default">
                  <label>Employee</label>
                  <select class="form-control" name="employee" id="employee" required>
                      <option value="">--- Choose Employe ---</option>
                      @foreach ($employees as $employe)
                          <option value="{{$employe->id}}">{{$employe->nik}} {{$employe->biodata->fullName()}} </option>
                          @endforeach
                      
                  </select>
              </div>
              <small>Daftar Karyawan yang belum memiliki transaksi gaji bulan ini</small>
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Create</button>
            </div>
            
         </form>
      </div>
   </div>
</div>
@endsection