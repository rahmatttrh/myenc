@extends('layouts.app')
   @section('title')
      Payroll Bisnis Unit
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Setup Payroll</li>
            <li class="breadcrumb-item active" aria-current="page">Potongan Bisnis Unit</li>
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
                  <div class="row">
                     <div class="col-12">
                        <form action="{{route('payroll.unit.update')}}" method="POST">
                           @csrf
                           <input type="number" name="unit" id="unit" value="{{$unit->id}}" hidden>
                           <div class="row">
                              {{-- <div class="col-md-2">
                                 <div class="form-group form-group-default">
                                    <label>PPH</label>
                                    <select class="form-control" name="pph" id="pph" required>
                                       <option value="" selected disabled>Choose</option>
                                       <option {{$unit->pph == '21' ? 'selected' : ''}} value="21">21 </option>
                                       <option {{$unit->pph == '22' ? 'selected' : ''}}  value="22">22 </option>
                                    </select>
                                 </div>
                              </div> --}}
                              <div class="col">
                                 <div class="form-group form-group-default">
                                    <label>Tipe Lembur</label>
                                    <select class="form-control" name="spkl_type" id="spkl_type" required>
                                       <option value="" selected disabled>Choose</option>
                                       <option {{$unit->spkl_type == 1 ? 'selected' : ''}} value="1">Gaji Pokok /173</option>
                                       <option {{$unit->spkl_type == 2 ? 'selected' : ''}}  value="2">Gaji Pokok+Tunjangan Tetap /173</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group form-group-default">
                                    <label>Hour Type</label>
                                    <select class="form-control" name="hour_type" id="hour_type" required>
                                       <option value="" selected disabled>Choose</option>
                                       <option {{$unit->hour_type == 1 ? 'selected' : ''}} value="1">Aktual </option>
                                       <option {{$unit->hour_type == 2 ? 'selected' : ''}}  value="2">Multiple</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col">
                                 <button class="btn btn-primary btn-sm">Update</button>
                              </div>
                           </div>
                           
                        </form>
                     </div>
                  </div>
                  <div class="table-responsive">
                     <table>
                        <thead>
                           {{-- <tr>
                              <th colspan="6">
                                 <a href="" class="btn btn-sm btn-light" data-target="#modal-add-reduction" data-toggle="modal">Add Reduction</a>
                              </th>
                           </tr> --}}
                           <tr>
                              <th rowspan="2">Desc</th>
                              <th colspan="2" class="text-center">Salary</th>
                              <th colspan="2" class="text-center">Potongan (%)</th>
                              <th rowspan="2">
                                 <a href="" class="btn btn-sm btn-light btn-block" data-target="#modal-add-reduction-{{$unit->id}}" data-toggle="modal">Add Reduction</a>
                              </th>
                           </tr>
                           <tr>
                              <th>Min</th>
                              <th>Max</th>
                              <th>Perusahaan</th>
                              <th>Karyawan</th>
                              
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($unit->reductions as $red)
                           <form action="{{route('reduction.update')}}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="number" name="reduction" id="reduction" value="{{$red->id}}" hidden>
                              <tr>
                                 <td>
                                    {{-- <input style="max-width: 120px" type="text" value=""> --}}
                                    {{$red->name}}
                                 </td>
                                 <td >
                                    <input style="max-width: 100px" name="min_salary" id="min_salary" type="text" value="{{$red->min_salary}}">
                                 </td>
                                 <td>
                                    <input style="max-width: 100px" name="max_salary" id="max_salary" type="text" value="{{$red->max_salary}}">
                                 </td>
                                 <td >
                                    <input style="max-width: 40px" name="company" id="company" type="text" value="{{$red->company}}">
                                 </td>
                                 <td >
                                    <input style="max-width: 40px" name="employee" id="employee" type="text" value="{{$red->employee}}">
                                 </td>
                                 <td>
                                    <div class="btn-group ">
                                       <button type="submit" class="btn btn-sm btn-primary btn-block">Update</button>
                                       <a href="#" data-target="#modal-delete-reduction-{{$red->id}}" data-toggle="modal" class="btn btn-sm btn-danger">Delete</a>
                                    </div>
                                 </td>
                              </tr>
                           </form>

                           <div class="modal fade" id="modal-delete-reduction-{{$red->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-sm" role="document">
                                 <div class="modal-content text-dark">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                       </button>
                                    </div>
                                    <div class="modal-body ">
                                       Delete  {{$red->name}}
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                       <button type="button" class="btn btn-danger ">
                                          <a class="text-light" href="{{route('reduction.delete', enkripRambo($red->id))}}">Delete</a>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endforeach
                           
                        </tbody>
                     </table>
                  </div>
                  

                  
                  



                  <div class="modal fade" id="modal-add-reduction-{{$unit->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                           <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Reduction {{$unit->name}}</h5>
                              
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
                                       <option value="" selected disabled>Choose</option>
                                       <option value="BPJS KS">BPJS Kesehatan </option>
                                       <option value="JKK">JKK </option>
                                       <option value="JHT">JHT </option>
                                       <option value="JKM">JKM </option>
                                       <option value="JP">JP </option>
                                       <option value="PPH">PPH </option>
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
                                          <input type="decimal" class="form-control" required name="company" id="company">
                                      </div>
                                    </div>
                                    <div class="col">
                                       <div class="form-group form-group-default">
                                          <label>Employee (%)</label>
                                          <input type="decimal" class="form-control" required name="employee" id="employee">
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