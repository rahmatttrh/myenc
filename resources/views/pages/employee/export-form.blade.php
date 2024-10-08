@extends('layouts.app')
@section('title')
Export Employee
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
          <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item active" aria-current="page">Export Employee</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-3">
         <form action="{{route('employee.filter')}}" method="POST">
            @csrf
            <div class="form-group form-group-default">
               <label>Bisnis Unit</label>
               {{-- <input id="name" name="name" type="text" class="form-control" placeholder="Fill Name"> --}}
               <select name="unit" id="unit" required class="form-control">
                  <option {{$unit == 'All' ? 'selected' : ''}} value="" disabled>Choose</option>
                  @foreach ($units as $un)
                      <option {{$unit == $un->id ? 'selected' : ''}} value="{{$un->id}}">{{$un->name}}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group form-group-default">
               <label>Lokasi</label>
               {{-- <input id="name" name="name" type="text" class="form-control" placeholder="Fill Name"> --}}
               <select name="loc" id="loc" required class="form-control">
                  <option {{$loc == 'All' ? 'selected' : ''}} value="" disabled>Choose </option>
                  @foreach ($locs as $l)
                      <option {{$loc == $l->code ? 'selected' : ''}} value="{{$l->code}}">{{$l->name}}</option>
                  @endforeach
               </select>
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Gender</label>
                     {{-- <input id="name" name="name" type="text" class="form-control" placeholder="Fill Name"> --}}
                     <select name="gender" id="gender" class="form-control">
                        <option {{$gender == 'All' ? 'selected' : ''}} value="All">All</option>
                        <option {{$gender == 'Male' ? 'selected' : ''}} value="Male">L</option>
                        <option {{$gender == 'Female' ? 'selected' : ''}} value="Female">P</option>
                     </select>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Type</label>
                     {{-- <input id="name" name="name" type="text" class="form-control" placeholder="Fill Name"> --}}
                     <select name="type" id="type" class="form-control">
                        <option {{$type == 'All' ? 'selected' : ''}} value="All">All</option>
                        <option {{$type == 'Kontrak' ? 'selected' : ''}} value="Kontrak">Kontrak</option>
                        <option {{$type == 'Tetap' ? 'selected' : ''}} value="Tetap">Tetap</option>
                     </select>
                  </div>
               </div>
            </div>
            
            <button type="submit" class="btn btn-block btn-primary">Show</button>

         </form>
         <hr>
         @if ($export == true)
         <a href="{{route('export.employee.excel', [$unit, $loc, $gender, $type])}}" target="_blank" class="btn btn-block btn-dark"><i class="fa fa-file-excel"></i> Export</a>
         @endif
         
      </div>
      <div class="col">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     {{-- <th class="text-center">No</th> --}}
                    
                     
                     <th>NIK</th>
                     <th>Name</th>
                     <th class="text-truncate">Bisnis Unit</th>
                     <th>Department</th>
                     <th>Lokasi</th>
                     <th>Gender</th>
                     <th>Type</th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($employees as $employee)
                  <tr>
                     {{-- <td class="text-center">{{++$i}}</td> --}}
                     
                     <td class="text-truncate">{{$employee->contract->id_no}}</td>
                     <td class="text-truncate" style="max-width: 150px">
                        
                           <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])}}"> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a> 
                        
                     </td>
                     
                     
                     
                     <td class="text-truncate">
                        {{-- {{$employee->unit_id}} --}}
                        {{$employee->department->unit->name ?? ''}}
                        
                     </td>
                     
                     <td class="text-truncate">
                        
                        {{$employee->department->name ?? ''}}
                        
                     </td>
                     <td class="text-uppercase">
                        {{$employee->contract->loc}}
                     </td>
                     <td>
                        @if ($employee->biodata->gender == 'Male')
                            L
                            @elseif($employee->biodata->gender == 'Female')
                            P
                        @endif
                        {{-- {{$employee->biodata->gender}} --}}
                     </td>
                     <td>{{$employee->contract->type}}</td>
                     
                  </tr>
                  @endforeach
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
  
</div>

@endsection