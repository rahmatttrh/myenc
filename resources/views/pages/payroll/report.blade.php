@extends('layouts.app')
@section('title')
Payroll Report
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Report</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         <h4>Form Report</h4>
         <hr>
         <form action="{{route('payroll.report.get')}}" method="POST">
            @csrf
            {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
            <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
            <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
            {{-- <div class="form-group form-group-default">
               <label>Unit</label>
               <select class="form-control "  name="unit" id="unit">
                  <option value="" disabled selected>Select</option>
                  @foreach ($units as $unit)
                      <option value="{{$unit->id}}">{{$unit->name}}</option>
                  @endforeach
               </select>
            </div> --}}
            <div class="form-group form-group-default">
               <label>Location</label>
               <select class="form-control " name="location" id="location">
                  <option value="" disabled selected>Select</option>
                  @foreach ($locations as $loc)
                     @if ($location != null)
                     <option {{$location == $loc->id ? 'selected' : ''}}  value="{{$loc->id}}">{{$loc->name}}</option>
                        @else
                        <option  value="{{$loc->id}}">{{$loc->name}}</option>
                     @endif
                      
                  @endforeach
               </select>
               {{-- <input type="number" class="form-control" id="hours" name="hours" > --}}
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Month</label>
                     <select class="form-control " required name="month" id="month">
                        @if ($month != null)
                           <option value="" disabled selected>Select</option>
                           <option {{$month == 'January' ? 'selected' : '' }} value="January">January</option>
                           <option {{$month == 'February' ? 'selected' : '' }} value="February">February</option>
                           <option {{$month == 'March' ? 'selected' : '' }} value="March">March</option>
                           <option {{$month == 'April' ? 'selected' : '' }} value="April">April</option>
                           <option {{$month == 'May' ? 'selected' : '' }} value="May">May</option>
                           <option {{$month == 'June' ? 'selected' : '' }} value="June">June</option>
                           <option {{$month == 'July' ? 'selected' : '' }} value="July">July</option>
                           <option {{$month == 'August' ? 'selected' : '' }} value="August">August</option>
                           <option {{$month == 'September' ? 'selected' : '' }} value="September">September</option>
                           <option {{$month == 'October' ? 'selected' : '' }} value="October">October</option>
                           <option {{$month == 'November' ? 'selected' : '' }} value="November">November</option>
                           <option {{$month == 'December' ? 'selected' : '' }} value="December">December</option>
                           @else
                           <option value="" disabled selected>Select</option>
                           <option value="January">January</option>
                           <option value="February">February</option>
                           <option value="March">March</option>
                           <option value="April">April</option>
                           <option value="May">May</option>
                           <option value="June">June</option>
                           <option value="July">July</option>
                           <option value="August">August</option>
                           <option value="September">September</option>
                           <option value="October">October</option>
                           <option value="November">November</option>
                           <option value="December">December</option>
                        @endif
                        
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Year</label>
                     <select class="form-control " required name="year" id="year">
                        @if ($year != null)
                           <option {{$year == '2023' ? 'selected' : '' }} value="2023">2023</option>
                           <option {{$year == '2024' ? 'selected' : '' }} value="2024">2024</option>
                           <option {{$year == '2025' ? 'selected' : '' }} value="2025">2025</option>
                           @else
                           <option value="" disabled selected>Select</option>
                           <option value="2023">2023</option>
                           <option value="2024">2024</option>
                           <option value="2025">2025</option>
                        @endif
                        
                        
                     </select>
                  </div>
               </div>
            </div>
            
            <button class="btn btn-block btn-primary" type="submit">Get Report</button>
         </form>
      </div>
      <div class="col">
         <h1>{{formatRupiah($transactions->sum('total'))}}</h1>
         <hr>
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  
                  <tr>
                     <th>Employee</th>
                     <th>Location</th>
                     <th>Gaji Bersih</th>
                     {{-- <th>Lembur</th> --}}
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
                     <td class="text-uppercase">{{$trans->location->code}}</td>
                     <td>{{formatRupiah($trans->total)}}</td>
                     {{-- <td>0</td> --}}
                     <td>Draft</td>
                     
                  </tr>
                  @endforeach
                  
                  
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>


@endsection