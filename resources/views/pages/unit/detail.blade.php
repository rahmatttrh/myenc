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
               <div class="card-header  "> 
                  
                     <div class="card-title"><b>{{$unit->name}}</b></div> 
                     <small>Total {{count($unit->employees->where('status', 1))}} Karyawan</small>
                  
                  
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
                        <small>
                           @if (auth()->user()->hasRole('Administrator'))
                              {{$depart->id}} 
                           @endif
                            {{$depart->name}} Department <br>
                           {{count($depart->employees->where('status', 1))}} Karyawan
                        </small> 
                        <div>
                           <a href="#" data-toggle="modal" class="text-white" data-target="#modal-add-position-dept-{{$depart->id}}">Add Position</a>  |
                           <a href="#" data-toggle="modal" class="text-white" data-target="#modal-add-subdept-{{$depart->id}}">Add Sub</a> |
                           <a href="#" class="text-white" data-toggle="modal" data-target="#modal-edit-department-{{$depart->id}}">Edit</a> |
                           <a href="#" class="text-white" data-toggle="modal" data-target="#modal-delete-depart-{{$depart->id}}">Delete</a>
                           {{-- <x-modal.delete :id="$depart->id" :body="$depart->name" url="{{route('department.delete', enkripRambo($depart->id))}}" /> --}}
                              <div class="modal fade" id="modal-delete-depart-{{$depart->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content text-dark">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body ">
                                          Delete {{$depart->name}} ?
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-danger ">
                                             <a class="text-light" href="{{route('department.delete', enkripRambo($depart->id))}}">Delete</a>
                                          </button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                        </div>
                     </div>
                     <div class="card-body p-0">
                        <table class="display  table-sm table-bordered  ">
                           <thead>
                              @foreach ($depart->positions->where('type', 'dept') as $depos)
                                  <tr>
                                    <td colspan="2">{{$depos->name}}</td>
                                    <td colspan="1">
                                       @if (count($depos->employees) > 0)
                                       @foreach ($depos->employees as $emp)
                                       {{$emp->biodata->fullName()}}
                                   @endforeach
                                       @endif
                                       
                                       
                                    </td>
                                    <td class="text-right">
                                       <a href="" data-toggle="modal" data-target="#modal-change-position-{{$depos->id}}">Assign</a> |
                                       {{-- <a href="">Edit</a> | --}}
                                       <a href="" data-toggle="modal" data-target="#modal-delete-{{$depos->id}}">Delete</a>
                                    </td>
                                  </tr>
                                  <x-modal.change-position :id="$depos->id" :pos="$depos" :deptemployees="$depart->getManagers()"  />
                                    <x-modal.delete :id="$depos->id" :body="$depos->name" url="{{route('position.department.delete', enkripRambo($depos->id))}}" />
                              @endforeach
                              <tr>
                                 <th colspan="4">Sub Department</th>
                              </tr>
                              <tr>
                                 <th scope="col" class="text-center"></th>
                                 {{-- <th scope="col">Sub Department Name</th> --}}
                                 <th>Position</th>
                                 <th>Total Karyawan</th>
                                 <th scope="col" class="text-right">Action</th>
                              </tr>
                              
                           </thead>
                           <tbody>
                              @if (count($depart->sub_depts) > 0)
                                    @foreach ($depart->sub_depts as $sub)
                                    <tr>
                                       {{-- <td class="text-center">{{++$i}}</td> --}}
                                       <td colspan="2">
                                          @if (auth()->user()->hasRole('Administrator'))
                                             {{$sub->id}} 
                                             @endif
                                          {{$sub->name}}
                                       </td>
                                       <td>{{count($sub->employees->where('status', 1))}} Karyawan</td>
      
                                       <td class="text-right">
                                          {{-- <div class="btn-group"> --}}
                                             <a href="#"  data-toggle="modal" data-target="#modal-add-position-{{$sub->id}}">Add Position</a> |
                                             <a href="#"  data-toggle="modal" data-target="#modal-edit-subdept-{{$sub->id}}">Edit</a> |
                                             <a href="#"  data-toggle="modal" data-target="#modal-delete-{{$sub->id}}">Delete</a> 
                                             
                                          {{-- </div> --}}
                                          
                                       </td>
                                    </tr>
                                    @foreach ($sub->positions as $pos)
                                        <tr>
                                          <td></td>
                                          <td>
                                             @if (auth()->user()->hasRole('Administrator'))
                                             {{$pos->id}} 
                                             @endif
                                             {{$pos->name}} 
                                          </td>
                                          <td>
                                             
                                             {{count($pos->getEmployees()->where('status', 1))}} Karyawan
                                             
                                          </td>
                                          <td class="text-right">
                                             {{-- @if ($pos->designation_id == 6)
                                             <a href="" data-toggle="modal" data-target="#modal-change-position-{{$pos->id}}">Assign</a> |
                                             @endif --}}
                                             
                                             <a href="#" data-toggle="modal" data-target="#modal-edit-position-{{$pos->id}}">Edit</a> | 
                                             <a href="#" data-toggle="modal" data-target="#modal-delete-{{$pos->id}}">Delete</a>
                                          </td>
                                       </tr> 
                                       <x-modal.change-position :id="$pos->id" :pos="$pos" :deptemployees="$depart->getManagers()"  />
                                       <x-modal.delete :id="$pos->id" :body="$pos->name" url="{{route('position.delete', enkripRambo($pos->id))}}" />
                                       <x-modal.edit-position :id="$pos->id" :pos="$pos" :designations="$designations"  />
                                    @endforeach
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

                   
                  <x-modal.add-position-dept :id="$depart->id" :department="$depart" url="" :designations="$designations" />
                  <x-modal.add-subdept :id="$depart->id" :department="$depart" url="" />
                  <x-modal.edit-department :id="$depart->id" :department="$depart"  />
               @endforeach
            </div>
            <hr>
            
         </div>
      </div>
   </div>

@endsection