@extends('layouts.app')
   @section('title')
      Employee Draft
   @endsection
@section('content')
   
   <div class="page-inner">
      {{-- <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Employee Draft</li>
         </ol>
      </nav> --}}
      <div class="page-header">
         <h5 class="page-title">Employee Draft</h5>
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
               <a href="#">Employee Draft</a>
            </li>
            {{-- <li class="separator">
               <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
               <a href="#">Draft</a>
            </li> --}}
         </ul>
         <div class="ml-auto">
            <button class="btn btn-light border btn-round " data-toggle="dropdown">
               <i class="fa fa-ellipsis-h"></i>
            </button>
            <div class="dropdown-menu">
   
   
               <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
               {{-- <a class="dropdown-item" style="text-decoration: none"  data-toggle="modal" data-target="#modal-export">Export</a> --}}
               <div class="dropdown-divider"></div>
               {{-- <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a> --}}
            </div>
         </div>
      </div>
      
      <form action="{{route('employee.publish')}}" method="post" >
         @csrf
         @error('id_item')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
         @enderror
         <div class="card ">
            {{-- <div class="card-header"> 
               <div class="card-title">Draft</div>
            </div>  --}}
            <div class="card-body">
               <div class="d-inline-flex align-items-center">
                  <button type="submit" name="submit" class="btn btn-sm btn-primary mr-3">Publish</button>
                  <div class="d-inline-flex align-items-center">
                        <span class="badge badge-muted badge-counter">
                           <span id="total">0</span>
                        </span>
                  </div>
               </div>
               <hr>
               <div class="table-responsive">
                  <table id="multi-filter-select" class="display basic-datatables table-sm table-striped " >
                     <thead>
                        <tr>
                           <th>&nbsp; <input type="checkbox" id="selectall" /></th>
                           {{-- <th>No</th> --}}
                           <th>ID</th>
                           <th>Name</th>
                           
                           <th>Email</th>
                           <th>Unit</th>
                           <th>Department</th>
                           {{-- <th>Designation</th> --}}
                           <th>Status</th>
                           {{-- <th class="text-right">Action</th> --}}
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($employees as $employee)
                           <tr>
                              <td class="text-center"><input type="checkbox" class="case" name="id_item[]" value="{{$employee->id}}" /> </td>
                              {{-- <td>{{++$i}}</td> --}}
                              {{-- <td><a href="{{route('employee.detail', enkripRambo($employee->id))}}">{{$employee->name}}</a> </td> --}}
                              <td>{{$employee->contract->id_no}}</td>
                              <td >
                                 <div class="text-nowrap">
                                    <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</a><br>
                                    {{-- <small class="text-muted">{{$employee->biodata->email}}</small> --}}
                                 </div>
                                       
                                    {{-- <div class="info-user ml-3">
                                       <div class="username">Jimmy Denis</div>
                                       <div class="status">Graphic Designer</div>
                                    </div> --}}
                              </td>
                              
                              <td>{{$employee->biodata->email}}</td>
                              <td>{{$employee->contract->unit->name ?? ''}}</td>
                              <td>{{$employee->contract->department->name ?? ''}}</td>
                              {{-- <td>{{$employee->contract->designation->name ?? ''}}</td> --}}
                              <td>
                                 OFF
                                 {{-- <span class="badge badge-muted">Off</span> --}}
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               
            </div>
         </div>
      </form>
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