@extends('layouts.app')
   @section('title')
      Employee
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="card">
               <div class="card-header d-flex"> 
                  <div class="d-flex  align-items-center">
                     <div class="card-title">Employee List</div> 
                  </div>
                  <div class="btn-group btn-group-page-header ml-auto">
                     <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-ellipsis-h"></i>
                     </button>
                     <div class="dropdown-menu">
                        
                        
                        <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                        <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.import')}}">Import</a>
                        {{-- <div class="dropdown-divider"></div>            --}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.export')}}" target="_blank">Print Preview</a>
                     </div>
                  </div>
               </div> 
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="multi-filter-select" class="display basic-datatables table table-striped " >
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
                           @foreach ($employees as $employee)
                              <tr>
                                 <td>{{++$i}}</td>
                                 {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                                 <td class="d-flex align-items-center">
                                    <div class="profile-picture mr-3">
                                       @if ($employee->status == 1)
                                          <div class="avatar avatar-sm avatar-online">
                                          @else
                                          <div class="avatar avatar-sm avatar-offline">
                                       @endif
                                          @if ($employee->biodata->picture)
                                             <img src="{{asset('storage/' . $employee->biodata->picture)}}" alt="..." class="avatar-img rounded-circle">
                                              @else
                                              <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                                          @endif
                                       </div>
                                    </div>
                                    {{-- <img src="{{asset('img/jm_denis.jpg')}}" alt="..." height="50" class=" rounded-circle mr-3"> --}}
                                    <div>
                                       <a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a><br>
                                       <small class="text-muted">{{$employee->biodata->email}}</small>
                                    </div>
                                          
                                       {{-- <div class="info-user ml-3">
                                          <div class="username">Jimmy Denis</div>
                                          <div class="status">Graphic Designer</div>
                                       </div> --}}
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
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection