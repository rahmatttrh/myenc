<div class="modal fade" id="modal-add-contract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Add New Contract</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('contract.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               <div class="row">
                  <div class="col-md-7">
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Type</label>
                              <select class="form-control type_add"  id="type_add" name="type_add" >
                                 <option value="" selected disabled>Select</option>
                                 <option value="Kontrak">Kontrak</option>
                                 <option value="Tetap">Tetap</option>
                              </select>
                              @error('type')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Start</label>
                              <input type="date" class="form-control"  name="start" id="start" value="{{$employee->contract->start}}">
                           </div>
                        </div>
                        <div class="col-md-4 end_add">
                           <div class="form-group form-group-default">
                              <label>End</label>
                              <input type="date" class="form-control"  name="end" id="end" value="{{$employee->contract->end}}" >
                           </div>
                        </div>
                        <div class="col-md-4 determination_add">
                           <div class="form-group form-group-default">
                              <label>Penetapan</label>
                              <input type="date" class="form-control"  name="determination" id="determination" value="{{$employee->contract->deterination}}" >
                           </div>
                        </div>
                        
                     </div>
                     <div class="row">
   
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>ID Employee</label>
                              <input type="text" class="form-control"  name="id" id="id" value="{{$employee->contract->id_no}}">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Work Hour</label>
                              <select class="form-control" id="shift"  name="shift">
                                 <option value="" selected disabled>Select</option>
                                 @foreach ($shifts as $shift)
                                 <option {{$employee->contract->shift_id == $shift->id ? 'selected' : ''}} value="{{$shift->id}}">{{formatTime($shift->in)}} - {{formatTime($shift->out)}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Lokasi</label>
                              <select class="form-control" id="loc"  name="loc">
                                 <option value="">Select</option>
                                 <option value="hw">HW</option>
                                 <option value="jgc">JGC</option>
                                 <option value="kj1-2">KJ 1-2</option>
                                 <option value="kj4">KJ 4</option>
                                 <option value="kj5">KJ 5</option>
                                 <option value="kj1-5">KJ 1-5</option>
                                 <option value="gs">GS</option>
                                 <option value="enc">ENC</option>
                                 <option value="plb">PLB</option>
                                 <option value="smg">Semarang</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group form-group-default">
                              <label>Bisnis Unit</label>
                              <select class="form-control unit_add" id="unit_add" name="unit_add" >
                                 <option value="" selected disabled>Select</option>
                                 @foreach ($units as $unit)
                                 <option {{$employee->contract->unit_id == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                 @endforeach
                              </select>
                              @error('unit_add')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Level</label>
                              <select class="form-control" id="designation" name="designation"  >
                                 <option value="" selected disabled>Select</option>
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
                              <select class="form-control department_add" id="department_add" name="department_add" >
                                 <option value="" selected disabled>Select</option>
                                 @foreach ($departments as $department)
                                 <option {{$employee->contract->department_id == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                                 @endforeach
                              </select>
                              @error('department_add')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Sub Department</label>
                              <select class="form-control subdept_add" id="subdept_add" name="subdept_add" >
                                 <option value="" selected disabled>Select</option>
                                 @foreach ($subdepts as $sub)
                                 <option {{$employee->contract->sub_dept_id == $sub->id ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name}}</option>
                                 @endforeach
                              </select>
                              @error('subdept_add')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Posisi</label>
                              <select class="form-control position_add" id="position_add" name="position_add" >
                                 <option value="" selected disabled>Select</option>
                                 @foreach ($allpositions as $position)
                                 {{--<option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                 <option {{$employee->position_id == $position->id ? 'selected' : ''}} value="{{$position->id}}">{{$position->name}} </option>
                                 @endforeach
                              </select>
                              @error('position_add')
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
                        <div class="col-md-8">
                           <div class="form-group form-group-default">
                              <label>Job Description</label>
                              <input type="text" class="form-control" name="desc" id="desc" value="{{$employee->contract->desc}}" >
   
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Cuti</label>
                              <input type="text" class="form-control"  name="cuti" id="cuti" value="{{$employee->contract->cuti}}" >
                           </div>
                        </div>
                        
                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group form-group-default">
                        <label>Notes</label>
                        <textarea class="form-control" name="note" id="note"  ></textarea>

                     </div>
                     <small>* Default data is generate from previous contract</small><br>
                     <small>* if you click "Submit", previous contract will automaticly deactivated</small>
                  </div>
               </div>
                  
                  

                  {{-- <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Manager</label>
                           <select class="form-control" id="manager" name="manager" >
                              @foreach ($managers as $man)
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
                           <select class="form-control" id="leader" name="leader" >
                              @foreach ($spvs as $spv)
                              <option {{$employee->direct_leader_id == $spv->id ? 'selected' : ''}} value="{{$spv->id}}">  {{$spv->designation->name}} | {{$spv->biodata->first_name}} {{$spv->biodata->last_name}}</option>
                              @endforeach
                              @foreach ($leaders as $lead)
                              <option {{$employee->direct_leader_id == $lead->id ? 'selected' : ''}} value="{{$lead->id}}">  {{$lead->designation->name}} | {{$lead->biodata->first_name}} {{$lead->biodata->last_name}}</option>
                              @endforeach
                           </select>
                           @error('leader')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                  </div> --}}
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Submit</button>
            </div>
            <div class="modal-body text-start">
               
            </div>
         </form>
      </div>
   </div>
</div>

