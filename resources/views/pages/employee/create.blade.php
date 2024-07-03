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
                              <input id="first_name" name="first_name" required type="text" value="{{old('first_name')}}" class="form-control" placeholder="Fill First Name">
                              @error('first_name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Last Name *</label>
                              <input id="last_name" name="last_name" required type="text" value="{{old('last_name')}}" class="form-control" placeholder="Fill Last Name">
                              @error('last_name')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
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
                        <div class="col-md-3">
                           <div class="form-group form-group-default">
                              <label>Birth Date</label>
                              <input id="birth_date" name="birth_date" value="{{old('birth_date')}}" type="date" class="form-control">
                              @error('birth_date')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Birth Place</label>
                              <input id="birth_place" name="birth_place" value="{{old('birth_place')}}" type="text" class="form-control" placeholder="Fill City">
                              @error('birth_place')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                     </div>
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
                        
                        {{-- <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Employee ID</label>
                              <input id="id" name="id" type="text" class="form-control" value="{{old('id')}}" placeholder="Fill ID Number">
                              @error('id')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div> --}}
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Phone Number</label>
                              <input id="phone" name="phone" type="text" value="{{old('phone')}}" class="form-control" placeholder="Fill Phone Number">
                              @error('phone')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Email</label>
                              <input id="email" name="email" required type="email" value="{{old('email')}}" class="form-control" placeholder="Fill Email">
                              @error('email')
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
                     <hr>
                     <div class="badge badge-info mb-2">Contract</div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>ID Employee*</label>
                              <input id="id" name="id" type="text" required value="{{old('id')}}" class="form-control" placeholder="">
                              @error('id')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group form-group-default">
                              <label>Bussiness Unit*</label>
                              <select class="form-control" id="unit" name="unit" required >
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
                              <label>Type*</label>
                              <select class="form-control type" required  id="type" name="type">
                                 <option value="" disabled selected>Select</option>
                                 <option  value="Kontrak">Kontrak</option>
                                 <option  value="Tetap">Tetap</option>
                              </select>
                              @error('type')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Start*</label>
                              <input type="date" class="form-control" required name="start" id="start" >
                           </div>
                        </div>
                        <div class="col-md-4 end">
                           <div class="form-group form-group-default">
                              <label>End</label>
                              <input type="date" class="form-control"  name="end" id="end"  >
                           </div>
                        </div>
                        <div class="col-md-4 determination">
                           <div class="form-group form-group-default">
                              <label>Penetapan</label>
                              <input type="date" class="form-control"  name="determination" id="determination"  >
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Work Hour*</label>
                              <select class="form-control" id="shift" required name="shift">
                                 <option value="" disabled selected>Select</option>
                                 @foreach ($shifts as $shift)
                                 <option  value="{{$shift->id}}">{{formatTime($shift->in)}} - {{formatTime($shift->out)}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Lokasi*</label>
                              <select class="form-control" id="loc" name="loc" required>
                                 <option value="" disabled selected>Select</option>
                                 <option  value="HW">HW</option>
                                 <option  value="JGC">JGC</option>
                                 <option  value="KJ4">KJ4</option>
                                 <option  value="KJ2/KJ5">KJ2/KJ5</option>
                                 <option  value="GS">GS</option>
                              </select>
                           </div>
                        </div>
   
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Level*</label>
                              <select class="form-control" id="designation" name="designation" required >
                                 <option value="" disabled selected>Select</option>
                                 @foreach ($designations as $designation)
                                 <option value="{{$designation->id}}">{{$designation->name}}</option>
                                 @endforeach
                              </select>
                              @error('designation')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Department</label>
                              <select class="form-control" id="department" name="department" >
                                 <option value="" disabled selected>Select</option>
                                 @foreach ($departments as $department)
                                 <option value="{{$department->id}}">{{$department->name}}</option>
                                 @endforeach
                              </select>
                              @error('department')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Jabatan*</label>
                              <select class="form-control" id="position" name="position" required>
                                 <option value="" disabled selected>Select</option>
                                 @foreach ($positions as $position)
                                 {{--<option {{$employee->contract->designation_id == $designation->id ? 'selected' : ''}} value="{{$designation->id}}">{{$designation->name}}</option>--}}
                                 <option value="{{$position->id}}">{{$position->name}} </option>
                                 @endforeach
                              </select>
                              @error('position')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Role</label>
                              <select class="form-control" id="role" name="role" >
                                 @foreach ($roles as $role)
                                 <option value="{{$role->id}}">{{$role->name}}</option>
                                 @endforeach
                              </select>
                              @error('role')
                              <small class="text-danger"><i>{{ $message }}</i></small>
                              @enderror
                           </div>
                        </div>
   
                        {{-- <div class="col-md-4">
                           <div class="form-group form-group-default">
                              <label>Salary</label>
                              <input type="text" class="form-control"  name="salary" id="salary" >
                           </div>
                        </div> --}}

                        
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Join Date*</label>
                        <input type="date" class="form-control" required name="join" id="join">
                     </div>
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


   @push('js_footer')
    

<script>
   $(document).ready(function() {
      $('.determination').hide()
      var type = $('#type').val();
      if (type == 'Kontrak') {
         $('.determination').hide()
         $('.end').show()
      } else {
         $('.determination').show()
         $('.end').hide()
      }

      $('.type').change(function() {
         
         var type = $('#type').val();
         console.log(type);
         if (type == 'Kontrak') {
            $('.determination').hide()
            $('.end').show()
         } else {
            $('.determination').show()
            $('.end').hide()
         }
      })

      $('.determination_add').hide()
      var type = $('#type_add').val();
      if (type == 'Kontrak') {
         $('.determination_add').hide()
         $('.end_add').show()
      } else {
         $('.determination_add').show()
         $('.end_add').hide()
      }

      $('.type_add').change(function() {
         
         var type = $('#type_add').val();
         console.log(type);
         if (type == 'Kontrak') {
            $('.determination_add').hide()
            $('.end_add').show()
         } else {
            $('.determination_add').show()
            $('.end_add').hide()
         }
      })
   })
</script>
@endpush

@endsection