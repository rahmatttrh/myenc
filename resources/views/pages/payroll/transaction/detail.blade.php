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
         <a href="{{route('payroll.transaction.monthly.all', enkripRambo($transaction->unit_transaction_id))}}" class="btn btn-light border mb-2"> <i class="fa fa-backward"></i>Back</a>
         <a href="{{route('payslip.pdf', enkripRambo($transaction->id))}}" class="btn btn-light border mb-2"><i class="fa fa-print"></i> Export Payslip</a>
         {{-- <a href=""  class="btn btn-primary btn-block">Submit</a> --}}
         {{-- <h1>Slip Gaji</h1>
         <hr> --}}
         <div class="card card-light shadow-none border">
            <div class="card-header">
               <h4>Payslip {{$transaction->month}}</h4>
               {{formatDate($transaction->cut_from)}} - {{formatDate($transaction->cut_to)}}
            </div>
            <div class="card-header">
               
               
               <h3><b>{{$transaction->employee->biodata->first_name}} {{$transaction->employee->biodata->last_name}}</b></h3>
              
               <div class="d-flex justify-content-between">
                  <div>
                     NIK <br>
                     Unit <br>
                     
                     Dept <br>
                     Position 

                  </div>
                  <div class="text-right">
                     {{$transaction->employee->nik ?? '-'}} <br>
                     {{$transaction->employee->contract->unit->name ?? '-'}} <br>
                     
                     {{$transaction->employee->department->name ?? '-'}} <br>
                     {{$transaction->employee->position->name ?? '-'}}

                  </div>
               </div>
            </div>
          
            <div class="card-body">
               <h2><b>{{formatRupiah($transaction->total ?? 0)}}</b></h2>
            </div>

            @if (auth()->user()->hasRole('Administrator|HRD|HRD-Payroll'))
            <div class="card-footer d-flex justify-content-between">
               <div>
                  Status <br>
                  Visibility
               </div>
               <div class="text-right">
                  <x-status.transaction :trans="$transaction" /> <br>
                  @if ($transaction->payslip_status == 'show')
                  <i data-target="#modal-payslip-hide-{{$transaction->id}}" data-toggle="modal" class="fa fa-eye"></i>
                  @else
                  <i data-target="#modal-payslip-show-{{$transaction->id}}" data-toggle="modal" class="fa fa-eye-slash"></i>
                  @endif
               </div>
                
            </div>
            @endif
            
            {{-- <div class="card-footer d-flex justify-content-between">
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
               
               
            </div>  --}}
         </div>

         
      </div>
      <div class="col-md-8">
         

         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
               <div class="card card-with-nav shadow-none border">
                  <div class="card-header">
                     <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                           <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">Detail</a> </li>
                           @if (auth()->user()->hasRole('Karyawan'))
                               @else
                               <li class="nav-item"> <a class="nav-link " id="pills-deduction-tab-nobd" data-toggle="pill" href="#pills-deduction-nobd" role="tab" aria-controls="pills-deduction-nobd" aria-selected="true">Deduction</a> </li>
                               <li class="nav-item"> <a class="nav-link " id="pills-spkl-tab-nobd" data-toggle="pill" href="#pills-spkl-nobd" role="tab" aria-controls="pills-spkl-nobd" aria-selected="true">SPKL</a> </li>
                               <li class="nav-item"> <a class="nav-link " id="pills-absence-tab-nobd" data-toggle="pill" href="#pills-absence-nobd" role="tab" aria-controls="pills-absence-nobd" aria-selected="true">Absence</a> </li>
                               <li class="nav-item"> <a class="nav-link " id="pills-additional-tab-nobd" data-toggle="pill" href="#pills-additional-nobd" role="tab" aria-controls="pills-additional-nobd" aria-selected="true">Additional</a> </li>
                           @endif
                           
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                           <div class="row">
                              <div class="col-xl-6">
                                 <table>
                                    <thead>
                                       <tr>
                                          <th colspan="2">Pendapatan</th>
                                       </tr>
                                       {{-- <tr>
                                          <th>Description</th>
                                          <th class="text-right">Nominal</th>
                                       </tr> --}}
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>Gaji Pokok</td>
                                          <td class="text-right">{{formatRupiah($transaction->employee->payroll->pokok) ?? 0}}</td>
                                       </tr>
                                      
                                       <tr>
                                          <td>Tunj. Jabatan</td>
                                          <td class="text-right">{{formatRupiah($transaction->employee->payroll->tunj_jabatan) ?? 0}}</td>
                                       </tr>
                                       <tr>
                                          <td>Tunj. Kinerja</td>
                                          <td class="text-right">{{formatRupiah($transaction->employee->payroll->tunj_kinerja) ?? 0}} </td>
                                       </tr>
                                       <tr>
                                          <td>Tunj. Operasional</td>
                                          <td class="text-right">{{formatRupiah($transaction->employee->payroll->tunj_ops) ?? 0}}</td>
                                       </tr>
                                       <tr>
                                          <td>Insentif</td>
                                          <td class="text-right">{{formatRupiah($transaction->employee->payroll->insentif) ?? 0}}</td>
                                       </tr>
                                       <tr>
                                          <td>Tunj. Lain</td>
                                          <td class="text-right">{{formatRupiah($transaction->additional_penambahan)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Lembur</td>
                                          <td class="text-right">{{formatRupiah($transaction->overtime)}}</td>
                                       </tr>
                                    </tbody>
                                 </table>

                                 <table class="mt-4">
                                    <thead>
                                       <tr>
                                          <th colspan="">Pendapatan</th>
                                          <th class="text-right">{{formatRupiah($payroll->total + $transaction->additional_penambahan + $transaction->overtime)}}</th>
                                       </tr>
                                       <tr>
                                          <th colspan="">Potongan</th>
                                          <th class="text-right">{{formatRupiah($transaction->reduction + $transaction->reduction_absence + $transaction->reduction_late)}}</th>
                                       </tr>
                                       <tr>
                                          <th colspan="">Gaji Bersih</th>
                                          <th class="text-right">{{formatRupiah($transaction->total)}}</th>
                                       </tr>
                                    </thead>
                                    <tbody>
   
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-xl-6">
                                 <table>
                                    <thead>
                                       <tr>
                                          <th colspan="2">Potongan</th>
                                       </tr>
                                       {{-- <tr>
                                          <th>Description</th>
                                          <th class="text-right">Nominal</th>
                                       </tr> --}}
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('class', 'Default')->where('type', 'employee') as $red)
                                          @if ($red->value)
                                          <tr>
                                             <td>{{$red->name}}</td>
                                             <td class="text-right text-danger"><b>{{formatRupiah($red->value)}}</b></td>
                                             {{-- <td><a href="{{route('transaction.reduction.delete', enkripRambo($red->id))}}">Delete</a></td> --}}
                                          </tr>
                                          @endif 
                                       @endforeach
                                       <tr>
                                          <td>Absensi</td>
                                          <td class="text-right">{{formatRupiah($transaction->reduction_absence)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Terlambat</td>
                                          <td class="text-right">{{formatRupiah($transaction->reduction_late)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Lain-Lain</td>
                                          <td class="text-right">{{formatRupiah($transaction->additional_pengurangan)}}</td>
                                       </tr>
                                    </tbody>
                                 </table>


                                 <table>
                                    <thead>
                                       <tr>
                                          <th colspan="2">Potongan Tambahan</th>
                                       </tr>
                                       {{-- <tr>
                                          <th>Description</th>
                                          <th class="text-right">Nominal</th>
                                       </tr> --}}
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('class', 'Additional')->where('type', 'employee') as $red)
                                          @if ($red->value)
                                          <tr>
                                             <td>{{$red->name}}</td>
                                             <td class="text-right text-danger"><b>{{formatRupiah($red->value)}}</b></td>
                                             {{-- <td><a href="{{route('transaction.reduction.delete', enkripRambo($red->id))}}">Delete</a></td> --}}
                                          </tr>
                                          @endif 
                                       @endforeach
                                     
                                    </tbody>
                                 </table>
                              </div>

                              
                              
                              <div class="col-md-12">
                                 <hr><hr>
                              <br>
                              {{-- <br>
                                 <table>
                                    <thead>
                                       <tr>
                                          <th>Description</th>
                                          <th class="text-right">Nominal</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td>Pendapatan</td>
                                          <td class="text-right">{{formatRupiah($payroll->total)}}</td>
                                       </tr>
                                      
                                       <tr>
                                          <td>Deduction</td>
                                          <td class="text-right">{{formatRupiah($transaction->reduction)}}</td>
                                       </tr>
                                       <tr>
                                          <td>Bruto</td>
                                          <td class="text-right">{{formatRupiah($transaction->bruto)}}</td>
                                       </tr>
                                       <tr>
                                          <td colspan="2"></td>
                                       </tr>
                                       <tr>
                                          <td>Lembur & Piket</td>
                                          <td class="text-right">{{formatRupiah($transaction->overtime)}}</td>
                                       </tr>
                                       <tr>
                                          <td><b>Gaji Bersih</b></td>
                                          <th class="text-right"><b> {{formatRupiah($transaction->total)}}</b></th>
                                       </tr>
                                    </tbody>
                                 </table> --}}
                              </div>
                           </div>
                           
                        </div>

                        <div class="tab-pane fade " id="pills-deduction-nobd" role="tabpanel" aria-labelledby="pills-deduction-tab-nobd">
                           <div class="row">
                              <div class="col-xl-6">
                                 <table class="">
                                    <thead>
                                       <tr>
                                          <th colspan="3">BSU</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($transaction->reductions->where('class', 'Default')->where('type', 'employee') as $red)
                                           <tr>
                                             <td>{{$red->name}}</td>
                                             {{-- <td></td> --}}
                                             <td class="text-right text-danger"><b>{{formatRupiah($red->value)}}</b></td>
                                             {{-- <td><a href="{{route('transaction.reduction.delete', enkripRambo($red->id))}}">Delete</a></td> --}}
                                           </tr>
                                           {{-- @if ($red->value_real != 0)
                                           <tr>
                                             <td class="text-right text-muted">Seharusnya</td>
                                             <td class="text-right text-muted text-danger">{{formatRupiah($red->value_real)}}</td>
                                           </tr>
                                           @endif --}}
                                           
                                       @endforeach
                                       <tr>
                                          <td class="text-right"><b>Total</b></td>
                                          <td class="text-right"><b>{{formatRupiah($transaction->reduction)}}</b></td>
                                       </tr>
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              @if (auth()->user()->hasRole('Karyawan'))
                                  @else
                                  <div class="col-xl-6">
                                    <table class="">
                                       <thead>
                                          <tr>
                                             <th colspan="3">Real</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach ($transaction->reductions->where('class', 'Default')->where('type', 'employee') as $red)
                                              
                                              @if ($red->value_real != 0)
                                              <tr>
                                                <td class="text-right ">{{$red->name}}</td>
                                                <td class="text-right  text-danger">{{formatRupiah($red->value_real)}}</td>
                                              </tr>
                                              @endif
                                              
                                          @endforeach
                                          <tr>
                                             <td class="text-right"><b>Total</b></td>
                                             <td class="text-right"><b>{{formatRupiah($transaction->reductions->where('type', 'employee')->where('class', 'Default')->sum('value_real'))}}</b></td>
                                          </tr>
                                          
                                          
                                          
                                       </tbody>
                                    </table>
                                 </div>
                              @endif
                              



                              
                           </div>
                         
                        </div>

                        <div class="tab-pane fade" id="pills-spkl-nobd" role="tabpanel" aria-labelledby="pills-spkl-tab-nobd">
                           <div class="row">
                              <div class="col-md-12">
                                 <table class="">
                                    <thead>
                                       <tr>
                                          <th colspan="3" class="text-right">Total</th>
                                          <th class="text-right">{{formatRupiah($transaction->overtime)}}</th>
                                          {{-- <th></th> --}}
                                       </tr>
                                       <tr>
                                          <th colspan="">Date</th>
                                          <th>Type</th>
                                          <th>Hours</th>
                                          <th class="text-right">Rate</th>
                                          {{-- <th></th> --}}
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($overtimes as $over)
                                           <tr>
                                             <td>{{formatDate($over->date)}}</td>
                                             <td>
                                                @if ($over->type == 1)
                                                    Lembur
                                                    @elseif($over->type == 2)
                                                    Piket
                                                    @elseif($over->type == 3)
                                                    ATL
                                                @endif
                                             </td>
                                             <td class="">{{$over->hours}} Jam</td>
                                             <td class="text-right text-info">{{formatRupiah($over->rate)}}</td>
                                             {{-- <td><a href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a></td> --}}
                                           </tr>
                                       @endforeach
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              
                           </div>
                           
                           
                           
                           <hr>
                           <p>
                              {{-- <a class="btn btn-light btn-sm border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                #Info
                              </a>
                               --}}
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
            
                        

                        <div class="tab-pane fade " id="pills-absence-nobd" role="tabpanel" aria-labelledby="pills-absence-tab-nobd">
                           <div class="row">
                              <div class="col-xl-6">
                                 <table class="">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Ketidakhadiran</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($alphas as $alpha)
                                           
                                           
                                           <tr>
                                             <td class=" ">{{formatDate($alpha->date)}}</td>
                                             <td class="text-right  text-danger">{{formatRupiah($alpha->value)}}</td>
                                           </tr>
                                           
                                       @endforeach
                                       <tr>
                                          <td class="text-right"><b>Total</b></td>
                                          <td class="text-right"><b>{{formatRupiah($alphas->sum('value'))}}</b></td>
                                       </tr>
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>

                              <div class="col-xl-6">
                                 <table class="">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Terlambat</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($lates as $late)
                                           
                                           
                                           <tr>
                                             <td class="">{{formatDate($late->date)}}</td>
                                             <th class="text-right">{{$late->minute}} Menit</th>
                                             {{-- <td class="text-right  text-danger">{{formatRupiah($alpha->value)}}</td> --}}
                                           </tr>
                                           
                                       @endforeach
                                       <tr>
                                          <td class="text-right"><b>Total Keterlambatan</b></td>
                                          <td class="text-right"><b>{{$totalKeterlambatan}}</b></td>
                                       </tr>
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              
                           </div>
                         
                        </div>

                        <div class="tab-pane fade " id="pills-additional-nobd" role="tabpanel" aria-labelledby="pills-additional-tab-nobd">
                           <div class="row">
                              
                              <div class="col-6">
                                 <table class="">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Penambahan</th>
                                          
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($penambahans as $item)
                                           <tr>
                                             <td>{{formatRupiahB($item->value)}}</td>
                                             <td>{{$item->desc}}</td>
                                           </tr>
                                       @endforeach

                                      
                                       
                                       
                                       
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-6">
                                 <table class="">
                                    <thead>
                                       <tr>
                                          <th colspan="3">Pengurangan</th>
                                          
                                       </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($pengurangans as $item)
                                           <tr>
                                             <td>{{formatRupiahB($item->value)}}</td>
                                             <td>{{$item->desc}}</td>
                                           </tr>
                                       @endforeach

                                      
                                       
                                       
                                       
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

<div class="modal fade" id="modal-payslip-hide-{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payslip.hide')}}" method="POST" >
            @csrf
            @method('PUT')
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$transaction->id}}" name="transactionId" id="transactionId" hidden>
               {{-- <span>Hide this Payslip.</span> <br> --}}
               <span>Sembunyikan Payslip di dashboard karyawan?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Hide</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-payslip-show-{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payslip.show')}}" method="POST" >
            @csrf
            @method('PUT')
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$transaction->id}}" name="transactionId" id="transactionId" hidden>
                 {{-- <span>Show this Payslip.</span> <br>  --}}
               <span>Tampilkan Payslip di dashboard karyaan?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Show</button>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection