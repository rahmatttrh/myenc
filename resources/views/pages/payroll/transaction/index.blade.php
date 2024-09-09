@extends('layouts.app')
@section('title')
Payroll Transaction
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Unit</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-3">
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
      <div class="col-md-9">
         <div class="tab-content" id="v-pills-tabContent">
            @foreach ($units as $unit)
            <div class="tab-pane fade {{$firstUnit->id == $unit->id ? 'show active' : ''}} " id="v-pills-{{$unit->id}}" role="tabpanel" aria-labelledby="v-pills-{{$unit->id}}-tab">
               <div class="table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th colspan="5" class="text-uppercase">SLIP GAJI {{$unit->name}}</th>
                           <th>
                              <a href="" class="btn  btn-light btn-block" data-target="#modal-add-master-transaction" data-toggle="modal"><i class="fas fa-sync"></i> Generate</a>
                           </th>
                        </tr>
                        <tr>
                           <th>Month</th>
                           <th>Year</th>
                           <th class="text-center">Total Employee</th>
                           <th class="text-right">Total Salary</th>
                           <th>Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($unit->unitTransactions as $trans)
                        <tr>
                           <td>{{$trans->month}}</td>
                           <td>{{$trans->year}}</td>
                           <td class="text-center">{{$trans->total_employee}} / {{count($trans->unit->employees->where('status', 1))}}</td>
                           <td class="text-right">{{formatRupiah($trans->total_salary)}}</td>
                           <td>Draft</td>
                           <td>
                              <a href="{{route('payroll.transaction.monthly', enkripRambo($trans->id))}}">Detail</a> | <a href="#" data-target="#modal-delete-master-transaction-{{$trans->id}}" data-toggle="modal">Delete</a>
                           </td>
                        </tr>

                        <div class="modal fade" id="modal-delete-master-transaction-{{$trans->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog modal-sm" role="document">
                              <div class="modal-content text-dark">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                    </button>
                                 </div>
                                 <div class="modal-body ">
                                    Delete data transaction {{$trans->month}} {{$trans->year}} {{$trans->unit->name}} ?
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-danger ">
                                       <a class="text-light" href="{{route('payroll.delete.master.transaction', enkripRambo($trans->id))}}">Delete</a>
                                    </button>
                                 </div>
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

            <div class="modal fade" id="modal-add-master-transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Genetare Slip Gaji</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <form action="{{route('payroll.add.master.transaction')}}" method="POST" >
                        <div class="modal-body">
                           @csrf
                           <input type="number" name="unit" id="unit" value="{{$unit->id}}" hidden>
                           <div class="row">
                              <div class="col-12">
                                 <div class="form-group form-group-default">
                                    <label>Month</label>
                                    <select name="month" id="month" required class="form-control">
                                       <option value="June">June</option>
                                       <option value="July">July</option>
                                       <option value="August">August</option>
                                       <option value="September">September</option>
                                       <option value="November">November</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <div class="form-group form-group-default">
                                    <label>Year</label>
                                    <select name="year" id="year" required class="form-control">
                                       <option value="2023">2023</option>
                                       <option value="2024">2024</option>
                                       <option value="2025">2025</option>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           
                           
                              
                              
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-info ">Add</button>
                        </div>
                        
                     </form>
                  </div>
               </div>
            </div>


              
            @endforeach
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

<div class="modal fade" id="modal-create-transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Transaction</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.transaction.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <div class="row">
                  <div class="col">

                  </div>
               </div>
               <div class="form-group form-group-default">
                  <label>Employee</label>
                  <select class="form-control" name="employee" id="employee" required>
                      <option value="">--- Choose Employe ---</option>
                      @foreach ($employees as $employe)
                          <option value="{{$employe->id}}">{{$employe->nik}} {{$employe->biodata->fullName()}} </option>
                          @endforeach
                      
                  </select>
              </div>
              <small>Daftar Karyawan yang belum memiliki transaksi gaji bulan ini</small>
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Create</button>
            </div>
            
         </form>
      </div>
   </div>
</div>
@endsection