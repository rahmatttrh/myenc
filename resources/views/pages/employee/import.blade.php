@extends('layouts.app')
@section('title')
Import Employee
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

   {{-- <div class="page-header d-flex">
      <h5 class="page-title">Import Employee</h5>
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
            <a href="#">Import</a>
         </li>
      </ul>
   </div> --}}

   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Import Employee</li>
      </ol>
   </nav>

   <div class="card shadow-none border">
      <div class="card-header d-flex">
         <div class="d-flex  align-items-center">
            <div class="card-title">Employee Import by Excel</div>
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
                     <button type="submit" class="btn btn-primary">Import</button>
                  </div>

               </form>
            </div>
            <div class="col-md-7">
               <div class="card card-light card-annoucement card-round shadow-none border">
                  <div class="card-body text-center">
                     {{-- <div class="card-opening">Import Excel</div> --}}
                     {{-- <div class="card-desc">
                        Make sure your document format is the same as the system requirements. Or you can download the template in the link below
                     </div> --}}
                     <div class="card-detail">
                        <a href="/documents/template-employee-fix.xlsx" class="btn btn-success btn-rounded">Download Template</a>
                     </div>
                     {{-- <div class="card-desc text-left">
                        Kolom Business Unit, Department, Sub Department, Position diisi dengan angka ID yang bisa dilihat di Master Data
                     </div> --}}
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card-footer">
         {{-- <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small> --}}
      </div>
   </div>
</div>

@endsection