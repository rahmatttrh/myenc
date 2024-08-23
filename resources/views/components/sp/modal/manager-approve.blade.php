<div class="modal fade" id="modal-app-manager-{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <form method="POST" action="{{route('sp.app.manager', enkripRambo($sp->id))}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$sp->id}}">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Approval Manager</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               Publish SP <br>
               Send to Employee
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">
                  Approve
               </button>
            </div>
         </form>
      </div>
   </div>
</div>