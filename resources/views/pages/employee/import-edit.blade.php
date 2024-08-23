@extends('layouts.app')
@section('title')
Update Employee
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
      <h5 class="page-title">Update Employee</h5>
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
            <a href="#">Update</a>
         </li>
      </ul>
   </div>

   <div class="card shadow-none border">
      <div class="card-header d-flex">
         <div class="d-flex  align-items-center">
            <div class="card-title">Employee Update by Excel</div>
         </div>

      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-5">
               <img src="{{asset('img/xls-file.png')}}" class="img mb-4" height="110" alt="">
               <form action="{{route('employee.import')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group ">
                     <label>File Excel</label>
                     <input id="excel" name="excel" type="file" class="form-control-file">
                     @error('excel')
                     <small class="text-danger"><i>{{ $message }}</i></small>
                     @enderror
                  </div>
                  <hr>
                  <div class="form-group">
                     <button type="submit" class="btn btn-muted border" disabled>Update</button>
                  </div>

               </form>
            </div>
            <div class="col-md-7">
               <h1>Fitur Update by Excel <br> masih dalam tahap pengembangan..</h1>
            </div>
            
         </div>
      </div>
      <div class="card-footer">
         {{-- <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small> --}}
      </div>
   </div>
</div>

@endsection