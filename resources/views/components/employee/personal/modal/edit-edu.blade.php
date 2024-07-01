<div class="modal fade" id="modal-edit-edu-{{$edu->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit Educational Background</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('educational.update')}}" method="POST">
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="edu" id="edu" value="{{$edu->id}}" hidden>
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group form-group-default">
                        <label>Degree</label>
                        <select class="form-control" id="degree" name="degree">
                           <option {{$edu->degree == 'SD' ? 'selected' : ''}} value="SD">SD</option>
                           <option {{$edu->degree == 'SMP' ? 'selected' : ''}} value="SMP">SMP</option>
                           <option {{$edu->degree == 'SMA/SMK' ? 'selected' : ''}} value="SMA/SMK">SMA/SMK</option>
                           <option {{$edu->degree == 'D3' ? 'selected' : ''}} value="D3">D3</option>
                           <option {{$edu->degree == 'D4' ? 'selected' : ''}} value="D4">D4</option>
                           <option {{$edu->degree == 'S1' ? 'selected' : ''}} value="S1">S1</option>
                           <option {{$edu->degree == 'S2' ? 'selected' : ''}} value="S2">S2</option>
                        </select>
                        @error('degree')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="form-group form-group-default">
                        <label>Major</label>
                        <input type="text" class="form-control" value="{{$edu->major}}" placeholder="Jurusan" name="major" id="major">
                        @error('major')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  
                  <div class="col-md-3">
                     <div class="form-group form-group-default">
                        <label>Year</label>
                        <input type="text" class="form-control" value="{{$edu->year}}" placeholder="Rentang tahun" name="year" id="year">
                        @error('year')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-9">
                     <div class="form-group form-group-default">
                        <label>Almamater Name</label>
                        <input type="text" class="form-control"  name="name" value="{{$edu->name}}" id="name" placeholder="Nama almamater">
                        @error('name')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>