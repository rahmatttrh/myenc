@extends('layouts.app')
@section('title')
Task List
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Task List</li>
      </ol>
   </nav>
   {{-- <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>
   <hr> --}}

   @if (auth()->user()->hasRole('Karyawan'))
      <div class="row">
         <div class="col-md-3">
            <h4>Create New task</h4>
            <hr>
            <form action="{{route('task.store')}}" method="POST">
               @csrf
               <div class="form-group form-group-default">
                  <label>Kategori</label>
                  <input type="text"  class="form-control" name="kategori" id="kategori">
               </div>
               <div class="form-group form-group-default">
                  <label>Action Plan</label>
                  <textarea   class="form-control" name="plan" id="plan" rows="5"></textarea>
               </div>
               <div class="form-group form-group-default">
                  <label>Target</label>
                  <input type="date"  class="form-control" name="target" id="target">
               </div>
               <hr>
               <button type="submit" class="btn  btn-primary">Submit</button>

            
            </form>
         </div>
         <div class="col">
            <div class="table-responsive">
               <table id="" class="display basic-datatables   table-striped ">
                  <thead>
                     <tr>
                        {{-- <th>ID</th> --}}
                        <th>Kategori</th>
                        <th>Action Plan</th>
                        <th>Target</th>
                        <th>Closed</th>
                        {{-- <th>PIC</th> --}}
                        <th>Status</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($tasks as $task)
                        <tr>
                           <td>{{$task->category}}</td>
                           <td><a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a></td>
                           <td>{{formatDate($task->target)}}</td>
                           <td>
                              @if ($task->closed)
                              {{formatDate($task->closed)}}
                                 @else
                                 -
                              @endif
                           </td>
                           {{-- <td>{{$task->employee->nik}}</td> --}}
                           @if ($task->status == 0)
                              <td class="bg-danger text-light">Open</td>
                              @elseif($task->status == 1)
                              <td class="bg-info text-light">Progress</td>
                              @else
                              <td class="bg-success text-light">Closed</td>
                              
                           @endif
                           {{-- <td>{{$task->desc ?? '-'}}</td>
                           <td>
                              @if ($task->evidence)
                                 Open
                                 @else
                                 -
                              @endif
                           </td> --}}
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
       @else
       <div class="table-responsive">
         <table id="" class="display basic-datatables   table-striped ">
            <thead>
               <tr>
                  {{-- <th>ID</th> --}}
                  <th>Kategori</th>
                  <th>Action Plan</th>
                  <th>Target</th>
                  <th>Closed</th>
                  <th>PIC</th>
                  <th>Status</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($myteams as $team)
                  @foreach ($tasks as $task)
                     @if ($task->employee_id == $team->id)
                     <tr>
                        <td>{{$task->category}}</td>
                        <td><a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a></td>
                        <td>{{formatDate($task->target)}}</td>
                        <td>
                           @if ($task->closed)
                           {{formatDate($task->closed)}}
                              @else
                              -
                           @endif
                        </td>
                        <td>{{$task->employee->nik}} {{$task->employee->biodata->fullName()}}</td>
                        @if ($task->status == 0)
                           <td class="bg-danger text-light">Open</td>
                           @elseif($task->status == 1)
                           <td class="bg-info text-light">Progress</td>
                           @else
                           <td class="bg-success text-light">Closed</td>
                           
                        @endif
                        {{-- <td>{{$task->desc ?? '-'}}</td>
                        <td>
                           @if ($task->evidence)
                              Open
                              @else
                              -
                           @endif
                        </td> --}}
                     </tr>
                     @endif
                     
                  @endforeach
               @endforeach
               
            </tbody>
         </table>
      </div>
   @endif
   
   
</div>





@endsection