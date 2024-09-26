@extends('layouts.app')
@section('title')
Export Employee
@endsection
@section('content')

<div class="page-inner">
   {{-- <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('employee', enkripRambo('active'))}}">Employee</a></li>
   <li class="breadcrumb-item active" aria-current="page">Import</li>
   </ol>
   </nav> --}}

   <div class="page-header d-flex">
      <h5 class="page-title">Export Employee</h5>
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
            <a href="#">Export</a>
         </li>
      </ul>
   </div>

   <div class="card shadow-none border">
      <div class="card-header d-flex">
         <div class="d-flex  align-items-center">
            {{-- <div class="card-title">Employee Update by Excel</div> --}}
         </div>

      </div>
      <div class="card-body">
         
      </div>
      <div class="card-footer">
         {{-- <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small> --}}
      </div>
   </div>
</div>

@endsection