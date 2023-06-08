<div class="tab-pane fade show active" id="v-pills-contract" role="tabpanel" aria-labelledby="v-pills-contract-tab">
   <div class="card card-with-nav">
      <div class="card-header">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link active show " id="pills-biodata-tab-nobd" data-toggle="pill" href="#pills-biodata-nobd" role="tab" aria-controls="pills-biodata-nobd" aria-selected="true">Contract</a> </li>
               <li class="nav-item"> <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Allowances</a> </li>
               <li class="nav-item"> <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">Social Networking</a> </li>
            </ul>
         </div>
      </div>
      <div class="card-body">
         <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
            <div class="tab-pane fade show active" id="pills-biodata-nobd" role="tabpanel" aria-labelledby="pills-biodata-tab-nobd">
               <form action="{{route('employee.update')}}" method="POST">
                  @csrf
                  @method('PUT')
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Contract Date</label>
                           <input type="date" class="form-control" id="date" name="date" value="{{$employee->biodata->first_name}}">
                        </div>
                     </div>
                     
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Department</label>
                           <select class="form-control" id="department" name="department">
                              @foreach ($departments as $department)
                                 <option {{$employee->contract->department_id == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Designation</label>
                           <select class="form-control" id="designation" name="designation">
                              @foreach ($designations as $designation)
                                  <option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Basic Salary (IDR)</label>
                           <input type="text" class="form-control" value="{{$employee->contract->salary}}" name="city" id="city">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Hourly Rate (IDR)</label>
                           <input type="text" class="form-control" value="{{$employee->biodata->city}}" name="city" id="city">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group form-group-default">
                           <label>Payslip Type</label>
                           <select class="form-control" id="designation" name="designation">
                              <option {{$employee->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">Month</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group form-group-default">
                           <label>Office Shift</label>
                           <select class="form-control" id="designation" name="designation">
                              <option {{$employee->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">Office</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group form-group-default">  
                           <label>Contract End</label>
                           <input type="date" class="form-control" id="end" name="end" value="{{$employee->biodata->last_name}}">
                        </div>
                     </div>
                  </div>
                  <div class="form-group form-group-default">  
                     <label>Role Description</label>
                     <textarea type="text" class="form-control" id="end" name="end"></textarea>
                  </div>
                  
                  
                  <div class="text-right mt-3 mb-3">
                     <button type="submit" class="btn btn-dark">Update</button>
                  </div>
               </form>
            </div>
            <div class="tab-pane fade" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
               <form action="{{route('employee.update.picture')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                  <div class="row">
                     <div class="col-md-3">
                        @if ($employee->biodata->picture)
                           <img src="{{asset('storage/' .$employee->biodata->picture)}}" alt="..." class="img-thumbnail">
                           @else
                           <img src="{{asset('img/user.png')}}" alt="..." class="img-thumbnail">
                        @endif
                        
                        
                     </div>
                     <div class="col-md-9">
                        <div class="form-group form-group-default">
                           <label>Select</label>
                           <input type="file" class="form-control" name="picture" id="picture">
                        </div>
                     </div>
                  </div>
                  <hr>
                  <button class="btn btn-dark">Update</button>
               </form>
            </div>
            <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
               <p>
                  <a class="btn btn-light border" data-toggle="collapse" href="#addSocial" role="button" aria-expanded="false" aria-controls="addSocial">
                    Add Account ...
                  </a>
                </p>
                <div class="collapse" id="addSocial">
                  <form action="">
                     <div class="row">
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Social Media</label>
                              <select class="form-control" id="gender">
                                 <option>Instagram</option>
                                 <option>Facebook</option>
                                 <option>Twitter</option>
                              </select>
                           </div>
                        </div>
                        <div class="col-md-7">
                           <div class="form-group form-group-default">
                              <label>Username</label>
                              <input type="text" class="form-control" value="" name="" placeholder="Fill Username ">
                           </div>
                        </div>
                        
                        <div class="col-md-2">
                           <button class="btn btn-primary btn-block">Add</button>
                        </div>
                     </div>
                  </form>
                </div>

               <div class="card card-stats card-round shadow-none border">
                  <div class="card-body ">
                     <div class="row align-items-center">
                        <div class="col-icon">
                           <img src="{{asset('img/social/instagram.png')}}" class="" height="60" alt="">
                           {{-- <div class="icon-big text-center icon-primary bubble-shadow-small">
                              <i class="fas fa-instagram"></i>
                              <i class="la flaticon-facebook"></i>
                           </div> --}}
                        </div>
                        <div class="col-md-9 col-stats ml-3 ml-sm-0">
                           <div class="numbers">
                              <p class="card-category">Instagram</p>
                              <h4 class="card-title">rahmatttrh</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-stats card-round shadow-none border">
                  <div class="card-body ">
                     <div class="row align-items-center">
                        <div class="col-icon">
                           <img src="{{asset('img/social/facebook.png')}}" class="" height="60" alt="">
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                           <div class="numbers">
                              <p class="card-category">Facebook</p>
                              <h4 class="card-title">Rahmat Hidayat</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-stats card-round shadow-none border">
                  <div class="card-body ">
                     <div class="row align-items-center">
                        <div class="col-icon">
                           <img src="{{asset('img/social/github.png')}}" class="" height="60" alt="">
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                           <div class="numbers">
                              <p class="card-category">Facebook</p>
                              <h4 class="card-title">Rahmat Hidayat</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card card-stats card-round shadow-none border">
                  <div class="card-body ">
                     <div class="row align-items-center">
                        <div class="col-icon">
                           <img src="{{asset('img/social/linkedin.png')}}" class="" height="60" alt="">
                        </div>
                        <div class="col col-stats ml-3 ml-sm-0">
                           <div class="numbers">
                              <p class="card-category">Facebook</p>
                              <h4 class="card-title">Rahmat Hidayat</h4>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>