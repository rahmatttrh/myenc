<div class="tab-pane fade {{$panel == 'document' ? 'show active' : ''}}" id="v-pills-document" role="tabpanel" aria-labelledby="v-pills-document-tab">
   <div class="card shadow-none border">
      <div class="card-header">
         
         <div class="row">
            <div class="col">
               <h1>Documents</h1>
               <small>List of your documents</small>
            </div>
            {{-- <div class="col text-right">
               <button class="btn btn-sm btn-light border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add account ...</button>
            </div> --}}
         </div>
      </div>
      <div class="card-body">
         <a class="" data-toggle="collapse" href="#addDocuments" role="button" aria-expanded="false" aria-controls="addDocuments">
            <i class="fas fa-plus mr-1"></i>
            Add ...
         </a>
         <div class="collapse" id="addDocuments">
            <form action="{{route('employee.document.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               <div class="row mt-3">
                  <div class="col-md-10">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">  
                              <label>Document name</label>
                              <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" placeholder="Fill Name of the File">
                              @error('name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">  
                              <label>Document Type</label>
                              <input type="text" class="form-control" id="type" name="type" value="{{old('type')}}" placeholder="Fill Type of the File" >
                              @error('type')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group form-group-default">  
                              <label>Document File</label>
                              <input type="file" class="form-control" id="file" name="file" required >
                           </div>
                        </div>
                       
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="text-right">
                        <button type="submit" class="btn btn-block btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
                     </div>
                  </div>
                  
               </div>
            </form>
         </div>
         <div class="table-responsive mt-3">
            <table id="multi-filter-select" class="display basic-datatables table table-striped " >
               <thead>
                  <tr>
                     {{-- <th>No</th> --}}
                     <th>Name</th>
                     <th>Type</th>
                     <th>File</th>
                     {{-- <th>Option</th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($documents as $doc)
                      <tr>
                        {{-- <td>{{++$i}}</td> --}}
                        <td class="text-nowrap">
                           <a href=""  class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{$doc->name}}
                           </a>
                           <div class="dropdown-menu">
                              <a  class="dropdown-item" href=""  data-toggle="modal" data-target="#modal-edit-doc-{{$doc->id}}">Edit</a>
                              <a  class="dropdown-item" href="" data-toggle="modal" data-target="#modal-delete-doc-{{$doc->id}}">Delete</a>
                           </div>
                           
                        </td>
                        <td>{{$doc->type}}</td>
                        <td>
                           @if ($doc->file)
                              <a class="badge badge-success" href="/storage/{{$doc->file}}" target="_blank">Download</a>
                              @else
                              <a class="badge badge-muted" href="#" @disabled(true)>Empty</a>
                           @endif
                           
                        </td>
                        {{-- <td>
                           <a href="" data-toggle="modal" data-target="#modal-delete-doc-{{$doc->id}}">Delete</a>
                           <a href="" data-toggle="modal" data-target="#modal-edit-doc-{{$doc->id}}">Edit</a>
                        </td> --}}
                      </tr>
                      <x-employee.document.modal.delete :document="$doc" />
                      <x-employee.document.modal.edit :document="$doc" />
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>