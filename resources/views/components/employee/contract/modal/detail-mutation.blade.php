<div class="modal fade" id="modal-detail-mutation-{{$mutation->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Detail Mutation</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('mutation.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
                  <div class="row">
                     <div class="col-md-6">
                        <div class="btn btn-block btn-sm mb-2" style="background-color: rgb(209, 216, 216)">Before</div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Work Hour</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{formatTime($mutation->before->shift->in)}} - {{formatTime($mutation->before->shift->out)}}" >
      
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Lokasi</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->loc}}" >
                              </div>
                           </div>
      
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Level</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->designation->name}}" >
                              </div>
                           </div>
                           
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Jabatan</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->position->name}}" >
                              </div>
                           </div>
                           
                        </div>
                        <div class="row">
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Department</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->department->name}}" >
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Bisnis Unit</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->unit->name}}" >
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Salary</label>
                                 <input type="text" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="salary" id="salary" value="{{formatRupiah($mutation->before->salary)}}">
                              </div>
                           </div>
                           
                           
                           
                           
                        </div>
                        <div class="row">
                           
                           
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Role Description</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->desc}}" >
      
                              </div>
                           </div>
                        </div>
      
                        {{-- <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Manager</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->manager->biodata->first_name}} {{$mutation->before->manager->biodata->last_name}}" >
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Direct Leader</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->before->direct_leader->biodata->first_name}} {{$mutation->before->direct_leader->biodata->last_name}}" >
                              </div>
                           </div>
                        </div> --}}
                        
                     </div>
                     <div class="col-md-6">
                        <div class="btn btn-block btn-sm btn-info mb-2" >Become</div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Work Hour</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{formatTime($mutation->become->shift->in)}} - {{formatTime($mutation->become->shift->out)}}" >
      
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Lokasi</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->loc}}" >
                              </div>
                           </div>
      
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Level</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->designation->name}}" >
                              </div>
                           </div>
                           
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Jabatan</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->position->name}}" >
                              </div>
                           </div>
                           
                        </div>
                        <div class="row">
                           
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Department</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->department->name}}" >
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Bisnis Unit</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->unit->name}}" >
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Salary</label>
                                 <input type="text" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="salary" id="salary" value="{{formatRupiah($mutation->become->salary)}}">
                              </div>
                           </div>
                           
                           
                           
                           
                        </div>
                        <div class="row">
                           
                           
                           <div class="col-md-12">
                              <div class="form-group form-group-default">
                                 <label>Role Description</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->desc}}" >
      
                              </div>
                           </div>
                        </div>
      
                        {{-- <div class="row">
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Manager</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->manager->biodata->first_name}} {{$mutation->become->manager->biodata->last_name}}" >
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group form-group-default">
                                 <label>Direct Leader</label>
                                 <input type="text" class="form-control" name="desc" id="desc" value="{{$mutation->become->direct_leader->biodata->first_name}} {{$mutation->become->direct_leader->biodata->last_name}}" >
                              </div>
                           </div>
                        </div> --}}
                     </div>
                  </div>
                  
                  

                  
            </div>
            {{-- <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Add Mutation</button>
            </div> --}}
         </form>
      </div>
   </div>
</div>

