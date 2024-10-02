<div class="modal fade" id="modal-complain-employee" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Bagian header modal -->
         <div class="modal-header">
            <h3 class="modal-title">Submit Notes</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form method="POST" action="{{route('sp.complain.employee') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="sp" id="sp" value="{{$sp->id}}">

            <!-- Bagian konten modal -->
            <div class="modal-body">

               {{-- <div class="form-group form-group-default">
                  <label>Date</label>
                  <input type="date" class="form-control"  name="date" id="date" >
               </div> --}}
               <div class="form-group form-group-default">
                  <label>Note</label>
                  <textarea class="form-control"  name="reason" id="reason" >{{$sp->complain_reason}}</textarea>
               </div>
            </div>

            <!-- Bagian footer modal -->
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         </form>

      </div>
   </div>
</div>