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
                              <th colspan="4" class="text-uppercase">{{$unit->name}}</th>
                           </tr>
                           <tr>
                              <th colspan="4" class="text-uppercase">Semester 
                                 @if ($semester == 1)
                                     I
                                     @else
                                     II
                                 @endif
                                 {{$year}}</th>
                           </tr>
                           <tr>
                              <th rowspan="2">Department</th>
                              <th rowspan="2" class="text-center">Total Karyawan</th>
                              <th colspan="2" class="text-center">QPE</th>
                              
                           </tr>
                           <tr>
                              
                              <th class="text-center">Complete</th>
                              <th class="text-center">Pending</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($unit->departments as $depart)
                               <tr>
                                 <td><a href="{{route('qpe.report.department', [enkripRambo($depart->id),enkripRambo($semester),enkripRambo($year)])}}">{{$depart->name}}</a></td>
                                 <td class="text-center">{{count($depart->employees)}}</td>
                                 <td class="text-center">{{$depart->getQpe($semester, $year)}}</td>
                                 <td class="text-center"> {{$depart->getEmptyQpe($semester, $year)}}</td>
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
