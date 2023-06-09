<div class="tab-pane fade" id="v-pills-document" role="tabpanel" aria-labelledby="v-pills-document-tab">
   <div class="card">
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
         <p>
            <a class="btn btn-light border" data-toggle="collapse" href="#addDocuments" role="button" aria-expanded="false" aria-controls="addDocuments">
              Add Document ...
            </a>
         </p>
         <div class="collapse" id="addDocuments">
            <form action="{{route('employee.update')}}" method="POST">
               @csrf
               @method('PUT')
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               <div class="row">
                  <div class="col-md-10">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">  
                              <label>Document name</label>
                              <input type="text" class="form-control" id="date" name="date" >
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">  
                              <label>Document Type</label>
                              <input type="text" class="form-control" id="date" name="date" >
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group form-group-default">  
                              <label>Document File</label>
                              <input type="file" class="form-control" id="date" name="date" >
                           </div>
                        </div>
                       
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="text-right">
                        <button type="submit" class="btn btn-block btn-dark">Add</button>
                     </div>
                  </div>
                  
               </div>
            </form>
         </div>
         <div class="table-responsive">
            <table id="multi-filter-select" class="display basic-datatables table table-striped " >
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Title</th>
                     <th>Amount</th>
                     <th>Allowances Option</th>
                     <th>Amount Option</th>
                     {{-- <th class="text-right">Action</th> --}}
                  </tr>
               </thead>
               <tbody>
                  
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>