<div class="tab-pane fade {{$panel == 'account' ? 'show active' : ''}}" id="v-pills-account" role="tabpanel" aria-labelledby="v-pills-account-tab">
   <div class="card shadow-none border">
      <div class="card-header">
         
         <div class="row">
            <div class="col">
               <h1>Accounts</h1>
               <small>Change your account detail</small>
            </div>
            {{-- <div class="col text-right">
               <button class="btn btn-sm btn-light border" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Add account ...</button>
            </div> --}}
         </div>
      </div>
      <div class="card-body">
         <form action="{{route('employee.update')}}" method="POST">
            @csrf
            @method('PUT')
            <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
            <div class="form-group form-group-default">  
               <label>Email *</label>
               <input type="text" class="form-control" readonly value="{{$employee->biodata->email}}" id="first_name" name="first_name">
            </div>
            <a href="{{route('password.request')}}">
               <i class="fas fa-key mr-1"></i>
               Change password...
            </a>
               {{-- <div class="text-right mt-3 mb-3">
                  <button type="submit" class="btn btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update</button>
               </div> --}}
         </form>
      </div>
   </div>
</div>