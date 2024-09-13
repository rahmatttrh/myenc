@extends('layouts.app')
@section('title')
QPE Report
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('qpe.report')}}">QPE Monitoring</a></li>
            <li class="breadcrumb-item " aria-current="page">{{$department->unit->name}}</li>
            <li class="breadcrumb-item active" aria-current="page">{{$department->name}}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
           <div class="card shadow-none border">
              {{-- <div class="card-header">
                 <h2>{{$unit->name}}</h2>
              </div> --}}
              <div class="card-body p-0">
                 <div class="table-responsive">
                    <table>
                       <thead>
                          <tr>
                             <th colspan="2" class="text-uppercase">{{$department->unit->name}}</th>
                             <th colspan="2" class="text-uppercase text-right">Semester 
                                @if ($semester == 1)
                                   I
                                   @else
                                   II
                                @endif
                                {{$year}}
                             </th>
                          </tr>
                          

                          <tr>
                             <th >Department</th>
                             <th class="text-center">{{$department->name}}</th>
                             <th class="text-right">QPE Empty</th>
                             <th class="text-center">{{$department->getEmptyQpe($semester, $year)}}</th>
                             
                          </tr>
                          <tr>
                             <th >Total Employee</th>
                             <th class="text-center">{{count($department->employees)}}</th>
                             <th class="text-right" >QPE Created</th>
                             <th class="text-center">{{$department->getQpe($semester, $year)}}</th>
                          </tr>
                          {{-- <tr>
                             <th >QPE Complete</th>
                             <th class="text-center">{{$department->getQpe($semester, $year)}}</th>
                             
                          </tr>
                          <tr>
                             <th >QPE Pending</th>
                             <th class="text-center">{{$department->getEmptyQpe($semester, $year)}}</th>
                             
                          </tr> --}}
                          
                          
                       </thead>
                       <tbody>
                          
                       </tbody>
                    </table>
                 </div>
              </div>
           </div>

           
        </div>
        <div class="col-md-8">
           <div class="card shadow-none border">
              {{-- <div class="card-header">
                 <h2>{{$unit->name}}</h2>
              </div> --}}
              <div class="card-body p-0">
                 <div class="table-responsive">
                    <table>
                       <thead>
                          <tr>
                             <th colspan="2"> QPE Created</th>
                             <th>{{$department->getQpe($semester, $year)}}</th>
                          </tr>
                          
                          <tr>
                             {{-- <th>#</th> --}}
                             <th class="">NIK</th>
                             <th class="">Employee</th>
                             <th>Status</th>
                          </tr>
                       </thead>
                       <tbody>
                          {{-- <tr>
                             <td>{{$department->getPendingQpe($semester, $year)}}</td>
                          </tr> --}}
                          {{-- @php
                              $i = 0;
                          @endphp --}}
                          {{-- @foreach ($department->getPendingQpe($semester, $year) as $pen)
                             <tr>
                                <td>{{$pen->nik}}</td>
                                <td>{{$pen->biodata->fullName()}}</td>
                                <td>Empty</td>
                             </tr>
                          @endforeach --}}
                          @foreach ($department->getCompleteQpe($semester, $year) as $pen)
                             <tr>
                                <td>{{$pen->nik}}</td>
                                <td>{{$pen->biodata->fullName()}}</td>
                                <td>
                                   @if($pen->getQpe($semester, $year)->status == '0' || $pen->getQpe($semester, $year)->status == '101')
                                   <a href="/qpe/edit/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                   @elseif($pen->getQpe($semester, $year)->status == '1' || $pen->getQpe($semester, $year)->status == '202' )
                                   <a href="/qpe/approval/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                   @else
                                   <a href="/qpe/show/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
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
        <div class="col">
           <div class="card shadow-none border">
              {{-- <div class="card-header">
                 <h2>{{$unit->name}}</h2>
              </div> --}}
              <div class="card-body p-0">
                 <div class="table-responsive">
                    <table>
                       <thead>
                          <tr>
                             <th colspan="" class="bg-danger" >QPE Empty</th>
                             <th class="bg-danger">{{$department->getEmptyQpe($semester, $year)}}</th>
                          </tr>
                          
                          <tr>
                             <th class="">NIK</th>
                             <th class="">Employee</th>
                          </tr>
                       </thead>
                       <tbody>
                          {{-- <tr>
                             <td>{{$department->getPendingQpe($semester, $year)}}</td>
                          </tr> --}}
                          @foreach ($department->getPendingQpe($semester, $year) as $pen)
                             <tr>
                                <td>{{$pen->nik}}</td>
                                <td>{{$pen->biodata->fullName()}}</td>
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

@endsection
