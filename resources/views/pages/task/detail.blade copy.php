@extends('layouts.app')
@section('title')
Task Create
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Task Create</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-7">
         
         <div class="card">
            <div class="card-header bg-primary text-white p-2">
               <small class="text-uppercase">Task Detail</small>
            </div>
            <div class="card-body p-0">
               <table>
                  <tbody>
                     <tr>
                        <td style="min-width: 150px">Status</td>
                        @if ($task->status == 0)
                           <td class="bg-danger text-light">Open</td>
                           @elseif($task->status == 1)
                           <td class="bg-info text-light">Progress</td>
                           @else
                           <td class="bg-success text-light">Closed</td>
                           
                        @endif
                        
                     </tr>
                     <tr>
                        <td>Kategori</td>
                        <td>{{$task->category}}</td>
                     </tr>
                     <tr>
                        <td>Action Plan</td>
                        <td>{{$task->plan}}</td>
                     </tr>
                     <tr>
                        <td>Target</td>
                        <td>{{formatDate($task->target)}}</td>
                     </tr>
                     <tr>
                        <td>Closed</td>
                        <td>
                           @if ($task->closed)
                           {{formatDate($task->closed)}}
                           @else
                           -
                           @endif
                           </td>
                     </tr>
                     <tr>
                        <td class="d-flex justify-content-between">
                           <span>PIC</span>
                           
                        </td>
                        <td>
                            @if ($task->status != 2)
                            <a href="" data-toggle="modal" data-target="#modal-task-pic">Add New</a>
                            @else

                            -
                            @endif
                           
                           
                        </td>
                     </tr>
                     {{-- <tr>
                        <td class="pl-4"><a href="" data-toggle="modal" data-target="#modal-task-pic">Add New PIC</a></td>
                        <td>-</td>
                     </tr> --}}
                     @foreach ($task->employees()->get() as $emp)
                         <tr>
                           <td>
                           
                           </td>
                           <td>{{$emp->nik}} {{$emp->biodata->fullName()}}</td>
                         </tr>
                     @endforeach
                     @if ($task->status == 2)
                     <tr>
                        <td>Keterangan</td>
                        <td>{{$task->desc}}</td>
                     </tr>
                     @endif
                     
                  </tbody>
               </table>
            </div>
         </div>
         <hr>
         @if ($task->status == 2)
         <img src="{{asset('storage/'. $task->evidence)}}" class="img-fluid" alt="Responsive image">
         @endif
            
         
      </div>
      <div class="col">
         @if ($task->status != 2)
             
         
         <form action="{{route('task.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="number" name="task" id="task" value="{{$task->id}}" hidden>
            <div class="row">
               <div class="col-md-7">
                  <div class="form-group form-group-default">
                     <label>Status</label>
                     <select name="status" id="status" class="form-control" required>
                        <option value="0">Open</option>
                        <option value="1">Progress</option>
                        <option value="2">Closed</option>
                     </select>
                     {{-- <input type="date"  class="form-control" name="target" id="target"> --}}
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input type="date"  class="form-control" name="date" id="date">
                  </div>
               </div>
            </div>

            <div class="form-group form-group-default">
               <label>Keterangan</label>
               <input type="text"  class="form-control" name="desc" id="desc">
            </div>
            <div class="form-group form-group-default">
               <label>Evidence</label>
               <input type="file"  class="form-control" name="evidence" id="evidence">
            </div>
            <hr>
            
            <button type="submit" class="btn  btn-primary">Update</button>
            <a class="btn btn-danger" href="{{route('task.delete', enkripRambo($task->id))}}">Delete</a>
         </form>
         @endif
      </div>
   </div>


   <div class="modal fade" id="modal-task-pic"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Form Add New PIC</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <form action="{{route('task.add.pic')}}" method="POST" >
             <div class="modal-body">
                @csrf
                <input type="number" name="task" id="task" value="{{$task->id}}" hidden>
                <div class="">
                   {{-- <label>New PIC</label> --}}
                   <select class="form-control js-example-basic-single" style="width: 100%"  id="employee" name="employee" >
                      {{-- <option value="" disabled selected>Choose one</option> --}}
                      @foreach ($employees as $emp)
                         <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                      @endforeach
                      {{-- <option value="" selected disabled>Select</option>
                      <option value="Kontrak">Kontrak</option>
                      <option value="Tetap">Tetap</option> --}}
                   </select>
                   @error('type')
                   <small class="text-danger"><i>{{ $message }}</i></small>
                   @enderror
                </div>
                   
                   
 
                 
                   
             </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info ">Add</button>
             </div>
             <div class="modal-body text-start">
                
             </div>
          </form>
       </div>
    </div>
 </div>


@push('myjs')
   <script>
      console.log('get_leaders');
   
      $(document).ready(function() {

         $('.employee').change(function() {
            var employee = $('.employee').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('employee :' + employee);
            
            $.ajax({
               url: "/fetch/leader/" + employee ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.to').html(result.result);

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