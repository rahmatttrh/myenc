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
      <div class="col-md-4">
         <h4>Form add SPKL</h4>
         <hr>
         <form action="{{route('payroll.overtime.store')}}" method="POST" enctype="multipart/form-data">
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
                     <label>Piket/Lembur</label>
                     <select class="form-control " required name="type" id="type">
                        <option value="" disabled selected>Select</option>
                        <option value="1">Lembur</option>
                        <option value="2">Piket</option>
                     </select>
                  </div>
               </div>
               
               
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Masuk/Libur</label>
                     <select class="form-control " required name="holiday_type" id="holiday_type">
                        <option value="" disabled selected>Select</option>
                        <option value="1">Masuk</option>
                        <option value="2">Libur Off</option>
                        <option value="3">Libur Nasional</option>
                        <option value="4">Idul Fitri</option>
                     </select>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Hours</label>
                     <input type="number" class="form-control" id="hours" name="hours" >
                  </div>
               </div>

            </div>
            <div class="form-group form-group-default">
               <label>Note</label>
               <input type="text"  class="form-control" id="desc" name="desc" >
            </div>
            <div class="form-group form-group-default">
               <label>Document</label>
               <input type="file"  class="form-control" id="doc" name="doc" >
            </div>
            
            
            <button class="btn btn-block btn-primary" type="submit">Add</button>
         </form>
         <hr>
         <small>
            Tipe Piket, data HOURS tidak perlu diisi
         </small>
         <hr>
         <small>
            Data pada form ini akan <b>Menambah</b> nilai Transaksi Gaji Karyawan
         </small>
         {{-- <div class="card">
            <div class="card-body p-0">
               <table class="display  table-sm table-bordered">
                  <thead>
                     <tr>
                        <th colspan="3">Hari Libur</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($holidays as $holi)
                         <tr>
                           <td>
                              @if ($holi->type == 1)
                                  <span class="badge badge-info">i</span>
                                  @elseif($holi->type == 2)
                                  <span class="badge badge-warning">i</span>
                                  @elseif($holi->type == 3)
                                  <span class="badge badge-danger">i</span>
                              @endif
                           </td>
                           <td>{{formatDateDayMonth($holi->date)}}</td>
                           <td class="text-truncate" style="max-width: 110px">{{$holi->desc}}</td>
                         </tr>
                     @endforeach
                     <tr>
                        <td colspan="3"></td>
                     </tr>
                     <tr>
                        <td colspan="3">
                           <span class="badge badge-info">i</span> Libur
                           <span class="badge badge-warning">i</span>  Nasional
                           <span class="badge badge-danger">i</span> Idul Fitri
                        </td>
                     </tr>
                  </tbody>
               </table>
               
            </div>
         </div> --}}
      </div>
      <div class="col">
         <form action="{{route('payroll.overtime.filter')}}" method="POST">
            @csrf
            <div class="row">
               {{-- <div class="col-md-3 ">
                  <div class="form-group form-group-default">
                     <label>Month</label>
                     <select class="form-control " required name="month" id="month">
                        <option value="" disabled selected>Select</option>
                        <option {{$month == 'all' ? 'selected' : '' }} value="all">All</option>
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
                     </select>
                  </div>
               </div>
               <div class="col-md-3 ">
                  <div class="form-group form-group-default">
                     <label>Year</label>
                     <select class="form-control " required name="year" id="year">
                        <option value="" disabled selected>Select</option>
                        <option {{$year == 'all' ? 'selected' : ''}} value="all">All</option>
                        <option {{$year == '2024' ? 'selected' : ''}} value="2024">2024</option>
                        <option {{$year == '2025' ? 'selected' : ''}} value="2025">2025</option>
                     </select>
                  </div>
               </div> --}}
               <div class="col-md-3">
                  <div class="form-group form-group-default">
                     <label>From</label>
                     <input type="date" name="from" id="from" value="{{$from}}" class="form-control">
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group form-group-default">
                     <label>To</label>
                     <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                  </div>
               </div>
               <div class="col">
                  <button class="btn btn-primary" type="submit" >Show</button>
               </div>
            </div>
         </form>   
         
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th>Type</th>
                     <th>Employee</th>
                     <th class="text-right">Date</th>
                     
                     <th class="text-center">Hours</th>
                     <th class="text-right">Rate</th>
                     <th></th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($overtimes as $over)
                      <tr>
                        {{-- <td>{{++$i}}</td> --}}
                        <td>
                           @if ($over->type == 1)
                               Lembur
                               @else
                               Piket
                           @endif
                        </td>
                        <td>{{$over->employee->nik}} {{$over->employee->biodata->fullName()}}</td>
                        <td class="text-right">
                           @if ($over->holiday_type == 1)
                              <span  class="badge badge-info ">
                              @elseif($over->holiday_type == 2)
                              <span class="badge badge-danger">
                              @elseif($over->holiday_type == 3)
                              <span class="badge badge-danger">LN -
                              @elseif($over->holiday_type == 4)
                              <span class="badge badge-danger">LR -
                           @endif
                           <a href="#" data-target="#modal-overtime-doc-{{$over->id}}" data-toggle="modal" class="text-white">{{formatDate($over->date)}}</a>
                           </span>
                        </td>
                        
                        
                        <td class="text-center">{{$over->hours}} </td>
                        <td class="text-right">{{formatRupiah($over->rate)}}</td>
                        <td>
                           <a href="#" data-target="#modal-delete-overtime-{{$over->id}}" data-toggle="modal">Delete</a>
                        </td>
                      </tr>

                     <div class="modal fade" id="modal-delete-overtime-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                 @if ($over->type == 1)
                                    Lembur
                                    @else
                                    Piket
                                 @endif
                                 {{$over->employee->nik}} {{$over->employee->biodata->fullName()}}
                                 tanggal {{formatDate($over->date)}}
                                 ?
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-danger ">
                                    <a class="text-light" href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>


@foreach ($overtimes as $over)
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
@endforeach


@endsection