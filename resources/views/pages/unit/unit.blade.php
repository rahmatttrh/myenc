@extends('layouts.app')
   @section('title')
      Bisnis Unit
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Bisnis Unit</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-md-4">
            <div class="card shadow-none border">
               <div class="card-header d-flex"> 
                  <div class="d-flex  align-items-center">
                     <div class="card-title">Form Add Business Unit</div> 
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
                  <form action="{{route('unit.store')}}" method="POST">
                     @csrf
                     <div class="form-group form-group-default">
                        <label>Business Unit Name</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Fill Name">
                     </div>
                     <button type="submit" class="btn btn-block btn-primary">Add New Business Unit</button>

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
                  <small>Bisnis Unit</small>
               </div>
               <div class="card-body p-0">
                  <table class="display  table-sm table-bordered   ">
                     <thead>
                        
                        <tr>
                           {{-- <th scope="col" class="text-center">ID</th> --}}
                           <th scope="col">ID - Unit Name</th>
                           <th>Department</th>
                           <th>Employee</th>
                           <th scope="col" class="text-right">Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @if (count($units) > 0)
                              @foreach ($units as $unit)
                              <tr>
                                 {{-- <td class="text-center">{{$unit->id}}</td> --}}
                                 <td><a href="{{route('unit.detail', enkripRambo($unit->id))}}">{{$unit->name}}</a></td>
                                 <td>{{count($unit->departments)}} Department</td>
                                 <td>{{count($unit->employees->where('status', 1))}}</td>

                              <td class="text-right">
                                    <a href="" data-toggle="modal" data-target="#modal-edit-unit-{{$unit->id}}">Edit</a> |
                                    <a href="#" data-toggle="modal" data-target="#modal-delete-{{$unit->id}}">Delete</a>
                                 </td>
                              </tr>
                              <x-modal.edit-unit :id="$unit->id" :unit="$unit"  />
                              <x-modal.delete :id="$unit->id" :body="$unit->name" url="{{route('unit.delete', enkripRambo($unit->id))}}" />
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
            {{-- <div class="card shadow-none border" >
               <div class="card-header d-flex"> 
                  <div class="d-flex  align-items-center">
                     <div class="card-title">Bisnis Unit List</div> 
                  </div>
                  <div class="btn-group btn-group-page-header ml-auto">
                     <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-ellipsis-h"></i>
                     </button>
                     <div class="dropdown-menu">
                        
                        
                        <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                     </div>
                  </div>
               </div> 
               <div class="card-body">
                  <div class="table-responsive">
                     <table id="" class="  table table-striped " >
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Bisnis Unit</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($units as $unit)
                              <tr>
                                 <td>{{++$i}}</td>
                                 <td>{{$unit->name}}</td>

                                <td class="text-right">
                                    <a href="#" data-toggle="modal" data-target="#modal-delete-{{$unit->id}}">Delete</a>
                                 </td>
                              </tr>
                              <x-modal.delete :id="$unit->id" :body="$unit->name" url="{{route('unit.delete', enkripRambo($unit->id))}}" />
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div> --}}
         </div>
      </div>
   </div>

@endsection