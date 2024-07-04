<div class="modal fade" id="modal-edit-contract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit Contract</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('contract.update')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  <input type="number" name="contract" id="contract" value="{{$employee->contract_id}}" hidden>
                  <div class="row">
                     <div class="col-md-7">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Type</label>
                                 <select class="form-control type"  id="type" name="type" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
                                    <option {{$employee->contract->type == 'Kontrak' ? 'selected' : ''}} value="Kontrak">Kontrak</option>
                                    <option {{$employee->contract->type == 'Tetap' ? 'selected' : ''}} value="Tetap">Tetap</option>
                                 </select>
                                 @error('type')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Start</label>
                                 <input type="date" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="start" id="start" value="{{$employee->contract->start}}">
                              </div>
                           </div>
                           <div class="col-md-4 end">
                              <div class="form-group form-group-default">
                                 <label>End</label>
                                 <input type="date" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="end" id="end" value="{{$employee->contract->end}}" >
                              </div>
                           </div>
                           <div class="col-md-4 determination">
                              <div class="form-group form-group-default">
                                 <label>Penetapan</label>
                                 <input type="date" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="determination" id="determination" value="{{$employee->contract->determination}}" >
                              </div>
                           </div>
                           
                        </div>
                        <div class="row">
      
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>ID Employee</label>
                                 <input type="text" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="nik" id="nik" value="{{$employee->contract->id_no}}">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Work Hour</label>
                                 <select class="form-control" id="shift" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="shift">
                                    @foreach ($shifts as $shift)
                                    <option {{$employee->contract->shift_id == $shift->id ? 'selected' : ''}} value="{{$shift->id}}">{{formatTime($shift->in)}} - {{formatTime($shift->out)}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Lokasi</label>
                                 <select class="form-control" id="loc" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="loc">
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
                           <div class="col-md-8">
                              <div class="form-group form-group-default">
                                 <label>Bisnis Unit</label>
                                 <select class="form-control unit" id="unit" name="unit" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
                                    @foreach ($units as $unit)
                                    <option {{$employee->contract->unit_id == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('unit')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
      
                           <div class="col-md-4">
                              <div class="form-group form-group-default">
                                 <label>Level</label>
                                 <select class="form-control" id="designation" name="designation" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> >
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
                                 <select class="form-control department" id="department" name="department" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
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
                                 <label>Sub Department</label>
                                 <select class="form-control subdept" id="subdept" name="subdept" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
                                    @foreach ($subdepts as $sub)
                                    <option {{$employee->sub_dept_id == $sub->id ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('subdept')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Posisi</label>
                                 <select class="form-control position" id="position" name="position" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
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
      
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Salary</label>
                                 <input type="text" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="salary" id="salary" value="{{$employee->contract->salary}}">
                              </div>
                           </div>
                           
                        </div>
                        <div class="row">
                           
                           
      
                           
                           {{-- <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Sub Department</label>
                                 <select class="form-control" id="sub" name="sub" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
                                    @foreach ($subdepts as $sub)
                                    <option {{$employee->contract->sub_dept_id == $sub->id ? 'selected' : ''}} value="{{$sub->id}}">{{$sub->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('sub')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div> --}}
                           
                           
                           
                           
                           
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
                                 <input type="text" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?> name="cuti" id="cuti" value="{{$employee->contract->cuti}}" >
                              </div>
                           </div>
                        </div>
      
                        
                     </div>

                     <div class="col-md-5">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Manager</label>
                                 <select class="form-control manager" id="manager" name="manager" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
                                    <option value="" disabled selected>Select</option>
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
                                 <select class="form-control leader" id="leader" name="leader" <?= auth()->user()->hasRole('Administrator|HRD|HRD-Recruitment') ? '' : 'readonly' ?>>
                                    <option value="" disabled selected>Select</option>
                                    @foreach ($spvs as $spv)
                                    <option {{$employee->direct_leader_id == $spv->id ? 'selected' : ''}} value="{{$spv->id}}">   {{$spv->biodata->first_name}} {{$spv->biodata->last_name}}</option>
                                    @endforeach
                                    @foreach ($leaders as $lead)
                                    <option {{$employee->direct_leader_id == $lead->id ? 'selected' : ''}} value="{{$lead->id}}">   {{$lead->biodata->first_name}} {{$lead->biodata->last_name}}</option>
                                    @endforeach
                                 </select>
                                 @error('leader')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                        </div>
                        <div class="form-group form-group-default">
                           <label>Notes</label>
                           <textarea class="form-control" name="note" id="note"  >{{$employee->contract->note}}</textarea>
   
                        </div>
                     </div>
                  </div>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>

