<div class="modal fade" id="modal-add-leader"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
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
                  <select class="form-control js-example-basic-single" style="width: 100%"  id="leader" name="leader" >
                     {{-- <option value="" disabled selected>Choose one</option> --}}
                     @foreach ($leaders as $leader)
                         <option value="{{$leader->id}}">
                           {{$leader->nik}} <b>{{$leader->biodata->fullName()}}</b> -
                           @if (count($leader->positions) > 0)
                               @foreach ($leader->positions as $pos)
                                  | {{$pos->name}}
                               @endforeach
                               @else
                               {{$leader->position->name ?? ''}}
                           @endif
                           
                        </option>
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

