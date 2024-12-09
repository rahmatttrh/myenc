@extends('layouts.app')
@section('title')
Payroll Absence
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item" aria-current="page">Absence</li>
         <li class="breadcrumb-item active" aria-current="page">Approval</li>
      </ol>
   </nav>

   <div class="card">
      <div class="card-header p-2 bg-primary text-white text-uppercase d-flex justify-content-between">
         <h4>Approval Absence</h4>
         {{-- @if(auth()->user()->username == 'EN-2-001' || auth()->user()->hasRole('HRD'))
            <a href="{{route('payroll.approval.manhrd.history')}}" class="badge badge-light">History</a>
            @elseif (auth()->user()->username == '11304')
            <a href="{{route('payroll.approval.manfin.history')}}" class="badge badge-light">History</a>
            @elseif (auth()->user()->username == 'EN-2-006')
            <a href="{{route('payroll.approval.gm.history')}}" class="badge badge-light">History</a>
            @elseif (auth()->user()->username == 'BOD-002')
            <a href="{{route('payroll.approval.bod.history')}}" class="badge badge-light">History</a>
         @endif --}}
         
      </div>
      <div class="card-body p-0">
         <div class="table-responsive">
            <table>
               <thead>
                  <tr>
                     <td colspan="8" class="">Daftar <b>Absensi</b> yang membutuhkan validasi anda, klik 'Detail' untuk melakukan validasi.</td>
                     
                  </tr>
                  <tr>
                     <th>NIK</th>
                     <th>Name</th>
                    <th>Type</th>
                    <th>Date</th>
                    
                    <th></th> 
                 </tr>
               </thead>
               <tbody>

                  @foreach ($absences as $absence)
                  <tr>
                     <td>{{$absence->employee->nik}} </td>
                     <td>{{$absence->employee->biodata->fullName()}}</td>
                    <td>
                       
                           
                        @if ($absence->type == 1)
                          Alpha
                          @elseif($absence->type == 2)
                          Terlambat ({{$absence->minute}} Menit)
                          @elseif($absence->type == 3)
                          ATL
                          @elseif($absence->type == 4)
                          Izin
                        @endif
                        (
                          @if ($absence->status == 404)
                          <span class="text-danger">Request Perubahan 
                           @if ($absence->type_req == 1)
                           Alpha
                           @elseif($absence->type_req == 2)
                           Terlambat ({{$absence->minute}} Menit)
                           @elseif($absence->type_req == 3)
                           ATL
                           @elseif($absence->type_req == 4)
                           Izin
                           @endif
                          </span>
                          @endif
                        )
                       
                    </td>
                    <td>{{formatDate($absence->date)}}</td>
                    
                    <td>
                     <a href="{{route('payroll.absence.edit', enkripRambo($absence->id))}}" class="">Update</a> |
                       <a href="#" data-target="#modal-delete-absence-{{$absence->id}}" data-toggle="modal">Delete</a>
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