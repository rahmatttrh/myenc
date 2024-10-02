@extends('layouts.app-doc')
@section('title')
   KPA {{$karyawan->biodata->fullName()}} {{$semester}}-{{$tahun}}
@endsection
@section('content')
<div class="container-xl">
   <!-- Page title -->
   <div class="page-header d-print-none">
     <div class="row align-items-center">
       <div class="col">
         <h2 class="page-title">
           KPA  {{$karyawan->biodata->fullName()}} {{$semester}} {{$tahun}}
         </h2>
       </div>
       <!-- Page title actions -->
       <div class="col-auto ms-auto d-print-none">
         <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
           <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
           Print 
         </button>
       </div>
     </div>
   </div>
 </div>
<div class="page-body" >
   <div class="container-xl">
      <div class="card card-lg">
         <div class="card-body">
            <div class="row border-bottom mb-4">
               <div class="col-12">
                  <img src="{{asset('img/logo/enc.jpg')}}"  alt="ENC" class="navbar-brand-image mb-2">
                  {{-- <h1 class="text-primary border-bottom pb-2">MANIFEST </h1> --}}
               </div>
               <hr>
               <div class="col-6">
                  <p class="h3">DETAIL</p>
                  <dl class="row">
                     <dd class="col-3">Nama</dd>
                     <dd class="col-9">: {{$karyawan->biodata->first_name}} {{$karyawan->biodata->last_name}}</dd>
                     <dd class="col-3">Jabatan</dd>
                     <dd class="col-9">:  {{$karyawan->contract->designation->name ?? ''}} {{$karyawan->contract->department->name ?? ''}}</dd>
                     <dd class="col-3">Periode</dd>
                     <dd class="col-9">: Semester {{$semester}} {{$tahun}} </dd>
                     
                  </dl>
               </div>
               <div class="col-6 text-end">
                  <p class="h3">Achievement</p> 
                  
                  <b>
                     <h1>
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                           <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                        </svg> --}}
                      {{$rating}}
                     </h1>
                  </b>
               </div>
            {{-- <div class="col-12 my-4">
                  <h1>{{$schedule->vessel->name}} </h1>
                  <h1>{{$schedule->origin->name}} - {{$schedule->destination->name}}</h1>
               </div> --}}
            </div>

            <div class="row">
               <div class="col-3">
                  <h4 class="">KPI</h4>
                  <div class="table-responsive">
                     <table id="basic-datatables" class="display basic-datatables table table-striped ">
                        <thead>
                           <tr>
                                 {{-- <th>No</th> --}}
                                 {{-- <th>Name</th> --}}
                                 <th>Month</th>
                                 <th class="text-center">Achievement</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($kpas as $kpa)
                           <tr>
                                 {{-- <td>{{++$i}}</td> --}}
                                 {{-- <td> {{$kpa->employe->biodata->fullName()}} </td> --}}
                                 <td>{{date('F', strtotime($kpa->date))  }}</td>
                                 <td class="text-center"><span class="badge badge-primary badge-lg"><b>{{$kpa->achievement}}</b></span></td>
                           </tr>
                           <x-modal.submit :id="$kpa->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($kpa->date))   " url="{{route('kpa.submit', enkripRambo($kpa->id))}}" />
                           <x-modal.delete :id="$kpa->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($kpa->date))   " url="{{route('kpa.delete', enkripRambo($kpa->id))}}" />
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="col-9">
                  <h4 class="">Grafik</h4>
                  <div class="chart-container" style="max-width: 100%">
                     <canvas id="barChart"></canvas>
                  </div>
               </div>
            </div>
            
            @foreach ($kpas as $kpa)
            <hr>
               <h4>{{formatMonthName($kpa->date)}}</h4>

               <div class="table-responsive">
                  <table id="tableCreate" class=" table table-striped ">
                      <thead>
                          <tr>
                              {{-- <th>No</th> --}}
                              <th >Objective</th>
                              <th class="text-center">Weight</th>
                              <th class="text-center">Target</th>
                              <th class="text-center">Value</th>
                              <th class="text-center">Achievement</th>
                              
                          </tr>
                      </thead>
                      <tbody>
                          @php
                          $totalAcv = 0;
                          @endphp
                          @foreach ($kpa->datas() as $data)
   
                          @php
                          $urlPdf = Storage::url($data->evidence) ;
                          @endphp
                          <tr>
                              {{-- <td>{{++$i}}</td> --}}
                              <td >{{$data->kpidetail->objective}}</td>
                              <td class="text-center"> {{$data->kpidetail->weight}}</td>
                              <td class="text-center"> {{$data->kpidetail->target}}</td>
                              <td class="text-center"> {{$data->value}}</td>
                              <td class="text-center"> <b>{{$data->achievement}}</b></td>
                              
                          </tr>
   
   
                         
                          @php
                          $totalAcv += $data->achievement;
                          @endphp
   
                          @endforeach
                      </tbody>
                      <tfoot>
                           @php
                               
                               $addtional = $kpa->additional()
                           @endphp
                          @if($addtional)
                          <tr>
                              <td class="text-right" colspan="5">Achievement</td>
                              <td class="text-right"><b>{{$totalAcv}}</b></td>
                          </tr>
                          <tr>
                              <td>Addtional </td>
                              <td><b>{{$addtional->addtional_objective}}</b></td>
                              <td>{{$addtional->addtional_weight}}</td>
                              <td>{{$addtional->addtional_target}}</td>
                              <td>{{$addtional->value}}</td>
                              <td class="text-right"><b>{{$addtional->achievement}}</b></td>
                          </tr>
   
                          @endif
                          <tr>
                              <th colspan="4" class="text-right">Achievement Final</th>
                              <th class="text-center" id="totalAchievement">{{$kpa->achievement}}</th>
                          </tr>
                      </tfoot>
                  </table>
                  @if($kpa->status == '0'|| $kpa->status == '101')
                  <small class="text-danger">* Jika anda ingin mengupdate nilai value, silahkan klik objective</small>
                  @endif
               </div>
            @endforeach
            

         
            
            
            
            
            {{-- <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
               you again!</p> --}}
         </div>
      </div>
   </div>
</div>
@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        let semester = "{{$semester}}";
        // ambil dari laravel
        var achievementData = @json($achievementData);

        // konversi object ke array
        var dataArray = Object.values(achievementData);


        if (semester == 'I') {
            console.log('Test');

            var bulan = ["Jan", "Feb", "Mar", "Apr", "May", "Jun"];

        } else {

            var bulan = ["Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        }

        var barChart = document.getElementById('barChart').getContext('2d');

        var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
                labels: bulan,
                datasets: [{
                    label: "Achievement",
                    backgroundColor: 'rgb(23, 125, 255)',
                    borderColor: 'rgb(23, 125, 255)',
                    data: dataArray,
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