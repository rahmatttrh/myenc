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
                        {{-- @php
                            if(auth()->user()->hasRole('Karyawan')){
                              $myRole = 'Karyawan';
                            }
                        @endphp --}}
                        <option value="" selected disabled>Select</option>
                        @foreach ($roles->where('type', 'employee') as $role)
                            <option {{$employee->role == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                        @endforeach
                     </select>
                     <hr>
                     
                     
                  </div>

                  
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
         <hr>
         <form action="{{route('employee.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
            <div class="form-group form-group-default">  
               <label>Email *</label>
               <input type="text" class="form-control" readonly value="{{$employee->biodata->email}}" id="first_name" name="first_name">
            </div>
            <a href="{{route('password.request')}}">
               <i class="fas fa-key mr-1"></i>
               Change password...
            </a>
               {{-- <div class="text-right mt-3 mb-3">
                  <button type="submit" class="btn btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update</button>
               </div> --}}
         </form>
      </div>
   </div>
</div>