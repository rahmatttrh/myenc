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

   <div class="card shadow-none border col-md-12">
      <div class=" card-header">
         <x-absence-tab :activeTab="request()->route()->getName()" />
      </div>

      <div class="card-body px-0">

         <div class="row">
            <!-- Filter Table -->
            <div class="col-md-3">
                <h4>Form Filter Data</h4>
                <hr>
                <form action="{{route('payroll.absence.filter')}}" method="POST">
                    @csrf
                    <div class="row">
  
                       <div class="col-md-12">
                          <div class="form-group form-group-default">
                             <label>From</label>
                             <input type="date" name="from" id="from" value="{{$from}}" class="form-control">
                          </div>
                       </div>
                       <div class="col-md-12">
                          <div class="form-group form-group-default">
                             <label>To</label>
                             <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                          </div>
                       </div>
                       <div class="col">
                          <button class="btn btn-primary" type="submit">Filter</button>
                       </div>
                    </div>
  
                    <!--  End Filter Table  -->
                 </form>
            </div>
            <div class="col">
               
               <div class="table-responsive p-0">
                  <table id="data" class="display basic-datatables table-sm p-0">
                     <thead>
                        <tr>
                            <th>Employee</th>
                           <th>Type</th>
                           <th>Date</th>
                           
                           <th></th>
                        </tr>
                     </thead>

                     <tbody>
                        @foreach ($absences as $absence)
                        <tr>
                            <td>{{$absence->employee->nik}} {{$absence->employee->biodata->fullName()}}</td>
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
                           <td>{{formatDate($absence->date)}}</td>
                           
                           <td>
                            <a href="{{route('payroll.absence.edit', enkripRambo($absence->id))}}" class="">Update</a> |
                              <a href="#" data-target="#modal-delete-absence-{{$absence->id}}" data-toggle="modal">Delete</a>
                           </td>
                        </tr>

                        <div class="modal fade" id="modal-delete-absence-{{$absence->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content text-dark">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body ">
                                    Delete data
                                    @if ($absence->type == 1)
                                    Alpha
                                    @elseif($absence->type == 2)
                                    Terlambat ({{$absence->minute}})
                                    @elseif($absence->type == 3)
                                    ATL
                                    @endif
                                    {{$absence->employee->nik}} {{$absence->employee->biodata->fullName()}}
                                    tanggal {{formatDate($absence->date)}}
                                    ?
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger ">
                                       <a class="text-light" href="{{route('payroll.absence.delete', enkripRambo($absence->id))}}">Delete</a>
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </tbody>

                  </table>
               </div>
               <!-- End Table  -->

            </div>
         </div>


      </div>


   </div>
   <!-- End Row -->


</div>




@endsection