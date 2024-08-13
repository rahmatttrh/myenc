@extends('layouts.app')
@section('title')
SP
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Surat Peringatan</li>
      </ol>
   </nav>

   <div class="row">
      @if (auth()->user()->hasRole('Administrator'))
         @elseif(auth()->user()->hasRole('HRD-Manager'))
         <div class="col-md-4">
            <h4>Form Pengajuan SP dari HRD</h4>
            <hr>
            <form action="{{route('sp.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               {{-- <div class="form-group form-group-default">
                  <label>Type</label>
                  <select class="form-control" required id="level" name="level">
                     <option value="" selected disabled>Choose one</option>
                     <option value="Excisting">Excisting</option>
                     <option value="New">New</option>
                  </select>

               </div> --}}
               <div class="row">
                  <div class="col-md-8">
                     <div class="form-group form-group-default">
                        <label>Employee*</label>
                        <select class="form-control employee" required id="employee" name="employee">
                           <option value="" selected disabled>Select Employee</option>
                           @if (auth()->user()->hasRole('Manager|Asst. Manager|HRD'))
                              @foreach ($employee->positions as $pos)
                                 @foreach ($pos->department->employees as $emp)
                                 <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                                 @endforeach
                              @endforeach
                                 {{-- @foreach ($employees as $emp)
                                 <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                                 @endforeach --}}
                              @elseif(auth()->user()->hasRole('HRD') || auth()->user()->hasRole('HRD-Spv'))
                                 @foreach ($allEmployees as $emp)
                                    <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                                 @endforeach
                              @else 
                                 @foreach ($employees as $emp)
                                    <option value="{{$emp->employee->id}}">{{$emp->employee->nik}} {{$emp->employee->biodata->fullName()}} </option>
                                 @endforeach
                           @endif
                           
                        </select>
                        
         
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Level*</label>
                        <select class="form-control" required id="level" name="level">
                           <option value="" selected disabled>Select level</option>
                           <option value="I">SP I</option>
                           <option value="II">SP II</option>
                           <option value="III">SP III</option>
                        </select>

                     </div>
                  </div>
                  
               </div>

            
               <div class="form-group form-group-default">
                  <label>Alasan*</label>
                  <input type="text" required class="form-control" name="reason" id="reason">
               </div>

               <div class="form-group form-group-default">
                  <label>Kronologi*</label>
                  <textarea class="form-control" required name="desc" id="desc" rows="4"></textarea>
               </div>
               <div class="form-group form-group-default">
                  <label>File attachment</label>
                  <input type="file" class="form-control" name="file" id="file">
               </div>
               <hr>
               <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </form>
         </div>
         @else
         <div class="col-md-4">
            <h4>Form Pengajuan SP</h4>
            <hr>
            <form action="{{route('sp.store')}}" method="POST" enctype="multipart/form-data">
               @csrf
               
               <div class="row">
                  <div class="col-md-8">
                     <div class="form-group form-group-default">
                        <label>Employee*</label>
                        <select class="form-control employee" required id="employee" name="employee">
                           <option value="" selected disabled>Select Employee</option>
                           @if (auth()->user()->hasRole('Manager|Asst. Manager|HRD'))
                              @foreach ($employee->positions as $pos)
                                 @foreach ($pos->department->employees as $emp)
                                 <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                                 @endforeach
                              @endforeach
                                 {{-- @foreach ($employees as $emp)
                                 <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                                 @endforeach --}}
                              @elseif(auth()->user()->hasRole('HRD') || auth()->user()->hasRole('HRD-Spv'))
                                 @foreach ($allEmployees as $emp)
                                    <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                                 @endforeach
                              @else 
                                 @foreach ($employees as $emp)
                                    <option value="{{$emp->employee->id}}">{{$emp->employee->nik}} {{$emp->employee->biodata->fullName()}} </option>
                                 @endforeach
                           @endif
                           
                        </select>
                        
         
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group form-group-default">
                        <label>Level*</label>
                        <select class="form-control" required id="level" name="level">
                           <option value="" selected disabled>Select level</option>
                           <option value="I">SP I</option>
                           <option value="II">SP II</option>
                           <option value="III">SP III</option>
                        </select>

                     </div>
                  </div>
                  
               </div>

            
               <div class="form-group form-group-default">
                  <label>Alasan*</label>
                  <input type="text" required class="form-control" name="reason" id="reason">
               </div>

               <div class="form-group form-group-default">
                  <label>Kronologi*</label>
                  <textarea class="form-control" required name="desc" id="desc" rows="4"></textarea>
               </div>
               <div class="form-group form-group-default">
                  <label>File attachment</label>
                  <input type="file" class="form-control" name="file" id="file">
               </div>
               <hr>
               <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </form>
         </div>
      @endif

      @if (auth()->user()->hasRole('Administrator'))
      <div class="col-md-12">
         @else
      <div class="col-md-8">
      @endif
         <div class=" sp px-3">
            <table>
               {{-- <thead>
                  <tr>
                     <th colspan="5">SP Aktif</th>
                  </tr>
               </thead> --}}
               <tbody class="result">

               </tbody>
            </table>
            <hr >
         </div>
         

         <div class="table-responsive">
            <table id="" class="display basic-datatables table-sm table-bordered  table-striped ">
               <thead>
                  <tr>
                     <th class="text-center" style="width: 10px">No</th>
                     <th>ID</th>
                     <th>Name</th>
                     {{-- <th>NIK</th> --}}
                     
                     <th>Level</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($sps as $sp)
                  <tr>
                     <td class="text-center">{{++$i}}</td>
                     <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a> </td>
                     <td>{{$sp->employee->nik}} {{$sp->employee->biodata->fullName()}}</td>
                     {{-- <td>{{$sp->employee->nik}}</td> --}}
                     {{-- <td>{{formatDate($sp->date)}}</td> --}}
                     <td>SP {{$sp->level}}</td>
                     <td>
                        <x-status.sp :sp="$sp" />
                     </td>
                     
                     {{-- <td class="text-truncate" style="max-width: 240px">{{$sp->desc}}</td> --}}

                  </tr>


                  @endforeach
               </tbody>
            </table>
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