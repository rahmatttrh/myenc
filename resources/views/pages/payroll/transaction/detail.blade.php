@extends('layouts.app')

@section('title')
Detail Transaction Payroll Employee
@endsection

@section('content')
<div class="page-inner">
   
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll')}}">Payroll</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Detail Transaction</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-4">
         
         <div class="card card-light shadow-none border">
            <div class="card-header">
               
               
               <div class="card-list">
                  <div class="item-list">
                     <div class="avatar avatar-md avatar-online">

                        @if ($transaction->employee->picture)
                        <img src="{{asset('storage/' . $transaction->employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                        @else
                        <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                        @endif
                     </div>
                     <div class="info-user ml-3">
                        <div class="username">
                           <h3>{{$transaction->employee->biodata->first_name}} {{$transaction->employee->biodata->last_name}}</h3>
                        </div>
                        <div class="status"> {{$transaction->employee->position->name ?? '-'}} </div>
                     </div>
                  </div>
               </div>
               {{-- <small class="badge badge-white text-uppercase">{{$employee->contract->type ?? 'Kontrak/Tetap'}}</small> --}}
               <small class="badge badge-white text-uppercase">{{$transaction->employee->contract->unit->name ?? '-'}}</small>
               {{-- <small class="badge badge-white text-uppercase">{{$employee->contract->loc ?? 'Lokasi'}}</small> --}}
            </div>
          
            <div class="card-body">
               <b>{{formatRupiah($transaction->employee->payroll->total ?? 0)}}</b>
            </div>
            <div class="card-footer d-flex justify-content-between">
               <div>
                  @foreach ($transaction->details->where('type', 'basic') as $trans)
                      {{$trans->desc}} <br>
                  @endforeach
                  
                  <hr>
                  <a href="#" data-target="#modal-update-payroll" data-toggle="modal">Update</a>
               </div>
               <div class="text-right">
                  @if ($transaction->employee->payroll_id != null)
                  {{formatRupiah($transaction->employee->payroll->pokok) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_jabatan) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_ops) ?? 0}}  <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_kinerja) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->tunj_fungsional) ?? 0}} <br>
                  {{formatRupiah($transaction->employee->payroll->insentif) ?? 0}}
                      @else
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                  @endif
                  
               </div>
               
               
            </div> 
         </div>
      </div>
      <div class="col-md-8">
         

         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
               <div class="card card-with-nav shadow-none border">
                  <div class="card-header">
                     <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                           <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">Detail Transaksi Agustus</a> </li>
                           {{-- <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true">Komponen</a> </li> --}}
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                           <a href=""  class="btn btn-primary btn-sm mb-2">Submit</a>
                           <div class="row">
                              <div class="col-3">
                                 <span><b>Final</b></span> <br>
                                 <span>Gaji Pokok</span> <br>
                                 <span>Lembur/Piket</span> <br>
                                 <span>Pengurangan</span>
                              </div>
                              <div class="col-md-9">
                                 <span>: <b>6.500.000</b></span> <br>
                                 <span>: 4.300.000</span> <br>
                                 <span>: 300.000</span> <br>
                                 <span>: 100.000</span> <br>
                              </div>
                           </div>
                           <hr>
                           <table class=" ">
                              <thead>
                                 <tr>
                                    <th colspan="6">Penambah</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="">Lembur</td>
                                    <td>Upah/173</td>
                                    <td>Aktual</td>
                                    <td>8 Jam</td>
                                    <td>120.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 <tr>
                                    <td class="">Lembur</td>
                                    <td>Upah/173</td>
                                    <td>Aktual</td>
                                    <td>4 Jam</td>
                                    <td>60.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 
                                 
                                 
                              </tbody>
                           </table>

                           <table class="mt-2">
                              <thead>
                                 <tr>
                                    <th colspan="3">Potongan</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="">Kehadiran</td>
                                    <td>50.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 <tr>
                                    <td class="">Keterlambatan</td>
                                    <td>120.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 
                                 
                                 
                              </tbody>
                           </table>
                        </div>
            
                        
            
                     </div>
            
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>

@endsection