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
         <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                  <td>Date</td>
                  <td>{{formatDate($absence->date)}}</td>
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

               @if ($absence->status == 404)
               <tr>
                  <td>Status</td>
                  <td>Request perubahan ke 
                     <b>
                     @if ($absence->type_req == 1)
                     Alpha
                     @elseif($absence->type_req == 2)
                     Terlambat ({{$absence->minute}} Menit)
                     @elseif($absence->type_req == 3)
                     ATL
                     @elseif($absence->type_req == 4)
                     Izin
                     @endif
                  </b>
                  </td>
               </tr>
               <tr>
                  <td></td>
                  <td>
                     @if (auth()->user()->hasRole('HRD|HRD-Payroll'))
                        @if ($absence->status == 404)
                           <a href="" class="btn btn-primary btn-sm mb-2" data-target="#modal-approve-hrd-absence" data-toggle="modal">Approve</a>
                           <a href="" class="btn btn-danger btn-sm mb-2" data-target="#modal-reject-hrd-absence" data-toggle="modal">Reject</a>
                        @endif
                           
                        @endif
                  </td>
               </tr>
               @endif
               
               
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

<div class="modal fade" id="modal-approve-hrd-absence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('absence.approve.hrd')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="text" value="{{$absence->id}}" name="absence" id="absence" hidden>
               <span>Approve this Request?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Approve</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-reject-hrd-absence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('absence.reject.hrd')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="text" value="{{$absence->id}}" name="absence" id="absence" hidden>

               {{-- <span>Approve this Request?</span>
               <hr> --}}
               <div class="form-group ">
                  <label>Reject this Request?</label>
                  <input id="desc" name="desc" type="text" required class="form-control" placeholder="Alasan penolakan..">
                  
               </div>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger ">Reject</button>
            </div>
         </form>
      </div>
   </div>
</div>




@endsection