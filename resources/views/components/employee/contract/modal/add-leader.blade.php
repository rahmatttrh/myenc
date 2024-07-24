<div class="modal fade" id="modal-add-leader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Add Leader</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('leader.store')}}" method="POST" >
            <div class="modal-body">
               @csrf
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               <div class="form-group form-group-default">
                  <label>Leader</label>
                  <select class="form-control"  id="leader" name="leader" >
                     <option value="" disabled selected>Choose one</option>
                     @foreach ($leaders as $leader)
                         <option value="{{$leader->id}}">{{$leader->biodata->fullName()}}</option>
                     @endforeach
                     {{-- <option value="" selected disabled>Select</option>
                     <option value="Kontrak">Kontrak</option>
                     <option value="Tetap">Tetap</option> --}}
                  </select>
                  @error('type')
                  <small class="text-danger"><i>{{ $message }}</i></small>
                  @enderror
               </div>
                  
                  

                
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Submit</button>
            </div>
            <div class="modal-body text-start">
               
            </div>
         </form>
      </div>
   </div>
</div>

