@extends('layouts.app')

@section('title')
Detail Transaction Payroll Employee
@endsection

@section('content')
<div class="page-inner">
   
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll')}}">Payroll</a></li>
         
         <li class="breadcrumb-item active" aria-current="page">Detail Transaction</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-5">
         
         <div class="card card-light shadow-none border">
            <div class="card-header">
               
               
               <div class="card-list">
                  <div class="item-list">
                     <div class="avatar avatar-md avatar-online">

                        @if ($employee->picture)
                        <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                        @else
                        <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                        @endif
                     </div>
                     <div class="info-user ml-3">
                        <div class="username">
                           <h3>{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</h3>
                        </div>
                        <div class="status"> {{$employee->position->name ?? '-'}} </div>
                     </div>
                  </div>
               </div>
               <small class="badge badge-white text-uppercase">{{$employee->contract->type ?? 'Kontrak/Tetap'}}</small>
               <small class="badge badge-white text-uppercase">{{$employee->contract->unit->name ?? '-'}}</small>
               {{-- <small class="badge badge-white text-uppercase">{{$employee->contract->loc ?? 'Lokasi'}}</small> --}}
            </div>
            <div class="card-body">
               <div class="form-group form-group-default">
                  <label>Gaji Pokok</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" value="">
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group form-group-default">
                        <label>Tunj. Jabatan</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="">
                     </div>
                     <div class="form-group form-group-default">
                        <label>Tunj. Kinerja</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="">
                     </div>
                     <div class="form-group form-group-default">
                        <label>Insentif</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="">
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group form-group-default">
                        <label>Tunj. Ops</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="">
                     </div>
                     <div class="form-group form-group-default">
                        <label>Tunj. Fungsional</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="">
                     </div>
                     <button class="btn btn-primary btn-block">Update</button>
                  </div>
               </div>
            </div>
            {{-- <div class="card-body">
               <h2><b>Rp. 7.000.000</b></h2>
            </div>
            <div class="card-footer d-flex justify-content-between">
               <div>
                  Gaji Pokok <br>
                  Tunjangan Tetap <br>
                  Tunjangan Tidak Tetap 
               </div>
               <div class="text-right">
                  3.000.000 <br>
                  2.300.000 <br>
                  300.000 
               </div>
            </div> --}}
         </div>
      </div>
      <div class="col-md-7">
         

         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
               <div class="card card-with-nav shadow-none border">
                  <div class="card-header">
                     <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                           <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">Detail Transaksi Agustus</a> </li>
                           {{-- <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true">Komponen</a> </li> --}}
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                           <a href=""  class="btn btn-primary btn-sm mb-2">Submit</a>
                           <div class="row">
                              <div class="col-3">
                                 <span><b>Final</b></span> <br>
                                 <span>Gaji Pokok</span> <br>
                                 <span>Lembur/Piket</span> <br>
                                 <span>Pengurangan</span>
                              </div>
                              <div class="col-md-9">
                                 <span>: <b>6.500.000</b></span> <br>
                                 <span>: 4.300.000</span> <br>
                                 <span>: 300.000</span> <br>
                                 <span>: 100.000</span> <br>
                              </div>
                           </div>
                           <hr>
                           <table class=" ">
                              <thead>
                                 <tr>
                                    <th colspan="6">Penambah</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="">Lembur</td>
                                    <td>Upah/173</td>
                                    <td>Aktual</td>
                                    <td>8 Jam</td>
                                    <td>120.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 <tr>
                                    <td class="">Lembur</td>
                                    <td>Upah/173</td>
                                    <td>Aktual</td>
                                    <td>4 Jam</td>
                                    <td>60.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 
                                 
                                 
                              </tbody>
                           </table>

                           <table class="mt-2">
                              <thead>
                                 <tr>
                                    <th colspan="3">Potongan</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td class="">Kehadiran</td>
                                    <td>50.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 <tr>
                                    <td class="">Keterlambatan</td>
                                    <td>120.000</td>
                                    <td><a href="">Delete</a></td>
                                 </tr>
                                 
                                 
                                 
                              </tbody>
                           </table>
                        </div>
            
                        <div class="tab-pane fade" id="pills-doc-nobd" role="tabpanel" aria-labelledby="pills-doc-tab-nobd">
                           <form action="{{route('employee.update')}}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                              
                              <div class="form-group form-group-default">
                                 <label>Gaji Pokok</label>
                                 <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->biodata->first_name}}">
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Tunjangan Jabatan</label>
                                       <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->biodata->first_name}}">
                                    </div>

                                    <div class="form-group form-group-default">
                                       <label>Tunjangan Operasional</label>
                                       <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->biodata->first_name}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Tunjangan Kinerja</label>
                                       <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->biodata->first_name}}">
                                    </div>
                                    
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Tunjangan Fungsional</label>
                                       <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->biodata->first_name}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Insentif</label>
                                       <input type="text" class="form-control" id="first_name" name="first_name" value="{{$employee->biodata->first_name}}">
                                    </div>
                                    
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Tunjangan kemahalan Dareah</label>
                                       <input type="text" class="form-control" id="last_name" name="last_name" value="{{$employee->biodata->last_name}}">
                                    </div>
                                 </div>
                              </div>
                              
                              
            
                              <div class="text-right mt-3 mb-3">
                                 {{-- <button type="submit" class="btn btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update</button> --}}
                                 <button type="submit" class="btn btn-dark" >Update</button>
                              </div>
                           </form>
                        </div>
            
                        <div class="tab-pane fade " id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                           <form action="{{route('employee.update.picture')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                              <div class="row">
                                 <div class="col-md-6">
                                    @if ($employee->picture)
                                    <img src="{{asset('storage/' .$employee->picture)}}" alt="..." class="img-thumbnail">
                                    @else
                                    <img src="{{asset('img/user.png')}}" alt="..." class="img-thumbnail">
                                    @endif
            
            
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group form-group-default">
                                       <label>Select</label>
                                       <input type="file" class="form-control" name="picture" id="picture">
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              {{-- @if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Recruitment')) --}}
                              <button type="submit" class="btn btn-dark" >Update</button>
                              {{-- @endif --}}
                           </form>
                        </div>
                        <div class="tab-pane fade" id="pills-bio-nobd" role="tabpanel" aria-labelledby="pills-bio-tab-nobd">
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
                              {{-- @if (auth()->user()->hasRole('Administrator|HRD|HRD-Spv|HRD-Recruitment')) --}}
                              <div class="text-right mt-3 mb-3">
                                 <button type="submit" class="btn btn-dark" >Update Bio</button>
                              </div>
                              {{-- @endif --}}
                           </form>
                        </div>
            
                     </div>
            
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>

<div class="modal fade" id="modal-deactivate-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Deactivate Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('deactivate')}}" method="POST">
            <div class="modal-body">
               @csrf
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               <div class="row">
                  
                  <div class="col-md-8">
                     <div class="form-group form-group-default">
                        <label>Reason</label>
                        <input type="text" class="form-control" name="reason" id="reason"  required>
                        @error('reason')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Date</label>
                        <input type="date" class="form-control"  name="date" name="date"  required>
                        @error('date')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-dark ">Update</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-activate-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Deactivate Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('activate')}}" method="POST">
            <div class="modal-body">
               @csrf
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               {{-- <div class="row"> --}}
                  <small>Activate {{$employee->nik}} {{$employee->biodata->fullName()}}</small>
                  {{-- <div class="col-md-8">
                     <div class="form-group form-group-default">
                        <label>Reason</label>
                        <input type="text" class="form-control" name="reason" id="reason"  required>
                        @error('reason')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Date</label>
                        <input type="date" class="form-control"  name="date" name="date"  required>
                        @error('date')
                           <small class="text-danger"><i>{{ $message }}</i></small>
                        @enderror
                     </div>
                  </div> --}}
               {{-- </div> --}}
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary ">Acitvate</button>
            </div>
         </form>
      </div>
   </div>
</div>

<div class="modal fade" id="modal-publish-employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Publish Employee</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            Ubah status menjadi Karyawan Aktif?
            <hr>
            <small>- Sistem akan otomatis membuat akun</small><br>
            <small>- Username : NIK</small><br>
            <small>- Password : 12345678</small><br>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
            {{-- <button type="submit" class="btn btn-dark ">Update</button> --}}
            <a href="{{route('employee.publish.single', enkripRambo($employee->id))}}" class="btn btn-primary ">Publish</a>
         </div>
      </div>
   </div>
</div>
@endsection