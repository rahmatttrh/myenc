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
      
      <div class="row">
         <div class="col-md-4">
            <h4>Form Create</h4>
            <hr>
            <form action="{{route('announcement.store')}}" method="POST">
                @csrf
                <div class="form-group form-group-default">
                   <label>Broadcast/Personal</label>
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
                   <label>Title</label>
                   <input id="title" name="title" required type="text" class="form-control">
                </div>
                <div class="form-group form-group-default">
                   <label>Body</label>
                   <textarea name="body" id="body" class="form-control" cols="30" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-block btn-primary">Submit</button>

             </form>
         </div>
         <div class="col-md-8">
            <div class="table-responsive">
                <table class="display basic-datatables  table-sm table-bordered   ">
                    <thead>
                       
                       <tr>
                          {{-- <th scope="col" class="text-center">ID</th> --}}
                          <th scope="col">Type</th>
                          <th>Title</th>
                          <th>Body</th>
                          <th>Status</th>
                       </tr>
                    </thead>
                    <tbody>
                       
                       @foreach ($announcements as $announ)
                           <tr>
                            <td>
                                @if ($announ->type == 1)
                                    Broadcast
                                    @else
                                    Personal
                                @endif
                            </td>
                            <td>{{$announ->title}}</td>
                            <td class="text-truncate" style="max-width: 140px">{{$announ->body}}</td>
                            <td>
                                @if ($announ->status == 1)
                                    <span class="text-primary">Active</span>
                                    @elseif($announ->status == 0)
                                    <span class="text-muted">Off</span>
                                @endif
                            </td>
                           </tr>
                       @endforeach
                       
                    </tbody>
                 </table>
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