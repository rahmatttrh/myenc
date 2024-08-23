@extends('layouts.app')

@section('title')
Detail Transaction Payroll Employee
@endsection

@section('content')
<div class="page-inner">
   
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         
         <li class="breadcrumb-item active" aria-current="page">Detail Transaction</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-4">
         <a href=""  class="btn btn-primary btn-block">Submit</a>
         <hr>
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
                           <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true">Lembur</a> </li>
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                           
                        
                           <div class="row">
                              <div class="col-3">
                                 <span><b>Gaji Bersih</b></span> <br>
                                 <span>Pendapatan</span> <br>
                                 <span>Uang Lembur</span> <br>
                                 <span>Potongan</span>
                              </div>
                              <div class="col-md-9">
                                 <span>: <b>{{formatRupiah($transaction->total)}}</b></span> <br>
                                 <span>: {{formatRupiah($payroll->total)}}</span> <br>
                                 <span>: </span> <br>
                                 <span>: {{formatRupiah($transaction->reductions->where('type', 'employee')->sum('value'))}}</span> <br>
                              </div>
                           </div>
                           <hr>
                           
                           <div class="row">
                              <div class="col">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Potongan Karyawan</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('type', 'employee') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             {{-- <td></td> --}}
                                             <td class="text-right">{{formatRupiah($red->value)}}</td>
                                           </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Potongan Perusahaan</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('type', 'company') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             {{-- <td></td> --}}
                                             <td class="text-right">{{formatRupiah($red->value)}}</td>
                                           </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           
                           
                           <hr>
                           <p>
                              <a class="btn btn-light btn-sm border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                #Info
                              </a>
                              
                            </p>
                            <div class="collapse" id="collapseExample">
                              <table>
                                 <tbody>
                                    
                                    <tr>
                                       <td><b>Desc</b> </td>
                                       <td><b>Min. Salary</b></td>
                                       <td><b>Max. Salary</b></td>
                                       <td><b>Beban Perusahaan</b></td>
                                       <td><b>Beban Karyawan</b></td>
                                    </tr>
                                    @foreach ($employee->unit->reductions as $unitRed)
                                       <tr>
                                          <td>{{$unitRed->name}}</td>
                                          <td>{{formatRupiah($unitRed->min_salary)}}</td>
                                          <td>{{formatRupiah($unitRed->max_salary)}}</td>
                                          <td>{{$unitRed->company}} %</td>
                                          <td>{{$unitRed->employee}} %</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                            </div>
                           
                        </div>
            
                        <div class="tab-pane fade " id="pills-doc-nobd" role="tabpanel" aria-labelledby="pills-doc-tab-nobd">
                           <form action="{{route('payroll.overtime.store')}}" method="POST">
                              @csrf
                              <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden>
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                       <label>Date</label>
                                       <input type="date" class="form-control" id="date" name="date" >
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group form-group-default">
                                       <label>Hours</label>
                                       <input type="number" class="form-control" id="hours" name="hours" >
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="form-group form-group-default">
                                       <label>Type</label>
                                       <select name="type" id="type" class="form-control">
                                          <option value="1">GP/173</option>
                                          <option value="2">GP+Tunj. Tetap/173</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <button class="btn btn-block btn-primary" type="submit">Add</button>
                                 </div>
                              </div>
                           </form>
                           <hr>
                           <div class="table-responsive">
                              <table>
                                 <thead>
                                    <tr>
                                       <th>Date</th>
                                       <th>Hours</th>
                                       <th>Type</th>
                                       <th>Rupiah</th>
                                    </tr>
                                 </thead>
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
</div>

@endsection