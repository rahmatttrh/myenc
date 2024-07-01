<div class="modal fade" id="modal-delete-emergency-{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Delete Contact Emergency <b>{{$contact->name}}</b> dari Karyawan {{$contact->employee->biodata->first_name}} {{$contact->employee->biodata->last_name}} ?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger ">
                  <a class="text-light" href="{{route('emergency.delete', enkripRambo($contact->id))}}">Delete</a>
            </button>
         </div>
      </div>
   </div>
</div>