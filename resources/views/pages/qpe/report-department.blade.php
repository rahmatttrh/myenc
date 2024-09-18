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
      <div class="col-md-6">
         <div class="card shadow-none border">
            {{-- <div class="card-header">
               <h2>{{$unit->name}}</h2>
            </div> --}}
            <div class="card-body p-0">
               <div class="table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th colspan="" class="text-uppercase">{{$department->unit->name}}</th>
                           <th colspan="" class="text-uppercase ">Semester 
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
                           <th >{{$department->name}}</th>
                           
                           
                        </tr>
                        <tr>
                           <th >Total Employee</th>
                           <th >{{count($department->employees)}}</th>
                           
                        </tr>
                        
                        
                        
                     </thead>
                  </table>
               </div>
            </div>
            </div>
      </div>
      <div class="col-md-6">
         <div class="card shadow-none border">
            {{-- <div class="card-header">
               <h2>{{$unit->name}}</h2>
            </div> --}}
            <div class="card-body p-0">
               <div class="table-responsive">
                  <table>
                     <thead>
                        <tr>
                           <th class="text-center">Draft</th>
                           <th class="text-center">Verifikasi</th>
                           <th class="text-center">Done</th>
                           <th class="text-center">Empty</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td class="text-center">{{$department->getQpe($semester, $year, 0)}}</td>
                           <td class="text-center">{{$department->getQpe($semester, $year, 1)}}</td>
                           <td class="text-center">{{$department->getQpe($semester, $year, 2)}}</td>
                           <td class="text-center">{{$department->getEmptyQpe($semester, $year)}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
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
                           <th colspan="2"> QPE Draft</th>
                           {{-- <th>{{$department->getQpe($semester, $year, 0)}}</th> --}}
                        </tr>
                        
                       
                     </thead>
                     <tbody>
                       
                        @foreach ($department->getCompleteQpe($semester, $year) as $pen)
                            @if ($pen->getQpe($semester, $year)->status == '0')
                            
                        
                               <tr>
                                  {{-- <td>{{$pen->nik}}</td> --}}
                                  <td><a href="/qpe/edit/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}">{{$pen->nik}} {{$pen->biodata->fullName()}}</a> </td>
                                  {{-- <td>
                                     @if($pen->getQpe($semester, $year)->status == '0' || $pen->getQpe($semester, $year)->status == '101')
                                     <a href="/qpe/edit/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @elseif($pen->getQpe($semester, $year)->status == '1' || $pen->getQpe($semester, $year)->status == '202' )
                                     <a href="/qpe/approval/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @else
                                     <a href="/qpe/show/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @endif
                                  </td> --}}
                               </tr>
                           @endif
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
                           <th colspan="2"> QPE Verifikasi</th>
                           {{-- <th>{{$department->getQpe($semester, $year, 0)}}</th> --}}
                        </tr>
                        
                        
                     </thead>
                     <tbody>
                       
                        @foreach ($department->getCompleteQpe($semester, $year) as $pen)
                            @if ($pen->getQpe($semester, $year)->status == '1')
                            
                        
                               <tr>
                                  <td><a href="/qpe/approval/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}">{{$pen->nik}} {{$pen->biodata->fullName()}}</a> </td>
                                  {{-- <td>{{$pen->biodata->fullName()}}</td>
                                  <td>
                                     @if($pen->getQpe($semester, $year)->status == '0' || $pen->getQpe($semester, $year)->status == '101')
                                     <a href="/qpe/edit/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @elseif($pen->getQpe($semester, $year)->status == '1' || $pen->getQpe($semester, $year)->status == '202' )
                                     <a href="/qpe/approval/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @else
                                     <a href="/qpe/show/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @endif
                                  </td> --}}
                               </tr>
                           @endif
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
                           <th colspan=""> QPE Done</th>
                           {{-- <th>{{$department->getQpe($semester, $year, 2)}}</th> --}}
                        </tr>
                        
                        
                     </thead>
                     <tbody>
                       
                        @foreach ($department->getCompleteQpe($semester, $year) as $pen)
                            @if ($pen->getQpe($semester, $year)->status == '2')
                            
                        
                               <tr>
                                  <td><a href="/qpe/show/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}">{{$pen->nik}} {{$pen->biodata->fullName()}}</a> </td>
                                  {{-- <td></td>
                                  <td>
                                     @if($pen->getQpe($semester, $year)->status == '0' || $pen->getQpe($semester, $year)->status == '101')
                                     <a href="/qpe/edit/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @elseif($pen->getQpe($semester, $year)->status == '1' || $pen->getQpe($semester, $year)->status == '202' )
                                     <a href="/qpe/approval/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @else
                                     <a href="/qpe/show/{{enkripRambo($pen->getQpe($semester, $year)->kpa->id)}}"><x-status.qpe-plain :pe="$pen->getQpe($semester, $year)" />  </a>
                                     @endif
                                  </td> --}}
                               </tr>
                           @endif
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
                           {{-- <th class="bg-danger">{{$department->getEmptyQpe($semester, $year)}}</th> --}}
                        </tr>
                        
                        {{-- <tr>
                           <th class="">NIK</th>
                           <th class="">Employee</th>
                        </tr> --}}
                     </thead>
                     <tbody>
                        {{-- <tr>
                           <td>{{$department->getPendingQpe($semester, $year)}}</td>
                        </tr> --}}
                        @foreach ($department->getPendingQpe($semester, $year) as $pen)
                           <tr>
                              <td>{{$pen->nik}} {{$pen->biodata->fullName()}}</td>
                              {{-- <td></td> --}}
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
