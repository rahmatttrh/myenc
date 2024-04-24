@extends('layouts.app')
@section('title')
Employee
@endsection
@section('content')

<div class="page-inner">
   <div class="page-header d-flex">

      <h5 class="page-title">Employee</h5>
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
            <a href="#">Employee</a>
         </li>
      </ul>
      <div class="ml-auto">
         {{-- <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" >
                  <i class="fa fa-ellipsis-h"></i> Option
            </button> --}}
         <button class="btn btn-light border btn-round " data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu">


            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.import')}}">Import</a>
            {{-- <div class="dropdown-divider"></div>            --}}
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
         </div>
      </div>
   </div>

   

      
   <div class="card card-with-nav shadow-none border">
      <div class="card-header d-flex">
         <div class="row row-nav-line">
            <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
               <li class="nav-item"> <a class="nav-link {{$tab == 'active' ? 'show active' : ''}} " id="pills-active-tab-nobd" data-toggle="pill" href="#pills-active-nobd" role="tab" aria-controls="pills-active-nobd" aria-selected="true">Active</a> </li>
               <li class="nav-item"> <a class="nav-link {{$tab == 'draft' ? 'show active' : ''}}" id="pills-draft-tab-nobd" data-toggle="pill" href="#pills-draft-nobd" role="tab" aria-controls="pills-draft-nobd" aria-selected="false">Draft</a> </li>
               <li class="nav-item"> <a class="nav-link {{$tab == 'exit' ? 'show active' : ''}}" id="pills-exit-tab-nobd" data-toggle="pill" href="#pills-exit-nobd" role="tab" aria-controls="pills-exit-nobd" aria-selected="false">Exit</a> </li>

            </ul>
         </div>

      </div>
      <div class="card-body">
         <div class="tab-content" id="pills-without-border-tabContent">
            <div class="tab-pane fade {{$tab == 'active' ? 'show active' : ''}}" id="pills-active-nobd" role="tabpanel" aria-labelledby="pills-active-tab-nobd">
               <div class="table-responsive">
                  <table id="multi-filter-select" class="display basic-datatables table-sm table-bordered  table-striped ">
                     <thead>
                        <tr>
                           <th class="">No</th>
                           <th>Namee</th>
                           <th>ID</th>
                           <th>Phone</th>
                           <th>Bisnis Unit</th>
                           <th>Department</th>
                           <th>Level</th>
                           <th>Jabatan</th>
                           <th>Status</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($employees as $employee)
                        <tr>
                           <td class="text-center">{{++$i}}</td>
                           {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                           <td class="">
                              <div>
                                 <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a>
                                 {{-- <small class="text-muted">{{$employee->biodata->email}}</small> --}}
                              </div>
                              {{-- <div class="profile-picture mr-3">
                                 @if ($employee->biodata->status == 1)
                                 <div class="avatar avatar-sm avatar-online">
                                    @else
                                    <div class="avatar avatar-sm avatar-offline">
                                       @endif
                                       @if ($employee->picture)
                                       <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                                       @else
                                       <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                                       @endif
                                    </div>
                                 </div>
                                 <div>
                                    <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a><br>
                                    <small class="text-muted">{{$employee->biodata->email}}</small>
                                 </div> --}}
                           </td>
                           <td>{{$employee->contract->id_no}}</td>
                           <td>{{$employee->biodata->phone}}</td>
                           <td>{{$employee->contract->department->unit->name ?? ''}}</td>
                           <td>{{$employee->contract->department->name ?? ''}}</td>
                           <td>{{$employee->contract->designation->name ?? ''}}</td>
                           <td>{{$employee->position->name}}</td>
                           <td>
                              {{-- @if ($employee->biodata->status == 1)
                              <span class="badge badge-info">Active</span>
                              @else
                              <span class="badge badge-muted">Off</span>
                              @endif --}}

                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                     
                  </table>
               </div>
            </div>

            <div class="tab-pane fade {{$tab == 'draft' ? 'show active' : ''}}" id="pills-draft-nobd" role="tabpanel" aria-labelledby="pills-draft-tab-nobd">
               <form action="{{route('employee.publish')}}" method="post">
                  @csrf
                  @error('id_item')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                  <div class="d-inline-flex align-items-center">
                     <button type="submit" name="submit" class="btn btn-sm btn-primary mr-3">Activate</button>
                     <div class="d-inline-flex align-items-center">
                        <span class="badge badge-muted badge-counter">
                           <span id="total">0</span>
                        </span>
                     </div>
                  </div>
                  <hr>
                  <div class="table-responsive">
                     <table id="multi-filter-select" class="display basic-datatables table-sm table-bordered  table-striped ">
                        <thead>
                           <tr>
                              <th>&nbsp; <input type="checkbox" id="selectall" /></th>
                              <th>Name</th>
                              <th>ID</th>
                              <th>Email</th>
                              <th>Department</th>
                              <th>Designation</th>
                              <th>Status</th>
                              {{-- <th class="text-right">Action</th> --}}
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($draftEmployees as $employee)
                           <tr>
                              <td class="text-center"><input type="checkbox" class="case" name="id_item[]" value="{{$employee->id}}" /> </td>
                              {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                              <td class="text-nowrap">
                                 <div>
                                    <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a><br>
                                    {{-- <small class="text-muted">{{$employee->biodata->email}}</small> --}}
                                 </div>

                                 {{-- <div class="info-user ml-3">
                                             <div class="username">Jimmy Denis</div>
                                             <div class="status">Graphic Designer</div>
                                          </div> --}}
                              </td>
                              <td>{{$employee->contract->id_no}}</td>
                              <td>{{$employee->biodata->email}}</td>
                              <td>{{$employee->contract->department->name ?? ''}}</td>
                              <td>{{$employee->contract->designation->name ?? ''}}</td>
                              <td>
                                 <span class="badge badge-muted">Off</span>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </form>
            </div>

            <div class="tab-pane fade {{$tab == 'exit' ? 'show active' : ''}}" id="pills-exit-nobd" role="tabpanel" aria-labelledby="pills-exit-tab-nobd">
               <div class="table-responsive">
                  <table id="multi-filter-select" class="display basic-datatables table table-striped ">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Name</th>
                           <th>ID</th>
                           <th>Email</th>
                           <th>Department</th>
                           <th>Designation</th>
                           <th>Status</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        {{-- @foreach ($employees as $employee)
                                 <tr>
                                    <td>{{++$i}}</td>
                        <td class="d-flex align-items-center">
                           <div class="profile-picture mr-3">
                              @if ($employee->status == 1)
                              <div class="avatar avatar-sm avatar-online">
                                 @else
                                 <div class="avatar avatar-sm avatar-offline">
                                    @endif
                                    @if ($employee->picture)
                                    <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                                    @else
                                    <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                                    @endif
                                 </div>
                              </div>
                              <div>
                                 <a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a><br>
                                 <small class="text-muted">{{$employee->biodata->email}}</small>
                              </div>
                        </td>
                        <td>{{$employee->id_no}}</td>
                        <td>{{$employee->biodata->email}}</td>
                        <td>{{$employee->contract->department->name ?? ''}}</td>
                        <td>{{$employee->contract->designation->name ?? ''}}</td>
                        <td>
                           @if ($employee->status == 1)
                           <span class="badge badge-info">Active</span>
                           @else
                           <span class="badge badge-muted">Off</span>
                           @endif

                        </td>
                        </tr>
                        @endforeach --}}
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
   $(document).ready(function() {
      $('.tanggal').datepicker({
         format: "yyyy-mm-dd",
         autoclose: true
      });
   });

   var total = document.getElementById("total");

   $(function() {

      $("#selectall").change(function() {
         if (this.checked) {
            $(".case").each(function() {
               this.checked = true;
            });
            var jumlahCheck = $(".case").length;
         } else {
            $(".case").each(function() {
               this.checked = false;
            });
            var jumlahCheck = 0;
         }

         // menampilkan output ke elemen hasil
         total.innerHTML = jumlahCheck;
         // console.log(jumlahCheck);
      });

      $(".case").click(function() {
         if ($(this).is(":checked")) {
            var isAllChecked = 0;
            var jumlahCheck = $('input:checkbox:checked').length;

            $(".case").each(function() {
               if (!this.checked)
                  isAllChecked = 1;
            });

            if (isAllChecked == 0) {
               $("#selectall").prop("checked", true);

               jumlahCheck = $(".case").length;
            }


         } else {
            $("#selectall").prop("checked", false);

            jumlahCheck = $('input:checkbox:checked').length;
         }
         total.innerHTML = jumlahCheck;
         console.log(jumlahCheck);

      });


   });
</script>
@endsection