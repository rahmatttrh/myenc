@extends('layouts.app')
@section('title')
Logs Activity
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Log Activity</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-12">
         <div class="card shadow-none border">
            <div class="card-body px-0">
               <div class="table-responsive">
                  <table id="" class="display basic-datatables table-sm  ">
                     <thead>
                        <tr>
                           {{-- <th class="text-center" style="width: 10px">No</th> --}}
                           <th>Timestamp</th>
                           <th>User</th>
                           <th>Action</th>
                           
                           {{-- <th>Desc</th> --}}
                           
                           
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($logs as $log)
                        <tr>
                           {{-- <td class="text-center">{{++$i}}</td> --}}
                           <td class="text-truncate">{{formatDateTimeB($log->created_at)}}</td>
                           <td class="text-truncate">{{$log->user->username}} {{$log->user->name}}</td>
                           <td>
                              @if ($log->action == 'Login')
                                 {{$log->action}} into system
                                  @else
                                  {{$log->action}} {{$log->desc}}
                              @endif
                              
                           </td> 
                           
                           
                           {{-- <td>{{$log->desc}}</td> --}}
                           
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