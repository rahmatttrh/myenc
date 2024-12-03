@extends('layouts.app')
@section('title')
Payroll Employee
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Payroll</li>
      </ol>
   </nav>
   {{-- <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>
   <hr> --}}

    <div class="card border shadow-none">
        <div class="card-header d-flex justify-content-between">
            <h2>Payroll / Slip Gaji</h2>
            {{-- <div>
               <a href="{{route('task.history')}}" class="btn btn-light border btn-sm">History</a>
               <a href="{{route('task.create')}}" class="btn btn-primary btn-sm">Add New Task</a>
            </div> --}}
        </div>
        
        
        <div class="card-body p-0 pt-3">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th>NIK</th>
                     <th>Name</th>
                     <th>Loc</th>
                     <th class="text-right">Pendapatan</th>
                     <th class="text-right">Lembur</th>
                     <th class="text-right">Gaji Bersih</th>
                     
                     <th>Status</th>
                     {{-- <th>Action</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($transactions as $trans)
                  <tr>
                     <td>
                        <a href="{{route('payroll.transaction.detail', enkripRambo($trans->id))}}">{{$trans->employee->nik}} </a>
                        
                     </td>
                     <td>{{$trans->employee->biodata->fullName()}}</td>
                     <td>{{$trans->location->name}}</td>
                     <td class="text-right" >{{formatRupiahB($trans->employee->payroll->total)}}</td>
                     <td class="text-right" >{{formatRupiahB($trans->overtime)}}</td>
                     <td class="text-right">{{formatRupiahB($trans->total)}}</td>
                     {{-- <td>0</td> --}}
                     <td><x-status.transaction :trans="$trans" /> </td>
                     
                  </tr>
                  @endforeach
                  
                  
                  
               </tbody>
            </table>
        </div>
        </div>
        <div class="card-footer text-muted">
            <small>Data Task List dapat dilihat oleh atasan untuk tujuan monitoring pekerjaan</small>
        </div>
    </div>
   
   
</div>





@endsection