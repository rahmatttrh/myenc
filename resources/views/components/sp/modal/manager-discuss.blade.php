<div class="modal fade" id="modalManagerDiscuss" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Bagian header modal -->
         <div class="modal-header">
            <h3 class="modal-title">Need Discuss</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form method="POST" action="{{route('sp.discuss.manager') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="sp" id="sp" value="{{$sp->id}}">

            <!-- Bagian konten modal -->
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-7">
                     <div class="form-group form-group-default">
                        <label>Invitation</label>
                        <select class="form-control employee" required id="nd_for" name="nd_for">
                           <option value="" selected disabled>For</option>
                           <option value="1" >Atasan Langsung</option>
                           <option value="2" >Karyawan</option>
                           <option value="3" >Atasan Langsung & Karyawan</option>
                        </select>

                     </div>
                  </div>
                  <div class="col-md-5">
                     <div class="form-group form-group-default">
                        <label>Date</label>
                        <input type="datetime-local" class="form-control"  name="date" id="date" >
                     </div>
                  </div>
               </div>
               
               <div class="form-group form-group-default">
                  <label>Reason</label>
                  <textarea class="form-control"  name="reason" id="reason" ></textarea>
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