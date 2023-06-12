<div class="modal fade" id="modal-edit-social-{{$acc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('social.account.update')}}" method="POST">
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="account" id="account" value="{{$acc->id}}" hidden>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Social Media</label>
                        <select class="form-control" id="social" name="social" required>
                           @foreach ($socials as $social)
                              <option {{$acc->social_id == $social->id ? 'selected' : ''}} value="{{$social->id}}">{{$social->name}}</option>
                           @endforeach
                        </select>
                        @error('social')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-8">
                     <div class="form-group form-group-default">
                        <label>Username</label>
                        <input type="text" class="form-control" value="{{$acc->username}}" name="username" id="username" placeholder="Fill Username " required>
                        @error('username')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group form-group-default">
                        <label>Link</label>
                        <input type="text" class="form-control" value="{{$acc->link}}" name="link" name="link" placeholder="Fill Link " required>
                        @error('link')
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