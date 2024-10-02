<div class="modal fade" id="modal-edit-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <form method="POST" action="{{route('sp.update')}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id" value="{{$sp->id}}">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Edit Form SP</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
            
               <div class="row">
                  <div class="col-md-8">
                     <div class="form-group form-group-default">
                        <label>Employee</label>
                        <select class="form-control employee" required id="employee" name="employee">
                           <option value="" selected disabled>Select Employee</option>
                           @foreach ($employees as $emp)
                           <option {{$sp->employee_id == $emp->id ? 'selected' : '' }} value="{{$emp->id}}">{{$emp->biodata->first_name ?? ''}} {{$emp->biodata->last_name ?? ''}} </option>
                           @endforeach
                        </select>

                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Level</label>
                        <select class="form-control" required id="level" name="level">
                           <option value="" selected disabled>Select level</option>
                           <option {{$sp->level == 'I' ? 'selected' : ''}} value="I">SP I</option>
                           <option {{$sp->level == 'II' ? 'selected' : ''}} value="II">SP II</option>
                           <option {{$sp->level == 'II' ? 'selected' : ''}} value="III">SP III</option>
                        </select>

                     </div>
                  </div>
                  

                  {{-- <div class="col-md-6">
                     <small class="text-muted">Masa berlaku SP adalah 6 bulan</small>
                     <hr>
                  </div> --}}
                  {{-- <div class="col-md-6">
                     <div class="form-group form-group-default">
                        <label>Berlaku sampai</label>
                        <input type="date" class="form-control"  name="date_to" id="date_to">
                     </div>
                  </div> --}}
               </div>

               <div class="form-group form-group-default">
                  <label>Alasan</label>
                  <input type="text" class="form-control" name="reason" id="reason" value="{{$sp->reason}}">
               </div>

               <div class="form-group form-group-default">
                  <label>Kronologi</label>
                  <textarea class="form-control" name="desc" id="desc" rows="5">{{$sp->desc}}</textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">
                  Update
               </button>
            </div>
         </form>
      </div>
   </div>
</div>