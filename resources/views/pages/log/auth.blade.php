@extends('layouts.app')
@section('title')
Logs Activity
@endsection
@section('content')

<div class="page-inner">
   <div class="page-header d-flex">

      <h5 class="page-title">Logs Activity</h5>
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
            <a href="#">Logs Activity</a>
         </li>
      </ul>
      <div class="ml-auto">
         <button class="btn btn-light border btn-round " data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu">


            {{-- <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a> --}}
            <a class="dropdown-item" style="text-decoration: none" data-toggle="modal" data-target="#modal-export">Export</a>
            <div class="dropdown-divider"></div>
            {{-- <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a> --}}
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body px-0">
               <div class="table-responsive">
                  <table id="" class="display basic-datatables table-sm  ">
                     <thead>
                        <tr>
                           <th class="text-center" style="width: 10px">No</th>
                           <th>Action</th>
                           <th>NIK</th>
                           <th>Name</th>
                           
                           {{-- <th>Desc</th> --}}
                           
                           <th>Timestamp</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($logs as $log)
                        <tr>
                           <td class="text-center">{{++$i}}</td>
                           <td>{{$log->action}} into system</td>
                           <td>{{$log->user->username}}</td>
                           <td>{{$log->user->name}}</td>
                           
                           {{-- <td>{{$log->desc}}</td> --}}
                           <td>{{formatDateTime($log->created_at)}}</td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@push('myjs')
   <script>
      console.log('get_aktif_sp');
      $(".sp").hide();
   

      $(document).ready(function() {
         $('.employee').change(function() {
            
            var employee = $('#employee').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('employeeId:' + employee);
            
            $.ajax({
               url: "/fetch/sp/active/" + employee ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  // console.log('near :' + result.near);
                  // console.log('result :' + result.result);
                  
                  console.log('status :' + result.success);
                  if (result.success == true) {
                     $('.result').empty()
                     console.log('adaaa');
                     $(".sp").show();
                  } else {
                     $('.result').empty()
                     console.log('kosong');
                     $(".sp").hide();
                  }
                  

                  $.each(result.result, function(i, index) {
                     $('.result').html(result.result);

                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })
      })
   </script>
@endpush



@endsection