@extends('layouts.app')
@section('title')
Non ActiveEmployee
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Non Active Employee</li>
      </ol>
   </nav>

   <div class="card shadow-none border">
      <div class="card-header d-flex justify-content-between">
         <h2>List Karyawan Non Active</h2>
         <div>
            <a href="{{route('employee', enkripRambo('active'))}}" class="btn btn-light border btn-sm">Active</a>
            {{-- <a href="{{route('task.create')}}" class="btn btn-primary btn-sm">Add New Task</a> --}}
         </div>
     </div>
      <div class="card-body p-0 pt-3">
         <div class="table-responsive">
            <table id="" class="display basic-datatables table-sm table-bordered  table-striped ">
               <thead>
                  <tr>
                     <th class="text-center">No</th>
                     <th>Name</th>
                     <th>ID</th>
                     <th>Phone</th>
                     <th class="text-truncate">Bisnis Unit</th>
                     <th>Department</th>
                     <th>Level</th>
                     <th>Jabatan</th>
                     <th>Status</th>
                     {{-- <th class="text-right">Action</th> --}}
                  </tr>
               </thead>
               <tfoot>
                  <tr>
                     <th class=""></th>
                     <td @disabled(true)></td>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     <th></th>
                     {{-- <th class="text-right">Action</th> --}}
                  </tr>
               </tfoot>
               <tbody>
                  @foreach ($employees as $employee)
                  <tr>
                     <td class="text-center">{{++$i}}</td>
                     {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                     <td class="text-truncate">
                        <div>
                           <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a>
                           {{-- <small class="text-muted">{{$employee->biodata->email}}</small> --}}
                        </div>
                        {{-- <div class="profile-picture mr-3">
                           @if ($employee->biodata->status == 1)
                           <div class="avatar avatar-sm avatar-online">
                              @else
                              <div class="avatar avatar-sm avatar-offline">
                                 @endif
                                 @if ($employee->picture)
                                 <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                                 @else
                                 <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                                 @endif
                              </div>
                           </div>
                           <div>
                              <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a><br>
                              <small class="text-muted">{{$employee->biodata->email}}</small>
                           </div> --}}
                     </td>
                     <td class="text-truncate">{{$employee->contract->id_no}}</td>
                     <td>{{$employee->biodata->phone}}</td>
                     <td>{{$employee->department->unit->name ?? ''}}</td>
                     <td>{{$employee->department->name ?? ''}}</td>
                     <td>{{$employee->contract->designation->name ?? ''}}</td>
                     <td>{{$employee->position->name}}</td>
                     <td>
                        {{-- @if ($employee->biodata->status == 1)
                        <span class="badge badge-info">Active</span>
                        @else
                        <span class="badge badge-muted">Off</span>
                        @endif --}}

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