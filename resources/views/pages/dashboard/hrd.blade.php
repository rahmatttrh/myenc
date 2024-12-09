
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
      <div class="row d-block d-sm-none">
         <div class="col">
            <div class="card card-stats card-round border">
               <div class="card-body">
                  <div class="row align-items-center">
                     <div class="col-icon ">
                        <div class="icon-big text-center icon-info bubble-shadow-small">
                           <i class="far fa-newspaper"></i>
                        </div>
                     </div>
                     <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                           <p class="card-category">QPE</p>
                           <h4 class="card-title">{{count($payrollApprovals)}}</h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            {{-- <div class="card card-stats card-primary card-round">
               <div class="card-body">
                  <div class="row">
                     <div class="col-3">
                        <div class="icon-big text-center">
                           <i class="flaticon-interface-6"></i>
                        </div>
                     </div>
                     <div class="col col-stats">
                        <div class="numbers">
                           <p class="card-category">QPE </p>
                           <h4 class="card-title">0 </h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div> --}}
         </div>

         <div class="col ">
            <a href="{{route('payroll.approval.hrd')}}">
               <div class="card card-stats card-round border">
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-icon ">
                           <div class="icon-big text-center icon-primary bubble-shadow-small">
                              <i class="far fa-newspaper"></i>
                           </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                           <div class="numbers">
                              <p class="card-category">Payslip</p>
                              <h4 class="card-title">{{count($payrollApprovals)}}</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               {{-- <div class="card card-stats card-primary card-round">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-3">
                           <div class="icon-big text-center">
                              <i class="flaticon-interface-6"></i>
                           </div>
                        </div>
                        <div class="col col-stats">
                           <div class="numbers">
                              <p class="card-category">Payroll</p>
                              <h4 class="card-title">{{count($payrollApprovals)}}</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> --}}
            </a>
         </div>

         <div class="col ">

            <a href="{{route('payroll.absence.approval')}}">
               <div class="card card-stats card-round border">
                  <div class="card-body">
                     <div class="row align-items-center">
                        <div class="col-icon ">
                           <div class="icon-big text-center icon-success bubble-shadow-small">
                              <i class="far fa-newspaper"></i>
                           </div>
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                           <div class="numbers">
                              <p class="card-category">Absence</p>
                              <h4 class="card-title">{{count($absenceApprovals)}}</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               {{-- <div class="card card-stats card-primary card-round">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-3">  
                           <div class="icon-big text-center ml-3">
                              <i class="flaticon-interface-6 "></i>
                           </div>
                        </div>
                        <div class="col col-stats">
                           <div class="numbers">
                              <p class="card-category">Absence</p>
                              <h4 class="card-title">{{count($absenceApprovals)}}</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div> --}}
            </a>
         </div>

         <div class="col ">
            <div class="card card-stats card-danger card-round">
               <div class="card-body">
                  <div class="row">
                     <div class="col-3 ">
                        <div class="icon-big text-center">
                           <i class="flaticon-interface-6"></i>
                        </div>
                     </div>
                     <div class="col col-stats">
                        <div class="numbers">
                           <p class="card-category">SP </p>
                           <h4 class="card-title">0 </h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <div class="row">
        
         <div class="col-md-4">
            <div class="card card-primary">
               {{-- <div class="card-header">
                  Dashboard SPV
               </div> --}}
               <div class="card-body">
                  {{-- <span class="badge badge-dark">Level :</span> --}}
                  <x-role />
                  <hr>
                  
                  {{-- Dashboard HRD <hr class="bg-white"> --}}
                  <b>{{$employee->unit->name}}</b> - {{$employee->department->name}}<br>
                   
                  {{$employee->position->name}}
                  
                  {{-- @if (auth()->user()->hasRole('HRD'))
                     HRD
                  @endif
                  @if (auth()->user()->hasRole('Supervisor'))
                     SPV
                  @endif --}}
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between p-2 bg-primary text-white">
                        <small>Monitoring</small>
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
                                 <td class="text-center">{{count($pes->where('status', 0))}}</td>
                              </tr>
                              <tr>
                                 <td>Tetap</td>
                                 <td class="text-center">{{$tetap}}</td>
                                 <td>Progress</td>
                                 <td class="text-center">{{count($pes->where('status', 1))}}</td>
                              </tr>
                              <tr>
                                 <td class="text-muted">Nonactive</td>
                                 <td class="text-center text-muted">{{count($employees->where('status', 3))}}</td>
                                 <td>Done</td>
                                 <td class="text-center">{{count($pes->where('status', 2))}}</td>
                              </tr>
                              <tr>
                                 <td>Total Active</td>
                                 <td class="text-center">{{count($employees->where('status', '!=', 3))}}</td>
                                 <td>Total</td>
                                 <td class="text-center">{{count($pes)}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               {{-- <div class="col">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between p-2 bg-primary text-white">
                        <small>QPE</small>
                     </div>
                     <div class="card-body p-0">
                        <table class="display  table-sm table-bordered  ">
                           <thead>
                              <tr>
                                 <th colspan="2">Monitoring</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Draft</td>
                                 <td>{{count($pes->where('status', 0))}}</td>
                              </tr>
                              <tr>
                                 <td>Porgress</td>
                                 <td>{{count($pes->where('status', 1))}}</td>
                              </tr>
                              <tr>
                                 <td>Done</td>
                                 <td>{{count($pes->where('status', 2))}}</td>
                              </tr>
                              <tr>
                                 <td>Total</td>
                                 <td>{{count($pes)}}</td>
                              </tr>
                              
                              
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div> --}}
            </div>
            
            <div class="card">
               <div class="card-header bg-primary text-white p-2">
                  <small>Teams</small>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive overflow-auto" style="height: 200px">
                  <table class=" ">
                     {{-- <thead>
                        <tr>
                           <th></th>
                           <th>NIK</th>
                           <th>Name</th>
                        </tr>
                     </thead> --}}
                     <tbody>
                        @if (count($employee->positions) > 0)
                              @foreach ($positions as $pos)
                                    <tr>
                                    {{-- <td></td> --}}
                                    <td colspan="4">{{$pos->department->unit->name}} {{$pos->department->name}} ({{count($pos->department->employees)}}) </td>
                                    {{-- <td>{{$employee->biodata->fullName()}}</td> --}}
                                    </tr>
                                    @foreach ($pos->department->employees->where('status', 1) as $emp)
                                       <tr>
                                       <td></td>
                                       {{-- <td>{{$emp->sub_dept->name ?? ''}}</td> --}}
                                       {{-- <td></td> --}}
                                       <td>{{$emp->nik}} {{$emp->id}}</td>
                                       </tr>
                                    @endforeach
                              @endforeach
                            @else
                            @foreach ($teams as $team)
                                 @if ($team->employee->status == 1)
                                 <tr>
                                    <td>{{$team->employee->nik}} </td>
                                    <td> {{$team->employee->biodata->fullName()}}</td>
                                 </tr>
                                 @endif
                                 
                           @endforeach    
                        @endif
                        
                        
                        
                     </tbody>
                  </table>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="row ">
               <div class="col-6 col-md-4  d-none d-sm-block">
                  <div class="card card-stats card-round border">
                     <div class="card-body">
                        <div class="row align-items-center">
                           <div class="col-icon d-none d-md-block">
                              <div class="icon-big text-center icon-info bubble-shadow-small">
                                 <i class="far fa-newspaper"></i>
                              </div>
                           </div>
                           <div class="col col-stats ml-3 ml-sm-0">
                              <div class="numbers">
                                 <p class="card-category">QPE</p>
                                 <h4 class="card-title">0</h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  {{-- <div class="card card-stats card-primary card-round">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-3">
                              <div class="icon-big text-center">
                                 <i class="flaticon-interface-6"></i>
                              </div>
                           </div>
                           <div class="col col-stats">
                              <div class="numbers">
                                 <p class="card-category">QPE </p>
                                 <h4 class="card-title">0 </h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div> --}}
               </div>
      
               <div class="col-6 col-md-4  d-none d-sm-block">
                  <a href="{{route('payroll.approval.hrd')}}">
                     <div class="card card-stats card-round border">
                        <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col-icon d-none d-md-block">
                                 <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="far fa-newspaper"></i>
                                 </div>
                              </div>
                              <div class="col col-stats ml-3 ml-sm-0">
                                 <div class="numbers">
                                    <p class="card-category">Payslip</p>
                                    <h4 class="card-title">{{count($payrollApprovals)}}</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     {{-- <div class="card card-stats card-primary card-round">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-3">
                                 <div class="icon-big text-center">
                                    <i class="flaticon-interface-6"></i>
                                 </div>
                              </div>
                              <div class="col col-stats">
                                 <div class="numbers">
                                    <p class="card-category">Payroll</p>
                                    <h4 class="card-title">{{count($payrollApprovals)}}</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> --}}
                  </a>
               </div>
      
               <div class="col-6 col-md-4  d-none d-sm-block">
      
                  <a href="{{route('payroll.absence.approval')}}">
                     <div class="card card-stats card-round border">
                        <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col-icon d-none d-md-block">
                                 <div class="icon-big text-center icon-success bubble-shadow-small">
                                    <i class="far fa-newspaper"></i>
                                 </div>
                              </div>
                              <div class="col col-stats ml-3 ml-sm-0">
                                 <div class="numbers">
                                    <p class="card-category">Absence</p>
                                    <h4 class="card-title">{{count($absenceApprovals)}}</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     {{-- <div class="card card-stats card-primary card-round">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-3">  
                                 <div class="icon-big text-center ml-3">
                                    <i class="flaticon-interface-6 "></i>
                                 </div>
                              </div>
                              <div class="col col-stats">
                                 <div class="numbers">
                                    <p class="card-category">Absence</p>
                                    <h4 class="card-title">{{count($absenceApprovals)}}</h4>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> --}}
                  </a>
               </div>
      
               <div class="col-6 col-md-4  d-none d-sm-block">
                  <div class="card card-stats card-danger card-round">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-3  d-none d-md-block">
                              <div class="icon-big pl-3 text-center">
                                 <i class="flaticon-interface-6"></i>
                              </div>
                           </div>
                           <div class="col col-stats">
                              <div class="numbers">
                                 <p class="card-category">SP </p>
                                 <h4 class="card-title">0 </h4>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            
            
            <div class="card " >
               <div class="card-header d-flex justify-content-between p-2 bg-primary text-white">
                  <small>8 Latest QPE</small>
                  <a href="{{route('qpe')}}" class="text-white">more...</a>
               </div>
               <div class="card-body p-0 " >
                  <div class="table-responsive overflow-auto" style="height: 150px">
                     <table class="" >
                        <thead>
                           
                           <tr class="">
                              {{-- <th scope="col">#</th> --}}
                              {{-- <th></th> --}}
                              <th>Employee</th>
                              <th>Semester</th>
                              <th>Achievement</th>
                              <th>Status</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($recentPes as $pe)
                              <tr>
                                 {{-- <th></th> --}}
                                 <td>
                                    {{-- <a href="{{route('sp.detail', enkripRambo($pe->id))}}">{{$pe->code}}</a> --}}
                                    @if($pe->status == '0' || $pe->status == '101')
                                    <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                    @elseif($pe->status == '1' || $pe->status == '202' )
                                    <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                    @else
                                    <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                    @endif
                                 </td>
                                 <td>{{$pe->semester}} / {{$pe->tahun}}</td>
                                 <td>{{$pe->achievement}}</td>
                                 <td>
                                    <x-status.pe :pe="$pe" />
                                 </td>
                              </tr>
                              @endforeach
      
                        </tbody>
                     </table>
                  </div>
               </div>
               {{-- <div class="card-footer">
                  <small class="text-muted">*Ini adalah 8 data QPE terkini, klik <a href="{{route('qpe')}}">Disini</a> untuk melihat seluruh data QPE.</small>
               </div> --}}
            </div>
           
            <div class="card">
               <div class="card-header p-2 bg-danger text-white">
                  <small>5 Latest SP</small>
               </div>
               <div class="card-body p-0">
                  <div class="table-responsive overflow-auto" style="height: 150px">
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