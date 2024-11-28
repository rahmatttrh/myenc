@extends('layouts.app')
@section('title')
Create Task List
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Create Task List</li>
      </ol>
   </nav>
   {{-- <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>
   <hr> --}}

   <div class="row">
      <div class="col-md-4">
         <h4>Create New task</h4>
         <hr>
         <form action="{{route('task.store')}}" method="POST">
            @csrf
            <label class="mb-2">PIC</label>
            <select class="mb-3 form-control js-example-basic-single" style="width: 100%"  id="pic" required name="pic" >
               <option value="{{$employee->id}}">{{$employee->nik}} {{$employee->biodata->fullName()}}</option>
               @foreach ($myteams as $emp)
                  @php
                     $bio = DB::table('biodatas')->where('id', $emp->biodata_id)->first();
                  @endphp
                  <option value="{{$emp->id}}">{{$emp->nik}} {{$bio->first_name}} {{$bio->last_name}}</option>
               @endforeach
            </select>
            <div class="form-group form-group-default mt-3">
               <label>Kategori</label>
               <input type="text"  class="form-control" name="kategori" id="kategori">
            </div>
            <div class="form-group form-group-default">
               <label>Action Plan</label>
               <textarea   class="form-control" name="plan" id="plan" rows="3"></textarea>
            </div>
            <div class="form-group form-group-default">
               <label>Target</label>
               <input type="date"  class="form-control" name="target" id="target">
            </div>
            <hr>
            <button type="submit" class="btn  btn-primary">Submit</button>

         
         </form>
      </div>
   </div>
   
   
</div>





@endsection