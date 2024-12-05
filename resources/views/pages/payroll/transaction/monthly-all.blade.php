@extends('layouts.app')
@section('title')
Payroll Transaction
@endsection
@section('content')

<style>
   .hori-timeline .events {
      border-top: 3px solid #e9ecef;
   }
   .hori-timeline .events .event-list {
      display: block;
      position: relative;
      text-align: center;
      padding-top: 70px;
      margin-right: 0;
   }
   .hori-timeline .events .event-list:before {
      content: "";
      position: absolute;
      height: 36px;
      border-right: 2px dashed #dee2e6;
      top: 0;
   }
   .hori-timeline .events .event-list .event-date {
      position: absolute;
      top: 38px;
      left: 0;
      right: 0;
      width: 75px;
      margin: 0 auto;
      border-radius: 4px;
      padding: 2px 4px;
   }
   @media (min-width: 1140px) {
      .hori-timeline .events .event-list {
         display: inline-block;
         width: 24%;
         padding-top: 45px;
      }
      .hori-timeline .events .event-list .event-date {
         top: -12px;
      }
   }
   .bg-soft-primary {
      background-color: rgba(64,144,203,.3)!important;
   }
   .bg-soft-success {
      background-color: rgba(71,189,154,.3)!important;
   }
   .bg-soft-danger {
      background-color: rgba(231,76,94,.3)!important;
   }
   .bg-soft-warning {
      background-color: rgba(249,213,112,.3)!important;
   }
   .card {
      border: none;
      margin-bottom: 24px;
      -webkit-box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
      box-shadow: 0 0 13px 0 rgba(236,236,241,.44);
   }
</style>

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll.transaction')}}">Transaction</a></li>
         <li class="breadcrumb-item active" aria-current="page">Monthly</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-3">
         @if (auth()->user()->hasRole("HRD|HRD-Payroll") && $unitTransaction->status == 5)
         <a href="#" class="btn btn-success btn-block mb-2" data-target="#modal-publish-tu" data-toggle="modal">Publish</a>
         @endif
         @if (auth()->user()->hasRole("HRD|HRD-Payroll") && $unitTransaction->status == 0)
                  <a class="btn btn-primary  mb-2 btn-block" href="#" data-target="#modal-submit-tu" data-toggle="modal">Submit</a>
                  
               @endif
         <div class="card shadow-none border ">
            <div class="card-header">
               Status : <x-status.unit-transaction :unittrans="$unitTransaction" />
            </div>
            <div class="card-body">
                  <h4 class="text-uppercase">{{$unit->name}}</h4>
                  {{$unitTransaction->month}} {{$unitTransaction->year}} 
                  <hr class="bg-white">
                    
                  {{$unitTransaction->total_employee}} / {{count($unitTransaction->unit->employees->where('status', 1))}} Karyawan <br>
                  {{-- Total Salary <br> --}}
                   {{formatRupiah($unitTransaction->total_salary)}}
            </div>
            
            
         </div>
         {{-- <a href="" class="btn btn-block btn-info">Submit</a> --}}
         <a href="{{route('payroll.transaction.monthly', enkripRambo($unitTransaction->id))}}" class="btn btn-light border btn-block">Report Payslip</a>
         <a href="{{route('payroll.report.bpjsks', enkripRambo($unitTransaction->id))}}" class="btn btn-light border btn-block">BPJS Kesehatan</a>
         <a href="{{route('payroll.report.bpjsks', enkripRambo($unitTransaction->id))}}" class="btn btn-light border btn-block">BPJS Ketenagakerjaan</a>

         

         
      </div>
      <div class="col">
         <div class="hori-timeline mt-3" dir="ltr">
            <ul class="list-inline events">
                
                <li class="list-inline-item event-list">
                    <div class="px-4">
                     
                     @if ($manhrd)
                        <div class="event-date bg-primary text-white">MANAGER HRD</div>
                        <h5 class="font-size-16">{{formatDateTime($manhrd->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">HRD MANAGER</div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                        
                        {{-- <p class="text-muted">Everyone realizes why a new common language one could refuse translators.</p> --}}
                        {{-- <div>
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                        </div> --}}
                    </div>
                </li>
                <li class="list-inline-item event-list">
                    <div class="px-4">
                     @if ($manfin)
                        <div class="event-date bg-primary text-white">MANAGER FINANCE</div>
                        <h5 class="font-size-16">{{formatDateTime($manfin->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">MANAGER FINANCE</div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                        {{-- <p class="text-muted">If several languages coalesce the grammar of the resulting simple and regular</p>
                        <div>
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                        </div> --}}
                    </div>
                </li>
                <li class="list-inline-item event-list">
                    <div class="px-4">
                     @if ($gm)
                        <div class="event-date bg-primary text-white">GENERAL MANAGER</div>
                        <h5 class="font-size-16">{{formatDateTime($gm->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">GENERAL MANAGER</div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                    </div>
                </li>
                <li class="list-inline-item event-list">
                   <div class="px-4">
                     @if ($bod)
                        <div class="event-date bg-primary text-white">DIREKSI / BOD</div>
                        <h5 class="font-size-16">{{formatDateTime($bod->created_at)}}</h5>
                        
                        @else  
                        <div class="event-date bg-light border">DIREKSI <br><br> </div>
                        <h5 class="font-size-16">Waiting</h5>
                        
                     @endif
                   </div>
               </li>
                
            </ul>
         </div>
         <hr>
         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active "  role="tabpanel" >
               <div class="table-responsive">
                  <table id="data" class="display basic-datatables table-sm">
                     <thead>
                        <tr>
                           <th>NIK</th>
                           <th>Name</th>
                           <th>Loc</th>
                           <th class="text-right">Pendapatan</th>
                           <th class="text-right">Lembur</th>
                           <th class="text-right">Deduction</th>
                           <th class="text-right">Gaji Bersih</th>
                           <th></th>
                           
                           {{-- <th>Status</th> --}}
                           {{-- <th>Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($transactions as $trans)
                        <tr>
                           <td>
                              <a href="{{route('payroll.transaction.detail', enkripRambo($trans->id))}}">{{$trans->employee->nik}} </a>
                              
                           </td>
                           <td>{{$trans->employee->biodata->fullName()}}</td>
                           <td>{{$trans->location->name}}</td>
                           <td class="text-right" >{{formatRupiahB($trans->employee->payroll->total)}}</td>
                           <td class="text-right" >{{formatRupiahB($trans->overtime)}}</td>
                           <td class="text-right" >{{formatRupiahB($trans->reduction+$trans->reduction_absence+$trans->reduction_late)}}</td>
                           <td class="text-right">{{formatRupiahB($trans->total)}}</td>
                           <td>
                              @if ($trans->payslip_status == 'show')
                                  <i data-target="#modal-payslip-hide-{{$trans->id}}" data-toggle="modal" class="fa fa-eye"></i>
                                  @else
                                  <i data-target="#modal-payslip-show-{{$trans->id}}" data-toggle="modal" class="fa fa-eye-slash"></i>
                              @endif
                           </td>
                           {{-- <td>0</td> --}}
                           {{-- <td><x-status.transaction :trans="$trans" /> </td> --}}
                           
                        </tr>

                        <div class="modal fade" id="modal-payslip-hide-{{$trans->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                       <input type="text" value="{{$trans->id}}" name="transactionId" id="transactionId" hidden>
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

                        <div class="modal fade" id="modal-payslip-show-{{$trans->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                       <input type="text" value="{{$trans->id}}" name="transactionId" id="transactionId" hidden>
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
                        @endforeach
                        
                        
                        
                     </tbody>
                  </table>
               </div>

               <div class="modal fade" id="modal-add-reduction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-sm" role="document">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Add Reduction</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <form action="{{route('reduction.store')}}" method="POST" >
                           <div class="modal-body">
                              @csrf
                              <input type="number" value="{{$unit->id}}" name="unit" id="unit" hidden>
                              <div class="form-group form-group-default">
                                 <label>Type</label>
                                 <select class="form-control" name="desc" id="desc" required>
                                     <option value="">Choose</option>
                                     <option value="BPJS KS">BPJS Kesehatan </option>
                                     <option value="BPJS KT">BPJS Ketenagakerjaan </option>
                                 </select>
                             </div>
                              <div class="row">
                                 <div class="col-12">
                                    <div class="form-group form-group-default">
                                       <label>Min. Salary</label>
                                       <input type="number" class="form-control" name="min_salary" id="min_salary">
                                   </div>
                                 </div>
                                 <div class="col-12">
                                    <div class="form-group form-group-default">
                                       <label>Max. Salary</label>
                                       <input type="number" class="form-control" name="max_salary" id="max_salary">
                                   </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>Company (%)</label>
                                       <input type="decimal" class="form-control" name="company" id="company">
                                   </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>Employee (%)</label>
                                       <input type="decimal" class="form-control" name="employee" id="employee">
                                   </div>
                                 </div>
                              </div>
                                 
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-info ">Create</button>
                           </div>
                           
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <hr>
         
      </div>
   </div>
   
</div>

<div class="modal fade" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">

           
            
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">SIMPLE DATA</button> --}}
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            <a  href="{{route('employee.export.simple')}}" class="btn btn-info">SIMPLE DATA</a>
            <a  href="{{route('employee.export')}}" class="btn btn-primary">FULL DATA</a>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-submit-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.submit.master.transaction')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Submit this Report and send to HRD Manager?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-publish-tu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm<br>
               
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.publish')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="text" value="{{$unitTransaction->id}}" name="unitTransactionId" id="unitTransactionId" hidden>
               <span>Publish PaySlip dan tampilkan di Dashboard Karyawan?</span>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Publish</button>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection