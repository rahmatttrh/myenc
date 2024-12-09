@extends('layouts.app')
@section('title')
Payroll Absence
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         {{-- <li class="breadcrumb-item" aria-current="page">Payroll</li> --}}
         <li class="breadcrumb-item active" aria-current="page">Payslip</li>
      </ol>
   </nav>

   <div class="card">
      <div class="card-header p-2 bg-primary text-white text-uppercase d-flex justify-content-between">
         <h4>Approval Payslip</h4>
         @if(auth()->user()->username == 'EN-2-001' || auth()->user()->hasRole('HRD'))
            <a href="{{route('payroll.approval.manhrd.history')}}" class="badge badge-light">History</a>
            @elseif (auth()->user()->username == '11304')
            <a href="{{route('payroll.approval.manfin.history')}}" class="badge badge-light">History</a>
            @elseif (auth()->user()->username == 'EN-2-006')
            <a href="{{route('payroll.approval.gm.history')}}" class="badge badge-light">History</a>
            @elseif (auth()->user()->username == 'BOD-002')
            <a href="{{route('payroll.approval.bod.history')}}" class="badge badge-light">History</a>
         @endif
         
      </div>
      <div class="card-body p-0">
         <div class="table-responsive">
            <table>
               <thead>
                  <tr>
                     <td colspan="8" class="">Daftar <b>Payslip Report</b> yang membutuhkan validasi anda, klik 'Detail' untuk melakukan validasi.</td>
                     
                  </tr>
                  <tr>
                     <th>#</th>
                     <th>BSU</th>
                     <th>Month</th>
                     <th>Year</th>
                     <th class="text-center">Total Employee</th>
                     <th class="text-right">Total Salary</th>
                     <th class="text-center">Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>

                  @foreach ($unitTransactions as $trans)
                  <tr>
                     <td>{{++$i}}</td>
                     <td>{{$trans->unit->name}}</td>
                     <td>{{$trans->month}}</td>
                     <td>{{$trans->year}}</td>
                     <td class="text-center">{{$trans->total_employee}} / {{count($trans->unit->employees->where('status', 1))}}</td>
                     <td class="text-right">{{formatRupiahB($trans->total_salary)}}</td>
                     <td class="text-center"><x-status.unit-transaction :unittrans="$trans" /></td>
                     <td>
                        <a href="{{route('payroll.transaction.monthly', enkripRambo($trans->id))}}">Detail</a> 
                     </td>
                  </tr>

                  @endforeach
                  
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>




@endsection