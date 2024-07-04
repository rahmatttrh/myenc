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
         <div class="d-block d-sm-none">
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
         </div>

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
         @if ($pending != null)
         <a href="" class="btn btn-primary btn-block shadow-sm" data-toggle="modal" data-target="#modal-out">Out</a>
         @else
         <a href="" class="btn btn-danger btn-block shadow-sm" data-toggle="modal" data-target="#modal-in">In</a>
         @endif
         <hr>
         <div class="card  bg-primary text-white ">
            {{-- <div class="card-header" style="background-image: url({{asset('img/blogpost.jpg')}})">
               <div class="profile-picture">
                  <div class="avatar avatar-xl">
                     @if ($employee->picture)
                     <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                     @else
                     <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                     @endif
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="user-profile text-center">
                  <div class="name">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</div>
                  <div class="job">{{$employee->position->name}}</div>
                  <div class="desc">15/08/2023 - 15/08/24</div>
               </div>
               @if ($pending != null)
               <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-out">Out</a>
               @else
               <a href="" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-in">In</a>
               @endif
            </div>
            <hr> --}}
            <div class="card-footer d-flex justify-content-between">

               <div>
                  {{$employee->contract->shift->name ?? '-'}} <br>
                  Sisa Cuti <br>
               </div>
               <div class="text-right">
                  {{$employee->contract->shift ? formatTime($employee->contract->shift->in) : ''}} - {{$employee->contract->shift ? formatTime($employee->contract->shift->out) : ''}} <br>
                  4 <br>
               </div>
               
            </div>
            <div class="card-footer d-flex justify-content-between">

               <div>
                  Overtime <br>
                  Absen <br>
               </div>
               <div class="text-right">
                  4 Hours <br>
                  2 <br>
               </div>
               
            </div>
         </div>

         <div class="card">
            <div class="card-header bg-danger text-white p-2">
               <small class="text-uppercase">SP History</small>
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
               <small class="text-uppercase">{{$now->format('F')}} 2024</small>
            </div>
            <div class="card-body p-0">
               <table class=" ">
                  <thead>
      
                     <tr>
                        <th  rowspan="3" class="text-center">#</th>
                        {{-- <th>Date</th> --}}
                        <th colspan="3" class="text-center">Tap In</th>
                        <th colspan="3" class="text-center">Tap Out</th>
                        <th rowspan="3" class="text-center">Work Hours</th>
                     </tr>
                     <tr>
                        <tr>
                           {{-- <td></td> --}}
                           <th>Date</th>
                           <th>Time</th>
                           <th>Loc</th>
                           <th>Date</th>
                           <th>Time</th>
                           <th>Loc</th>
                           {{-- <td></td> --}}
                        </tr>
                     </tr>
                  </thead>
                  <tbody>
                     @if (count($presences) > 0)
                     @foreach ($presences as $pre)
                        <tr>
                           <td class="text-center">{{++$i}}</td>
                           {{-- <td>{{formatDate($pre->in_date)}}</td> --}}
                           <td>{{formatDate($pre->in_date)}}</td>
                           <td>{{ $pre->in_time ? formatTime($pre->in_time) : '-'}}</td>
                           <td>{{$pre->in_loc}}</td>
                           <td>{{formatDate($pre->out_date)}}</td>
                           <td>{{$pre->out_time ? formatTime($pre->out_time) : '-'}}</td>
                           <td>{{$pre->out_loc}}</td>
                           <td class="text-center">{{$pre->total ? formatTime($pre->total) : '-'}}</td>
                        </tr>
                     @endforeach
                     @else
                     <tr>
                        <td colspan="3" class="text-center">Empty</td>
                     </tr>
                     @endif
      
      
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