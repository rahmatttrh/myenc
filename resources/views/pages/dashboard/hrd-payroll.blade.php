
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
         <div class="col-sm-6 col-md-3">
            <div class="card card-primary">
               <div class="card-body">
                  <x-role />
                  <hr>
                  
                  <b>{{$employee->unit->name}}</b> - {{$employee->department->name}}<br>
                   
                  {{$employee->position->name}}
               </div>
            </div>

            <div class="card">
               <div class="card-header p-2 bg-primary text-white">
                  <i class="fas fa-desktop"></i> <small>Monitoring</small>
               </div>
               <div class="card-body p-0">
                  <table class="display  table-sm table-bordered">
                     <thead>
                        <tr>
                           <th colspan="2">Transaction</th>
                           {{-- <th colspan="2">QPE</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Draft</td>
                           <td class="text-center">{{count($transactions->where('status', 0))}}</td>
                           {{-- <td>Draft</td>
                           <td class="text-center">{{count($qpes->where('status', 0))}}</td> --}}
                        </tr>
                        <tr>
                           <td>Completed</td>
                           <td class="text-center">{{count($transactions->where('status', 1))}}</td>
                           {{-- <td>Porgress</td>
                           <td class="text-center">{{count($qpes->where('status', 1))}}</td> --}}
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
               {{-- <div class="card-header p-2 bg-primary text-white">
                  <i class="fas fa-desktop"></i> <small>Monitoring</small>
               </div> --}}
               <div class="card-body p-0">
                  <table class="display  table-sm table-bordered">
                     <thead>
                        <tr>
                           <th colspan="2">Hari Libur</th>
                           {{-- <th colspan="2">QPE</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($holidays as $holi)
                            <tr>
                              <td>{{formatDateDayMonth($holi->date)}}</td>
                              <td class="text-truncate" style="max-width: 110px">{{$holi->desc}}</td>
                            </tr>
                        @endforeach
                     </tbody>
                  </table>
                  
               </div>
            </div>
           

            {{-- <span>Hari Libur {{$month}}</span> 
            <hr>
            @foreach ($holidays as $holi)
                <span class="badge badge-primary">{{formatDateDay($holi->date)}}</span>
            @endforeach --}}
            
         </div>
         <div class="col-sm-6 col-md-9">
            <div class="table-responsive">
               <table id="data" class="display basic-datatables table-sm">
                  <thead>
                     <tr>
                        {{-- <th class="text-center" style="width: 30px">No</th> --}}
                        {{-- @if (auth()->user()->hasRole('Administrator'))
                        <th>ID</th>
                        @endif --}}
                        <th>Name</th>
                        <th>Month</th>
                        {{-- <th>NIK</th> --}}
                        
                        <th class="text-truncate">Unit</th>
                        <th>Pendapatan</th>
                        <th>Gaji Bersih</th>
                        <th>Status</th>
                     </tr>
                  </thead>
                  
                  <tbody>
                     @foreach ($transactions as $trans)
                         <tr>
                           {{-- <td class="text-center">{{++$i}}</td> --}}
                           
                           {{-- <td>{{$trans->employee->nik}}</td> --}}
                           <td><a href="{{route('payroll.transaction.detail', enkripRambo($trans->id))}}"> {{$trans->employee->nik}} {{$trans->employee->biodata->fullName()}}</a></td>
                           <td>{{$trans->month}}</td>
                           <td>{{$trans->employee->department->name}}</td>
                           <td>{{formatRupiah($trans->employee->payroll->total)}}</td>
                           <td>{{formatRupiah($trans->total)}}</td>
                           <td>Draft</td>
                         </tr>
                     @endforeach
                  </tbody>
                  
               </table>
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