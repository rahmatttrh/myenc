<div class="tab-pane fade {{$panel == 'contract' ? 'show active' : ''}} " id="v-pills-contract" role="tabpanel" aria-labelledby="v-pills-contract-tab">
   <div class="card card-with-nav">
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link show active" id="pills-contract-tab-nobd" data-toggle="pill" href="#pills-contract-nobd" role="tab" aria-controls="pills-contract-nobd" aria-selected="true">Contract</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-allowances-tab-nobd" data-toggle="pill" href="#pills-allowances-nobd" role="tab" aria-controls="pills-allowances-nobd" aria-selected="false">Allowances</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-commissions-tab-nobd" data-toggle="pill" href="#pills-commissions-nobd" role="tab" aria-controls="pills-commissions-nobd" aria-selected="false">Commissions</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-deductions-tab-nobd" data-toggle="pill" href="#pills-deductions-nobd" role="tab" aria-controls="pills-deductions-nobd" aria-selected="false">Deductions</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-reimbursements-tab-nobd" data-toggle="pill" href="#pills-reimbursements-nobd" role="tab" aria-controls="pills-reimbursements-nobd" aria-selected="false">Reimbursements</a> </li>
            </ul>
         </div>
      </div>
      <div class="card-body">
         <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">

            <div class="tab-pane fade show active" id="pills-contract-nobd" role="tabpanel" aria-labelledby="pills-contract-tab-nobd">
               <form action="{{route('contract.update')}}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  <input type="number" name="contract" id="contract" value="{{$employee->contract_id}}" hidden>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Contract Date</label>
                           <input type="date" class="form-control" id="date" name="date" value="{{$employee->contract->date}}">
                           @error('date')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>ID Employee</label>
                           <input type="text" class="form-control" name="id" id="id" value="{{$employee->contract->id_no}}">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Department</label>
                           <select class="form-control" id="department" name="department">
                              @foreach ($departments as $department)
                                 <option {{$employee->contract->department_id == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                              @endforeach
                           </select>
                           @error('department')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Designation</label>
                           <select class="form-control" id="designation" name="designation">
                              @foreach ($designations as $designation)
                                  <option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
                              @endforeach
                           </select>
                           @error('designation')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Basic Salary (IDR)</label>
                           <input type="text" class="form-control" value="{{$employee->contract->salary}}" name="salary" id="salary">
                           @error('salary')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Hourly Rate (IDR)</label>
                           <input type="text" class="form-control" value="{{$employee->contract->hourly_rate}}" name="hourly_rate" id="hourly_rate">
                           @error('hourly_rate')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Payslip Type</label>
                           <select class="form-control" id="payslip" name="payslip">
                              <option {{$employee->contract->payslip == 'Month' ? 'selected' : ''}} value="Month">Month</option>
                           </select>
                           @error('payslip')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Office Shift</label>
                           <select class="form-control" id="shift" name="shift">
                              @foreach ($shifts as $shift)
                              <option {{$employee->contract->shift_id == $shift->id ? 'selected' : ''}} value="{{$shift->id}}">{{$shift->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Contract End</label>
                           <input type="date" class="form-control" id="end" name="end" value="{{$employee->contract->end}}">
                        </div>
                     </div>
                  </div>
                  <div class="form-group form-group-default">  
                     <label>Role Description</label>
                     <textarea type="text" class="form-control" id="desc" name="desc">{{$employee->contract->desc}}</textarea>
                  </div>
                  
                  
                  <div class="text-right mt-3 mb-3">
                     <button type="submit" class="btn btn-dark">Update Contract</button>
                  </div>
               </form>
            </div>

            <div class="tab-pane fade " id="pills-allowances-nobd" role="tabpanel" aria-labelledby="pills-allowances-tab-nobd">
               <a class="" data-toggle="collapse" href="#addAllowances" role="button" aria-expanded="false" aria-controls="addAllowances">
                  <i class="fas fa-plus mr-1"></i>
                  Add ...
               </a>
               <div class="collapse " id="addAllowances">
                  <form action="{{route('employee.update')}}" method="POST">
                     @csrf
                     @method('PUT')
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Allowances Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark">Add</button>
                           </div>
                        </div>
                        
                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped " >
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Title</th>
                           <th>Amount</th>
                           <th>Allowances Option</th>
                           <th>Amount Option</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="tab-pane fade " id="pills-commissions-nobd" role="tabpanel" aria-labelledby="pills-commissions-tab-nobd">
                  <a class="" data-toggle="collapse" href="#addCommissions" role="button" aria-expanded="false" aria-controls="addCommissions">
                     <i class="fas fa-plus mr-1"></i>
                    Add ...
                  </a>
               <div class="collapse" id="addCommissions">
                  <form action="{{route('employee.update')}}" method="POST">
                     @csrf
                     @method('PUT')
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Commission Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark">Add</button>
                           </div>
                        </div>
                        
                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped " >
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Title</th>
                           <th>Amount</th>
                           <th>Commission Option</th>
                           <th>Amount Option</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="tab-pane fade" id="pills-deductions-nobd" role="tabpanel" aria-labelledby="pills-deductions-tab-nobd">
               <a class="" data-toggle="collapse" href="#addDeductions" role="button" aria-expanded="false" aria-controls="addDeductions">
                  <i class="fas fa-plus mr-1"></i>
                  Add ...
               </a>
               <div class="collapse" id="addDeductions">
                  <form action="{{route('employee.update')}}" method="POST">
                     @csrf
                     @method('PUT')
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Deduction Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark">Add</button>
                           </div>
                        </div>
                        
                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped " >
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Title</th>
                           <th>Amount</th>
                           <th>Deduction Option</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
               </div>
            </div>

            <div class="tab-pane fade " id="pills-reimbursements-nobd" role="tabpanel" aria-labelledby="pills-reimbursements-tab-nobd">
               <a class="" data-toggle="collapse" href="#addReimbursements" role="button" aria-expanded="false" aria-controls="addReimbursements">
                  <i class="fas fa-plus mr-1"></i>
                  Add ...
               </a>
               <div class="collapse" id="addReimbursements">
                  <form action="{{route('employee.update')}}" method="POST">
                     @csrf
                     @method('PUT')
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Reimbursement Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="1">1</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">  
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="date" name="date" >
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark">Add</button>
                           </div>
                        </div>
                        
                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped " >
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Title</th>
                           <th>Amount</th>
                           <th>Reimbursement Option</th>
                           <th>Amount Option</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        
                     </tbody>
                  </table>
               </div>
            </div>

         </div>
         
      </div>
   </div>
</div>