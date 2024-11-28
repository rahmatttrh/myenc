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

    <div class="card border shadow-none">
        <div class="card-header d-flex justify-content-between">
            <h2>Task List</h2>
            <div>
               <a href="{{route('task.history')}}" class="btn btn-light border btn-sm">History</a>
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
                            @foreach ($tasks->where('status', '!=', 2) as $task)
                            <tr>
                                <td class="text-truncate">
                                    {{$task->category}}
                                    {{-- {{$task->newMessage()}} --}}
                                    @if ($task->newMessage() == 1)
                                        <i class="fa fa-bell text-info"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a>
                                    
                                    
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @elseif (auth()->user()->hasRole('Karyawan'))
                
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
                                @foreach ($employee->tasks()->get()->where('status', '!=', 2) as $task)
                                    <tr>
                                        <td>{{$task->category}}

                                            @if ($task->newMessage() == 1)
                                                <i class="fa fa-bell text-info"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('task.detail', enkripRambo($task->id))}}">{{$task->plan}}</a>
                                            @if ($task->status == 2)
                                                
                                                [<small>{{$task->desc}}</small>]
                                            @endif
                                        </td>
                                        
                                        <td>{{formatDate($task->target)}}</td>
                                        <td>
                                        @if ($task->closed)
                                        {{formatDate($task->closed)}}
                                            @else
                                            -
                                        @endif
                                        </td>
                                        <td>
                                            @foreach ($task->employees()->get() as $emp)
                                            {{$emp->nik}}
                                            @endforeach
                                            
                                        </td>
                                        {{-- <td>{{$task->employee->nik}}</td> --}}
                                        @if ($task->status == 0)
                                        <td class="bg-danger text-light">Open</td>
                                        @elseif($task->status == 1)
                                        <td class="bg-info text-light">Progress</td>
                                        @else
                                        <td class="bg-success text-light">Closed</td>
                                        
                                        @endif
                                       
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
                            
                            @foreach ($myTasks->where('status', '!=', 2) as $mTask)
                            <tr>
                                <td>{{$mTask->category}}
                                    @if ($mTask->newMessage() == 1)
                                        <i class="fa fa-bell text-info"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('task.detail', enkripRambo($mTask->id))}}">{{$mTask->plan}}</a>
                                    {{-- @if ($mTask->status == 2)
                                        [<small>{{$mTask->desc}}</small>]
                                    @endif --}}
                                </td>
                                
                                <td>{{formatDate($mTask->target)}}</td>
                                <td>
                                    @if ($mTask->closed)
                                    {{formatDate($mTask->closed)}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
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
                                @foreach ($tasks->where('status', '!=', 2) as $task)
                                
                                    @if ($task->employee_id == $team->id )
                                    <tr>
                                    <td>{{$task->category}}
                                        @if ($task->newMessage() == 1)
                                            <i class="fa fa-bell text-info"></i>
                                        @endif
                                    </td>
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
                                    <td>
                                        @foreach ($task->employees()->get() as $emp)
                                        {{$emp->nik}}
                                        @endforeach
                                        
                                     </td>
                                    {{-- <td>{{$task->employee->nik}} {{$task->employee->biodata->fullName()}}</td> --}}
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