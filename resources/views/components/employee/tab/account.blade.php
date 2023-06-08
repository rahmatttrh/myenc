<div class="tab-pane fade" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
   <div class="card">
      <div class="card-header">
         
         <div class="row">
            <div class="col">
               <h1>Accounts</h1>
            </div>
            <div class="col text-right">
               <button class="btn btn-sm btn-light border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add account ...</button>
            </div>
         </div>
      </div>
      <div class="card-body">
         
         <div class="collapse" id="collapseExample">
            <form action="">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group form-group-default">
                        <label>Bank</label>
                        <select class="form-control" id="gender">
                           <option>Mandiri</option>
                           <option>BCA</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Rekening Number</label>
                        <input type="text" class="form-control" value="" name="" placeholder="Fill Rekening Number">
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group form-group-default">
                        <label>Expired Date</label>
                        <input type="date" class="form-control" value="" name="" placeholder="Fill Rekening Number">
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button class="btn btn-primary btn-block">Add</button>
                  </div>
               </div>
            </form>
         </div>

         <div class="card card-dark bg-primary-gradient">
            <div class="card-body bubble-shadow text-white">
               <div class="row">
                  <div class="col">
                     {{-- <img src="{{asset('img/visa.svg')}}" height="12.5" alt="Visa Logo"> --}}
                     <h1 style="font-weight: bolder">MANDIRI</h1>
                  </div>
                  <div class="col text-right">
                     <div class=" ml-auto">
                        <a href="#" type="button" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu">
                           
                           
                           <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                           {{-- <div class="dropdown-divider"></div>            --}}
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                        </div>
                     </div>
                  </div>
               </div>
               
               <h2 class="py-3 mb-0">1234 33455 55665 5678</h2>
               <div class="row">
                  <div class="col-8 pr-0">
                     <h3 class="fw-bold mb-1">Sultan Ghani</h3>
                     <div class="text-small text-uppercase fw-bold op-8">Card Holder</div>
                  </div>
                  <div class="col-4 pl-0 text-right">
                     <h3 class="fw-bold mb-1">4/26</h3>
                     <div class="text-small text-uppercase fw-bold op-8">Expired</div>
                     
                  </div>
               </div>
            </div>
         </div>
         <div class="card card-dark bg-info-gradient">
            <div class="card-body bubble-shadow text-white">
               <div class="row">
                  <div class="col">
                     {{-- <img src="{{asset('img/visa.svg')}}" height="12.5" alt="Visa Logo"> --}}
                     <h1 style="font-weight: bolder">BCA</h1>
                  </div>
                  <div class="col text-right">
                     <div class=" ml-auto">
                        <a href="#" type="button" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fa fa-ellipsis-h"></i>
                        </a>
                        <div class="dropdown-menu">
                           
                           
                           <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                           {{-- <div class="dropdown-divider"></div>            --}}
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                        </div>
                     </div>
                  </div>
               </div>
               
               <h2 class="py-3 mb-0">1234 33455 55665 5678</h2>
               <div class="row">
                  <div class="col-8 pr-0">
                     <h3 class="fw-bold mb-1">Sultan Ghani</h3>
                     <div class="text-small text-uppercase fw-bold op-8">Card Holder</div>
                  </div>
                  <div class="col-4 pl-0 text-right">
                     <h3 class="fw-bold mb-1">4/26</h3>
                     <div class="text-small text-uppercase fw-bold op-8">Expired</div>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>