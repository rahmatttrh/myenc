@extends('layouts.app')
   @section('title')
      Payroll Bisnis Unit
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Payroll</li>
            <li class="breadcrumb-item active" aria-current="page">Bisnis Unit</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-md-3">
            {{-- <div class="card shadow-none border">
               
               <div class="card-body"> --}}
                     <div class="nav flex-column justify-content-start nav-pills nav-primary" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach ($units as $unit)
                           <a class="nav-link {{$firstUnit->id == $unit->id ? 'active' : ''}} text-left pl-3" id="v-pills-{{$unit->id}}-tab" data-toggle="pill" href="#v-pills-{{$unit->id}}" role="tab" aria-controls="v-pills-{{$unit->id}}" aria-selected="true">
                              
                               {{$unit->name}}
                           </a>
                        @endforeach
                     </div>
               {{-- </div>
               
            </div> --}}
         </div>
         <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
               @foreach ($units as $unit)
               <div class="tab-pane fade {{$firstUnit->id == $unit->id ? 'show active' : ''}} " id="v-pills-{{$unit->id}}" role="tabpanel" aria-labelledby="v-pills-{{$unit->id}}-tab">
                  <div class="card">
                     <div class="card-header  p-2 bg-primary text-white">
                        {{-- <small> --}}
                           {{-- @if (auth()->user()->hasRole('Administrator'))
                              {{$unit->id}} 
                           @endif --}}
                            <b>{{$unit->name}}</b> <br>
                            Potongan (%)
                        {{-- </small>  --}}
                     </div>
                     <div class="card-body p-0">
                        <div class="table-responsive">
                        <table>
                           <thead>
                              <tr>
                                 <th colspan="6">
                                    <a href="" class="btn btn-sm btn-light" data-target="#modal-add-reduction" data-toggle="modal">Add Reduction</a>
                                 </th>
                              </tr>
                              <tr>
                                 <th>Desc</th>
                                 <th>Min. Salary</th>
                                 <th>Max. Salary</th>
                                 <th>Company</th>
                                 <th>Employee</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($unit->reductions as $red)
                              <tr>
                                 <td>
                                    <input style="max-width: 120px" type="text" value="{{$red->name}}">
                                 </td>
                                 <td >
                                    <input style="max-width: 100px" type="text" value="{{$red->min_salary}}">
                                 </td>
                                 <td>
                                    <input style="max-width: 100px" type="text" value="{{$red->max_salary}}">
                                 </td>
                                 <td >
                                    <input style="max-width: 40px" type="text" value="{{$red->company}}">
                                 </td>
                                 <td >
                                    <input style="max-width: 40px" type="text" value="{{$red->employee}}">
                                 </td>
                                 <td>
                                    <div class="btn-group">
                                       <a href="" class="btn btn-sm btn-primary">Update</a>
                                       <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                 </td>
                              </tr>
                              @endforeach
                              
                           </tbody>
                        </table>
                     </div>
                       <hr>
                     </div>
                  </div>

                  <div class="modal fade" id="modal-add-reduction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Reduction</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                              </button>
                           </div>
                           <form action="{{route('reduction.store')}}" method="POST" >
                              <div class="modal-body">
                                 @csrf
                                 <input type="number" value="{{$unit->id}}" name="unit" id="unit" hidden>
                                 <div class="form-group form-group-default">
                                    <label>Type</label>
                                    <select class="form-control" name="desc" id="desc" required>
                                        <option value="">Choose</option>
                                        <option value="BPJS KS">BPJS Kesehatan </option>
                                        <option value="BPJS KT">BPJS Ketenagakerjaan </option>
                                    </select>
                                </div>
                                 <div class="row">
                                    <div class="col-12">
                                       <div class="form-group form-group-default">
                                          <label>Min. Salary</label>
                                          <input type="number" class="form-control" name="min_salary" id="min_salary">
                                      </div>
                                    </div>
                                    <div class="col-12">
                                       <div class="form-group form-group-default">
                                          <label>Max. Salary</label>
                                          <input type="number" class="form-control" name="max_salary" id="max_salary">
                                      </div>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                       <div class="form-group form-group-default">
                                          <label>Company (%)</label>
                                          <input type="decimal" class="form-control" name="company" id="company">
                                      </div>
                                    </div>
                                    <div class="col">
                                       <div class="form-group form-group-default">
                                          <label>Employee (%)</label>
                                          <input type="decimal" class="form-control" name="employee" id="employee">
                                      </div>
                                    </div>
                                 </div>
                                    
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                 <button type="submit" class="btn btn-info ">Create</button>
                              </div>
                              
                           </form>
                        </div>
                     </div>
                  </div>
               </div>

                   
                 
               @endforeach
            </div>
            <hr>
            
         </div>
      </div>
   </div>

   

@endsection