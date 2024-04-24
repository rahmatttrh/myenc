@extends('layouts.app')
@section('title')
Dashboard
@endsection
@section('content')
<div class="page-inner mt--5">
   {{-- <div class="page-header">
      <h4 class="page-title">Dashboard</h4>
   </div> --}}
   <div class="row">
      <div class="col-md-4">
         <div class="card card-profile card-secondary ">
            <div class="card-header" style="background-image: url({{asset('img/blogpost.jpg')}})">
               <div class="profile-picture">
                  <div class="avatar avatar-xl">
                     @if ($employee->picture)
                     <img src="{{asset('storage/' . $employee->picture)}}" alt="..." class="avatar-img rounded-circle">
                     @else
                     <img src="{{asset('img/user.png')}}" alt="..." class="avatar-img rounded-circle">
                     @endif</div>
               </div>
            </div>
            <div class="card-body">
               <div class="user-profile text-center">
                  <div class="name">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</div>
                  <div class="job">{{$employee->position->name}}</div>
                  <div class="desc">15/08/2023 - 15/08/24</div>
                  
               </div>
               @if ($pending != null)
               <a href="" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-out">Out</a>
               @else
               <a href="" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-in">In</a>
               @endif
               
            </div>
            
         </div>
         
         {{-- <div class="badge badge-info">Absensi</div> --}}
         <ol class="activity-feed">
            @foreach ($presences as $presence)
            <li class="feed-item feed-item-info">
               <time class="date" datetime="9-23">{{formatDate($presence->date)}}</time>
               <span class="text">In {{formatTime($presence->in)}} - Out 
                  @if ($presence->out)
                  {{formatTime($presence->out) ?? '-'}}
                  @else
                  -
                  @endif
                  
                  {{-- <a href="#">"Volunteer Opportunity"</a> --}}
               </span>
            </li>
            @endforeach
            
         </ol>
      </div>
      <div class="col-md-8">
         {{-- <div class="alert alert-info">You have 2 Notification !</div> --}}
         <div class="alert alert-info shadow-sm">

            {{-- <div class="card-body"> --}}
               <div class="card-opening">
                  <h4>
                     <img src="{{asset('img/flaticon/promote.png')}}" height="28" alt="" class="mr-1">
                     <b>Announcement</b>
                  </h4>
               </div>
               <hr>
               <div class="card-desc">
                  Tanggal 8 & 9 Februari Libur Nasional dan Cuti Bersama
               </div>
               {{-- <div class="card-detail">
                     <div class="btn btn-light btn-rounded">Download Template</div>
                  </div> --}}
            {{-- </div> --}}
         </div>
         <hr>
         <span class="badge badge-info mb-2">APRIL 2024</span> <span class="badge badge-info mb-2">LEMBUR 5 JAM</span> <br>
         
         @foreach ($dates as $date)
         <div class="btn btn-primary mb-1">{{$date->format('d')}}</div>
         @endforeach

         
         <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
            <thead>
               <tr>
                  <th colspan="3">Recent Request</th>
               </tr>
               <tr>
                  {{-- <th scope="col">#</th> --}}
                  <th scope="col">Type</th>
                  <th scope="col">Date</th>
                  <th scope="col">Status</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  {{-- <td>1</td> --}}
                  <td>SPKL</td>
                  <td>12/03/24</td>
                  <td>Pending</td>
               </tr>
               <tr>
                  {{-- <td>2</td> --}}
                  <td>Cuti</td>
                  <td>09/03/24</td>
                  <td>Approved</td>
               </tr>
               
            </tbody>
         </table>
         {{-- <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
               </tr>
               <tr>
                  <td>2</td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                  <td>@fat</td>
               </tr>
               <tr>
                  <td>3</td>
                  <td colspan="2">Larry the Bird</td>
                  <td>@twitter</td>
               </tr>
            </tbody>
         </table> --}}
         
      </div>
   </div>
</div>

<div class="modal fade" id="modal-in" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kamu sudah tiba dikantor?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.presence.in')}}" method="POST">
         @csrf
         <div class="modal-body">
            <div class="form-group form-group-default">
               <label>Select Location</label>
               <select class="form-control" name="loc" id="loc">
                  <option value="HW">HW</option>
                  <option value="JGC">JGC</option>
                  <option value="KJ">KJ</option>
                  <option value="GS">GS</option>
               </select>
               {{-- <input id="Name" type="text" class="form-control" > --}}
            </div>
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
         </form>
      </div>
   </div>
</div>

@if ($pending != null)
<div class="modal fade" id="modal-out" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Kamu sudah selesai bekerja?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="{{route('employee.presence.out')}}" method="POST">
         @csrf
         @method('PUT')

         <input type="number" id="presence" name="presence" value="{{$pending->id}}" hidden>
         <div class="modal-body">
            <div class="form-group form-group-default">
               <label>Select Location</label>
               <select class="form-control" name="loc" id="loc">
                  <option value="HW">HW</option>
                  <option value="JGC">JGC</option>
                  <option value="KJ">KJ</option>
                  <option value="GS">GS</option>
               </select>
               {{-- <input id="Name" type="text" class="form-control" > --}}
            </div>
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-primary">Submit</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endif

@push('chart-dashboard')
<script>
   $(document).ready(function() {
      var barChart = document.getElementById('barChart').getContext('2d');

      var myBarChart = new Chart(barChart, {
         type: 'bar',
         data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
               label: "Sales",
               backgroundColor: 'rgb(23, 125, 255)',
               borderColor: 'rgb(23, 125, 255)',
               data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            }],
         },
         options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
               yAxes: [{
                  ticks: {
                     beginAtZero: true
                  }
               }]
            },
         }
      });
   })
</script>
@endpush

@endsection