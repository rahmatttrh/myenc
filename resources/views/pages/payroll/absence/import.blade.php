@extends('layouts.app')
@section('title')
Payroll Absence
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Absence</li>
      </ol>
   </nav>

   <div class="card shadow-none border col-md-12">
      <div class=" card-header">
         <x-absence-tab :activeTab="request()->route()->getName()" />
      </div>

      <div class="card-body">
         <div class="row">
            <div class="col-md-5">
               <img src="{{asset('img/xls-file.png')}}" class="img mb-4" height="110" alt="">
               <form action="{{route('payroll.absence.import.store')}}" method="POST" enctype="multipart/form-data">
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
               <div class="card  shadow-none border">
                  <div class="card-body ">
                     {{-- <div class="card-opening  text-center">Template Excel Absence</div> --}}
                     {{-- <div class="card-desc text-center">
                        Make sure your document format is the same as the system requirements. Or you can download the template in the link below
                     </div> --}}
                     
                     <!-- <a href="{{route('payroll.absence.export')}}">
                        <button type="submit" class="btn btn-success  btn-rounded">Download Template</button>
                     </a> -->
                     <form action="{{route('payroll.absence.template')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group ">
                                 <label>Pilih Tanggal <span class="text-danger">*</span> </label>
                                 <input class="form-control" type="date" name="date" id="dateInput" max="<?php echo date('Y-m-d'); ?>" required>
                                 @error('excel')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group ">
                                 <label>Pilih Bisnis Unit <span class="text-danger">*</span> </label>
                                 <select name="bu" id="" class="form-control" required>
                                    <option value="">-Pilih Bisnis Unit-</option>
                                    <option value="all">All</option>
                                    @foreach($units as $unit)
                                    <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('excel')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group ">
                                 <label>Pilih Lokasi <span class="text-danger">*</span> </label>
                                 <select name="location" id="" class="form-control" required>
                                    <option value="">-Pilih Lokasi-</option>
                                    <option value="all">All</option>
                                    @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{$location->name}}</option>
                                    @endforeach
                                 </select>
                                 @error('excel')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                           </div>
                           <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-success  btn-rounded">Download Template</button>
                             </div>
                           </div>
                        </div>
                        

                     </form>
                  </div>
                  <div class="card-footer">
                    <b>Panduan Pengisian Template Excel Absensi</b>
                    <hr>
                     - Kolom Type hanya bisa di isi 'Alpha, Terlambat, ATL'<br>
                     - Kolom Menit wajib diisi ketika Type 'Terlambat' <br>
                     - Kolom Menit diisi bilangan bulat (Contoh terlambat 15 menit, maka diisi 15)

                  </div>
               </div>
            </div>
         </div>

         <!-- import xls -->

         <hr>

      </div>
   </div>
   <!-- End Row -->


</div>




@endsection