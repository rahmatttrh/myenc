<div class="tab-pane fade {{$panel == 'contract' ? 'show active' : ''}} " id="v-pills-contract" role="tabpanel" aria-labelledby="v-pills-contract-tab">
   <div class="card card-with-nav shadow-none border">
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link show active" id="pills-contract-tab-nobd" data-toggle="pill" href="#pills-contract-nobd" role="tab" aria-controls="pills-contract-nobd" aria-selected="true">Active</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-history-tab-nobd" data-toggle="pill" href="#pills-history-nobd" role="tab" aria-controls="pills-history-nobd" aria-selected="true">History</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-mutation-tab-nobd" data-toggle="pill" href="#pills-mutation-nobd" role="tab" aria-controls="pills-mutation-nobd" aria-selected="true">Mutation</a> </li>
               {{--<li class="nav-item"> <a class="nav-link " id="pills-allowances-tab-nobd" data-toggle="pill" href="#pills-allowances-nobd" role="tab" aria-controls="pills-allowances-nobd" aria-selected="false">Allowances</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-commissions-tab-nobd" data-toggle="pill" href="#pills-commissions-nobd" role="tab" aria-controls="pills-commissions-nobd" aria-selected="false">Commissions</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-deductions-tab-nobd" data-toggle="pill" href="#pills-deductions-nobd" role="tab" aria-controls="pills-deductions-nobd" aria-selected="false">Deductions</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-reimbursements-tab-nobd" data-toggle="pill" href="#pills-reimbursements-nobd" role="tab" aria-controls="pills-reimbursements-nobd" aria-selected="false">Reimbursements</a> </li>--}}
            </ul>
         </div>
      </div>
      <div class="card-body">
         <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">

            <div class="tab-pane fade show active" id="pills-contract-nobd" role="tabpanel" aria-labelledby="pills-contract-tab-nobd">
               <div class="card card-dark bg-secondary-gradient shadow-none">
                  
                  {{-- @if (count($employee->positions) > 0)
                     <div class="card-body bubble-shadow text-white">
                        <div class="row">
                           <div class="col-md-8">
                              
                              <h4 style="font-weight: bolder" class="text-uppercase">
                                 @if ($employee->contract->type == 'Kontrak')
                                 Kontrak
                                 @elseif($employee->contract->type == 'Tetap')
                                 Tetap
                                 @else
                                 Kontrak/Tetap
                                 @endif
                                 
                                 <br> 
                                 @if ($employee->contract->type == 'Kontrak')
                                    {{formatDate($employee->contract->start)}} - {{formatDate($employee->contract->end)}} 
                                 @endif
                              </h4>
                           </div>
                           @if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Recruitment'))
                              
                           @if (count($employee->positions) > 0)
                               @else
                           
                           <div class="col text-right">
                              <div class=" ml-auto">
                                 <a href="#" type="button" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa fa-ellipsis-h"></i>
                                 </a>
                                 <div class="dropdown-menu">
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-add-leader">Add Leader</a>
                                    <hr>
                                    @if ($employee->contract->type == 'Kontrak')
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-add-contract">Create New</a>
                                    
                                    @endif
                                    
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-create-mutation">Add Mutation</a>
                                    <hr>
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-edit-contract">Edit</a>
                                    
                                    @if ($employee->contract->type == 'PKWT')
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-bank-{{$employee->id}}">Delete</a>
                                    @endif
                                 </div>
                              </div>
                           </div>
                           @endif
                           @endif
                        </div>
                        <div class="row mt-2">
                           <div class="col-6 pr-0">
                              <div class="text-small text-uppercase fw-bold op-8">NIK </div>
                              <small class="fw-bold mt-1 ">{{$employee->nik ?? '-'}} </small>
                              <hr>
                              @foreach ($employee->positions as $pos)
                              <div class="text-small text-uppercase fw-bold op-8">{{$pos->department->unit->name}}  {{$pos->department->name}}</div>
                              <small class="fw-bold mt-1">{{$pos->name ?? '-'}} </small><br><br>
                              @endforeach
                              
                              
                              
                           </div>
                           
                        </div>
                        
                        
                        

                       
                        
                     </div>
                      @else --}}
                      <div class="card-body bubble-shadow text-white">
                        <div class="row">
                           <div class="col-md-8">
                              {{-- <img src="{{asset('img/visa.svg')}}" height="12.5" alt="Visa Logo"> --}}
                              <h4 style="font-weight: bolder" class="text-uppercase">
                                 @if ($employee->contract->type == 'Kontrak')
                                 {{-- {{$employee->contract->type}}  --}}
                                 Kontrak
                                 @elseif($employee->contract->type == 'Tetap')
                                 Tetap
                                 @else
                                 Kontrak/Tetap
                                 @endif
                                 
                                 <br> 
                                 @if ($employee->contract->type == 'Kontrak')
                                    {{formatDate($employee->contract->start)}} - {{formatDate($employee->contract->end)}} 
                                 @endif
                              </h4>
                           </div>
                           @if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Recruitment'))
                              
                           
                           <div class="col text-right">
                              <div class=" ml-auto">
                                 <a href="#" type="button" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa fa-ellipsis-h"></i>
                                 </a>
                                 <div class="dropdown-menu">
                                    {{-- <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-add-position">Add Position</a>
                                    <hr> --}}
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-add-leader">Add Leader</a>
                                    <hr>
                                    @if ($employee->contract->type == 'Kontrak')
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-add-contract">Create New</a>
                                    
                                    @endif
                                    
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-create-mutation">Add Mutation</a>
                                    <hr>
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-edit-contract">Edit</a>
                                    
                                    @if ($employee->contract->type == 'PKWT')
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-bank-{{$employee->id}}">Delete</a>
                                    @endif
                                 </div>
                              </div>
                           </div>
                           @endif
                        </div>
                        
                        {{-- <h2 class="py-3 mb-0">{{$acc->account_no}}</h2> --}}
                        
                        
                        <div class="row mt-2">
                           <div class="col-6 pr-0">
                              <div class="text-small text-uppercase fw-bold op-8">NIK </div>
                              <small class="fw-bold mt-1 ">{{$employee->nik ?? '-'}} </small>
                              <div class="mt-2"></div>
                              <div class="text-small text-uppercase fw-bold op-8">Unit </div>
                              <small class="fw-bold mt-1">{{$employee->contract->unit->name ?? '-'}}  </small>
                              <div class="mt-2"></div>
                              <div class="text-small text-uppercase fw-bold op-8">Department </div>
                              <small class="fw-bold mt-1">{{$employee->department->name ?? '-'}}  </small><br>
                              <small class="fw-bold mt-1 pl-2">- {{$employee->sub_dept->name ?? '-'}}  </small>
                              <div class="mt-2"></div>
                              <hr>
                              <div class="text-small text-uppercase fw-bold op-8">Position </div>
                              {{-- <small class="fw-bold mt-1"></small> --}}
                              <small class="fw-bold mt-1">
                              @if (count($employee->positions) > 0)
                                 @foreach ($employee->positions as $pos)
                                 {{$pos->department->unit->name}}  {{$pos->department->name}}
                                 {{$pos->name ?? '-'}} <br>
                                 @endforeach
                                 @else
                                 @if (auth()->user()->hasRole('Administrator'))
                                 Designation ID :{{$employee->contract->designation->id}} <br>
                                 Position ID : {{$employee->position_id ?? ''}} <br>
                                 @endif
                                 {{$employee->position->name ?? ''}} 
                              @endif
                              </small>
                              
                              
                           </div>
                           <div class="col-6 pl-0 text-right">
                              <div class="text-small text-uppercase fw-bold op-8">Lokasi Kerja </div>
                              <small class="fw-bold mt-1 text-uppercase ">{{$employee->contract->loc ?? '-'}} </small>
                              <div class="text-small text-uppercase fw-bold op-8">{{$employee->contract->shift->name ?? '-'}}
                                 @if ($employee->contract->shift)
                                 {{formatTime($employee->contract->shift->in )}}
                                 @endif
                                 @if ($employee->contract->shift)
                                 - {{formatTime($employee->contract->shift->out )}}
                                 @endif
                                 
                                 </div>
                              
                           </div>
                        </div>
                        
                        
                           @if ($employee->designation->name == 'Manager')
                               @else
                               <hr class="bg-white">
                              <div class="text-small text-uppercase fw-bold op-8"> {{$employee->contract->desc ?? 'Jobdesk Empty'}} </div>
                              <hr class="bg-white">
                               <div class="row">
                                 {{-- <div class="col-6 pr-0">
                                    <div class="text-small text-uppercase fw-bold op-8">Manager </div>
                                    <small class="fw-bold mt-1">{{$employee->manager->biodata->fullName() ?? '-'}} </small>
                                    
                                    
                                 </div> --}}
                                 <div class="col-6 pr-0 ">
                                    <div class="text-small text-uppercase fw-bold op-8">Direct Leader</div>
                                    <small class="fw-bold mt-1">
                                       
                                       @foreach ($empleaders as $empleader)
                                       @if (auth()->user()->hasRole('Administrator|HRD|HRD-Staff|HRD-Recruitment'))
                                       <a href="#"  class="text-light" data-toggle="modal" data-target="#modal-revoke-leader-{{$empleader->id}}">{{$empleader->leader->nik}} {{$empleader->leader->biodata->fullName()}}</a>
                                        @else
                                        {{$empleader->leader->nik}} {{$empleader->leader->biodata->fullName()}}
                                       @endif
                                       {{-- <a href="#"  class="text-light" data-toggle="modal" data-target="#modal-revoke-leader-{{$empleader->id}}">{{$empleader->leader->nik}} {{$empleader->leader->biodata->fullName()}}</a> --}}
                                          <br>

                                          <x-employee.contract.modal.revoke-leader :employee="$employee" :leader="$empleader" />
                                       @endforeach
                                    </small>
                                    
                                 
                                    
                                 </div>

                                 <div class="col-6 prl-0 text-right ">
                                    <div class="text-small text-uppercase fw-bold op-8">Manager / Asst. Manager</div>
                                    <small class="fw-bold mt-1">
                                       @foreach ($mymanagers as $man)
                                           {{-- @if (count($man->positions) > 0)
                                             @foreach ($man->positions as $pos)
                                                   {{$pos->name}}
                                             @endforeach
                                             @else
                                             {{$man->position->name}}
                                          @endif
                                        
                                       |  --}}
                                       {{$man->biodata->fullName()}} <br>
                                       @endforeach
                                    </small>
                                 </div>
                                 
                              </div>
                           @endif
                           
                           
                        
                        
                        @if ($employee->contract->type == 'Kontrak')
                        <div class="row mt-2">
                           <div class="col-12 pl-0 text-right">
                              <div class="text-small text-uppercase fw-bold op-8">Join Date</div>
                              <small class="text-small text-uppercase fw-bold op-8">{{formatDate($employee->join)}}</small>
                              {{-- <div class="text-small text-uppercase fw-bold op-8">Join Date</div> --}}
                           
                              
                           </div>
                        </div>
                        @endif
   
                        @if ($employee->contract->type == 'Tetap')
                        <hr class="bg-white">
                        <div class="row">
                           <div class="col-6 pr-0">
                              <div class="text-small text-uppercase fw-bold op-8">Join Date </div>
                              <small class="fw-bold mb-1">
                                 @if ($employee->join)
                                 {{formatDate($employee->join)}}
                                 @else
                                 -
                                 @endif

                                 {{-- {{formatDate($employee->join)}} --}}
                                 
                              </small>
                              
                              
                           </div>
                           <div class="col-6 pl-0 text-right">
                              <div class="text-small text-uppercase fw-bold op-8">Penetapan</div>
                              <small class="fw-bold mb-1">
                                 @if ($employee->contract->determination)
                                 {{formatDate($employee->contract->determination)}}
                                 @else
                                 -
                                 @endif
                                 </small>
                              
                           
                              
                           </div>
                        </div>
                        
                        @endif
                        
                     </div>
                     
                  {{-- @endif --}}

               </div>

               
               
              
               <hr>
            </div>

            <div class="tab-pane fade s" id="pills-history-nobd" role="tabpanel" aria-labelledby="pills-history-tab-nobd">
               {{-- <h3>Histories</h3> --}}
               @foreach ($contracts as $contract)
                  @if ($contract->status == 0)
                  <div class="card  shadow-none border">
                     <div class="card-body ">
                        <div class="row">
   
                           <div class="col-md-8">
                              {{-- <img src="{{asset('img/visa.svg')}}" height="12.5" alt="Visa Logo"> --}}
                              <span>{{$contract->type}} <br> 
                                 @if ($contract->type == 'Kontrak')
                                    {{formatDate($contract->start)}} - {{formatDate($contract->end)}} 
                                 @endif
                              </span>
                           </div>
                           <div class="col text-right">
                              <div class=" ml-auto">
                                 <a href="#" type="button" class=" dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa fa-ellipsis-h"></i>
                                 </a>
                                 <div class="dropdown-menu">
                                    
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-detail-contract-{{$contract->id}}">Detail</a>
                                    <hr>
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-contract-{{$contract->id}}">Delete</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        {{-- <h2 class="py-3 mb-0">{{$acc->account_no}}</h2> --}}
                        
                     </div>
                  </div>
                  <x-employee.contract.modal.detail-contract :contract="$contract"/>
                  <div class="modal fade" id="modal-delete-contract-{{$contract->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                  
                           <div class="modal-body">
                  
                              Delete this Contract ? <br>
                              {{$contract->employee->nik}} <br>
                              {{formatDate($contract->start)}} -  {{formatDate($contract->end)}}
                  
                  
                           </div>
                           <div class="modal-footer"><a href="{{route('contract.delete', enkripRambo($contract->id))}}" class="btn btn-danger">Delete</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  @else
                  @endif
               @endforeach
               
               
            </div>

            <div class="tab-pane fade s" id="pills-mutation-nobd" role="tabpanel" aria-labelledby="pills-mutation-tab-nobd">
               {{-- <h3>Histories</h3> --}}
               @foreach ($employee->mutations as $mutation)
               <div class="card  shadow-none border">
                  
                  <div class="card-body ">
                     {{formatDate($mutation->date)}}
                     <hr>
                     <div class="row">

                        <div class="col-md-8">
                           {{-- <img src="{{asset('img/visa.svg')}}" height="12.5" alt="Visa Logo"> --}}
                           <span>
                              {{-- {{$mutation->before->designation->name}}  --}}
                              {{$mutation->before->position->name}} <br> 
                              Department {{$mutation->before->department->name}} <br>
                              {{$mutation->before->unit->name}} <br>
                              {{$mutation->before->loc}} <br>
                              

                           </span>
                        </div>
                        <div class="col text-right">
                           <span>
                              {{-- {{$mutation->before->designation->name}}  --}}
                              {{$mutation->become->position->name}} <br> 
                              Department {{$mutation->become->department->name}} <br>
                              {{$mutation->become->unit->name}} <br>
                              {{$mutation->become->loc}} <br>
                              

                           </span>
                        </div>
                     </div>
                     <hr>
                     <a href="#" data-toggle="modal" data-target="#modal-detail-mutation-{{$mutation->id}}">Detail</a>
                     
                     {{-- <h2 class="py-3 mb-0">{{$acc->account_no}}</h2> --}}
                     
                  </div>
               </div>
               <x-employee.contract.modal.detail-mutation :mutation="$mutation"/>
               @endforeach
               
               
            </div>

            <div class="tab-pane fade " id="pills-allowances-nobd" role="tabpanel" aria-labelledby="pills-allowances-tab-nobd">
               <a class="" data-toggle="collapse" href="#addAllowances" role="button" aria-expanded="false" aria-controls="addAllowances">
                  <i class="fas fa-plus mr-1"></i>
                  Add ...
               </a>
               <div class="collapse " id="addAllowances">
                  <form action="{{route('employee.allowances.store')}}" method="POST">
                     @csrf
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Allowances Option</label>
                                    <select class="form-control" id="option" name="option">
                                       <option value="" disabled selected>Select one</option>
                                       <option value="Perjalanan Dinas">Perjalanan Dinas</option>
                                       <option value="Hari Raya">Hari Raya</option>
                                       <option value="Kompensasi">Kompensasi</option>
                                       <option value="Menikah">Menikah</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Type</label>
                                    <select class="form-control" id="amount_option" name="amount_option">
                                       <option value="" disabled selected>Select one</option>
                                       <option value="IDR">IDR</option>
                                       <option value="USD">USD</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="amount" name="amount">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
                           </div>
                        </div>

                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped ">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Title</th>
                           <th>Amount</th>
                           <th>Type</th>
                           <th>Amount Option</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($employee->allowances as $allow)
                        <tr>
                           <td class="text-center">{{++$i}}</td>
                           <td class="text-nowrap">
                              <a href="" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 {{$allow->title}}
                              </a>
                              <div class="dropdown-menu">
                                 <a class="dropdown-item" href="" data-toggle="modal" data-target="#modal-edit-allow-{{$allow->id}}">Edit</a>
                                 <a class="dropdown-item" href="" data-toggle="modal" data-target="#modal-delete-allow-{{$allow->id}}">Delete</a>
                              </div>
                           </td>
                           <td>{{formatRupiah($allow->amount)}}</td>
                           <td>{{$allow->option}}</td>
                           <td>{{$allow->amount_option}}</td>
                        </tr>
                        <x-employee.contract.modal.delete-allow :allow="$allow" />
                        <x-employee.contract.modal.edit-allow :allow="$allow" />
                        @endforeach
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
                  <form action="{{route('employee.allowances.store')}}" method="POST">
                     @csrf
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Commission Option</label>
                                    <select class="form-control" id="designation" name="designation">
                                       <option value="" disabled selected>Choose one</option>
                                       <option value="Penjualan">Penjualan</option>
                                       <option value="Berjenjang">Berjenjang</option>
                                       <option value="Premi">Premi</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Type</label>
                                    <select class="form-control" id="amount_option" name="amount_option">
                                       <option value="" disabled selected>Select one</option>
                                       <option value="IDR">IDR</option>
                                       <option value="USD">USD</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="amount" name="amount">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark" >Add</button>
                           </div>
                        </div>

                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped ">
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
                                    <input type="text" class="form-control" id="date" name="date">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="date" name="date">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
                           </div>
                        </div>

                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped ">
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
                                    <input type="text" class="form-control" id="date" name="date">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group form-group-default">
                                    <label>Ammount</label>
                                    <input type="text" class="form-control" id="date" name="date">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="text-right">
                              <button type="submit" class="btn btn-block btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
                           </div>
                        </div>

                     </div>
                  </form>
               </div>
               <div class="table-responsive mt-3">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped ">
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

<x-employee.contract.modal.edit-contract :employee="$employee" :shifts="$shifts" :designations="$designations" :departments="$departments" :positions="$positions" :managers="$managers" :spvs="$spvs"  :leaders="$leaders" :subdepts="$subdepts" :units="$units" :allpositions="$allpositions" />
<x-employee.contract.modal.add-contract :employee="$employee" :shifts="$shifts" :designations="$designations" :departments="$departments" :positions="$positions" :managers="$managers" :spvs="$spvs"  :leaders="$leaders" :subdepts="$subdepts" :units="$units" :allpositions="$allpositions" />

<x-employee.contract.modal.create-mutation :employee="$employee" :shifts="$shifts" :designations="$designations" :departments="$departments" :positions="$positions" :managers="$managers" :spvs="$spvs"  :leaders="$leaders" :allmanagers="$allmanagers" :allspvs="$allspvs"  :allleaders="$allleaders" :subdepts="$subdepts" :units="$units" :allpositions="$allpositions" />
<x-employee.contract.modal.add-leader :employee="$employee" :leaders="$leaders" />

{{-- <x-employee.contract.modal.add-position :employee="$employee" :leaders="$leaders" /> --}}

@push('js_footer')
    

<script>
   $(document).ready(function() {
      $('.determination').hide()
      var type = $('#type').val();
      if (type == 'Kontrak') {
         $('.determination').hide()
         $('.end').show()
      } else {
         $('.determination').show()
         $('.end').hide()
      }

      $('.type').change(function() {
         
         var type = $('#type').val();
         console.log(type);
         if (type == 'Kontrak') {
            $('.determination').hide()
            $('.end').show()
         } else {
            $('.determination').show()
            $('.end').hide()
         }
      })

      $('.determination_add').hide()
      var type = $('#type_add').val();
      if (type == 'Kontrak') {
         $('.determination_add').hide()
         $('.end_add').show()
      } else {
         $('.determination_add').show()
         $('.end_add').hide()
      }

      $('.type_add').change(function() {
         
         var type = $('#type_add').val();
         console.log(type);
         if (type == 'Kontrak') {
            $('.determination_add').hide()
            $('.end_add').show()
         } else {
            $('.determination_add').show()
            $('.end_add').hide()
         }
      })
   })
</script>
@endpush


@push('myjs')
   <script>
      console.log('get_department');
   
      $(document).ready(function() {
         $('.unit').change(function() {
            
            var unit = $('#unit').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('unit :' + unit);
            
            $.ajax({
               url: "/fetch/department/" + unit ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.department').html(result.result);

                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })

         $('.department').change(function() {
            
            var department = $('#department').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('department :' + department);
            
            $.ajax({
               url: "/fetch/subdept/" + department ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.subdept').html(result.result);
                     $('.manager').html(result.manager);
                     $('.leader').html(result.leader);
                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })

         $('.subdept').change(function() {
            
            var subdept = $('#subdept').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('subdept :' + subdept);
            
            $.ajax({
               url: "/fetch/position/" + subdept ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.position').html(result.result);
                     
                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })



         $('.unit_add').change(function() {
            
            var unit_add = $('#unit_add').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('unit_add :' + unit_add);
            
            $.ajax({
               url: "/fetch/department/" + unit_add ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.department_add').html(result.result);

                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })

         $('.department_add').change(function() {
            
            var department_add = $('#department_add').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('department_add :' + department_add);
            
            $.ajax({
               url: "/fetch/subdept/" + department_add ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.subdept_add').html(result.result);
                     
                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })

         $('.subdept_add').change(function() {
            
            var subdept_add = $('#subdept_add').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('subdept_add :' + subdept_add);
            
            $.ajax({
               url: "/fetch/position/" + subdept_add ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.position_add').html(result.result);
                     
                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })



         $('.unit_mutation').change(function() {
            
            var unit_mutation = $('#unit_mutation').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('unit_mutation :' + unit_mutation);
            
            $.ajax({
               url: "/fetch/department/" + unit_mutation ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.department_mutation').html(result.result);

                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })

         $('.department_mutation').change(function() {
            
            var department_mutation = $('#department_mutation').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('department_mutation :' + department_mutation);
            
            $.ajax({
               url: "/fetch/subdept/" + department_mutation ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.subdept_mutation').html(result.result);
                     $('.manager_mutation').html(result.manager);
                     $('.leader_mutation').html(result.leader);
                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })

         $('.subdept_mutation').change(function() {
            
            var subdept_mutation = $('#subdept_mutation').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('subdept_mutation :' + subdept_mutation);
            
            $.ajax({
               url: "/fetch/position/" + subdept_mutation ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.position_mutation').html(result.result);
                     
                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })
      })
   </script>
@endpush