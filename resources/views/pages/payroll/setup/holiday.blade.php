@extends('layouts.app')
@section('title')
Libur Nasional
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Setup Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Libur Nasional</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         <h4>Form Add Libur Nasional</h4>
         <hr>
         <form action="{{route('holiday.store')}}" method="POST">
            @csrf
            {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
            <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
            <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input type="date" required class="form-control" id="date" name="date" >
                  </div>
               </div>
            </div>
            
            <div class="form-group form-group-default">
               <label>Type</label>
               <select name="type" id="type" class="form-control">
                  <option value="" disabled selected>Select</option>
                  <option value="1">Libur</option>
                  <option value="2">Libur Nasional</option>
                  <option value="3">Libur Idul Fitri</option>
               </select>
            </div>
            <div class="form-group form-group-default">
               <label>Desc</label>
               <input type="text" required class="form-control" id="desc" name="desc" >
            </div>
            <button class="btn btn-block btn-primary" type="submit">Add</button>
         </form>
      </div>
      <div class="col">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th>Date</th>
                     <th>Type</th>
                     <th>Desc</th>
                     <th></th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($holidays as $holi)
                  <tr>
                      <td style="width: 100px">
                        {{formatDate($holi->date)}}
                      </td>
                      <td>
                        @if ($holi->type == 1)
                            Libur
                            @elseif($holi->type == 2)
                            Libur Nasional
                            @elseif($holi->type == 3)
                            Libur Idul Fitri
                        @endif
                      </td>
                      <td>{{$holi->desc}}</td>
                      <td>
                        <a href="{{route('holiday.delete', enkripRambo($holi->id))}}">Delete</a>
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