@extends('layouts.app')
   @section('title')
      Shift
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Shift</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-md-4">
            <div class="card shadow-none border">
               <div class="card-header d-flex"> 
                  <div class="d-flex  align-items-center">
                     <div class="card-title">Form Add Shift</div> 
                  </div>
                  {{-- <div class="btn-group btn-group-page-header ml-auto">
                     <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-ellipsis-h"></i>
                     </button>
                     <div class="dropdown-menu">
                        
                        
                        <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                     </div>
                  </div> --}}
               </div> 
               <div class="card-body">
                  <form action="{{route('shift.store')}}" method="POST">
                     @csrf
                     <div class="form-group form-group-default">
                        <label>Shift Name</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Fill Shift Name">
                     </div>
                     <div class="row">
                        <div class="col">
                           <div class="form-group form-group-default">
                              <label>In</label>
                              <input id="in" name="in" type="time" class="form-control" >
                           </div>
                        </div>
                        <div class="col">
                           <div class="form-group form-group-default">
                              <label>Out</label>
                              <input id="out" name="out" type="time" class="form-control" >
                           </div>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-block btn-primary">Add New Shift</button>

                  </form>
               </div>
               <div class="card-footer">
                  {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni at neque inventore vel.</small> --}}
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="card">
               <div class="card-header p-2 bg-primary text-white">
                  <small>Shift / Work Hour</small>
               </div>
               <div class="card-body p-0">
                  <table class="display  table-sm table-bordered   ">
                     <thead>
                        
                        <tr>
                           {{-- <th scope="col" class="text-center">ID</th> --}}
                           <th scope="col">Shift Name</th>
                           <th>Time</th>
                           <th scope="col" class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if (count($shifts) > 0)
                              @foreach ($shifts as $shift)
                              <tr>
                                 {{-- <td class="text-center">{{$unit->id}}</td> --}}
                                 <td>{{$shift->id}} - {{$shift->name}}</td>
                                 <td>{{formatTime($shift->in)}} {{formatTime($shift->out)}}</td>

                              <td class="text-right">
                                    <a href="" data-toggle="modal" data-target="#modal-edit-shift-{{$shift->id}}">Edit</a> |
                                    <a href="#" data-toggle="modal" data-target="#modal-delete-{{$shift->id}}">Delete</a>
                                 </td>
                              </tr>
                              <x-modal.edit-shift :id="$shift->id" :shift="$shift"  />
                              <x-modal.delete :id="$shift->id" :body="$shift->name" url="{{route('shift.delete', enkripRambo($shift->id))}}" />
                           @endforeach
                           @else
                           <tr>
                              <td colspan="5" class="text-center">Empty</td>
                           </tr>
                        @endif
                        
                        
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection