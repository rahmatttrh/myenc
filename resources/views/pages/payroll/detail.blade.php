@extends('layouts.app')

@section('title')
Setup Payroll Employee
@endsection

@section('content')
<div class="page-inner">
   
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('payroll.setup')}}">Setup</a></li>
         <li class="breadcrumb-item active" aria-current="page">Employee</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-4">
         
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
               {{-- <small class="badge badge-white text-uppercase">{{$employee->contract->type ?? 'Kontrak/Tetap'}}</small> --}}
               <small class="badge badge-white text-uppercase">{{$employee->contract->unit->name ?? '-'}}</small>
               {{-- <small class="badge badge-white text-uppercase">{{$employee->contract->loc ?? 'Lokasi'}}</small> --}}
            </div>
            {{-- <div class="card-body">
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
            </div> --}}
            <div class="card-body">
               <b>{{formatRupiah($employee->payroll->total ?? 0)}}</b>
            </div>
            <div class="card-footer d-flex justify-content-between">
               {{-- <div>
                  Gaji Pokok <br>
                  Tunj. Jabatan <br>
                  Tunj. OPS <br>
                  Tunj. Kinerja <br>
                  Tunj. Fungsional <br>
                  Insentif  <br>
                  <hr>
                  <a href="#" data-target="#modal-update-payroll" data-toggle="modal">Update</a>
               </div>
               <div class="text-right">
                  @if ($employee->payroll_id != null)
                  {{formatRupiah($employee->payroll->pokok) ?? 0}} <br>
                  {{formatRupiah($employee->payroll->tunj_jabatan) ?? 0}} <br>
                  {{formatRupiah($employee->payroll->tunj_ops) ?? 0}}  <br>
                  {{formatRupiah($employee->payroll->tunj_kinerja) ?? 0}} <br>
                  {{formatRupiah($employee->payroll->tunj_fungsional) ?? 0}} <br>
                  {{formatRupiah($employee->payroll->insentif) ?? 0}}
                      @else
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                      0 <br>
                  @endif
                  
               </div> --}}
               
               
            </div> 
         </div>
      </div>
      <div class="col-md-8">
         

         <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
               <div class="card card-with-nav shadow-none border">
                  <div class="card-header">
                     <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                           <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">Upah</a> </li>
                           <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true">Riwayat Slip Gaji</a> </li>
                           <li class="nav-item"> <a class="nav-link " id="pills-document-tab-nobd" data-toggle="pill" href="#pills-document-nobd" role="tab" aria-controls="pills-document-nobd" aria-selected="true">Document</a> </li>
                           {{-- <li class="nav-item"> <a class="nav-link" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false">Profile Picture</a> </li>
                           <li class="nav-item"> <a class="nav-link  " id="pills-bio-tab-nobd" data-toggle="pill" href="#pills-bio-nobd" role="tab" aria-controls="pills-bio-nobd" aria-selected="true">Notes</a> </li> --}}
                           {{-- <li class="nav-item"> <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false">Social Networking</a> </li> --}}
                        </ul>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                        <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                           <form action="{{route('payroll.update')}}" method="POST" enctype="multipart/form-data" >
                              @csrf
                              @method('PUT')
                              <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
                              
                              <div class="row">
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>Gaji Pokok</label>
                                       <input type="text" class="form-control" id="pokok" name="pokok" value="{{$employee->payroll->pokok ?? 0}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Tunj. Jabatan</label>
                                       <input type="text" class="form-control" id="tunj_jabatan" name="tunj_jabatan" value="{{$employee->payroll->tunj_jabatan ?? 0}}">
                                    </div>
                                    
                                    <div class="form-group form-group-default">
                                       <label>Insentif</label>
                                       <input type="text" class="form-control" id="insentif" name="insentif" value="{{$employee->payroll->insentif ?? 0}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Document</label>
                                       <input type="file" class="form-control" id="doc" name="doc" ">
                                    </div>
                                 </div>
                                 <div class="col">
                                    <div class="form-group form-group-default">
                                       <label>Tunj. Kinerja</label>
                                       <input type="text" class="form-control" id="tunj_kinerja" name="tunj_kinerja" value="{{$employee->payroll->tunj_kinerja ?? 0}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Tunj. Ops</label>
                                       <input type="text" class="form-control" id="tunj_ops" name="tunj_ops" value="{{$employee->payroll->tunj_ops ?? 0}}">
                                    </div>
                                    <div class="form-group form-group-default">
                                       <label>Tunj. Fungsional</label>
                                       <input type="text" class="form-control" id="tunj_fungsional" name="tunj_fungsional" value="{{$employee->payroll->tunj_fungsional ?? 0}}">
                                    </div>
                                 </div>
                              </div>
                              
                              
            
                              <div class="text-right mt-3 mb-3">
                                 {{-- <button type="submit" class="btn btn-dark" {{$employee->status == 0 ? 'disabled' : ''}}>Update</button> --}}
                                 <button type="submit" class="btn btn-dark" >Update</button>
                              </div>
                           </form>
                        </div>
            
                        <div class="tab-pane fade" id="pills-doc-nobd" role="tabpanel" aria-labelledby="pills-doc-tab-nobd">
                           <table class=" ">
                              
                              <tbody>
                                 <tr>
                                    <td class="d-flex justify-content-between">
                                       {{-- <span></span> --}}
                                       <a href="">Januari</a>
                                       <span class="text-success">Done</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="d-flex justify-content-between">
                                       <span>Februari</span>
                                       <span class="text-success">Done</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="d-flex justify-content-between">
                                       <span>Maret</span>
                                       <span class="text-success">Done</span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td class="d-flex justify-content-between">
                                       <span>April</span>
                                       <span class="text-success">Done</span>
                                    </td>
                                 </tr>
                                 
                                 
                              </tbody>
                           </table>
                           
                        </div>
            
                        <div class="tab-pane fade " id="pills-document-nobd" role="tabpanel" aria-labelledby="pills-document-tab-nobd">
                           <iframe style="width: 100%; height:400px" src="{{asset('storage/' . $employee->payroll->doc)}}" frameborder="0"></iframe>
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

<div class="modal fade" id="modal-update-payroll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Payroll</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('payroll.update')}}" method="POST" >
            <div class="modal-body">
               @csrf
               @method('PUT')
               <input type="number" name="employee" id="employee" value="{{$employee->id}}" hidden>
               <div class="form-group form-group-default">
                  <label>Gaji Pokok</label>
                  <input type="text" class="form-control" id="pokok" name="pokok" value="{{$employee->payroll->pokok ?? 0}}">
               </div>
               <div class="row">
                  <div class="col">
                     <div class="form-group form-group-default">
                        <label>Tunj. Jabatan</label>
                        <input type="text" class="form-control" id="tunj_jabatan" name="tunj_jabatan" value="{{$employee->payroll->tunj_jabatan ?? 0}}">
                     </div>
                     <div class="form-group form-group-default">
                        <label>Tunj. Kinerja</label>
                        <input type="text" class="form-control" id="tunj_kinerja" name="tunj_kinerja" value="{{$employee->payroll->tunj_kinerja ?? 0}}">
                     </div>
                     <div class="form-group form-group-default">
                        <label>Insentif</label>
                        <input type="text" class="form-control" id="insentif" name="insentif" value="{{$employee->payroll->insentif ?? 0}}">
                     </div>
                  </div>
                  <div class="col">
                     <div class="form-group form-group-default">
                        <label>Tunj. Ops</label>
                        <input type="text" class="form-control" id="tunj_ops" name="tunj_ops" value="{{$employee->payroll->tunj_ops ?? 0}}">
                     </div>
                     <div class="form-group form-group-default">
                        <label>Tunj. Fungsional</label>
                        <input type="text" class="form-control" id="tunj_fungsional" name="tunj_fungsional" value="{{$employee->payroll->tunj_fungsional ?? 0}}">
                     </div>
                  </div>
               </div>
                  
                  
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-info ">Update</button>
            </div>
            
         </form>
      </div>
   </div>
</div>


@endsection