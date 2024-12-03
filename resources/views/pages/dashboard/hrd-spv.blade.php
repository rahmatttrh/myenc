
@extends('layouts.app')
@section('title')
      Dashboard
@endsection
@section('content')
   <div class="page-inner mt--5">
      <div class="page-header">
         <h5 class="page-title text-info">
            {{-- <i class="fa fa-home"></i> --}}
            Welcome back, {{auth()->user()->getGender()}} {{auth()->user()->name}}
            
            
         </h5>
      </div>
      <div class="row">
         {{-- <div class="col-sm-6 col-md-3">
            <a href="" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Vessel">
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
                              <p class="card-category">Bisnis Unit</p>
                              <h4 class="card-title">{{$units}}</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </a>
         </div> --}}
         <div class="col-sm-6 col-md-3">
            {{-- <a href="" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Vessel">
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
            </a> --}}
            <div class="card card-primary">
               <div class="card-body text-center">
                  <h1>HRD Supervisor</h1>
               </div>
            </div>
            {{-- <div class="table-responsive"> --}}
               {{-- table table-bordered table-sm table-head-bg-info table-bordered-bd-info --}}
            <div class="card">
               {{-- <div class="card-header p-2 bg-dark text-white">
                  <small>Employee Status</small>
               </div> --}}
               <div class="card-body p-0">
                  <table class="display  table-sm table-bordered  table-striped ">
                     <thead>
                        <tr>
                           <th colspan="2">Employee</th>
                        </tr>
                        <tr>
                           <th scope="col">Status</th>
                           <th scope="col" class="text-center">Jumlah</th>
                           
                        </tr>
                        
                     </thead>
                     <tbody>
                        <tr>
                           <td>Kontrak</td>
                           <td class="text-center">{{$kontrak}}</td>
                        </tr>
                        <tr>
                           <td>Tetap</td>
                           <td class="text-center">{{$tetap}}</td>
                        </tr>
                        <tr>
                           <td>Pending</td>
                           <td class="text-center">{{$empty}}</td>
                        </tr>
                        <tr>
                           <td>Total</td>
                           <td class="text-center">{{count($employees)}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-md-9">
            <div class="row">
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header p-2 bg-primary text-white">
                        <small>Contract End This Month</small>
                     </div>
                     <div class="card-body p-0">
                        <table class="display  table-sm table-bordered  table-striped ">
                           <thead>
                              
                              <tr>
                                 <th scope="col">ID</th>
                                 <th scope="col" >Name</th>
                                 {{-- <th>Unit</th>
                                 <th>Department</th> --}}
                                 <th>Expired</th>
                              </tr>
                              
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="3" class="text-center">Empty</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="card">
                     <div class="card-header p-2 bg-danger text-white">
                        <small>Recent SP</small>
                     </div>
                     <div class="card-body p-0">
                        <table class="display  table-sm table-bordered  table-striped ">
                           <thead>
                              
                              <tr>
                                 <th>ID</th>
                                 <th scope="col">Level</th>
                                 <th>NIK</th>
                                 <th scope="col" >Name</th>
                                 {{-- <th>Unit</th>
                                 <th>Department</th> --}}
                                 <th>Status</th>
                              </tr>
                              
                           </thead>
                           <tbody>
                              @if (count($sps) > 0)
                                 @foreach ($sps as $sp)
                                 <tr>
                                    <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a></td>
                                    <td>SP {{$sp->level}}</td>
                                    <td>{{$sp->employee->nik}}</td>
                                    <td>{{$sp->employee->biodata->fullName()}}</td>
                                    <td><x-status.sp :sp="$sp" /> </td>
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
               <div class="col-md-12">
                  <hr>
                  <div class="card">
                     <div class="card-header d-flex p-2 text-white" style="background-color: rgb(44, 42, 42)">
                        <small>Logs Activity</small>
                        <a href="{{route('log')}}" class="ml-auto text-info">More...</a>
                     </div>
                     <div class="card-body p-0">
                        <table class="display  table-sm table-bordered  table-striped ">
                           <thead>
                              
                              <tr>
                                 <th scope="col">Name</th>
                                 <th scope="col">Action</th>
                                 {{-- <th>Unit</th>
                                 <th>Department</th> --}}
                                 <th>Desc</th>
                                 <th>Timestamp</th>
                              </tr>
                              
                           </thead>
                           <tbody>
                              @if (count($logs) > 0)
                                 @foreach ($logs as $log)
                                 <tr>
                                    <td>{{$log->user->name}}</td>
                                    <td>{{$log->action}}</td>
                                    <td>{{$log->desc}}</td>
                                    <td>{{formatDateTime($log->created_at)}}</td>
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
               </div>
            </div>
         </div>
         
         
      </div>
      <div class="row">
         <div class="col-md-3">
            

            
         </div>
         <div class="col-md-9">
            
            
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