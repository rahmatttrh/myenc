@extends('layouts.app')

@section('title')
   Detail Employee
@endsection

@section('content')
<div class="page-inner">
   {{-- <h4 class="page-title">User Profile</h4> --}}
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page"><a href="{{route('employee')}}">Employee</a></li>
         <li class="breadcrumb-item active" aria-current="page">Detail</li>
      </ol>
   </nav>
   <div class="row">
      <div class="col-md-4">
         <div class="card card-profile card-secondary">
            <div class="card-header" style="background-image: url('{{asset('img/blogpost.jpg')}}')">
               <div class="profile-picture">
                  @if ($employee->status == 1)
                     <div class="avatar avatar-xl avatar-online">
                     @else
                     <div class="avatar avatar-xl avatar-offline">
                  @endif
                  
                     @if ($employee->biodata->picture)
                     <img src="{{asset('storage/' . $employee->biodata->picture)}}" alt="..." class="avatar-img rounded-circle">
                         @else
                         <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                     @endif
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="user-profile text-center mb--4">
                  <div class="h4"><b> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</b></div>
                  <small>{{$employee->contract->designation->name ?? ''}} {{$employee->contract->department->name ?? ''}}</small>
               </div>
               
            </div>
            <div class="card-footer">
               <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active text-left pl-3" id="v-pills-contract-tab" data-toggle="pill" href="#v-pills-contract" role="tab" aria-controls="v-pills-contract" aria-selected="false">
                     <i class="fas fa-file-contract mr-1"></i>
                    
                     Contract
                  </a>
                  <a class="nav-link  text-left pl-3" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true">
                     <i class="fas fa-address-book mr-1"></i>
                     Basic Information
                  </a>
                  
                  <a class="nav-link text-left pl-3" id="v-pills-personal-tab" data-toggle="pill" href="#v-pills-personal" role="tab" aria-controls="v-pills-personal" aria-selected="false">
                     <i class="fas fa-user mr-1"></i>
                     Personal Information
                  </a>
                  <a class="nav-link text-left pl-3" id="v-pills-account-tab" data-toggle="pill" href="#v-pills-account" role="tab" aria-controls="v-pills-account" aria-selected="false">
                     <i class="fas fa-credit-card mr-1"></i>
                     Account Information
                  </a>

                  <a class="nav-link text-left pl-3" id="v-pills-document-tab" data-toggle="pill" href="#v-pills-document" role="tab" aria-controls="v-pills-document" aria-selected="false">
                     <i class="fas fa-file mr-1"></i>
                     Document
                  </a>
                  {{-- <a class="nav-link text-left pl-3" id="v-pills-bank-tab" data-toggle="pill" href="#v-pills-bank" role="tab" aria-controls="v-pills-bank" aria-selected="false">
                     <i class="fas fa-key mr-1"></i>
                     Change Password
                  </a> --}}
               </div>
            </div>
            <div class="card-footer">
               <small>Lorem ipsum dolor sit amet consectetur adipisicing elit.</small>
            </div>
         </div>
         
         
      </div>
      <div class="col-md-8">
         <div class="tab-content" id="v-pills-tabContent">
            <x-employee.tab.basic :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles"/>
            <x-employee.tab.contract :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" :shifts="$shifts"/>
            <x-employee.tab.personal :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles"/>
            <x-employee.tab.account :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" />
            <x-employee.tab.document :employee="$employee" :departments="$departments" :designations="$designations" :roles="$roles" />
         </div>
         
      </div>
      
   </div>
</div>
@endsection