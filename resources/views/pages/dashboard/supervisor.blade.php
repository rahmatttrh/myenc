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
   {{-- <div class="page-header">
      <h4 class="page-title">Dashboard</h4>
   </div> --}}
   <div class="row">
      <div class="col-md-4">
         {{-- <div class="btn btn-primary btn-block">Supervisor</div>
         <hr> --}}
         {{-- <div class="d-block d-sm-none">
            <div class="alert alert-info shadow-sm">

                  <div class="card-opening">
                     <h4>
                        <img src="{{asset('img/flaticon/promote.png')}}" height="28" alt="" class="mr-1">
                        <b>Announcement</b>
                     </h4>
                  </div>
                  <hr>
                  <div class="card-desc">
                     Tanggal 8 & 9 Februari Libur Nasional dan Cuti Bersama
                  </div>
            </div>
            <hr>
         </div> --}}
         {{-- <div class="card card-profile card-secondary ">
            <div class="card-header" style="background-image: url({{asset('img/blogpost.jpg')}})">
               <div class="profile-picture">
                  <div class="avatar avatar-xl">
                     @if ($employee->picture)
                     <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                     @else
                     <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                     @endif</div>
               </div>
            </div>
            <div class="card-body">
               <div class="user-profile text-center">
                  <div class="name">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</div>
                  <div class="job">{{$employee->position->name}}</div>
                  
               </div>
               
               
            </div>
             
           
            
         </div> --}}
         <div class="card card-primary">
            {{-- <div class="card-header">
               Dashboard Leader
            </div> --}}
            <div class="card-body">
               Dashboard
               @if (auth()->user()->hasRole('Supervisor'))
                   SPV
                   @elseif(auth()->user()->hasRole('Leader'))
                   Team Leader
               @endif
               <hr class="bg-white">
               <b>{{$employee->unit->name}}</b> - {{$employee->department->name}} Department<br>
                
               {{$employee->position->name}}
            </div>
         </div>
         <div class="card">
            {{-- <div class="card-header bg-primary text-white p-2">
               <small>Employee</small>
            </div> --}}
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
                     <tr>
                        <th colspan="2">Team</th>
                        {{-- <th>Name</th> --}}
                     </tr>
                  </thead>
                  <tbody>
                     {{-- @foreach ($teams as $team)
                         <tr>
                           <td>{{$team->employee->department->name}} </td>
                           <td>{{$team->employee->nik}}</td>
                           <td> {{$team->employee->biodata->fullName()}}</td>
                         </tr>
                     @endforeach --}}
                     @foreach ($myteams as $team)
                         @php
                             $bio = DB::table('biodatas')->where('id', $team->biodata_id)->first();
                         @endphp
                         <tr>
                           {{-- <td>{{$team->department->name}} </td> --}}
                           <td>{{$team->nik}}</td>
                           <td> {{$bio->first_name}} {{$bio->last_name}}</td>
                         </tr>
                     @endforeach
                     
                     
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
         <div class="card">
            <div class="card-header bg-primary text-white p-2">
               <small>Latest QPE</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
                     
                     <tr>
                        {{-- <th scope="col">No</th> --}}
                        <th scope="col">Name</th>
                        <th>Semester/Tahun</th>
                        <th scope="col">Achievement</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($myteams as $team)
                         @foreach ($allpes as $pe)
                             @if ($pe->employe_id == $team->id)
                             <tr>
                              {{-- <td>{{++$i}}</td> --}}
                              <td>
                                 @if($pe->status == '0' || $pe->status == '101')
                                 <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} - {{$pe->employe->biodata->fullName()}} </a>
                                 @elseif($pe->status == '1' || $pe->status == '202' )
                                 <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} - {{$pe->employe->biodata->fullName()}} </a>
                                 @else
                                 <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} - {{$pe->employe->biodata->fullName()}} </a>
                                 @endif
                                 
                              </td>
                              <td>{{$pe->semester}} / {{$pe->tahun}}</td>
                              <td>{{$pe->achievement}}</td>
                              <td>
                                 <x-status.pe :pe="$pe" />
                              </td>
                           </tr>
                             @endif
                         @endforeach
                     @endforeach
                     {{-- @if (count($peRecents) > 0)
                        @foreach ($peRecents as $pe)
                        <tr>
                           <td>
                              @if($pe->status == '0' || $pe->status == '101')
                              <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} - {{$pe->employe->biodata->fullName()}} </a>
                              @elseif($pe->status == '1' || $pe->status == '202' )
                              <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} - {{$pe->employe->biodata->fullName()}} </a>
                              @else
                              <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} - {{$pe->employe->biodata->fullName()}} </a>
                              @endif
                              
                           </td>
                           <td>{{$pe->semester}} / {{$pe->tahun}}</td>
                           <td>{{$pe->achievement}}</td>
                           <td>
                              <x-status.pe :pe="$pe" />
                           </td>
                        </tr>
                        @endforeach
                        
                         @else
                         <tr>
                           <td colspan="5" class="text-center">Empty</td>
                        </tr>
                     @endif --}}
                     
                     
                     
                  </tbody>
               </table>
            </div>
            {{-- <div class="card-footer">
               <small class="text-muted">*Ini adalah 8 data QPE terkini, klik <a href="{{route('qpe')}}">Disini</a> untuk melihat seluruh data QPE.</small>
            </div> --}}
         </div>

         <div class="card">
            <div class="card-header bg-danger text-white p-2">
               <small>Recent SP</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
                     
                     <tr>
                        {{-- <th scope="col">No</th> --}}
                        {{-- <th scope="col">ID</th> --}}
                        <th>Name</th>
                        <th>ID</th>
                        <th>Level</th>
                        {{-- <th scope="col">NIK</th> --}}
                        
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($spRecents) > 0)
                        @foreach ($spRecents as $sp)
                            <tr>
                              <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->employee->nik}} {{$sp->employee->biodata->fullName()}}</a></td>
                              <td>{{$sp->code}}</td>
                              <td>SP {{$sp->level}}</td>
                              
                              {{-- <td></td>
                              <td></td> --}}
                              <td><x-status.sp :sp="$sp" /> </td>
                            </tr>
                        @endforeach
                         @else
                         <tr>
                           <td colspan="4" class="text-center">Empty</td>
                        </tr>
                     @endif
                     
                     
                     
                  </tbody>
               </table>
            </div>
         </div>

         {{-- <div class="card">
            <div class="card-header p-2">
               <small>SPKL Request</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
                     
                     <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th>Name</th>
                        <th scope="col">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($spkls) > 0)
                         @foreach ($spkls as $spkl)
                         <tr>
                           <td><a href="{{route('spkl.detail', enkripRambo($spkl->id))}}">{{$spkl->code}}</a></td>
                           <td>{{formatDate($spkl->date)}}</td>
                           <td>{{$spkl->employee->biodata->first_name}} {{$spkl->employee->biodata->last_name}}</td>
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
         </div>

         <div class="card">
            <div class="card-header p-2">
               <small>SPT Request</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
                     
                     <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Date</th>
                        <th>Name</th>
                        <th scope="col">Status</th>
                     </tr>
                  </thead>
                  <tbody>
                  </tbody>
               </table>
            </div>
         </div> --}}
         
         
         
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
                     <input type="date" class="form-control"  name="date" id="date" value="{{$presence->in_date}}">
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
                           <input type="time" class="form-control"  name="time" id="time" value="{{$presence->in_time}}" >
                        </div>
                     </div>
                  </div>
                  
               </div>
               <div class="col-md-6">
                  <div class="badge badge-info mb-2">Out</div>
                  {{-- <hr> --}}
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input type="date" class="form-control"  name="date" id="date" value="{{$presence->out_date}}">
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
                           <input type="time" class="form-control"  name="time" id="time" value="{{$presence->out_time}}" >
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
   <div class="modal-dialog modal-sm" role="document">
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
               <input type="date" class="form-control"  name="date" id="date" >
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
                     <input type="time" class="form-control"  name="time" id="time" >
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
               <input type="date" class="form-control"  name="date" id="date" >
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
                     <input type="time" class="form-control"  name="time" id="time" >
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