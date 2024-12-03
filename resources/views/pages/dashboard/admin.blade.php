@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('content')
<div class="page-inner mt--5">
   <div class="page-header">
      <h5 class="page-title text-info">
         {{-- <i class="fa fa-home"></i> --}}
         Welcome back, Mr. {{auth()->user()->name}}
         
         
      </h5>
   </div>
   {{-- <div class="row">
         <div class="col-sm-6 col-md-3">
            <a href="" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Karyawan">
               <div class="card card-stats card-primary card-round">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-5">
                           <div class="icon-big text-center">
                              <i class="flaticon-users"></i>
                           </div>
                        </div>
                        <div class="col col-stats">
                           <div class="numbers">
                              <p class="card-category">Total Employee</p>
                              <h4 class="card-title">{{count($employees)}}</h4>
</div>
</div>
</div>
</div>
</div>
</a>
</div>
<div class="col-sm-6 col-md-3">
   <a href="#" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Karyawan Tetap">
      <div class="card card-stats card-info card-round">
         <div class="card-body">
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center">
                     <i class="flaticon-user"></i>
                  </div>
               </div>
               <div class="col col-stats">
                  <div class="numbers">
                     <p class="card-category">Tetap</p>
                     <h4 class="card-title">{{$tetap}}</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </a>
</div>
<div class="col-sm-6 col-md-3">
   <a href="" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Karyawan Kontrak">
      <div class="card card-stats card-primary card-round">
         <div class="card-body">
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center">
                     <i class="flaticon-user"></i>
                  </div>
               </div>
               <div class="col col-stats">
                  <div class="numbers">
                     <p class="card-category">Kontrak</p>
                     <h4 class="card-title">{{$kontrak}}</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </a>
</div>
<div class="col-sm-6 col-md-3">
   <a href="#" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Karyawan Pensiun   ">
      <div class="card card-stats card-danger card-round">
         <div class="card-body">
            <div class="row">
               <div class="col-5">
                  <div class="icon-big text-center">
                     <i class="flaticon-clock"></i>
                  </div>
               </div>
               <div class="col col-stats">
                  <div class="numbers">
                     <p class="card-category">Off</p>
                     <h4 class="card-title">{{$off}}</h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </a>
</div>
</div> --}}

<div class="row">
   <div class="col-md-4">
      <div class="card">
         <div class="card-header p-2 bg-primary text-white">
            <i class="fas fa-desktop"></i> <small>Monitoring</small>
         </div>
         <div class="card-body p-0">
            <table class="display  table-sm table-bordered">
               <thead>
                  <tr>
                     <th colspan="2">Employee</th>
                     <th colspan="2">QPE</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Kontrak</td>
                     <td class="text-center">{{$kontrak}}</td>
                     <td>Draft</td>
                     <td class="text-center">{{count($qpes->where('status', 0))}}</td>
                  </tr>
                  <tr>
                     <td>Tetap</td>
                     <td class="text-center">{{$tetap}}</td>
                     <td>Porgress</td>
                     <td class="text-center">{{count($qpes->where('status', 1))}}</td>
                  </tr>
                  <tr>
                     <td class="text-muted">Nonactive</td>
                     <td class="text-center text-muted">{{count($employees->where('status', 3))}}</td>
                     <td>Done</td>
                     <td class="text-center">{{count($qpes->where('status', 2))}}</td>
                  </tr>
                  <tr>
                     <td>Total Active</td>
                     <td class="text-center">{{count($employees->where('status', '!=', 3))}}</td>
                     <td>Total</td>
                     <td class="text-center">{{count($qpes)}}</td>
                  </tr>
                  {{-- <tr>
                           <td>Nonactive</td>
                           <td class="text-center">{{count($employees->where('status', 3))}}</td>
                  </tr> --}}
               </tbody>
            </table>
            <table class="display  table-sm table-bordered">
               <thead>
                  <tr>
                     <th colspan="2">SP</th>
                     <th colspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Draft</td>
                     <td class="text-center">{{count($sps->where('status', 0))}}</td>
                     {{-- <td>Draft</td>
                           <td class="text-center">{{count($qpes->where('status', 0))}}</td> --}}
                  </tr>
                  <tr>
                     <td>Progress</td>
                     <td class="text-center">{{count($sps->where('status','>', 0)->where('status', '<', 4))}}</td>
                     {{-- <td>Porgress</td>
                           <td class="text-center">{{count($qpes->where('status', 1))}}</td> --}}
                  </tr>
                  <tr>
                     <td class="text-muted">Published</td>
                     <td class="text-center text-muted">{{count($sps->where('status', '>=', 4))}}</td>
                     {{-- <td>Done</td>
                           <td class="text-center">{{count($qpes->where('status', 2))}}</td> --}}
                  </tr>

                  {{-- <tr>
                           <td>Nonactive</td>
                           <td class="text-center">{{count($employees->where('status', 3))}}</td>
                  </tr> --}}
               </tbody>
            </table>
         </div>
      </div>
      <div class="card">
         {{-- <div class="card-header d-flex justify-content-between p-2 text-white" style="background-color: rgb(120, 121, 122)">
                  <small><b>Latest Log Activity</b></small>
                  <a href="{{route('log.auth')}}" class="text-white">More..</a>
      </div> --}}
      <div class="card-body p-0">
         <table class="display  table-sm table-bordered   ">
            <thead>

               <tr>
                  <th colspan="2" class="d-flex justify-content-between py-2">
                     <span>Latest Log Activity</span>
                     <a href="{{route('log.auth')}}" class="text-white">More..</a>
                  </th>
                  {{-- <th scope="col">Time</th> --}}
               </tr>
            </thead>
            <tbody>
               @if (count($logins) > 0)
               @foreach ($logins as $log)
               <tr>
                  <td class="text-truncate" style="max-width: 110px;">
                     <small>{{formatDateTimeB($log->created_at)}}</small> {{$log->user->username}} {{$log->user->name}}
                     <br>
                     @if ($log->action == 'Login')
                     {{$log->action}} into system<br>
                     @else
                     {{$log->action}} <small>{{$log->desc}}</small>
                     @endif


                  </td>
                  {{-- <td>{{$log->action}}</td>
                  <td>{{$log->desc}}</td> --}}
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
</div>
<div class="col-md-8">
   


   <div class="card">
      <div class="card-header d-flex justify-content-between p-2 bg-primary text-white">
         <small> <i class="fas fa-file-contract"></i> Latest QPE</small>
         <a href="{{route('qpe')}}" class="text-white">More..</a>
      </div>
      <div class="card-body p-0">
         <table class="display  table-sm table-bordered  ">
            <thead>

               <tr>
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">NIK</th>
                  <th scope="col">Employee</th>
                  <th>Semester</th>
                  {{-- <th>Desc</th> --}}
                  <th scope="col">Status</th>
                  <th>Last Update</th>
               </tr>
            </thead>
            <tbody>
               @if (count($recentQpes) > 0)
               @foreach ($recentQpes as $pe)
               <tr>
                  <td>{{$pe->employe->nik}}</td>
                  <td>{{$pe->employe->biodata->fullName()}}</td>
                  <td>{{$pe->semester}} / {{$pe->tahun}}</td>
                  <td class="text-muted">
                     <x-status.qpe-plain :pe="$pe" />
                  </td>
                  <td>
                     {{formatDateTimeB($pe->updated_at)}}
                  </td>

                  {{-- <td class="text-right">
                                    @if($pe->status == 0)
                                    <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{$pe->id}}"><i class="fas fa-trash"></i> Delete</button> -->
                  @elseif(($pe->status == '1' || $pe->status == '2' || $pe->status == '101' || $pe->status == '202') && $pe->behavior > 0)
                  <a href="{{ route('export.qpe', $pe->id) }}" target="_blank"> Preview PDF</a>
                  @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                  <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                  @endif
                  </td> --}}
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
      <div class="card-footer">
         <small class="text-muted">*Ini adalah 8 data QPE terkini, klik <a href="{{route('qpe')}}">Disini</a> untuk melihat seluruh data QPE.</small>
      </div>
   </div>

   <div class="card">
      <div class="card-header d-flex justify-content-between p-2 bg-danger text-white">
         <small>5 Latest SP</small>
         <a href="{{route('sp')}}" class="text-white">More..</a>
      </div>
      <div class="card-body p-0">
         <table class="display  table-sm table-bordered   ">
            <thead>

               <tr>
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">ID</th>
                  <th>NIK</th>
                  <th scope="col">Name</th>

                  <th>Level</th>
                  <th scope="col">Status</th>
                  <th>Last Update</th>
               </tr>
            </thead>
            <tbody>
               @if (count($recentSps) > 0)
               @foreach ($recentSps as $sp)
               <tr>
                  <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a></td>
                  <td>{{$sp->employee->nik}}</td>
                  <td>{{$sp->employee->biodata->first_name}} {{$sp->employee->biodata->last_name}}</td>

                  <td>
                     SP {{$sp->level}}
                  </td>
                  {{-- <td style="max-width: 190px" class="text-truncate">{{$sp->desc}}</td> --}}
                  <td>
                     <x-status.sp :sp="$sp" />
                  </td>
                  <td>{{formatDateTimeB($sp->updated_at)}}</td>
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
      <div class="card-header p-2 bg-primary text-white">
         <small>SPKL Request</small>
      </div>
      <div class="card-body p-0">
         <table class="display  table-sm table-bordered  table-striped ">
            <thead>

               <tr>
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">ID</th>
                  <th scope="col">Date</th>
                  <th>Name</th>
                  {{-- <th>Desc</th> --}}
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
                  {{-- <td style="max-width: 190px" class="text-truncate">{{$spkl->desc}}</td> --}}
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
</div>
</div>

</div>

@push('chart-dashboard')
<script>
   $(document).ready(function() {
      var barChart = document.getElementById('barChart').getContext('2d');

      var myBarChart = new Chart(barChart, {
         type: 'bar',
         data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
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