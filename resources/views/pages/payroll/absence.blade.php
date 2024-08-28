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
         <li class="breadcrumb-item active" aria-current="page">Absence</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         <h4>Form Absence</h4>
         <hr>
         <form action="{{route('payroll.absence.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
            <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
            <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
            <div class="form-group form-group-default">
               <label>Employee</label>
               <select class="form-control js-example-basic-single" style="width: 100%" required name="employee" id="employee">
                  <option value="" disabled selected>Select</option>
                  @foreach ($employees as $emp)
                      <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                  @endforeach
               </select>
               {{-- <input type="number" class="form-control" id="hours" name="hours" > --}}
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input type="date" required class="form-control" id="date" name="date" >
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Type</label>
                     <select class="form-control " required name="type" id="type">
                        <option value="" disabled selected>Select</option>
                        <option value="1">Ketidakhadiran</option>
                        <option value="2">Keterlambatan</option>
                        <option value="3">Cuti/Ijin/Sakit</option>
                     </select>
                  </div>
               </div>
            </div>
            {{-- <div class="row">
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Hours Type</label>
                     <select class="form-control"  name="hours_type" id="hours_type">
                        <option value="" disabled selected>Select</option>
                        <option value="1">Aktual</option>
                        <option value="2">Multiple</option>
                     </select>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Hours</label>
                     <input type="number"  class="form-control" id="hours" name="hours" >
                  </div>
               </div>
            </div> --}}
            
            <div class="form-group form-group-default">
               <label>Desc</label>
               <input type="text" required class="form-control" id="desc" name="desc" >
            </div>
         
            <div class="form-group form-group-default">
               <label>Document</label>
               <input type="file"  class="form-control" id="doc" name="doc" >
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
                     {{-- <th>Type</th> --}}
                     <th>Hours</th>
                     <th>Rate</th>
                     <th></th>
                  </tr>
               </thead>
               
               <tbody>
                  {{-- @foreach ($overtimes as $over)
                      <tr>
                        <td>{{$over->employee->nik}}</td>
                        <td>{{$over->employee->biodata->fullName()}}</td>
                        <td>
                           <a href="#" data-target="#modal-overtime-doc-{{$over->id}}" data-toggle="modal">{{formatDate($over->date)}}</a>
                           
                           @foreach ($holidays as $holi)
                               @if ($holi->date == $over->date)
                                 @if ($holi->type == 1)
                                 <span class="badge badge-info">i</span>
                                 @elseif($holi->type == 2)
                                 <span class="badge badge-warning">i</span>
                                 @else
                                 <span class="badge badge-danger">i</span>
                                 @endif
                               @endif
                           @endforeach
                        </td>
                        
                        <td>{{$over->hours}} (
                           @if ($over->hours_type == 1)
                               Aktual
                               @else
                               Multiple
                           @endif
                        )</td>
                        <td>{{formatRupiah($over->rate)}}</td>
                        <td>
                           <a href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a>
                        </td>
                      </tr>
                  @endforeach --}}
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>


{{-- @foreach ($overtimes as $over)
<div class="modal fade" id="modal-overtime-doc-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Document SPKL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="modal-body">

         <iframe src="{{asset('storage/' . $over->doc)}}" frameborder="0" style="width:100%"  height="500px"></iframe>
        </div>
      </div>
   </div>
</div>
@endforeach --}}


@endsection