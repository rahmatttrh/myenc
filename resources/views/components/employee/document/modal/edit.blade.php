<div class="modal fade" id="modal-edit-doc-{{$document->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Edit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.document.update')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="document" id="account" value="{{$document->id}}" hidden>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Document name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$document->name}}" placeholder="Fill Name of the File">
                        @error('name')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group form-group-default">  
                        <label>Document Type</label>
                        <input type="text" class="form-control" id="type" name="type" value="{{$document->type}}" placeholder="Fill Type of the File" >
                        @error('type')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group form-group-default">  
                        <label>Document File</label>
                        <input type="file" class="form-control" id="file" name="file" value="{{$document->file}}" >
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