<div class="modal fade" id="modal-detail-contract-{{$contract->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Detail Contract</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('contract.update')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Type</label>
                           <input type="string" class="form-control"  name="start" id="start" value="{{$contract->type}}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Start</label>
                           <input type="date" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="start" id="start" value="{{$contract->start}}">
                        </div>
                     </div>
                     <div class="col-md-4 end">
                        <div class="form-group form-group-default">
                           <label>End</label>
                           <input type="date" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="end" id="end" value="{{$contract->end}}" >
                        </div>
                     </div>
                     <div class="col-md-4 determination">
                        <div class="form-group form-group-default">
                           <label>Penetapan</label>
                           <input type="date" class="form-control" <?= auth()->user()->hasRole('Administrator|HRD') ? '' : 'readonly' ?> name="determination" id="determination" value="{{$contract->deterination}}" >
                        </div>
                     </div>
                     
                  </div>
                  <div class="row">

                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>ID Employee</label>
                           <input type="text" class="form-control"  name="id" id="id" value="{{$contract->id_no}}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Office Shift</label>
                           <input type="text" class="form-control"  name="id" id="id" value="{{$contract->shift->name ?? ''}}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Level</label>
                           <input type="text" class="form-control"  name="id" id="id" value="{{$contract->designation->name ?? ''}}">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Department</label>
                           <input type="text" class="form-control"  name="id" id="id" value="{{$contract->department->name ?? ''}}">
                        </div>
                     </div>
                     
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Jabatan</label>
                           <input type="text" class="form-control"  name="id" id="id" value="{{$contract->position->name ?? ''}}">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Salary</label>
                           <input type="text" class="form-control" name="salary" id="salary" value="{{$contract->salary}}">
                        </div>
                     </div>
                     
                     
                  </div>
                  <div class="row">
                     
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Cuti Tahunan</label>
                           <input type="text" class="form-control"  name="cuti" id="cuti" value="{{$contract->cuti}}" >
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="form-group form-group-default">
                           <label>Role Description</label>
                           <input type="text" class="form-control" name="desc" id="desc" value="{{$contract->desc}}" >

                        </div>
                     </div>
                  </div>

                  
            </div>
            {{-- <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Update</button>
            </div> --}}
         </form>
      </div>
   </div>
</div>