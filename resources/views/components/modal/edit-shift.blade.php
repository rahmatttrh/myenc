<div class="modal fade" id="modal-edit-shift-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit Shift/Work Hours</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('shift.update')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
                  {{-- <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden> --}}
                  <input type="number" name="shift" id="shift" value="{{$id}}" hidden>
                  <div class="form-group form-group-default">
                     <label>Business Unit Name</label>
                     <input type="text" class="form-control"  name="name" id="name" value="{{$shift->name}}"  >
                  </div>
                  <div class="row">
                     <div class="col">
                        <div class="form-group form-group-default">
                           <label>In</label>
                           <input id="in" name="in" type="time" class="form-control" value="{{$shift->in}}" >
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group form-group-default">
                           <label>Out</label>
                           <input id="out" name="out" type="time" class="form-control" value="{{$shift->out}}" >
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

