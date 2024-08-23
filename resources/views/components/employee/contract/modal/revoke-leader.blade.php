<div class="modal fade" id="modal-revoke-leader-{{$leader->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title text-dark" >Revoke Leader</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body text-dark">
            Revoke {{$leader->leader->biodata->fullName()}} from leader list of {{$employee->biodata->fullName()}} ?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger ">
                  <a class="text-light" href="{{route('leader.revoke', enkripRambo($leader->id))}}">Revoke</a>
            </button>
         </div>
      </div>
   </div>
</div>