@extends('layouts.app')
@section('title')
QPE Report
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">QPE Monitoring</li>
        </ol>
    </nav>
    <div class="row">
      <div class="col-md-3">
         <h4>Filter Report</h4>
         <hr>
         <form action="{{route('qpe.report.filter')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Semester</label>
                     <select class="form-control " required name="semester" id="semester">
                        <option value="" disabled selected>Select</option>
                        <option {{$semester == 1 ? 'selected' : ''}} value="1">I</option>
                        <option {{$semester == 2 ? 'selected' : ''}} value="2">II</option>
                     </select>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Tahun</label>
                     <select class="form-control " required name="year" id="year">
                        <option value="" disabled selected>Select</option>
                        <option {{$year == 2024 ? 'selected' : ''}} value="2024">2024</option>
                        <option {{$year == 2025 ? 'selected' : ''}} value="2025">2025</option>
                     </select>
                  </div>  
               </div>
            </div>
            

                
            
            <button class="btn btn-block btn-primary" type="submit">Show</button>
         </form>
      </div>
        <div class="col">
            <div class="card shadow-none border">
                
                
                <div class="card-body p-0">
                  <div class="table-responsive">
                     <table>
                        <thead>
                           <tr>
                              <th rowspan="2">BSU</th>
                              <th rowspan="2" class="text-center">Total Karyawan</th>
                              <th colspan="2" class="text-center">QPE</th>
                              
                           </tr>
                           <tr>
                              
                              <th class="text-center">Complete</th>
                              <th class="text-center">Pending</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($units as $unit)
                               <tr>
                                 <td><a href="{{route('qpe.report.unit', [enkripRambo($unit->id),enkripRambo($semester),enkripRambo($year)])}}">{{$unit->name}}</a></td>
                                 <td class="text-center">{{count($unit->employees)}}</td>
                                 <td class="text-center">{{$unit->getQpe($semester, $year)}}</td>
                                 <td class="text-center"> {{$unit->getEmptyQpe($semester, $year)}}</td>
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
