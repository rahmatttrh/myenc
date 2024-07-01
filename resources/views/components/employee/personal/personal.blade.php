<div class="tab-pane fade {{$panel == 'personal' ? 'show active' : ''}}" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
   <div class="card card-with-nav shadow-none border">
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link show active" id="pills-emergency-tab-nobd" data-toggle="pill" href="#pills-emergency-nobd" role="tab" aria-controls="pills-emergency-nobd" aria-selected="false">Emergency Contact</a> </li>
               
               
               <li class="nav-item"> <a class="nav-link " id="pills-edu-tab-nobd" data-toggle="pill" href="#pills-edu-nobd" role="tab" aria-controls="pills-edu-nobd" aria-selected="false">Educationals</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-bank-tab-nobd" data-toggle="pill" href="#pills-bank-nobd" role="tab" aria-controls="pills-bank-nobd" aria-selected="false">Bank Account</a> </li>
               <li class="nav-item"> <a class="nav-link " id="pills-social-tab-nobd" data-toggle="pill" href="#pills-social-nobd" role="tab" aria-controls="pills-social-nobd" aria-selected="false">Social</a> </li>
               
            </ul>
         </div>
      </div>
      <div class="card-body">
         <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
            
            <div class="tab-pane fade show active" id="pills-emergency-nobd" role="tabpanel" aria-labelledby="pills-emergency-tab-nobd">
               <a class="" data-toggle="collapse" href="#addContact" role="button" aria-expanded="false" aria-controls="addBank">
                  <i class="fas fa-plus mr-1"></i>
                  Add Emergency Contact ...
               </a>
               <div class="collapse" id="addContact">
                  <form action="{{route('emergency.store')}}" method="POST">
                     @csrf
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default mt-3">  
                              <label>Full Name*</label>
                              <input type="text" required class="form-control" name="name" id="name">
                              @error('name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default mt-3">  
                              <label>Hubungan</label>
                              <input type="text" class="form-control" name="hubungan" id="hubungan">
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
                              <input type="text" class="form-control" required name="phone" id="phone" >
                              @error('phone')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">  
                              <label>Email</label>
                              <input type="text" class="form-control" name="email" id="email" >
                              @error('email')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="form-group form-group-default">  
                        <label>Address</label>
                        <textarea type="text" class="form-control" name="address" id="address"></textarea>
                        @error('address')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                     <div class="text-right mt-3 mb-3">
                        <button type="submit" class="btn btn-dark">Add Contact</button>
                     </div>
                  </form>
               </div>
               <div class="card-list">
                  @foreach ($employee->contactEmergencies as $contact)
                  <div class="item-list">
                     <div class="avatar">
                        <img src="{{asset('img/man.png')}}" alt="..." class="avatar-img rounded">
                     </div>
                     <div class="info-user ml-3">
                        <div class="username">{{$contact->name}}  [{{$contact->hubungan}}]</div>
                        <div class="status">{{$contact->phone}}</div>
                     </div>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-edit-emergency-{{$contact->id}}">Edit</a>
                        <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-emergency-{{$contact->id}}">Delete</a>
                     </div>
                  </div>

                  <x-employee.personal.modal.edit-emergency :contact="$contact"  />
                  <x-employee.personal.modal.delete-emergency :contact="$contact"/>
                  @endforeach
               </div>
            </div>

            <div class="tab-pane fade " id="pills-bank-nobd" role="tabpanel" aria-labelledby="pills-bank-tab-nobd">
               <a class="" data-toggle="collapse" href="#addBank" role="button" aria-expanded="false" aria-controls="addBank">
                  <i class="fas fa-plus mr-1"></i>
                  Add Bank Account ...
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
                           <button type="submit" class="btn btn-primary btn-block" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
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

            <div class="tab-pane fade " id="pills-edu-nobd" role="tabpanel" aria-labelledby="pills-edu-tab-nobd">
               <a class="" data-toggle="collapse" href="#addEdu" role="button" aria-expanded="false" aria-controls="addEdu">
                  <i class="fas fa-plus mr-1"></i>
                  Add Educational Background ...
               </a>
               <div class="collapse" id="addEdu">
                  <form action="{{route('educational.store')}}" method="POST">
                     @csrf
                     <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                     <div class="row mt-3">
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Degree</label>
                              <select class="form-control" id="degree" name="degree">
                                 <option value="SD">SD</option>
                                 <option value="SMP">SMP</option>
                                 <option value="SMA/SMK">SMA/SMK</option>
                                 <option value="D3">D3</option>
                                 <option value="D4">D4</option>
                                 <option value="S1">S1</option>
                                 <option value="S2">S2</option>
                              </select>
                              @error('degree')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-9">
                           <div class="form-group form-group-default">
                              <label>Major</label>
                              <input type="text" class="form-control" value="{{old('major')}}" placeholder="Jurusan" name="major" id="major">
                              @error('major')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Year</label>
                              <input type="text" class="form-control" value="{{old('year')}}" placeholder="Tahun" name="year" id="year">
                              @error('year')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-7">
                           <div class="form-group form-group-default">
                              <label>Almamater Name</label>
                              <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" placeholder="Nama almamater">
                              @error('name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        
                        
                        <div class="col-md-2">
                           <button type="submit" class="btn btn-primary btn-block" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
                        </div>
                     </div>
                  </form>
               </div>
               {{-- <div class=""></div> --}}
               <div class="card-list">
                  @foreach ($employee->educationals as $edu)
                  <div class="item-list">
                     {{-- <div class="avatar">
                        <img src="{{asset('img/man.png')}}" alt="..." class="avatar-img rounded">
                     </div> --}}
                     <div class="info-user">
                        <div class="username">{{$edu->year}} - {{$edu->degree}}  {{$edu->major}}</div>
                        <div class="status">{{$edu->name}}</div>
                     </div>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-edit-edu-{{$edu->id}}">Edit</a>
                        <a  class="dropdown-item" style="text-decoration: none" href="" data-toggle="modal" data-target="#modal-delete-edu-{{$edu->id}}">Delete</a>
                     </div>
                  </div>

                  <x-employee.personal.modal.edit-edu :edu="$edu"  />
                  <x-employee.personal.modal.delete-edu :edu="$edu"/>
                  @endforeach
               </div>
            </div>

            <div class="tab-pane fade " id="pills-social-nobd" role="tabpanel" aria-labelledby="pills-social-tab-nobd">
             
                  <a class="" data-toggle="collapse" href="#addSocial" role="button" aria-expanded="false" aria-controls="addSocial">
                     <i class="fas fa-plus mr-1"></i>
                    Add Social Account ...
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
                           <button type="submit" class="btn btn-primary btn-block" {{$employee->status == 0 ? 'disabled' : ''}}>Add</button>
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

            
            
            
         </div>
         
      </div>
   </div>
</div>