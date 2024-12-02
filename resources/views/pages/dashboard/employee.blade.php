@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('content')

<style>
   table th {
      background-color: white;
      color: rgb(78, 77, 77);
   }
</style>

<div class="page-inner mt--5">
   <div class="page-header">
      <h5 class="page-title text-info">
         <i class="fa fa-home"></i>
         Dashboard
         
      </h5>
   </div>
   <div class="row">
      <div class="col-md-4">
         {{-- <div class="card">
            <div class="card-body">
               @if (auth()->user()->hasRole('HRD-Recruitment'))
                 Hak Akses :  HRD Recruitment
               @endif
            </div>
         </div> --}}
         {{-- ANNOUNCE --}}
         

         @if (count($sps) > 0)
         <div class="card ">
            <div class="card-header bg-danger text-white"><b>Surat Peringatan <i class="fa fa-exclamation"></i></b></div>
            <div class="card-body">
               @foreach ($sps as $sp)
               <a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}} - SP {{$sp->level}}</a>
                 <br>
               @endforeach
            </div>
         </div>
         @endif
         {{-- @if ($pending != null)
         <a href="" class="btn btn-primary btn-block shadow-sm" data-toggle="modal" data-target="#modal-out">Out</a>
         @else
         <a href="" class="btn btn-danger btn-block shadow-sm" data-toggle="modal" data-target="#modal-in">In</a>
         @endif
         <hr> --}}
         <div class="card  bg-primary text-white ">
           
            <div class="card-body">

               <h1>{{$employee->unit->name}}</h1>
               
            </div>
            <div class="card-footer d-flex justify-content-between">

               <div>
                  Department <br>
                  Posisi <br>
               </div>
               <div class="text-right">
                  {{$employee->department->name}} <br>
                  {{$employee->position->name}} <br>
               </div>
               
            </div>
         </div>

         <div class="card">
            <div class="card-header bg-primary text-white p-2">
               <small class="text-uppercase">Recent PE</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  {{-- <thead >

                     <tr class="bg-primary text-white">
                        <th scope="col">ID</th>
                        
                     </tr>
                  </thead> --}}
                  <tbody>
                     @if (count($peHistories) > 0)
                     @foreach ($peHistories as $peHis)
                     <tr>
                        <td>
                           <a href="/qpe/show/{{enkripRambo($peHis->kpa->id)}}">Semester {{$peHis->semester}} / {{$peHis->tahun}}</a>
                        </td>
                        
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="1" class="text-center">Empty</td>
                     </tr>
                     @endif


                  </tbody>
               </table>
            </div>
         </div>

         <div class="card">
            <div class="card-header bg-danger text-white p-2">
               <small class="text-uppercase">Recent SP</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead >

                     <tr class="bg-danger text-white">
                        <th scope="col">ID</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($spHistories) > 0)
                     @foreach ($spHistories as $spHis)
                     <tr>
                        <td>
                           <a href="{{route('sp.detail', enkripRambo($spHis->id))}}">{{$spHis->code}} - SP {{$spHis->level}}</a>
                        </td>
                        
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="1" class="text-center">Empty</td>
                     </tr>
                     @endif


                  </tbody>
               </table>
            </div>
         </div>

      </div>


      <div class="col-md-8">
         @if (count($broadcasts) > 0)
            @foreach ($broadcasts as $broad)
            <div class="d-none d-sm-block">
               <div class="alert alert-info shadow-sm">
   
                  <div class="card-opening">
                     <h4>
                        <img src="{{asset('img/flaticon/promote.png')}}" height="28" alt="" class="mr-1">
                        <b>Broadcast</b>
                     </h4>
                  </div>
                  {{-- <hr> --}}
                  <div class="card-desc">
                     {{$broad->title}}.
                     {{-- <div class="text-truncate" style="max-width: 200px">
                        {{strip_tags($broad->body)}}
                     </div> --}}
                     <a href="{{route('announcement.detail', enkripRambo($broad->id))}}">Click here</a> to see more detail
                     
                  </div>
               </div>
            </div>
            @endforeach
         @endif

         @if (count($personals) > 0)
            @foreach ($personals as $pers)
            <div class="d-none d-sm-block">
               <div class="alert alert-danger shadow-sm">
   
                  <div class="card-opening">
                     <h4>
                        {{-- <img src="{{asset('img/flaticon/promote.png')}}" height="28" alt="" class="mr-1"> --}}
                        <b>Personal Message</b>
                     </h4>
                  </div>
                  {{-- <hr> --}}
                  <div class="card-desc">
                     
                     {{$pers->title}}.
                     <a href="{{route('announcement.detail', enkripRambo($pers->id))}}">Click here</a> to see more detail
                        <hr>
                        <small class="text-muted">* Ini adalah pesan personal yang hanya dikirim ke anda</small>
                  </div>
               </div>
            </div>
            @endforeach
         @endif


         @if (count($sps) > 0)
         <div class="d-none d-sm-block">
            <div class="alert alert-danger shadow-sm">

               <div class="card-opening">
                  <h4>
                     <img src="{{asset('img/flaticon/promote.png')}}" height="28" alt="" class="mr-1">
                     <b>Announcement</b>
                  </h4>
               </div>
               <hr>
               <div class="card-desc">
                  
                      @foreach ($sps as $sp)
                      S orry, you've got SP {{$sp->level}} {{$sp->code}}, <a href="{{route('sp.detail', enkripRambo($sp->id))}}">click here to confirm </a><br>
                         
                      @endforeach
                  
               </div>
            </div>
            <hr>
         </div>
         @endif

         {{-- <span class="badge badge-info mb-2">{{$now->format('F')}} 2024</span> <br> --}}
         

         {{-- <div class="card">
            <div class="card-header bg-secondary text-white p-2">
               <small class="text-uppercase">SPKL Request</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>

                     <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th>Desc</th>
                        <th scope="col">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($spkls) > 0)
                     @foreach ($spkls as $spkl)
                     <tr>
                        <td><a href="{{route('spkl.detail', enkripRambo($spkl->id))}}">{{$spkl->code}}</a></td>
                        <td>{{formatDate($spkl->date)}}</td>
                        <td style="max-width: 190px" class="text-truncate">{{$spkl->desc}}</td>
                        <td>
                           <x-status.spkl :spkl="$spkl" />
                        </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="5" class="text-center">SPKL Empty</td>
                     </tr>
                     @endif

                     @if (count($spkls) > 0)
                     @foreach ($spkls as $spkl)
                     <tr>
                        <td><a href="{{route('spkl.detail', enkripRambo($spkl->id))}}">{{$spkl->code}}</a></td>
                        <td>{{formatDate($spkl->date)}}</td>
                        <td style="max-width: 190px" class="text-truncate">{{$spkl->desc}}</td>
                        <td>
                           <x-status.spkl :spkl="$spkl" />
                        </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="5" class="text-center">SPT Empty</td>
                     </tr>
                     @endif


                  </tbody>
               </table>
            </div>
         </div> --}}
         {{-- <div class="card">
            <div class="card-header p-2">
               <small class="text-uppercase">SPT Request</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>

                     <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th>Desc</th>
                        <th scope="col">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($spkls) > 0)
                     @foreach ($spkls as $spkl)
                     <tr>
                        <td><a href="{{route('spkl.detail', enkripRambo($spkl->id))}}">{{$spkl->code}}</a></td>
                        <td>{{formatDate($spkl->date)}}</td>
                        <td style="max-width: 190px" class="text-truncate">{{$spkl->desc}}</td>
                        <td>
                           <x-status.spkl :spkl="$spkl" />
                        </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="5" class="text-center">Empty</td>
                     </tr>
                     @endif


                  </tbody>
               </table>
            </div>
         </div> --}}

         <div class="card">
            <div class="card-header bg-primary text-white p-2">
               <small class="text-uppercase">Task List</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
      
                     <tr>
                        <th class="text-center">#</th>
                        <th class="">Kategori</th>
                        <th class="">Action Plan</th>
                        <th class="text-center">Target</th>
                        <th class="text-center">Closed</th>
                        <th>Status</th>
                        {{-- <th>Date</th> --}}
                        {{-- <th colspan="3" class="text-center">Tap In</th>
                        <th colspan="3" class="text-center">Tap Out</th>
                        <th rowspan="3" class="text-center">Work Hours</th> --}}
                     </tr>
                     
                  </thead>
                  <tbody>
                     @foreach ($tasks as $task)
                        <tr>
                           <td>{{++$i}}</td>
                           <td>{{$task->category}}</td>
                           <td><a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a></td>
                           <td>{{formatDate($task->target)}}</td>
                           <td>
                              @if ($task->closed)
                              {{formatDate($task->closed)}}
                                 @else
                                 -
                              @endif
                           </td>
                           @if ($task->status == 0)
                              <td class="bg-danger text-light">Open</td>
                              @elseif($task->status == 1)
                              <td class="bg-info text-light">Progress</td>
                              @else
                              <td class="bg-success text-light">Closed</td>
                              
                           @endif
                           
                        </tr>
                     @endforeach
                     {{-- <tr>
                        <td>1</td>
                        <td>MARS</td>
                        <td>Fitur Drop Cargo by Material Man</td>
                        <td>17/10/2024</td>
                        <td>17/10/2024</td>
                        <td>Done</td>
                     </tr> --}}
      
                  </tbody>
               </table>
            </div>
         </div>

         <hr>


         <div class="card">
            <div class="card-header bg-primary text-white p-2">
               <small class="text-uppercase">Recent Absences {{$now->format('Y')}}</small>
            </div>
            <div class="card-body p-0">
               <table class=" table-sm p-0">
                  <thead>
                     <tr>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>Date</th>
                        
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
                           @endif
                        </td>
                        <td>{{formatDate($absence->date)}}</td>
                        
                        
                     </tr>

                     @endforeach
                  </tbody>

               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@foreach ($presences as $presence)
<div class="modal fade" id="modal-presence-{{$presence->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Presence</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.presence.in')}}" method="POST">
            @csrf
            <div class="modal-body">

               <div class="row">
                  <div class="col-md-6">
                     <div class="badge badge-info mb-2">In</div>
                     {{-- <hr> --}}
                     <div class="form-group form-group-default">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" id="date" value="{{$presence->in_date}}">
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Location</label>
                              <select class="form-control" name="loc" id="loc">
                                 <option {{$presence->in_loc == 'HW' ?  'selected' : ''}} value="HW">HW</option>
                                 <option {{$presence->in_loc == 'JGC' ?  'selected' : ''}} value="JGC">JGC</option>
                                 <option {{$presence->in_loc == 'KJ' ?  'selected' : ''}} value="KJ">KJ</option>
                                 <option {{$presence->in_loc == 'GS' ?  'selected' : ''}} value="GS">GS</option>
                              </select>
                              {{-- <input id="Name" type="text" class="form-control" > --}}
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Time</label>
                              <input type="time" class="form-control" name="time" id="time" value="{{$presence->in_time}}">
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="col-md-6">
                     <div class="badge badge-info mb-2">Out</div>
                     {{-- <hr> --}}
                     <div class="form-group form-group-default">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" id="date" value="{{$presence->out_date}}">
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Location</label>
                              <select class="form-control" name="loc" id="loc">
                                 <option {{$presence->out_loc == 'HW' ?  'selected' : ''}} value="HW">HW</option>
                                 <option {{$presence->out_loc == 'JGC' ?  'selected' : ''}} value="JGC">JGC</option>
                                 <option {{$presence->out_loc == 'KJ' ?  'selected' : ''}} value="KJ">KJ</option>
                                 <option {{$presence->out_loc == 'GS' ?  'selected' : ''}} value="GS">GS</option>
                              </select>
                              {{-- <input id="Name" type="text" class="form-control" > --}}
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Time</label>
                              <input type="time" class="form-control" name="time" id="time" value="{{$presence->out_time}}">
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-3">
                     Work Hours <br>
                     Overtime <br>
                  </div>
                  <div class="col-9">
                     : <b>{{$presence->total}}</b> <br>
                     : <b>0</b>
                  </div>
               </div>

            </div>
            <div class="modal-footer">
               {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
               {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            </div>
         </form>
      </div>
   </div>
</div>
@endforeach

<div class="modal fade" id="modal-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kamu sudah tiba dikantor?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.presence.in')}}" method="POST">
            @csrf
            <div class="modal-body">
               <div class="form-group form-group-default">
                  <label>Date</label>
                  <input type="date" class="form-control" name="date" id="date">
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Location</label>
                        <select class="form-control" name="loc" id="loc">
                           <option value="HW">HW</option>
                           <option value="JGC">JGC</option>
                           <option value="KJ">KJ</option>
                           <option value="GS">GS</option>
                        </select>
                        {{-- <input id="Name" type="text" class="form-control" > --}}
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Time</label>
                        <input type="time" class="form-control" name="time" id="time">
                     </div>
                  </div>
               </div>
               <hr>
               Fitur ini masih dalam tahap pengembangan :)

            </div>
            <div class="modal-footer">
               {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
               <button type="submit" class="btn btn-primary" disabled>Submit</button>
               
               
            </div>
         </form>
      </div>
   </div>
</div>

@if ($pending != null)
<div class="modal fade" id="modal-out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kamu sudah selesai bekerja?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.presence.out')}}" method="POST">
            @csrf
            @method('PUT')

            <input type="number" id="presence" name="presence" value="{{$pending->id}}" hidden>
            <div class="modal-body">
               <div class="form-group form-group-default">
                  <label>Date</label>
                  <input type="date" class="form-control" name="date" id="date">
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Select Location</label>
                        <select class="form-control" name="loc" id="loc">
                           <option value="HW">HW</option>
                           <option value="JGC">JGC</option>
                           <option value="KJ">KJ</option>
                           <option value="GS">GS</option>
                        </select>
                        {{-- <input id="Name" type="text" class="form-control" > --}}
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Time</label>
                        <input type="time" class="form-control" name="time" id="time">
                     </div>
                  </div>
               </div>

            </div>
            <div class="modal-footer">
               {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endif

@push('chart-dashboard')
<script>
   $(document).ready(function() {
      var barChart = document.getElementById('barChart').getContext('2d');

      var myBarChart = new Chart(barChart, {
         type: 'bar',
         data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
               label: "Sales",
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
                     beginAtZero: true
                  }
               }]
            },
         }
      });
   })
</script>
@endpush

@endsection