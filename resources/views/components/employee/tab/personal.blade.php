<div class="tab-pane fade" id="v-pills-personal" role="tabpanel" aria-labelledby="v-pills-personal-tab">
   <div class="card card-with-nav">
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link active show " id="pills-bio-tab-nobd" data-toggle="pill" href="#pills-bio-nobd" role="tab" aria-controls="pills-bio-nobd" aria-selected="true">Bio</a> </li>
               <li class="nav-item"> <a class="nav-link" id="pills-social-tab-nobd" data-toggle="pill" href="#pills-social-nobd" role="tab" aria-controls="pills-social-nobd" aria-selected="false">Social</a> </li>
               <li class="nav-item"> <a class="nav-link" id="pills-bank-tab-nobd" data-toggle="pill" href="#pills-bank-nobd" role="tab" aria-controls="pills-bank-nobd" aria-selected="false">Bank Account</a> </li>
               <li class="nav-item"> <a class="nav-link" id="pills-emergency-tab-nobd" data-toggle="pill" href="#pills-emergency-nobd" role="tab" aria-controls="pills-emergency-nobd" aria-selected="false">Emergency Contact</a> </li>
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
            <div class="tab-pane fade" id="pills-social-nobd" role="tabpanel" aria-labelledby="pills-social-tab-nobd">
             
                  <a class="" data-toggle="collapse" href="#addSocial" role="button" aria-expanded="false" aria-controls="addSocial">
                     <i class="fas fa-plus mr-1"></i>
                    Add Account ...
                  </a>
               <div class="collapse" id="addSocial">
                  <form action="">
                     <div class="row mt-3">
                        <div class="col-md-10">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="form-group form-group-default">
                                    <label>Social Media</label>
                                    <select class="form-control" id="gender">
                                       <option>Instagram</option>
                                       <option>Facebook</option>
                                       <option>Twitter</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-8">
                                 <div class="form-group form-group-default">
                                    <label>Username</label>
                                    <input type="text" class="form-control" value="" name="" placeholder="Fill Username ">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group form-group-default">
                                    <label>Link</label>
                                    <input type="text" class="form-control" value="" name="" placeholder="Fill Username ">
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <button class="btn btn-primary btn-block">Add</button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="card-list">
                  <div class="item-list">
                     <div class="avatar">
                        <img src="{{asset('img/social/instagram.png')}}" alt="..." class="avatar-img rounded">
                     </div>
                     <div class="info-user ml-3">
                        <div class="username">rahmatttrh</div>
                        <div class="status">Instagram</div>
                     </div>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a  class="dropdown-item" style="text-decoration: none" href="">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item" style="text-decoration: none" href="">Delete</a>
                     </div>
                     {{-- <button class="btn btn-icon btn-info btn-round btn-sm">
                        <i class="fa fa-link"></i>
                     </button> --}}
                  </div>
                  <div class="item-list">
                     <div class="avatar">
                        <img src="{{asset('img/social/facebook.png')}}" alt="..." class="avatar-img rounded">
                     </div>
                     <div class="info-user ml-3">
                        <div class="username">Rahmat Hidayat</div>
                        <div class="status">Facebook</div>
                     </div>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a  class="dropdown-item" style="text-decoration: none" href="">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item" style="text-decoration: none" href="">Delete</a>
                     </div>
                  </div>
                  <div class="item-list">
                     <div class="avatar">
                        <img src="{{asset('img/social/github.png')}}" alt="..." class="avatar-img rounded">
                     </div>
                     <div class="info-user ml-3">
                        <div class="username">rahmatttrh</div>
                        <div class="status">Github</div>
                     </div>
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a  class="dropdown-item" style="text-decoration: none" href="">Edit</a>
                        <div class="dropdown-divider"></div>
                        <a  class="dropdown-item" style="text-decoration: none" href="">Delete</a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="tab-pane fade" id="pills-bank-nobd" role="tabpanel" aria-labelledby="pills-bank-tab-nobd">
                  <a class="" data-toggle="collapse" href="#addBank" role="button" aria-expanded="false" aria-controls="addBank">
                     <i class="fas fa-plus mr-1"></i>
                     Add Account ...
                  </a>
               <div class="collapse" id="addBank">
                  <form action="">
                     <div class="row mt-3">
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
               <div class="mt-3"></div>
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
            <div class="tab-pane fade " id="pills-emergency-nobd" role="tabpanel" aria-labelledby="pills-emergency-tab-nobd">
               <form action="{{route('employee.update')}}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  
                  <div class="form-group form-group-default">  
                     <label>Full Name</label>
                     <input type="text" class="form-control" name="" id="">
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Contact Number</label>
                           <input type="text" class="form-control" name="" id="">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Email</label>
                           <input type="text" class="form-control" name="" id="">
                        </div>
                     </div>
                  </div>
                     <div class="form-group form-group-default">  
                        <label>Address</label>
                        <textarea type="text" class="form-control" name="" id=""></textarea>
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