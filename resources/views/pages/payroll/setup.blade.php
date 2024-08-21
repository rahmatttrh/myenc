@extends('layouts.app')
@section('title')
Setup Payroll
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Setup</li>
      </ol>
   </nav>
   
   <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
         <div class="card card-with-nav shadow-none border">
            <div class="card-header">
               <div class="row row-nav-line">
                  <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                     <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">Gaji Karyawan</a> </li>
                     <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true">Bisnis Unit</a> </li>
                     
                  </ul>
               </div>
            </div>
            <div class="card-body">
               <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                  <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                     <div class="table-responsive">
                        <table id="data" class="display basic-datatables table-sm">
                           <thead>
                              <tr>
                                 <th class="text-center">No</th>
                                 {{-- @if (auth()->user()->hasRole('Administrator'))
                                 <th>ID</th>
                                 @endif --}}
                                 
                                 <th>Employee</th>
                                 {{-- <th>Name</th> --}}
                                 <th class="text-truncate">Bisnis Unit</th>
                                 <th>Position</th>
                                 <th>Status</th>
                                 {{-- <th>Action</th> --}}
                              </tr>
                           </thead>
                           
                           <tbody>
                              @foreach ($employees as $employee)
                              <tr>
                                 <td class="text-center">{{++$i}}</td>
                                 {{-- @if (auth()->user()->hasRole('Administrator'))
                                 <td>{{$employee->id}}</td>
                                 @endif --}}
                                 <td class="text-truncate">
                                    <a href="{{route('payroll.detail', enkripRambo($employee->id))}}"> 
                                       {{$employee->nik}} {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a> 
                                 </td>
                                 {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                                 {{-- <td class="text-truncate">
                                    <div>
                                       <a href="{{route('payroll.detail', enkripRambo($employee->id))}}"> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a>  </div>
                                   
                                 </td> --}}
                                 
                                 
                                 {{-- <td>{{$employee->biodata->phone}}</td> --}}
                                 
                                 <td class="text-truncate">
                                    @if (count($employee->positions) > 0)
                                          {{-- @foreach ($employee->positions as $pos)
                                              {{$pos->department->unit->name}}
                                          @endforeach --}}
                                          Multiple
                                        @else
                                        @if (auth()->user()->hasRole('Administrator'))
                                        {{$employee->department->unit->id ?? ''}}
                                       @endif
                                        {{$employee->department->unit->name ?? ''}}
                                    @endif
                                    
                                 </td>
                                 
                                
                                 
                                 <td>
                                    @if (count($employee->positions) > 0)
                                          {{-- @foreach ($employee->positions as $pos)
                                              {{$pos->name}}
                                          @endforeach --}}
                                          Multiple
                                        @else
                                        @if (auth()->user()->hasRole('Administrator'))
                                        {{$employee->position->id ?? ''}}
                                       @endif
                                        {{$employee->position->name ?? ''}}
                                    @endif
                                 </td>
                                 <td>
                                    @if ($employee->payroll_id != null)
                                       <i class="fa fa-check"></i>
                                       @else
                                       Empty
                                    @endif
                                 </td>
                                 {{-- <td>
                                    <a href="" class="">Update</a>
                                 </td> --}}
                              </tr>
                              @endforeach
                           </tbody>
                           
                        </table>
                     </div>
                  </div>
      
                  <div class="tab-pane fade" id="pills-doc-nobd" role="tabpanel" aria-labelledby="pills-doc-tab-nobd">
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
                                                <a href="" class="btn btn-sm btn-light btn-block" data-target="#modal-add-reduction" data-toggle="modal">Add Reduction</a>
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
                                 <hr>

                                 <div class="row">
                                    <div class="col-6">
                                       <form action="{{route('payroll.unit.update.pph')}}" method="POST">
                                          @csrf
                                          <input type="number" name="unit" id="unit" value="{{$unit->id}}" hidden>
                                          <div class="row">
                                             <div class="col">
                                                <div class="form-group form-group-default">
                                                   <label>PPH</label>
                                                   <select class="form-control" name="pph" id="pph" required>
                                                      <option value="" selected disabled>Choose</option>
                                                      <option {{$unit->pph == '21' ? 'selected' : ''}} value="21">21 </option>
                                                      <option {{$unit->pph == '22' ? 'selected' : ''}}  value="22">22 </option>
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
                                                      <option value="" selected disabled>Choose</option>
                                                      <option value="BPJS KS">BPJS Kesehatan </option>
                                                      <option value="JKK">JKK </option>
                                                      <option value="JHT">JHT </option>
                                                      <option value="JKM">JKM </option>
                                                      <option value="JP">JP </option>
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
      
      
               </div>
      
            </div>
         </div>
      </div>
   </div>
   
</div>

<div class="modal fade" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">

           
            
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">SIMPLE DATA</button> --}}
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            <a  href="{{route('employee.export.simple')}}" class="btn btn-info">SIMPLE DATA</a>
            <a  href="{{route('employee.export')}}" class="btn btn-primary">FULL DATA</a>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
   

   $(document).ready(function() {
      $('.tanggal').datepicker({
         format: "yyyy-mm-dd",
         autoclose: true
      });
   });

   var total = document.getElementById("total");

   $(function() {

      $("#selectall").change(function() {
         if (this.checked) {
            $(".case").each(function() {
               this.checked = true;
            });
            var jumlahCheck = $(".case").length;
         } else {
            $(".case").each(function() {
               this.checked = false;
            });
            var jumlahCheck = 0;
         }

         // menampilkan output ke elemen hasil
         total.innerHTML = jumlahCheck;
         // console.log(jumlahCheck);
      });

      $(".case").click(function() {
         if ($(this).is(":checked")) {
            var isAllChecked = 0;
            var jumlahCheck = $('input:checkbox:checked').length;

            $(".case").each(function() {
               if (!this.checked)
                  isAllChecked = 1;
            });

            if (isAllChecked == 0) {
               $("#selectall").prop("checked", true);

               jumlahCheck = $(".case").length;
            }


         } else {
            $("#selectall").prop("checked", false);

            jumlahCheck = $('input:checkbox:checked').length;
         }
         total.innerHTML = jumlahCheck;
         console.log(jumlahCheck);

      });


   });
</script>
@endsection