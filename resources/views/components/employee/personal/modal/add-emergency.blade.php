<div class="modal fade" id="add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Add Emergency Contact</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('emergency.update')}}" method="POST">
            <div class="modal-body">
               @csrf
                  @method('PUT')
                  <input type="number" name="emergency" id="emergency" value="{{$employee->emergency_id}}" hidden>
                  
                  <div class="form-group form-group-default">  
                     <label>Full Name</label>
                     <input type="text" class="form-control" name="name" id="name" value="{{$employee->emergency->name}}">
                     @error('name')
                        <small class="text-danger"><i>{{ $message }}</i></small>
                     @enderror
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Contact Number</label>
                           <input type="text" class="form-control" name="phone" id="phone" value="{{$employee->emergency->phone}}">
                           @error('phone')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Email</label>
                           <input type="text" class="form-control" name="email" id="email" value="{{$employee->emergency->email}}">
                           @error('email')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                           @enderror
                        </div>
                     </div>
                  </div>
                     <div class="form-group form-group-default">  
                        <label>Address</label>
                        <textarea type="text" class="form-control" name="address" id="address">{{$employee->emergency->address}}</textarea>
                        @error('address')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  <div class="text-right mt-3 mb-3">
                     <button type="submit" class="btn btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update Contact</button>
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