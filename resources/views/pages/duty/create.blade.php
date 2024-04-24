@extends('layouts.app')
   @section('title')
      Create Employee
   @endsection
@section('content')
   
   <div class="page-inner">
      {{-- <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('employee', enkripRambo('active'))}}">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
         </ol>
      </nav> --}}
      <div class="page-header d-flex">
         <h5 class="page-title">Create Employee</h5>
         <ul class="breadcrumbs">
            <li class="nav-home">
               <a href="/">
                  <i class="flaticon-home"></i>
               </a>
            </li>
            <li class="separator">
               <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
               <a href="{{route('employee', enkripRambo('active'))}}">Employee</a>
            </li>
            <li class="separator">
               <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
               <a href="#">Create</a>
            </li>
         </ul>
      </div>
      
      <div class="card shadow-none border">
         <div class="card-header d-flex"> 
            <div class="d-flex  align-items-center">
               <div class="card-title">Form Create Employee</div> 
            </div>
            
         </div> 
         <div class="card-body">
            
            <form action="{{route('employee.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               <div class="row">
                  <div class="col-md-8">
                     
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>First Name *</label>
                              <input id="first_name" name="first_name" type="text" value="{{old('first_name')}}" class="form-control" placeholder="Fill First Name">
                              @error('first_name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Last Name *</label>
                              <input id="last_name" name="last_name" type="text" value="{{old('last_name')}}" class="form-control" placeholder="Fill Last Name">
                              @error('last_name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div>
                     {{-- <div class="row">
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Birth Date</label>
                              <input id="birth_date" name="birth_date" value="{{old('birth_date')}}" type="date" class="form-control">
                              @error('birth_date')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="form-group form-group-default">
                              <label>Birth Place</label>
                              <input id="birth_place" name="birth_place" value="{{old('birth_place')}}" type="text" class="form-control" placeholder="Fill City">
                              @error('birth_place')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div> --}}
                     <div class="row">
                        {{-- <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Religion</label>
                              <select class="form-control" id="religion" name="religion">
                                 <option {{old('religion') == 'Islam' ? 'selected' : ''}} value="Islam">Islam</option>
                                 <option {{old('religion') == 'Christian' ? 'selected' : ''}}  value="Christian">Christian</option>
                                 <option {{old('religion') == 'Hindu' ? 'selected' : ''}}  value="Hindu">Hindu</option>
                                 <option {{old('religion') == 'Budha' ? 'selected' : ''}}  value="Budha">Budha</option>
                              </select>
                              @error('religion')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div> --}}
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Gender</label>
                              <select class="form-control" id="gender" name="gender">
                                 <option value="" disabled selected>Choose one</option>
                                 <option {{old('gender') == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                                 <option {{old('gender') == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                              </select>
                              @error('gender')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Employee ID</label>
                              <input id="id" name="id" type="text" class="form-control" value="{{old('id')}}" placeholder="Fill ID Number">
                              @error('id')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-5">
                           <div class="form-group form-group-default">
                              <label>Phone Number</label>
                              <input id="phone" name="phone" type="text" value="{{old('phone')}}" class="form-control" placeholder="Fill Phone Number">
                              @error('phone')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        {{-- <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Marital Status</label>
                              <select class="form-control" id="gender" name="gender">
                                 <option {{old('marital') == 'Single' ? 'selected' : ''}} value="Single">Single</option>
                                 <option {{old('marital') == 'Married' ? 'selected' : ''}} value="Married">Married</option>
                              </select>
                           </div>
                        </div> --}}
                     </div>
                     {{-- <div class="form-group form-group-default">
                        <label>Address</label>
                        <textarea id="address" name="address" type="text" class="form-control">{{old('address')}}</textarea>
                     </div> --}}
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Email</label>
                              <input id="email" name="email" type="email" value="{{old('email')}}" class="form-control" placeholder="Fill Email">
                              @error('email')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Bussiness Unit</label>
                              <select class="form-control" id="unit" name="unit">
                                 <option value="" disabled selected>Choose one</option>
                                 @foreach ($units as $unit)
                                       <option {{old('unit') == $unit->id ? 'selected' : ''}} value="{{$unit->id}}">{{$unit->name}}</option>
                                 @endforeach
                              </select>
                              @error('unit')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Department</label>
                              <select class="form-control" id="department" name="department">
                                 {{-- <option >{{$department->name}}</option> --}}
                                 <option value="" disabled selected>Choose one</option>
                                 @foreach ($departments as $department)
                                       <option {{old('department') == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
                                 @endforeach
                              </select>
                              @error('department')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Designation</label>
                              <select class="form-control" id="designation" name="designation">
                                 <option value="" disabled selected>Choose one</option>
                                 @foreach ($designations as $designation)
                                       <option {{old('designation') == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>
                                 @endforeach
                              </select>
                              @error('designation')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Role</label>
                              <select class="form-control" id="role" name="role">
                                 <option value="" disabled selected>Choose one</option>
                                 @foreach ($roles as $role)
                                       <option {{old('role') == $role->name ? 'selected' : ''}} value="{{$role->name}}">{{$role->name}}</option>
                                 @endforeach
                              </select>
                              @error('role')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Office Shift</label>
                              <select class="form-control" id="shift" name="shift">
                                 <option value="" disabled selected>Choose one</option>
                                 @foreach ($shifts as $shift)
                                       <option {{old('shift') == $shift->id ? 'selected' : ''}} value="{{$shift->id}}">{{$shift->name}}</option>
                                 @endforeach
                              </select>
                              @error('shift')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Basic Salary</label>
                              <input id="salary" name="salary" type="text" value="{{old('salary')}}" class="form-control" placeholder="Fill Basic Salary">
                              @error('salary')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Payslip Type</label>
                              <select class="form-control" id="payslip" name="payslip">
                                 <option value="" disabled selected>Choose one</option>
                                 <option {{old('payslip') == 'Month' ? 'selected' : ''}}  value="Month">Month</option>
                                 <option {{old('payslip') == 'Week' ? 'selected' : ''}} value="Week">Week</option>
                              </select>
                              @error('payslip')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Select Picture</label>
                        <input type="file" class="form-control" name="picture" id="picture">
                     </div>
                     <img src="{{asset('img/undraw/hire.png')}}" alt="..." class="img-thumbnail">
                  </div>
               </div>
               <hr>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
         <div class="card-footer">
            <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small>
         </div>
      </div>
   </div>

@endsection