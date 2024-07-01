<div class="modal fade" id="modal-create-mutation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Add Mutation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('mutation.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  <input type="number" name="contract" id="contract" value="{{$employee->contract_id}}" hidden>
                  
                  <div class="row">
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group form-group-default">
                                 <label>Work Hour</label>
                                 <select class="form-control" id="shift" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="shift">
                                    @foreach ($shifts as $shift)
                                    <option {{$employee->contract->shift_id == $shift->id ? 'selected' : ''}} value="{{$shift->id}}">{{$shift->name}} {{formatTime($shift->in)}} - {{formatTime($shift->out)}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Lokasi</label>
                                 <select class="form-control" id="loc" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="loc">
                                    <option value="">Select</option>
                                    <option {{$employee->contract->loc == 'HW' ? 'selected' : ''}} value="HW">HW</option>
                                    <option {{$employee->contract->loc == 'JGC' ? 'selected' : ''}} value="JGC">JGC</option>
                                    <option {{$employee->contract->loc == 'KJ4' ? 'selected' : ''}} value="KJ4">KJ4</option>
                                    <option {{$employee->contract->loc == 'KJ2/KJ5' ? 'selected' : ''}} value="KJ2/KJ5">KJ2/KJ5</option>
                                    <option {{$employee->contract->loc == 'GS' ? 'selected' : ''}} value="GS">GS</option>
                                 </select>
                              </div>
                           </div>
      
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Level</label>
                                 <select class="form-control" id="designation" name="designation" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> >
                                    @foreach ($designations as $designation)
                                    <option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('designation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Jabatan</label>
                                 <select class="form-control" id="position" name="position" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?>>
                                    @foreach ($allpositions as $position)
                                    {{--<option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                    <option {{$employee->position_id == $position->id ? 'selected' : ''}} value="{{$position->id}}">{{$position->name}} </option>
                                    @endforeach
                                 </select>
                                 @error('position')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           
                        </div>
                        <div class="row">
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Department</label>
                                 <select class="form-control" id="department" name="department" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?>>
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
                                 <label>Bisnis Unit</label>
                                 <select class="form-control" id="unit" name="unit" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?>>
                                    @foreach ($units as $unit)
                                    <option {{$employee->contract->unit_id == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('unit')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Salary</label>
                                 <input type="text" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="salary" id="salary" value="{{$employee->contract->salary}}">
                              </div>
                           </div>
                           
                           
                           
                           
                        </div>
                        <div class="row">
                           
                           
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Role Description</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$employee->contract->desc}}" >
      
                              </div>
                           </div>
                        </div>
      
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Manager</label>
                                 <select class="form-control" id="manager" name="manager" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?>>
                                    @foreach ($allmanagers as $man)
                                    <option {{$employee->manager_id == $man->id ? 'selected' : ''}} value="{{$man->id}}">{{$man->biodata->first_name}} {{$man->biodata->last_name}}</option>
                                    @endforeach
                                 </select>
                                 @error('manager')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Direct Leader</label>
                                 <select class="form-control" id="leader" name="leader" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?>>
                                    @foreach ($allspvs as $spv)
                                    <option {{$employee->direct_leader_id == $spv->id ? 'selected' : ''}} value="{{$spv->id}}">  {{$spv->designation->name}} | {{$spv->biodata->first_name}} {{$spv->biodata->last_name}}</option>
                                    @endforeach
                                    @foreach ($allleaders as $lead)
                                    <option {{$employee->direct_leader_id == $lead->id ? 'selected' : ''}} value="{{$lead->id}}">  {{$lead->designation->name}} | {{$lead->biodata->first_name}} {{$lead->biodata->last_name}}</option>
                                    @endforeach
                                 </select>
                                 @error('leader')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                        </div>
                        
                     </div>
                     <div class="col-md-6">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Date</label>
                                 <input type="date" required class="form-control" name="date" id="date"  >
            
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Reason</label>
                                 <input type="text" class="form-control" name="reason" id="reason" placeholder="Alasan mutasi" >
            
                              </div>
                           </div>
                        </div>
                        <hr>
                        <small>*Aksi ini akan otomatis merubah Contract</small><br>
                        <small>*Tidak membuat Contract baru</small>
                     </div>
                  </div>
                  
                  

                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Add Mutation</button>
            </div>
         </form>
      </div>
   </div>
</div>

