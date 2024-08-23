@extends('layouts.app')
@section('title')
Employee
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Active Employee</li>
      </ol>
   </nav>
   {{-- <div class="page-header d-flex">

      <h5 class="page-title">Active Employee</h5>
      <ul class="breadcrumbs">
         <li class="nav-home">
            <a href="/">
               <i class="flaticon-home"></i>
            </a>
         </li>
         <li class="separator">
            <i class="flaticon-right-arrow"></i>
         </li>
         <li class="nav-item">
            <a href="#">Employee</a>
         </li>
      </ul>
      <div class="ml-auto">
         <button class="btn btn-light border btn-round " data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu">


            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
            <a class="dropdown-item" style="text-decoration: none"  data-toggle="modal" data-target="#modal-export">Export</a>
            <div class="dropdown-divider"></div></div>
      </div>
   </div> --}}

   <div class="card shadow-none border">
      <div class="card-body">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th class="text-center">No</th>
                     @if (auth()->user()->hasRole('Administrator'))
                     <th>ID</th>
                     <th>User ID</th>
                     @endif
                     
                     <th>NIK</th>
                     <th>Name</th>
                     <th>KPI</th>
                     <th>Leader</th>
                     {{-- <th>Phone</th> --}}
                     <th class="text-truncate">Bisnis Unit</th>
                     <th>Department</th>
                     <th>Sub</th>
                     <th  >Posisi</th>
                     {{-- <th>Kontrak/Tetap</th> --}}
                     {{-- <th class="text-right">Action</th> --}}
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th class=""></th>
                     <td @disabled(true) colspan=""></td>
                     <th ></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     {{-- <th></th> --}}
                     {{-- <th></th> --}}
                     {{-- <th class="text-right">Action</th> --}}
                  </tr>
               </tfoot>
               <tbody>
                  @foreach ($employees as $employee)
                  <tr>
                     <td class="text-center">{{++$i}}</td>
                     @if (auth()->user()->hasRole('Administrator'))
                     <td>{{$employee->id}}</td>
                     <td>{{$employee->user_id}}</td>
                     @endif
                     <td class="text-truncate">{{$employee->contract->id_no}}</td>
                     {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                     <td class="text-truncate">
                        <div>
                           <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('basic')])}}"> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a> 
                           {{-- <small class="text-muted">{{$employee->biodata->email}}</small> --}}
                        </div>
                       
                     </td>
                     
                     <td>
                        @if ($employee->kpi_id != null)
                        {{-- <a href="{{route('kpi.edit', enkripRambo($employee->kpi_id))}}">{{$employee->getKpi()->title}}</a> --}}
                            {{-- <span class="text-success">OK</span> --}}
                            <i class="fa fa-check"></i>
                            @else
                            Empty
                        @endif
                        
                     </td>
                     <td>
                        @if (count($employee->getLeaders()) > 0)
                            {{-- OK --}}
                            <i class="fa fa-check"></i>
                            @else
                            Empty
                        @endif
                     </td>
                     {{-- <td>{{$employee->biodata->phone}}</td> --}}
                     
                     <td class="text-truncate">
                        @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->department->unit->id ?? ''}} -
                        @endif
                        {{$employee->department->unit->name ?? ''}}
                        {{-- @if (count($employee->positions) > 0)
                              Multiple
                            @else
                            @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->department->unit->id ?? ''}}
                           @endif
                            {{$employee->department->unit->name ?? ''}}
                        @endif --}}
                        
                     </td>
                     
                     <td>
                        @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->department->id ?? ''}} -
                           @endif
                        {{$employee->department->name ?? ''}}
                        {{-- @if (count($employee->positions) > 0)
                              Multiple
                            @else
                            
                            
                        @endif --}}
                     </td>
                     <td>
                        @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->sub_dept->id ?? ''}} -
                           @endif
                        {{$employee->sub_dept->name ?? ''}}
                        {{-- @if (count($employee->positions) > 0)
                              @foreach ($employee->positions as $pos)
                                  {{$pos->sub_dept->name ?? ''}}
                              @endforeach
                            @else
                            {{$employee->sub_dept->name ?? ''}}
                        @endif --}}
                     </td>
                     {{-- <td>{{$employee->contract->designation->name ?? ''}}</td> --}}
                     <td>
                        @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->position->id ?? ''}} -
                           @endif
                        {{$employee->position->name ?? ''}}
                        {{-- @if (count($employee->positions) > 0)
                              Multiple
                            @else
                            @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->position->id ?? ''}}
                           @endif
                            {{$employee->position->name ?? ''}}
                        @endif --}}
                     </td>
                     {{-- <td>
                        @if ($employee->contract->type == 'Kontrak')
                        <span class="badge badge-info">Kontrak</span>
                        @elseif($employee->contract->type == 'Tetap')
                        <span class="badge badge-info">Tetap</span>
                        @else
                        <span class="badge badge-muted">Empty</span>
                        @endif
      
                     </td> --}}
                  </tr>
                  @endforeach
               </tbody>
               
            </table>
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