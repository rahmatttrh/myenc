@extends('layouts.app')
@section('title')
Payroll Transaction
@endsection
@section('content')

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
         <div class="card shadow-none border card-primary">
            
            <div class="card-body">
                  <h2 class="text-uppercase">{{$unit->name}}</h2>
                  {{$unitTransaction->month}} {{$unitTransaction->year}} 
                  <hr class="bg-white">
                  Total Karyawan <br>
                  {{$unitTransaction->total_employee}} / {{count($unitTransaction->unit->employees->where('status', 1))}} <br><br>
                  Total Salary <br>
                   {{formatRupiah($unitTransaction->total_salary)}}
            </div>
            
            
         </div>
         {{-- <a href="" class="btn btn-block btn-info">Submit</a> --}}
         <a href="{{route('payroll.transaction.monthly', enkripRambo($unitTransaction->id))}}" class="btn btn-light border btn-block">Report Transaction</a>
         <a href="{{route('payroll.report.bpjsks', enkripRambo($unitTransaction->id))}}" class="btn btn-light border btn-block">Report BPJS KS</a>

         

         
      </div>
      <div class="col">
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
                           <th class="text-right">Gaji Bersih</th>
                           
                           <th>Status</th>
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
                           <td class="text-right">{{formatRupiahB($trans->total)}}</td>
                           {{-- <td>0</td> --}}
                           <td><x-status.transaction :trans="$trans" /> </td>
                           
                        </tr>
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


@endsection