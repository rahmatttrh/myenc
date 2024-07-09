<div class="modal fade" id="modal-add-subdept-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Add Subdept</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('subdept.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               
                  {{-- <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden> --}}
                  <input type="number" name="department" id="department" value="{{$id}}" hidden>
                  <div class="form-group form-group-default">
                     <label>Sub Department name</label>
                     <input type="text" class="form-control"  name="name" id="name"  >
                  </div>
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Add</button>
            </div>
         </form>
      </div>
   </div>
</div>

