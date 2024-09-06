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
                     <div class="col-md-7">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Work Hour</label>
                                 <select class="form-control" id="shift"  name="shift">
                                    @foreach ($shifts as $shift)
                                    <option {{$employee->contract->shift_id == $shift->id ? 'selected' : ''}} value="{{$shift->id}}">{{formatTime($shift->in)}} - {{formatTime($shift->out)}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Lokasi</label>
                                 <select class="form-control" id="loc"  name="loc">
                                    <option value="">Select</option>
                                    <option {{$employee->contract->loc == 'hw' ? 'selected' : ''}} value="hw">HW</option>
                                    <option {{$employee->contract->loc == 'jgc' ? 'selected' : ''}} value="jgc">JGC</option>
                                    <option {{$employee->contract->loc == 'kj1-2' ? 'selected' : ''}} value="kj1-2">KJ 1-2</option>
                                    <option {{$employee->contract->loc == 'kj4' ? 'selected' : ''}} value="kj4">KJ 4</option>
                                    <option {{$employee->contract->loc == 'kj5' ? 'selected' : ''}} value="kj5">KJ 5</option>
                                    <option {{$employee->contract->loc == 'kj1-5' ? 'selected' : ''}} value="kj1-5">KJ 1-5</option>
                                    <option {{$employee->contract->loc == 'gs' ? 'selected' : ''}} value="gs">GS</option>
                                    <option {{$employee->contract->loc == 'enc' ? 'selected' : ''}} value="enc">ENC</option>
                                    <option {{$employee->contract->loc == 'plb' ? 'selected' : ''}} value="plb">PLB</option>
                                    <option {{$employee->contract->loc == 'smg' ? 'selected' : ''}} value="smg">Semarang</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Bisnis Unit</label>
                                 <select class="form-control unit_mutation" id="unit_mutation" name="unit_mutation" >
                                    @foreach ($units as $unit)
                                    <option {{$employee->contract->unit_id == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('unit_mutation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
      
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Level</label>
                                 <select class="form-control" id="designation" name="designation"  >
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
                                 <label>Department</label>
                                 <select class="form-control department_mutation" id="department_mutation" name="department_mutation" >
                                    @foreach ($departments as $department)
                                    <option {{$employee->contract->department_id == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('department_mutation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Sub Department</label>
                                 <select class="form-control subdept_mutation" id="department_mutation" name="department_mutation" >
                                    @foreach ($subdepts as $sub)
                                    <option {{$employee->contract->sub_dept_id == $sub->id ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('department_mutation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Posisi</label>
                                 <select class="form-control position_mutation" id="position_mutation" name="position_mutation" >
                                    @foreach ($allpositions as $position)
                                    {{--<option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                    <option {{$employee->position_id == $position->id ? 'selected' : ''}} value="{{$position->id}}">{{$position->name}} </option>
                                    @endforeach
                                 </select>
                                 @error('position_mutation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Salary</label>
                                 <input type="text" class="form-control"  name="salary" id="salary" value="{{$employee->contract->salary}}">
                              </div>
                           </div>
                           
                        </div>
                        <div class="row">
                           
                           
                           
                           
                           
                           
                           
                           
                        </div>
                        <div class="row">
                           
                           
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Job Description</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$employee->contract->desc}}" >
      
                              </div>
                           </div>
                        </div>
      
                        {{-- <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Manager</label>
                                 <select class="form-control manager_mutation" id="manager_mutation" name="manager_mutation" >
                                    @foreach ($allmanagers as $man)
                                    <option {{$employee->manager_id == $man->id ? 'selected' : ''}} value="{{$man->id}}">{{$man->biodata->first_name}} {{$man->biodata->last_name}}</option>
                                    @endforeach
                                 </select>
                                 @error('manager_mutation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Direct Leader</label>
                                 <select class="form-control leader_mutation" id="leader_mutation" name="leader_mutation" >
                                    @foreach ($allspvs as $spv)
                                    <option {{$employee->direct_leader_id == $spv->id ? 'selected' : ''}} value="{{$spv->id}}">  {{$spv->designation->name}} | {{$spv->biodata->first_name}} {{$spv->biodata->last_name}}</option>
                                    @endforeach
                                    @foreach ($allleaders as $lead)
                                    <option {{$employee->direct_leader_id == $lead->id ? 'selected' : ''}} value="{{$lead->id}}">  {{$lead->designation->name}} | {{$lead->biodata->first_name}} {{$lead->biodata->last_name}}</option>
                                    @endforeach
                                 </select>
                                 @error('leader_mutation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                        </div> --}}
                        
                     </div>
                     <div class="col-md-5">
                        <div class="row">
                           <div class="col-md-8">
                              <div class="form-group form-group-default">
                                 <label>Date</label>
                                 <input type="date" required class="form-control" name="date" id="date"  >
            
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Reason</label>
                                 <textarea class="form-control" name="reason" id="reason"  ></textarea>
            
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

