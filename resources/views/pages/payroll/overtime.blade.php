@extends('layouts.app')
@section('title')
Payroll Overtime
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Overtime</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-3">
         <h4>Form SPKL</h4>
         <hr>
         <form action="{{route('payroll.overtime.store')}}" method="POST">
            @csrf
            {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
            <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
            <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
            <div class="form-group form-group-default">
               <label>Employee</label>
               <select class="form-control js-example-basic-single" required name="employee" id="employee">
                  <option value="" disabled selected>Select</option>
                  @foreach ($employees as $emp)
                      <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                  @endforeach
               </select>
               {{-- <input type="number" class="form-control" id="hours" name="hours" > --}}
            </div>
            <div class="form-group form-group-default">
               <label>Date</label>
               <input type="date" required class="form-control" id="date" name="date" >
            </div>
            <div class="form-group form-group-default">
               <label>Hours Type</label>
               <select class="form-control" required name="hours_type" id="hours_type">
                  <option value="" disabled selected>Select</option>
                  <option value="1">Aktual</option>
                  <option value="2">Multiple</option>
               </select>
               {{-- <input type="number" class="form-control" id="hours" name="hours" > --}}
            </div>
            <div class="form-group form-group-default">
               <label>Hours</label>
               <input type="number" required class="form-control" id="hours" name="hours" >
            </div>
            <button class="btn btn-block btn-primary" type="submit">Add</button>
         </form>
      </div>
      <div class="col">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     {{-- <th class="text-center">No</th> --}}
                     <th>NIK</th>
                     <th>Employee</th>
                     <th>Date</th>
                     <th>Type</th>
                     <th>Hours</th>
                     <th>Rate</th>
                     <th></th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($overtimes as $over)
                      <tr>
                        {{-- <td>{{++$i}}</td> --}}
                        <td>{{$over->employee->nik}}</td>
                        <td>{{$over->employee->biodata->fullName()}}</td>
                        <td>{{formatDate($over->date)}}</td>
                        <td>
                           @if ($over->hours_type == 1)
                               Aktual
                               @else
                               Multiple
                           @endif
                        </td>
                        <td>{{$over->hours}}</td>
                        <td>{{formatRupiah($over->rate)}}</td>
                        <td>
                           <a href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a>
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