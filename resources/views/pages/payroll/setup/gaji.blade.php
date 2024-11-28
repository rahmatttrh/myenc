@extends('layouts.app')
@section('title')
Payroll
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Setup Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Gaji Karyawan</li>
      </ol>
   </nav>
   
   <div class="row">
      <div class="col-md-3">
         <a href="{{route('payroll.import')}}" class="btn text-left btn-light btn-block border mb-2"><i class="fa fa-file" ></i> Import Excel Payroll</a>
         <div class="nav flex-column justify-content-start nav-pills nav-primary"  aria-orientation="vertical">
            @foreach ($units as $unit)
               <a class="nav-link {{$activeUnit->id == $unit->id ? 'active' : ''}} text-left pl-3" href="{{route('payroll.unit.list', enkripRambo($unit->id))}}"  aria-selected="true">
                  
                   {{$unit->name}}
               </a>
            @endforeach
         </div>
      </div>
      <div class="col-md-9">
         {{-- <div class="px-3 mb-2 d-flex justify-content-between">
            <h2></h2>
            <a href="{{route('payroll.import')}}" class="btn btn-sm btn-primary">Import Excel</a>
         </div> --}}
         {{-- <hr> --}}
         <div class="table-responsive">
            <table id="" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     {{-- <th class="text-center">No</th> --}}
                     {{-- @if (auth()->user()->hasRole('Administrator'))
                     <th>ID</th>
                     @endif --}}
                     
                     <th>NIK</th>
                     <th>Name</th>
                     <th>Department</th>
                     {{-- <th class="text-truncate">Bisnis Unit</th> --}}
                     <th>Position</th>
                     <th>Setup Gaji</th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($employees as $employee)
                  <tr>
                     {{-- <td class="text-center">{{++$i}}</td> --}}
                     {{-- @if (auth()->user()->hasRole('Administrator'))
                     <td>{{$employee->id}}</td>
                     @endif --}}
                     <td class="text-truncate">{{$employee->contract->id_no}}</td>
                     {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                     <td class="text-truncate">
                        <div>
                           <a href="{{route('payroll.detail', enkripRambo($employee->id))}}"> {{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a> 
                           {{-- <small class="text-muted">{{$employee->biodata->email}}</small> --}}
                        </div>
                       
                     </td>
                     
                     
                     {{-- <td>{{$employee->biodata->phone}}</td> --}}
                     
                     <td>
                        {{$employee->department->name ?? ''}}
                     </td>
                     
                    
                     
                     <td>
                        @if (count($employee->positions) > 0)
                              {{-- @foreach ($employee->positions as $pos)
                                  {{$pos->name}}
                              @endforeach --}}
                              Multiple
                            @else
                            {{-- @if (auth()->user()->hasRole('Administrator'))
                            {{$employee->position->id ?? ''}}
                           @endif --}}
                            {{$employee->position->name ?? ''}}
                        @endif
                     </td>
                     <td>
                        @if ($employee->payroll_id)
                           Complete
                            @else
                            Empty
                        @endif
                     </td>
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