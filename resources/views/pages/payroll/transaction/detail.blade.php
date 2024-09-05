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
                           <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true">Form SPKL</a> </li>
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
                                 {{-- <span>Lembur</span> <br>
                                 <span>Potongan</span> --}}
                              </div>
                              <div class="col-md-9">
                                 <span>: <b>{{formatRupiah($transaction->total)}}</b></span> <br>
                                 <span>: {{formatRupiah($payroll->total)}}</span> <br>
                                 {{-- <span>: {{formatRupiah($totalOvertime)}} </span> <br>
                                 <span>: {{formatRupiah($transaction->reduction)}}</span> <br> --}}
                              </div>
                           </div>
                           <hr>
                           <div class="row">
                              <div class="col-md-6">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="5">Lembur & Piket</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($overtimes as $over)
                                           <tr>
                                             <td>{{formatDate($over->date)}}</td>
                                             <td>
                                                @if ($over->type == 1)
                                                    L
                                                    @else
                                                    P
                                                @endif
                                             </td>
                                             <td class="text-right">{{$over->hours}} Jam</td>
                                             <td class="text-right text-info">{{formatRupiah($over->rate)}}</td>
                                             <td><a href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a></td>
                                           </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-6">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="5">Potongan Kehadiran</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($absences as $abs)
                                           <tr>
                                             <td>
                                                @if ($abs->type == 1)
                                                   Alpha
                                                   @elseif($abs->type == 2)
                                                   Terlambat ({{$abs->minute}})
                                                   @elseif($abs->type == 3)
                                                   Cuti/Izin
                                                @endif
                                             </td>
                                             <td>{{formatDate($abs->date)}}</td>
                                             <td class="text-danger">{{formatRupiah($abs->value)}}</td>
                                          </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                                 
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
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
                                             <td class="text-right text-danger"><b>{{formatRupiah($red->value)}}</b></td>
                                           </tr>
                                           @if ($red->value_real != 0)
                                           <tr>
                                             <td class="text-right text-muted">Seharusnya</td>
                                             <td class="text-right text-muted text-danger">{{formatRupiah($red->value_real)}}</td>
                                           </tr>
                                           @endif
                                           
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                                 
                              </div>
                              <div class="col">
                                 <table class="mt-2">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Beban Perusahaan</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('type', 'company') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             {{-- <td></td> --}}
                                             <td class="text-right">{{formatRupiah($red->value)}}</td>
                                           </tr>
                                           @if ($red->value_real != $red->value)
                                           <tr>
                                             <td class="text-right">+ Selisih</td>
                                             <td class="text-right"><b>{{formatRupiah($red->value_real)}}</b></td>
                                           </tr>
                                           @endif
                                       @endforeach
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <hr>

                           <table class="mt-2">
                              <thead>
                                 <tr>
                                    <th colspan="5">Additional</th>
                                    
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($additionals as $add)
                                    <tr>
                                       <td>
                                          @if ($add->type == 1)
                                              Penambahan
                                              @else
                                              Pengurangan
                                          @endif
                                       </td>
                                       <td>{{formatDate($add->date)}}</td>
                                       <td>{{formatRupiah($add->value)}}</td>
                                       <td>{{$add->desc}}</td>
                                       <td><a href="">Delete</a></td>
                                    </tr>
                                 @endforeach
                                 
                                 
                                 
                              </tbody>
                           </table>
                           
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
                           <form action="{{route('payroll.overtime.store')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                               <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
                              {{--<input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
                              <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
                              
                              <div class="row">
                                 <div class="col-md-3">
                                    <div class="form-group form-group-default">
                                       <label>Date*</label>
                                       <input type="date" required class="form-control" id="date" name="date" >
                                    </div>
                                 </div>
                                 <div class="col-md-3">
                                    <div class="form-group form-group-default">
                                       <label>Piket/Lembur*</label>
                                       <select class="form-control " required name="type" id="type">
                                          <option value="" disabled selected>Select</option>
                                          <option value="1">Lembur</option>
                                          <option value="2">Piket</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>Masuk/Libur*</label>
                                       <select class="form-control " required name="holiday_type" id="holiday_type">
                                          <option value="" disabled selected>Select</option>
                                          <option value="1">Masuk</option>
                                          <option value="2">Libur</option>
                                          <option value="3">Libur Nasional</option>
                                          <option value="4">Idul Fitri</option>
                                       </select>
                                    </div>
                                 </div>
                                 
                                 
                              </div>
                              <div class="row">
                                 
                                 <div class="col-md-3">
                                    <div class="form-group form-group-default">
                                       <label>Hours*</label>
                                       <input type="number" required class="form-control" id="hours" name="hours" >
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Document</label>
                                       <input type="file"  class="form-control" id="doc" name="doc" >
                                    </div>
                                 </div>
                                 <div class="col">
                                    <button class="btn btn-block btn-primary" type="submit">Add</button>
                                 </div>
                  
                              </div>
                              
                              
                              
                              
                           </form>
                           <hr>
                           <div class="row">
                              <div class="col-md-6">
                                 <table>
                                    <tbody>
                                       <tr>
                                          <td colspan="2">#Lembur/Jam</td>
                                       </tr>
                                       <tr>
                                          {{-- <td></td> --}}
                                          <td>
                                             @if ($employee->unit->spkl_type == 1)
                                                Gaji Pokok /173
                                                @elseif($employee->unit->spkl_type == 2)
                                                Gaji Pokok+Tunjangan Tetap /173
                                             @endif
                                          </td>
                                          <td>
                                             @if ($employee->unit->spkl_type == 1)
                                                {{formatRupiah(round($employee->payroll->pokok / 173))}}
                                                @elseif($employee->unit->spkl_type == 2)
                                                {{formatRupiah(round($employee->payroll->total / 173))}}
                                             @endif
                                          </td>
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
   </div>
</div>

@endsection