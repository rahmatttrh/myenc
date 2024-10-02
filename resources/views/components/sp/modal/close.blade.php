<div class="modal fade" id="modal-sp-close" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Close Case SP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>

         <div class="modal-body">

            Close case this SP ? <br>
            {{$sp->code}}


         </div>
         <div class="modal-footer"><a href="{{route('sp.close', enkripRambo($sp->id))}}" class="btn btn-primary">Close Complain</a>
         </div>
      </div>
   </div>
</div>