<div class="tab-pane fade {{$panel == 'personal' ? 'show active' : ''}}" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
   <div class="card card-with-nav">
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link show active " id="pills-bio-tab-nobd" data-toggle="pill" href="#pills-bio-nobd" role="tab" aria-controls="pills-bio-nobd" aria-selected="true">Bio</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-social-tab-nobd" data-toggle="pill" href="#pills-social-nobd" role="tab" aria-controls="pills-social-nobd" aria-selected="false">Social</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-bank-tab-nobd" data-toggle="pill" href="#pills-bank-nobd" role="tab" aria-controls="pills-bank-nobd" aria-selected="false">Bank Account</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-emergency-tab-nobd" data-toggle="pill" href="#pills-emergency-nobd" role="tab" aria-controls="pills-emergency-nobd" aria-selected="false">Emergency Contact</a> </li>
            </ul>
         </div>
      </div>
      <div class="card-body">
         <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
            <div class="tab-pane fade show active" id="pills-bio-nobd" role="tabpanel" aria-labelledby="pills-bio-tab-nobd">
               <form action="{{route('employee.update.bio')}}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  <div class="form-group form-group-default">  
                     <label>Bio *</label>
                     <textarea type="text" class="form-control" id="bio" name="bio">{{$employee->bio}}</textarea>
                     @error('bio')
                        <small class="text-danger"><i>{{ $message }}</i></small>
                     @enderror
                  </div>
                  <div class="form-group form-group-default">  
                     <label>Experience</label>
                     <select class="form-control" id="experience" name="experience">
                        <option value="" disabled selected>Choose one</option>
                        <option  {{$employee->experience == 'Startup' ? 'selected' : ''}} value="Startup">Startup</option>
                        <option {{$employee->experience == 'Intermediate' ? 'selected' : ''}} value="Intermediate">Intermediate</option>
                        <option {{$employee->experience == 'Expert' ? 'selected' : ''}} value="Expert">Expert</option>
                     </select>
                     @error('experience')
                        <small class="text-danger"><i>{{ $message }}</i></small>
                     @enderror
                  </div>
                  <div class="text-right mt-3 mb-3">
                     <button type="submit" class="btn btn-dark">Update Bio</button>
                  </div>
               </form>
            </div>
            <div class="tab-pane fade " id="pills-social-nobd" role="tabpanel" aria-labelledby="pills-social-tab-nobd">
             
                  <a class="" data-toggle="collapse" href="#addSocial" role="button" aria-expanded="false" aria-controls="addSocial">
                     <i class="fas fa-plus mr-1"></i>
                    Add Account ...
                  </a>
               <div class="collapse" id="addSocial">
                  <form action="{{route('social.account.store')}}" method="POST">
                     @csrf
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group form-group-default">
                                    <label>Social Media</label>
                                    <select class="form-control" id="social" name="social" required>
                                       @foreach ($socials as $social)
                                           <option {{old('social') == $social->id ? 'selected' : ''}} value="{{$social->id}}">{{$social->name}}</option>
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
                                    <input type="text" class="form-control" value="{{old('username')}}" name="username" id="username" placeholder="Fill Username " required>
                                    @error('username')
                                       <small class="text-danger"><i>{{ $message }}</i></small>
                                    @enderror
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group form-group-default">
                                    <label>Link</label>
                                    <input type="text" class="form-control" value="{{old('link')}}" name="link" name="link" placeholder="Fill Link " required>
                                    @error('link')
                                       <small class="text-danger"><i>{{ $message }}</i></small>
                                    @enderror
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <button type="submit" class="btn btn-primary btn-block">Add</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="card-list">
                  @foreach ($employee->socialAccounts as $acc)
                  <div class="item-list">
                     <div class="avatar">
                        <img src="{{asset($acc->social->logo)}}" alt="..." class="avatar-img rounded">
                     </div>
                     <div class="info-user ml-3">
                        <div class="username"><a href="{{$acc->link}}" target="_blank">{{$acc->username}}</a></div>
                        <div class="status">{{$acc->social->name}}</div>
                     </div>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-edit-social-{{$acc->id}}">Edit</a>
                        <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-social-{{$acc->id}}">Delete</a>
                     </div>
                  </div>

                  <x-employee.personal.modal.edit-social :acc="$acc" :socials="$socials" />
                  <x-employee.personal.modal.delete-social :acc="$acc"/>
                  @endforeach
               </div>
            </div>

            <div class="tab-pane fade " id="pills-bank-nobd" role="tabpanel" aria-labelledby="pills-bank-tab-nobd">
                  <a class="" data-toggle="collapse" href="#addBank" role="button" aria-expanded="false" aria-controls="addBank">
                     <i class="fas fa-plus mr-1"></i>
                     Add Account ...
                  </a>
               <div class="collapse" id="addBank">
                  <form action="{{route('bank.account.store')}}" method="POST">
                     @csrf
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Bank</label>
                              <select class="form-control" id="bank" name="bank">
                                 @foreach ($banks as $bank)
                                    <option {{old('bank') == $bank->id ? 'selected' : ''}} value="{{$bank->id}}">{{$bank->name}}</option>
                                 @endforeach
                              </select>
                              @error('bank')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Rekening Number</label>
                              <input type="text" class="form-control" value="{{old('account_no')}}" name="account_no" id="account_no" placeholder="Fill Account Number">
                              @error('account_no')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Expired Date</label>
                              <input type="date" class="form-control" value="{{old('expired_date')}}" name="expired_date" id="expired_date">
                              @error('expired_date')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-2">
                           <button type="submit" class="btn btn-primary btn-block">Add</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="mt-3"></div>
               @foreach ($employee->bankAccounts as $acc)
                  <div class="card card-dark bg-{{$acc->bank->color}}-gradient shadow-none">
                     <div class="card-body bubble-shadow text-white">
                        <div class="row">
                           <div class="col">
                              {{-- <img src="{{asset('img/visa.svg')}}" height="12.5" alt="Visa Logo"> --}}
                              <h1 style="font-weight: bolder">{{$acc->bank->name}}</h1>
                           </div>
                           <div class="col text-right">
                              <div class=" ml-auto">
                                 <a href="#" type="button" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       <i class="fa fa-ellipsis-h"></i>
                                 </a>
                                 <div class="dropdown-menu">
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-edit-bank-{{$acc->id}}">Edit</a>
                                    <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-bank-{{$acc->id}}">Delete</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <h2 class="py-3 mb-0">{{$acc->account_no}}</h2>
                        <div class="row">
                           <div class="col-8 pr-0">
                              <h3 class="fw-bold mb-1">{{$acc->employee->biodata->first_name}} {{$acc->employee->biodata->last_name}}</h3>
                              <div class="text-small text-uppercase fw-bold op-8">Name</div>
                           </div>
                           <div class="col-4 pl-0 text-right">
                              <h3 class="fw-bold mb-1"> {{ \Carbon\Carbon::parse($acc->expired_date)->format('d/m/Y')}}</h3>
                              <div class="text-small text-uppercase fw-bold op-8">Expired</div>
                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <x-employee.personal.modal.edit-bank :acc="$acc" :banks="$banks" />
                  <x-employee.personal.modal.delete-bank :acc="$acc"/>
               @endforeach
               
             
            </div>
            
            <div class="tab-pane fade " id="pills-emergency-nobd" role="tabpanel" aria-labelledby="pills-emergency-tab-nobd">
               <form action="{{route('emergency.update')}}" method="POST">
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
                     <button type="submit" class="btn btn-dark">Update Contact</button>
                  </div>
               </form>
            </div>
         </div>
         
      </div>
   </div>
</div>