<div class="tab-pane fade {{$panel == 'account' ? 'show active' : ''}}" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
   <div class="card shadow-none border">
      <div class="card-header">
         
         <div class="row">
            <div class="col">
               <h1>Accounts</h1>
               <small>Change account detail</small>
            </div>
            {{-- <div class="col text-right">
               <button class="btn btn-sm btn-light border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add account ...</button>
            </div> --}}
         </div>
      </div>
      <div class="card-body">
         <form action="{{route('employee.update.role')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
            <div class="row">
               <div class="col-md-10">
                  
                  
                  <div class="form-group form-group-default">
                     <label>Role</label>
                     <select class="form-control" id="role" name="role">
                        
                        <option value="" selected disabled>
                           
                           Select
                        </option>
                        @foreach ($roles->where('type', 'employee') as $role)
                            <option {{$employee->role == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                     </select>
                     
                  </div>
                  

                  @if ($employee->department)
                  @if ($employee->department->slug == 'hrd')
                  <div class="form-group form-group-default">
                     <label>
                        Second Role
                        {{-- @if ($employee->user->hasRole('Supervisor'))
                            Supervisor
                            @else
                            -
                        @endif --}}
                     </label>
                     <select class="form-control" id="role2" name="role2">
                        <option value="" selected disabled>Select</option>
                        @foreach ($roles->where('type', 'hrd') as $role)
                           <option {{$employee->role2 == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                     </select>
                  </div>
                  @endif
                  @endif
                  
                     
                  
                  @if ($employee->status == 0)
                        * Publish karyawan untuk menambahkan Role
                     @endif
               </div>
               <div class="col-md-2">
                  @if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Recruitment'))
                  <button type="submit" class="btn btn-block btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update</button>
                  @endif
               </div>
            </div>
{{--             
               <div class="text-right mt-3 mb-3">
                  
               </div> --}}
         </form>
         
         <form action="{{route('employee.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
            <div class="form-group form-group-default">  
               <label>Email *</label>
               <input type="text" class="form-control" readonly value="{{$employee->biodata->email}}" id="first_name" name="first_name">
            </div>
            {{-- <a href="{{route('password.request')}}">
               <i class="fas fa-key mr-1"></i>
               Change password...
            </a> --}}
            <hr>
            <a href="#" data-toggle="modal" data-target="#modal-reset-password">Reset Password</a>
               {{-- <div class="text-right mt-3 mb-3">
                  <button type="submit" class="btn btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update</button>
               </div> --}}
         </form>
         <hr>
         @if (auth()->user()->hasRole('Administrator'))
                  Role 1 :   <x-role-1 :employee="$employee" />, 
                  Role 2 :  <x-role-2 :employee="$employee" />
                  <hr>
                  @endif
      </div>
      
   </div>
</div>


<div class="modal fade" id="modal-reset-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Reset Password {{$employee->nik}} {{$employee->biodata->fullName()}} ? 
            <hr>
            Password default : 12345678
            {{-- <hr>
            Harap langsung mengganti password anda setelah login menggunakan password default --}}
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger ">
                  <a class="text-light" href="{{route('employee.reset.password', enkripRambo($employee->id))}}">Delete</a>
            </button>
         </div>
      </div>
   </div>
</div>