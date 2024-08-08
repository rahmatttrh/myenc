<div class="modal fade" id="modal-edit-emergency-{{$contact->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit Contact Emergency</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('emergency.update')}}" method="POST">
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="emergency" id="emergency" value="{{$contact->id}}" hidden>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default mt-3">  
                        <label>Full Name</label>
                        <input type="text" required class="form-control" name="name" id="name" value="{{$contact->name}}">
                        @error('name')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default mt-3">  
                        <label>Hubungan</label>
                        <input type="text" class="form-control" name="hubungan" id="hubungan" value="{{$contact->hubungan}}">
                        @error('hubungan')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
               </div>
               
               <div class="row ">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Phone Number*</label>
                        <input type="text" class="form-control" required name="phone" id="phone" value="{{$contact->phone}}">
                        @error('phone')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$contact->email}}">
                        @error('email')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="form-group form-group-default">  
                  <label>Address</label>
                  <textarea type="text" class="form-control" name="address" id="address">{{$contact->address}}</textarea>
                  @error('address')
                     <small class="text-danger"><i>{{ $message }}</i></small>
                  @enderror
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               @if (auth()->user()->hasRole('Administrator|HRD|HRD-Staff|HRD-Recruitment'))
               <button type="submit" class="btn btn-dark ">Update</button>
            
               @endif
            </div>
         </form>
      </div>
   </div>
</div>