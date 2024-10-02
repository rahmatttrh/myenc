<div class="modal fade" id="modal-reject-hrd" data-bs-backdrop="static">
   <div class="modal-dialog">
      <div class="modal-content">

         <!-- Bagian header modal -->
         <div class="modal-header">
            <h3 class="modal-title">Konfirmasi Reject</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
         </div>
         <form method="POST" action="{{route('sp.reject',$sp->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{$sp->id}}">

            <!-- Bagian konten modal -->
            <div class="modal-body">
               <div class="form-group form-group-default">
                  <label>Alasan Penolakan</label>
                  <input type="text" class="form-control" name="alasan_reject" id="alasan_reject" value="{{old('alasan_reject')}}">
               </div>
               {{-- <div class="row">
                  <div class="col-md-12">
                     <div class="card shadow-none border">
                        <div class="card-header d-flex">
                           <div class="d-flex  align-items-center">
                              <div class="card-title">Konfirmasi Reject</div>
                           </div>

                        </div>
                        <div class="card-body">
                           <label for="" class="label-control">Alasan Penolakan</label>
                           <textarea name="alasan_reject" class="form-control" id="" cols="30" rows="10" placeholder="Isikan alasan penolakan disini"></textarea>
                        </div>
                     </div>
                  </div>
               </div> --}}
            </div>

            <!-- Bagian footer modal -->
            <div class="modal-footer">
               <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-danger">Reject</button>
            </div>
         </form>

      </div>
   </div>
</div>