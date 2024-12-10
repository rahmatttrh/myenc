
@extends('layouts.app')
@section('title')
      Dashboard
@endsection
@section('content')
   <div class="page-inner mt--5">
      {{-- <div class="page-header">
         <h5 class="page-title text-info">
            <i class="fa fa-home"></i>
            Dashboard
            
            
         </h5>
      </div> --}}
      <div class="row">
         <div class="col-sm-6 col-md-4">
            <div class="card card-primary">
               <div class="card-body">
                  <x-role />
                  <hr>
                  
                  <b>{{$employee->unit->name}}</b> - {{$employee->department->name}}<br>
                   
                  {{$employee->position->name}}
               </div>
            </div>
            
            <form action="{{route('payroll.overtime.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
               <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
               <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
               <div class="form-group form-group-default">
                  <label>Employee KJ 4-5</label>
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
                        <input type="number" required class="form-control" id="hours" name="hours" >
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
               Data pada form ini akan <b>Menambah</b> nilai Transaksi Gaji Karyawan
            </small>
         </div>
         <div class="col-sm-6 col-md-8">
            <h2>Recent SPKL</h2>
            <hr>
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
            <div class="card shadow-none border">
               <div class="card-body">
                  <b>Description</b> <br>
                  <span>{{$over->desc}}</span>
               </div>
            </div>
            <iframe src="{{asset('storage/' . $over->doc)}}" frameborder="0" style="width:100%"  height="500px"></iframe>
         </div>
         </div>
      </div>
   </div>
   @endforeach

   @push('chart-dashboard')
   <script>
       $(document).ready(function() {
         var barChart = document.getElementById('barChart').getContext('2d');

         var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
               labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
               datasets : [{
                  label: "Resign",
                  backgroundColor: 'rgb(23, 125, 255)',
                  borderColor: 'rgb(23, 125, 255)',
                  data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
               }],
            },
            options: {
               responsive: true, 
               maintainAspectRatio: false,
               scales: {
                  yAxes: [{
                     ticks: {
                        beginAtZero:true
                     }
                  }]
               },
            }
         });
      })
   </script>
   @endpush
   
@endsection