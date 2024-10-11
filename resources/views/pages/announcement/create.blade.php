@extends('layouts.app')
   @section('title')
      Announcement
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Announcement</li>
         </ol>
      </nav>
      
      <form action="{{route('announcement.store')}}" method="POST">
         @csrf
         <div class="row">
            <div class="col-md-4">
                <h4>Form Create Announcement</h4>
                <hr>
               <div class="form-group form-group-default">
                  <label>Broadcast/Personal*</label>
                  <select name="type" id="type" required class="form-control" >
                      <option value="1">Broadcast</option>
                      <option value="2">Personal</option>
                  </select>
               </div>
               <div class="form-group form-group-default">
                  <label>Employee</label>
                  <select name="employee" id="employee" class="form-control" >
                      <option value="" disabled selected>Choose</option>
                      @foreach ($employees as $emp)
                          <option value="{{$emp->id}}">{{$emp->biodata->fullName()}}</option>
                      @endforeach
                  </select>
               </div>
               <div class="form-group form-group-default">
                  <label>Title*</label>
                  <input id="title" name="title" required type="text" class="form-control">
               </div>
               <button type="submit" class="btn btn-block btn-primary">Submit</button>
               <hr>
               <small>
                Tipe Broadcast. Announcement akan tampil di Dashboard semua Employee.
               </small>
               <hr>
               <small>
                Tipe Personal, data Employee harus dipilih. Announcement akan tampil di Dashboard Employee yang dipilih.
               </small>
            </div>
            
            <div class="col">

               <textarea name="body" id="body" cols="30" rows="10" hidden></textarea>
               {{-- <span>B</span> --}}
               <main>
                  <trix-toolbar id="my_toolbar"></trix-toolbar>
                  <div class="more-stuff-inbetween"></div>
                  <trix-editor toolbar="my_toolbar" input="body" style="min-height: 250px"></trix-editor>
                </main>
            </div>
         </div>
         
         {{-- <div class="form-group form-group-default">
            <label>Body</label>
            <textarea name="body" id="body" class="form-control" cols="30" rows="5"></textarea>
         </div> --}}
         
         

      </form>
   </div>

@endsection