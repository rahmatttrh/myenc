@extends('layouts.app')
   @section('title')
      Payroll Bisnis Unit
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Payroll</li>
            <li class="breadcrumb-item active" aria-current="page">Bisnis Unit</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-md-4">
            {{-- <div class="card shadow-none border">
               
               <div class="card-body"> --}}
                     <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($units as $unit)
                           <a class="nav-link {{$firstUnit->id == $unit->id ? 'active' : ''}} text-left pl-3" id="v-pills-{{$unit->id}}-tab" data-toggle="pill" href="#v-pills-{{$unit->id}}" role="tab" aria-controls="v-pills-{{$unit->id}}" aria-selected="true">
                              
                               {{$unit->name}}
                           </a>
                        @endforeach
                     </div>
               {{-- </div>
               
            </div> --}}
         </div>
         <div class="col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
               @foreach ($units as $unit)
               <div class="tab-pane fade {{$firstUnit->id == $unit->id ? 'show active' : ''}} " id="v-pills-{{$unit->id}}" role="tabpanel" aria-labelledby="v-pills-{{$unit->id}}-tab">
                  <div class="card">
                     <div class="card-header  p-2 bg-primary text-white">
                        {{-- <small> --}}
                           {{-- @if (auth()->user()->hasRole('Administrator'))
                              {{$unit->id}} 
                           @endif --}}
                            <b>{{$unit->name}}</b> <br>
                            Potongan
                        {{-- </small>  --}}
                     </div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col">
                              <small>Perusahaan</small>
                              <hr>
                              <div class="row">
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>BPJS KS </label>
                                       <input type="text" class="form-control" id="last_name" name="last_name" value="">
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>BPJS KT </label>
                                       <input type="text" class="form-control" id="last_name" name="last_name" value="">
                                    </div>
                                 </div>
                              </div>
                              
                              
                           </div>
                           <div class="col">
                              <small>Karyawan</small>
                              <hr>
                              <div class="row">
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>BPJS KS</label>
                                       <input type="text" class="form-control" id="last_name" name="last_name" value="">
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>BPJS KT </label>
                                       <input type="text" class="form-control" id="last_name" name="last_name" value="">
                                    </div>
                                 </div>
                              </div>
                              
                              
                           </div>
                        </div>
                        
                     </div>
                  </div>
               </div>

                   
                 
               @endforeach
            </div>
            <hr>
            
         </div>
      </div>
   </div>

@endsection