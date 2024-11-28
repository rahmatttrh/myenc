@extends('layouts.app')
@section('title')
Task List History
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Task List History</li>
      </ol>
   </nav>
   {{-- <a href="{{route('task.create')}}" class="btn btn-primary">Add Task</a>
   <hr> --}}

    <div class="card border shadow-none">
        <div class="card-header d-flex justify-content-between">
            <h2>Task List History</h2>
            <div>
               <a href="{{route('task')}}" class="btn btn-light border btn-sm">Task List</a>
               <a href="{{route('task.create')}}" class="btn btn-primary btn-sm">Add New Task</a>
            </div>
            
        </div>
        <div class="card-body p-0 pt-3">
            @if(auth()->user()->hasRole('Administrator'))
                <div class="table-responsive">
                    <table id="" class="display basic-datatables   table-striped ">
                        <thead>
                        <tr>
                            <th>Kategori</th>
                            <th>Action Plan</th>
                            <th>Target</th>
                            <th>Closed</th>
                            <th>PIC</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    <tbody>
                        @foreach ($tasks->where('status', 2) as $task)
                        <tr>
                        <td class="text-truncate">{{$task->category}}</td>
                        <td>
                            <a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a>
                            {{-- @if ($task->status == 2)
                                            
                                [<small>{{$task->desc}}</small>]
                            @endif --}}
                        </td>
                        <td>{{formatDate($task->target)}}</td>
                        <td>
                            @if ($task->closed)
                            {{formatDate($task->closed)}}
                                @else
                                -
                            @endif
                        </td>
                        <td class="text-truncate">
                            @foreach ($task->employees()->get() as $emp)
                            {{$emp->nik}} 
                            @endforeach
                            
                        </td>
                        @if ($task->status == 0)
                            <td class="bg-danger text-light">Open</td>
                            @elseif($task->status == 1)
                            <td class="bg-info text-light">Progress</td>
                            @else
                            <td class="bg-success text-light" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$task->desc}}">
                              {{-- <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top">
                                 Tooltip on top
                               </button> --}}
                              <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{$task->desc}}">Closed</span>
                            </td>
                            
                        @endif
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                @elseif (auth()->user()->hasRole('Karyawan'))
                
                    <div class="table-responsive">
                        <table id="" class="display basic-datatables   table-striped ">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Kategori</th>
                                <th>Action Plan</th>
                                <th>PIC</th>
                                <th>Target</th>
                                <th>Closed</th>
                                {{-- <th>PIC</th> --}}
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee->tasks()->get()->where('status', 2) as $task)
                                <tr>
                                    <td>{{$task->category}}</td>
                                    <td>
                                        <a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a>
                                        {{-- @if ($task->status == 2)
                                            
                                            [<small>{{$task->desc}}</small>]
                                        @endif --}}
                                    </td>
                                    <td>
                                       @foreach ($task->employees()->get() as $emp)
                                       {{$emp->nik}}
                                       @endforeach
                                       
                                    </td>
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
                                    <td class="bg-success text-light">
                                       
                                       <span >Closed</span>
                                    </td>
                                    
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
                    @else
                    <div class="table-responsive">
                        <table id="" class="display basic-datatables   table-striped ">
                        <thead>
                            <tr>
                                <th>Kategori</th>
                                <th>Action Plan</th>
                                <th>Target</th>
                                <th>Closed</th>
                                <th>PIC</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           

                            @foreach ($myTasks->where('status', 2) as $mTask)
                            <tr>
                                <td>{{$mTask->category}}</td>
                                <td>
                                    <a href="{{route('task.detail', enkripRambo($mTask->id))}}">{{$mTask->plan}}</a>
                                    {{-- @if ($mTask->status == 2)
                                        [<small>{{$mTask->desc}}</small>]
                                    @endif --}}
                                </td>
                                {{-- <td>
                                    @foreach ($task->employees()->get() as $emp)
                                    {{$emp->nik}}
                                    @endforeach
                                    
                                 </td> --}}
                                <td>{{formatDate($mTask->target)}}</td>
                                <td>
                                    @if ($mTask->closed)
                                    {{formatDate($mTask->closed)}}
                                    @else
                                    -
                                    @endif
                                </td>
                                {{-- <td>{{$mTask->employee->nik}} {{$mTask->employee->biodata->fullName()}}</td> --}}
                                <td class="text-truncate">
                                    @foreach ($mTask->employees()->get() as $emp)
                                    {{$emp->nik}} 
                                    @endforeach
                                    
                                </td>
                                @if ($mTask->status == 0)
                                    <td class="bg-danger text-light">Open</td>
                                    @elseif($mTask->status == 1)
                                    <td class="bg-info text-light">Progress</td>
                                    @else
                                    <td class="bg-success text-light">Closed</td>
                                    
                                @endif
                            </tr>
                            @endforeach


                            @foreach ($myteams as $team)
                                @foreach ($tasks->where('status', 2) as $task)
                                
                                    @if ($task->employee_id == $team->id )
                                    <tr>
                                    <td>{{$task->category}}</td>
                                    <td>
                                        <a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a>
                                        @if ($task->status == 2)
                                            [<small>{{$task->desc}}</small>]
                                        @endif
                                    </td>
                                    <td>
                                       @foreach ($task->employees()->get() as $emp)
                                       {{$emp->nik}}
                                       @endforeach
                                       
                                    </td>
                                    <td>{{formatDate($task->target)}}</td>
                                    <td>
                                        @if ($task->closed)
                                        {{formatDate($task->closed)}}
                                            @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-truncate">
                                        @foreach ($task->employees()->get() as $emp)
                                        {{$emp->nik}} 
                                        @endforeach
                                        
                                    </td>
                                    @if ($task->status == 0)
                                        <td class="bg-danger text-light">Open</td>
                                        @elseif($task->status == 1)
                                        <td class="bg-info text-light">Progress</td>
                                        @else
                                        <td class="bg-success text-light">Closed</td>
                                        
                                    @endif
                                    </tr>
                                    @endif
                                    
                                @endforeach
                            @endforeach
                            
                        </tbody>
                        </table>
                    </div>
                
            @endif
        </div>
        <div class="card-footer text-muted">
            <small>Data Task List dapat dilihat oleh atasan untuk tujuan monitoring pekerjaan</small>
        </div>
    </div>
   
   
</div>





@endsection