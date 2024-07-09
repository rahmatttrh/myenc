@extends('layouts.app')
   @section('title')
      Bisnis Unit
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('unit')}}">Bisnis Unit</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-md-4">
            <div class="card shadow-none border">
               <div class="card-header  d-flex"> 
                  <div class="d-flex  align-items-center">
                     <div class="card-title"><b>{{$unit->name}}</b></div> 
                  </div>
                  
               </div> 
               <div class="card-body">
                  
                  <form action="{{route('department.store')}}" method="POST">
                     @csrf
                     <input type="text" value="{{$unit->id}}"  name="unit" id="unit" hidden>
                     <div class="form-group form-group-default">
                        <label>Department Name</label>
                        <input id="name" name="name" required type="text" class="form-control" >
                     </div>
                     <button type="submit" class="btn btn-block btn-light border">Add New Department</button>

                  </form>
                     <hr>
                     <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($departments as $depart)
                           <a class="nav-link {{$firstDept->id == $depart->id ? 'active' : ''}} text-left pl-3" id="v-pills-{{$depart->id}}-tab" data-toggle="pill" href="#v-pills-{{$depart->id}}" role="tab" aria-controls="v-pills-{{$depart->id}}" aria-selected="true">
                              
                              {{$depart->name}}
                           </a>
                        @endforeach
                        
                        
                        
                     </div>
               </div>
               
            </div>
         </div>
         <div class="col-md-8">
            <div class="tab-content" id="v-pills-tabContent">
               @foreach ($departments as $depart)
               <div class="tab-pane fade {{$firstDept->id == $depart->id ? 'show active' : ''}} " id="v-pills-{{$depart->id}}" role="tabpanel" aria-labelledby="v-pills-{{$depart->id}}-tab">
                  <div class="card">
                     <div class="card-header d-flex justify-content-between p-2 bg-primary text-white">
                        <small>{{$depart->name}} Department</small>
                        <div>
                           <a href="#" class="text-white" data-toggle="modal" data-target="#modal-edit-department-{{$depart->id}}">Edit</a> |
                           <a href="#" class="text-white" data-toggle="modal" data-target="#modal-delete-{{$depart->id}}">Delete</a>
                           | <a href="#" data-toggle="modal" class="text-white" data-target="#modal-add-subdept-{{$depart->id}}">Add Sub</a>
                        </div>
                     </div>
                     <div class="card-body p-0">
                        <table class="display  table-sm table-bordered  ">
                           <thead>
                              
                              <tr>
                                 {{-- <th scope="col" class="text-center">#</th> --}}
                                 <th scope="col">Sub Department Name</th>
                                 <th>Position</th>
                                 <th scope="col" class="text-right">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @if (count($depart->sub_depts) > 0)
                                    @foreach ($depart->sub_depts as $sub)
                                    <tr>
                                       {{-- <td class="text-center">{{++$i}}</td> --}}
                                       <td><a href="{{route('unit.detail', enkripRambo($sub->id))}}">{{$sub->name}}</a></td>
                                       <td>
                                          @foreach ($sub->positions as $pos)
                                              {{$pos->name}} <br>
                                          @endforeach
                                       </td>
      
                                    <td class="text-right">
                                       {{-- <div class="btn-group"> --}}
                                          <a href="#"  data-toggle="modal" data-target="#modal-edit-subdept-{{$sub->id}}">Edit</a> |
                                          <a href="#"  data-toggle="modal" data-target="#modal-delete-{{$sub->id}}">Delete</a> |
                                          <a href="#"  data-toggle="modal" data-target="#modal-add-position-{{$sub->id}}">Add Position</a>
                                       {{-- </div> --}}
                                          
                                       </td>
                                    </tr>
                                    <x-modal.delete :id="$sub->id" :body="$sub->name" url="{{route('subdept.delete', enkripRambo($sub->id))}}" />
                                       <x-modal.edit-subdept :id="$sub->id" :sub="$sub"  />
                                    <x-modal.add-position :id="$sub->id" :sub="$sub" :designations="$designations"  />
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

               <x-modal.delete :id="$depart->id" :body="$depart->name" url="{{route('department.delete', enkripRambo($depart->id))}}" />
                  <x-modal.add-subdept :id="$depart->id" :body="$depart->name" url="" />
                  <x-modal.edit-department :id="$depart->id" :department="$depart"  />
               @endforeach
            </div>
            <hr>
            
         </div>
      </div>
   </div>

@endsection