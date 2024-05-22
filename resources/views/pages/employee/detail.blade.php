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
               <div class="card-list">
                  <div class="item-list">
                     @if ($employee->biodata->status == 1)
                     <div class="avatar avatar-xl avatar-online">
                        @else
                        <div class="avatar avatar-xl avatar-offline">
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
               </div>
               <div class="card-body">
                  {{-- <div class="user-profile text-center mb--4">
                  <div class="h4"><b> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</b>
               </div>
               <small>{{$employee->contract->designation->name ?? ''}} {{$employee->contract->department->name ?? ''}}</small>
            </div> --}}
            <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
               <a class="nav-link {{$panel == 'contract' ? 'active' : ''}}  text-left pl-3" id="v-pills-contract-tab" data-toggle="pill" href="#v-pills-contract" role="tab" aria-controls="v-pills-contract" aria-selected="false">
                  <i class="fas fa-file-contract mr-1"></i>

                  Contract
               </a>
               <a class="nav-link {{$panel == 'basic' ? 'active' : ''}} text-left pl-3" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true">
                  <i class="fas fa-address-book mr-1"></i>
                  Basic
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
            <div>Sisa Cuti</div>
            <div>3</div>
            {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit.</small> --}}
            {{-- <small>Completeness 25%</small>
               <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div> --}}
            {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste unde beatae inventore.</small> --}}
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
         <x-employee.contract.contract :employee="$employee" :departments="$departments" :designations="$designations" :positions="$positions" :roles="$roles" :shifts="$shifts" :panel="$panel" :i="0" />
         <x-employee.basic.basic :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :panel="$panel" />
         <x-employee.personal.personal :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :socials="$socials" :banks="$banks" :panel="$panel" />
         <x-employee.account.account :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :panel="$panel" />
         <x-employee.document.document :employee="$employee" :documents="$employee->documents" :panel="$panel" :i="0" />
      </div>

   </div>

</div>
</div>
@endsection