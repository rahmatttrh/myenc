@extends('layouts.app-doc')
@section('title')
   KPA Employee
@endsection
@section('content')
<div class="container-xl">
   <!-- Page title -->
   <div class="page-header d-print-none">
     <div class="row align-items-center">
       <div class="col">
         <h2 class="page-title">
           KPA {{$kpa->employe->biodata->fullName()}}
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
                     <dd class="col-3">Name</dd>
                     <dd class="col-9">: {{$kpa->employe->biodata->fullName()}}</dd>
                     <dd class="col-3">Month</dd>
                     <dd class="col-9">: {{ date('M Y', strtotime($kpa->date))}}</dd>
                     
                  </dl>
               </div>
               <div class="col-6 text-end">
                  <p class="h3">Status</p>
                  {{-- <x-status.schedule :schedule="$schedule" :lastreport="$schedule->lastreport()"/> --}}
                     @if($kpa->status == 0)
                     <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                     @elseif($kpa->status == '1')
                     <td><span class="badge badge-warning badge-lg"><b>Validasi HRD</b></span></td>
                     @elseif($kpa->status == '2')
                     <td><span class="badge badge-success badge-lg"><b>Done</b></span></td>
                     @elseif($kpa->status == '101')
                     <td><span class="badge badge-danger badge-lg"><b>Di Reject</b></span></td>
                  @endif
               </div>
            {{-- <div class="col-12 my-4">
                  <h1>{{$schedule->vessel->name}} </h1>
                  <h1>{{$schedule->origin->name}} - {{$schedule->destination->name}}</h1>
               </div> --}}
            </div>
            <h4 class="">Objective KPI</h4>
            <div class="table-responsive">
               <table id="tableCreate" class=" table table-striped ">
                   <thead>
                       <tr>
                           <th>No</th>
                           <th>Objective</th>
                           <th>Weight</th>
                           <th>Target</th>
                           <th>Value</th>
                           <th>Achievement</th>
                           @if($kpa->status == '1' || $kpa->status == '101')
                           <th>Status</th>
                           <th>Keterangan</th>
                           @endif
                       </tr>
                   </thead>
                   <tbody>
                       @php
                       $totalAcv = 0;
                       @endphp
                       @foreach ($datas as $data)

                       @php
                       $urlPdf = Storage::url($data->evidence) ;
                       @endphp
                       <tr>
                           <td>{{++$i}}</td>
                           <td><a href="#" data-target="#myModal-{{$data->id}}" data-toggle="modal"> {{$data->kpidetail->objective}} </a></td>
                           <td> {{$data->kpidetail->weight}}</td>
                           <td> {{$data->kpidetail->target}}</td>
                           <td> {{$data->value}}</td>
                           <td class="text-right"> <b>{{$data->achievement}}</b></td>
                           @if($kpa->status == '1' || $kpa->status == '101')
                           <td>
                               @if($data->status == '0')
                               <span class="badge badge-default">Open</span>
                               @elseif($data->status == '1')
                               <span class="badge badge-success">Valid</span>
                               @elseif($data->status == '101')
                               <span class="badge badge-danger">Invalid</span>
                               @endif
                           </td>
                           <td>
                               <br>{{$data->reason_rejection}}
                           </td>
                           @endif
                       </tr>


                      
                       @php
                       $totalAcv += $data->achievement;
                       @endphp

                       @endforeach
                   </tbody>
                   <tfoot>
                       @if($addtional)
                       <tr>
                           <td class="text-right" colspan="5">Achievement</td>
                           <td class="text-right"><b>{{$totalAcv}}</b></td>
                       </tr>
                       <tr>
                           <td>Addtional </td>
                           <td><b><a href="#" data-target="#modalEditAddtional" data-toggle="modal">{{$addtional->addtional_objective}}</a></b></td>
                           <td>{{$addtional->addtional_weight}}</td>
                           <td>{{$addtional->addtional_target}}</td>
                           <td>{{$addtional->value}}</td>
                           <td class="text-right"><b>{{$addtional->achievement}}</b></td>
                       </tr>

                       @endif
                       <tr>
                           <th colspan="5" class="text-right">Achievement Final</th>
                           <th class="text-right" id="totalAchievement">{{$kpa->achievement}}</th>
                       </tr>
                   </tfoot>
               </table>
               @if($kpa->status == '0'|| $kpa->status == '101')
               <small class="text-danger">* Jika anda ingin mengupdate nilai value, silahkan klik objective</small>
               @endif
           </div>
            
            
            
            {{-- <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to working with
               you again!</p> --}}
         </div>
      </div>
   </div>
</div>
@endsection