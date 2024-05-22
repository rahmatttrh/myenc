@extends('layouts.app')
   @section('title')
      Position
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Position</li>
         </ol>
      </nav>
      
      <div class="card">
         <div class="card-header d-flex"> 
            <div class="d-flex  align-items-center">
               <div class="card-title">Position List</div> 
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
            <div class="row">
               <div class="col-md-4">
                  <h4>Form Create</h4>
                  <hr>
                  <form action="{{route('department.store')}}" method="POST">
                     @csrf
                     <div class="form-group form-group-default">
                        <label>Name</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="Fill Name">
                     </div>
                     <button type="submit" class="btn btn-primary">Add</button>

                  </form>
               </div>
               <div class="col-md-8">
                  <div class="table-responsive">
                     <table id="multi-filter-select" class="display basic-datatables  table " >
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th class="text-right">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>
                                    <a href="">Delete</a>
                              </td>
                           </tr>
                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>
                                    <a href="">Delete</a>
                              </td>
                           </tr>
                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>
                                    <a href="">Delete</a>
                              </td>
                           </tr>
                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>
                                    <a href="">Delete</a>
                              </td>
                           </tr>

                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>
                                    <a href="">Delete</a>
                              </td>
                           </tr>
                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>
                                 <a href="">Delete</a>
                              </td>
                           </tr>
                           <tr>
                              <td>1</td>
                              <td>Staff</td>
                              <td class="text-right">
                                 <a href="">Edit</a>  
                                                                     <a href="">Delete</a>
                              </td>
                           </tr>
                           {{-- @foreach ($departments as $department)
                              <tr>
                                 <td>{{++$i}}</td>
                                 <td>{{$department->name}}</td>
                                 <td class="text-right">
                                    <div class="btn-group border" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-light">Edit</button>
                                    <button type="button" class="btn btn-sm btn-light">Delete</button>
                                  </div>
                                 </td>
                              </tr>
                           @endforeach --}}
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection