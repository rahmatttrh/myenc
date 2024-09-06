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
            <li class="breadcrumb-item active" aria-current="page">Unit</li>
        </ol>
    </nav>
    <div class="row">
      
        <div class="col-md-3">
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
                           </tr>
                           <tr>
                              <th colspan="2" class="text-uppercase">Semester 
                                 @if ($semester == 1)
                                     I
                                     @else
                                     II
                                 @endif
                                 {{$year}}</th>
                           </tr>

                           <tr>
                              <th >Department</th>
                              <th class="text-center">{{$department->name}}</th>
                              
                           </tr>
                           <tr>
                              <th >Total Employee</th>
                              <th class="text-center">{{count($department->employees)}}</th>
                              
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
                           <th colspan="2"> QPE Complete</th>
                           <th>{{$department->getQpe($semester, $year)}}</th>
                        </tr>
                        
                        <tr>
                           <th class="">NIK</th>
                           <th class="">Employee</th>
                           <th>QPE</th>
                        </tr>
                     </thead>
                     <tbody>
                        {{-- <tr>
                           <td>{{$department->getPendingQpe($semester, $year)}}</td>
                        </tr> --}}
                        @foreach ($department->getCompleteQpe($semester, $year) as $pen)
                           <tr>
                              <td>{{$pen->nik}}</td>
                              <td>{{$pen->biodata->fullName()}}</td>
                              <td>
                                 @if($pen->getQpe($semester, $year)->status == '0' || $pen->getQpe($semester, $year)->status == '101')
                                 <a href="/qpe/edit/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}">{{$pen->getQpe($semester, $year)->employe->nik}}  </a>
                                 @elseif($pen->getQpe($semester, $year)->status == '1' || $pen->getQpe($semester, $year)->status == '202' )
                                 <a href="/qpe/approval/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}">{{$pen->getQpe($semester, $year)->employe->nik}}  </a>
                                 @else
                                 <a href="/qpe/show/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}">{{$pen->getQpe($semester, $year)->employe->nik}}  </a>
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
         <div class="col-md-4">
            <div class="card shadow-none border">
               {{-- <div class="card-header">
                  <h2>{{$unit->name}}</h2>
               </div> --}}
               <div class="card-body p-0">
                  <div class="table-responsive">
                     <table>
                        <thead>
                           <tr>
                              <th colspan="" class="bg-danger" >QPE Pending</th>
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
