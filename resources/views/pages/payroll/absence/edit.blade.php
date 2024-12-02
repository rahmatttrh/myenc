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
         <li class="breadcrumb-item " aria-current="page">Absence</li>
         <li class="breadcrumb-item active" aria-current="page">Eidt</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         <table class=" table-sm p-0">
            <thead>
               <tr>
                   <th colspan="2">Detail Absence</th>
                  
               </tr>
            </thead>
      
            <tbody>
               <tr>
                  <td>NIK</td>
                  <td>{{$absence->employee->nik}}</td>
               </tr>
               <tr>
                  <td>Name</td>
                  <td>{{$absence->employee->biodata->fullName()}}</td>
               </tr>
               <tr>
                  <td>Type</td>
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
                  </td>
               </tr>
               <tr>
                  <td>Date</td>
                  <td>{{formatDate($absence->date)}}</td>
               </tr>
            </tbody>
      
         </table>
         <hr>
         <span class="badge badge-info mb-2">Form Update</span>
         <form action="{{route('payroll.absence.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="number" name="absenceId" id="absenceId" value="{{$absence->id}}" hidden>
            <div class="form-group form-group-default">
               <label>Type</label>
               <select class="form-control" required name="type" id="type">
                  <option value="" disabled selected>Select</option>
                  <option value="1">Alpha</option>
                  <option value="2">Terlambat</option>
                  <option value="3">ATL</option>
                  <option value="4">Izin</option>
               </select>
            </div>
            <div class="form-group form-group-default">
               <label>Evidence</label>
               <input type="file" required class="form-control" id="evidence" name="evidence">
            </div>
            <button type="submit" class="btn btn-ligh border">Update</button>

            
         </form>
      </div>
      <div class="col-md-8">
         <iframe src="{{asset('storage/' . $absence->doc)}}" width="100%" height="500px" scrolling="auto" frameborder="0"></iframe>
      </div>
   </div>


   


</div>




@endsection