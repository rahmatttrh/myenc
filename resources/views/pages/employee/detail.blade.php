@extends('layouts.app')

@section('title')
Detail Employee
@endsection

@section('content')
<div class="page-inner">
   {{-- <h4 class="page-title">User Profile</h4> --}}
   {{-- <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('employee', enkripRambo('active'))}}">Employee</a></li>
   <li class="breadcrumb-item active" aria-current="page">Detail</li>
   </ol>
   </nav> --}}
   <div class="page-header d-flex">
      <h5 class="page-title">Detail Employee</h5>
      <ul class="breadcrumbs">
         <li class="nav-home">
            <a href="/">
               <i class="flaticon-home"></i>
            </a>
         </li>
         <li class="separator">
            <i class="flaticon-right-arrow"></i>
         </li>
         @if (auth()->user()->hasRole('Administrator'))
         <li class="nav-item">
            <a href="{{route('employee', enkripRambo('active'))}}">Employee</a>
         </li>
         @else
         <li class="nav-item">
            <a href="#">Employee</a>
         </li>
         @endif
         <li class="separator">
            <i class="flaticon-right-arrow"></i>
         </li>
         <li class="nav-item">
            <a href="#">Detail</a>
         </li>
      </ul>
   </div>
   <div class="row">
      <div class="col-md-4">
         <div class="card card-light shadow-none border">
            <div class="card-header">
               @if ($employee->status == 1)
                  <small class="badge badge-info text-uppercase "><a href="#" class="text-white" data-toggle="modal" data-target="#modal-deactivate-employee">Aktif</a></small>
                   @elseif($employee->status == 0)
                   <small class="badge badge-muted ">Draft</small>
                   @else
                   <small class="badge badge-muted ">Non Active</small>
               @endif
               
               <div class="card-list">
                  <div class="item-list">
                     @if ($employee->biodata->status == 1)
                     <div class="avatar avatar-md avatar-online">
                        @else
                        <div class="avatar avatar-md avatar-offline">
                           @endif

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
                           <div class="status">{{$employee->contract->designation->name ?? ''}} {{$employee->contract->department->name ?? ''}}</div>
                        </div>
                     </div>
                  </div>
                  <small class="badge badge-white text-uppercase">{{$employee->contract->type ?? 'Kontrak/Tetap'}}</small>
                  <small class="badge badge-white text-uppercase">{{$employee->contract->unit->name}}</small>
                  <small class="badge badge-white text-uppercase">{{$employee->contract->loc ?? 'Lokasi'}}</small>
               </div>
               <div class="card-body">
                  {{-- <div class="user-profile text-center mb--4">
                  <div class="h4"><b> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</b>
               </div>
               <small>{{$employee->contract->designation->name ?? ''}} {{$employee->contract->department->name ?? ''}}</small>
            </div> --}}
            <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
               <a class="nav-link {{$panel == 'basic' ? 'active' : ''}} text-left pl-3" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true">
                  <i class="fas fa-address-book mr-1"></i>
                  Basic Information
               </a>
               <a class="nav-link {{$panel == 'contract' ? 'active' : ''}}  text-left pl-3" id="v-pills-contract-tab" data-toggle="pill" href="#v-pills-contract" role="tab" aria-controls="v-pills-contract" aria-selected="false">
                  <i class="fas fa-file-contract mr-1"></i>

                  Contract Agreement
               </a>
               
               <a class="nav-link {{$panel == 'personal' ? 'active' : ''}} text-left pl-3" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="true">
                  <i class="fas fa-user mr-1"></i>
                  Personal Data
               </a>
               <a class="nav-link {{$panel == 'account' ? 'active' : ''}} text-left pl-3" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="false">
                  <i class="fas fa-credit-card mr-1"></i>
                  System Account
               </a>

               <a class="nav-link {{$panel == 'document' ? 'active' : ''}} text-left pl-3" id="v-pills-document-tab" data-toggle="pill" href="#v-pills-document" role="tab" aria-controls="v-pills-document" aria-selected="false">
                  <i class="fas fa-file mr-1"></i>
                  Document
               </a>
               {{-- <a class="nav-link {{$panel == 'basic' ? 'active' : ''}} text-left pl-3" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true">
                  <i class="fas fa-address-book mr-1"></i>
                  Work
               </a> --}}

               {{-- <a class="nav-link {{$panel == 'personal' ? 'active' : ''}} text-left pl-3" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="false">
               <i class="fas fa-user mr-1"></i>
               Personal
               </a>
               <a class="nav-link {{$panel == 'account' ? 'active' : ''}} text-left pl-3" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="false">
                  <i class="fas fa-credit-card mr-1"></i>
                  Account
               </a>

               <a class="nav-link {{$panel == 'document' ? 'active' : ''}} text-left pl-3" id="v-pills-document-tab" data-toggle="pill" href="#v-pills-document" role="tab" aria-controls="v-pills-document" aria-selected="false">
                  <i class="fas fa-file mr-1"></i>
                  Document
               </a> --}}
            </div>

         </div>
         <div class="card-footer d-flex justify-content-between">
            {{-- <div>Sisa Cuti</div>
            <div>3</div> --}}
            {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit.</small> --}}
            {{-- <small>Completeness 25%</small>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
            {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste unde beatae inventore.</small> --}}
            {{-- <a href="{{route('export.kpi')}}">Export PDF KPI</a> --}}
         </div>
      </div>
   </div>
   <div class="col-md-8">
      @if ($employee->status == 0)
      <div class="alert alert-warning shadow-none">
         <small class="text-muted">You can not change data before activate employee</small>
      </div>
      @endif

      <div class="tab-content" id="v-pills-tabContent">
         <x-employee.contract.contract :employee="$employee" :departments="$departments" :designations="$designations" :positions="$positions" :roles="$roles" :shifts="$shifts" :panel="$panel" :i="0" :managers="$managers" :spvs="$spvs" :leaders="$leaders" :allmanagers="$allManagers" :allspvs="$allSpvs" :allleaders="$allLeaders" :subdepts="$subdepts" :units="$units" :allpositions="$allPositions" />
         <x-employee.basic.basic :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :panel="$panel" />
         <x-employee.personal.personal :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :socials="$socials" :banks="$banks" :panel="$panel" />
         <x-employee.account.account :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :panel="$panel" />
         <x-employee.document.document :employee="$employee" :documents="$employee->documents" :panel="$panel" :i="0" />
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
@endsection