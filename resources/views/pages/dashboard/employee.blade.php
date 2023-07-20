
@extends('layouts.app')
@section('title')
      Dashboard
@endsection
@section('content')
   <div class="page-inner mt--5">
      <div class="page-header">
         <h4 class="page-title">Dashboard</h4>
      </div>
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
                        @endif
                        {{-- <img src="{{asset('img/profile.jpg')}}" alt="..." class="avatar-img rounded-circle"> --}}
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="user-profile text-center">
                     <div class="name">{{$employee->biodata->first_name}} {{$employee->biodata->last_name}}</div>
                     <div class="job">{{$employee->contract->designation->name}} {{$employee->contract->department->name}}</div>
                     <div class="desc">{{$employee->bio ?? 'Bio..'}}</div>
                     <div class="social-media">
                        <a class="btn btn-info btn-twitter btn-sm btn-link" href="#"> 
                           <span class="btn-label just-icon"><i class="flaticon-twitter"></i> </span>
                        </a>
                        <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                           <span class="btn-label just-icon"><i class="flaticon-google-plus"></i> </span> 
                        </a>
                        <a class="btn btn-primary btn-sm btn-link" rel="publisher" href="#"> 
                           <span class="btn-label just-icon"><i class="flaticon-facebook"></i> </span> 
                        </a>
                        <a class="btn btn-danger btn-sm btn-link" rel="publisher" href="#"> 
                           <span class="btn-label just-icon"><i class="flaticon-dribbble"></i> </span> 
                        </a>
                     </div>
                     <div class="view-profile">
                        <a href="{{route('employee.detail', [enkripRambo($employee->id), enkripRambo('contract')])}}" class="btn btn-secondary btn-block">View Full Profile</a>
                     </div>
                  </div>
               </div>
               <div class="card-footer">
                  <div class="row user-stats text-center">
                     <div class="col">
                        <div class="number">2</div>
                        <div class="title">Sisa Cuti</div>
                     </div>
                     <div class="col">
                        <div class="number">5</div>
                        <div class="title">Terlambat</div>
                     </div>
                     <div class="col">
                        <div class="number">1</div>
                        <div class="title">Absen</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="alert alert-info">You have 2 Notification !</div>
            <div class="card card-light">
               
               <div class="card-body">
                  <div class="card-opening">
                     <h2>
                        <img src="{{asset('img/flaticon/promote.png')}}" height="40" alt="" class="mr-1">
                        <b>Announcement</b>
                     </h2>
                  </div>
                  <hr>
                  <div class="card-desc">
                     Lorem, ipsum dolor sit amet consectetur adipisicing elit. Incidunt provident ipsum
                     similique dignissimos! <br>
                     Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim et, voluptatibus possimus doloribus, nisi magnam voluptas dolore debitis, eligendi laboriosam commodi ea fugiat!
                  </div>
                  {{-- <div class="card-detail">
                     <div class="btn btn-light btn-rounded">Download Template</div>
                  </div> --}}
               </div>
            </div>
            <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
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
            </table>
            <div class="card shadow-none border">
               <div class="card-header">
                  <div class="card-title">Feed Activity</div>
               </div>
               <div class="card-body">
                  <ol class="activity-feed">
                     <li class="feed-item feed-item-secondary">
                        <time class="date" datetime="9-25">Sep 25</time>
                        <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                     </li>
                     <li class="feed-item feed-item-success">
                        <time class="date" datetime="9-24">Sep 24</time>
                        <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                     </li>
                     <li class="feed-item feed-item-info">
                        <time class="date" datetime="9-23">Sep 23</time>
                        <span class="text">Joined the group <a href="single-group.php">"Boardsmanship
                              Forum"</a></span>
                     </li>
                     <li class="feed-item feed-item-warning">
                        <time class="date" datetime="9-21">Sep 21</time>
                        <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                     </li>
                     <li class="feed-item feed-item-danger">
                        <time class="date" datetime="9-18">Sep 18</time>
                        <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                     </li>
                     <li class="feed-item">
                        <time class="date" datetime="9-17">Sep 17</time>
                        <span class="text">Attending the event <a href="single-event.php">"Some New
                              Event"</a></span>
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
   </div>

   @push('chart-dashboard')
   <script>
       $(document).ready(function() {
         var barChart = document.getElementById('barChart').getContext('2d');

         var myBarChart = new Chart(barChart, {
            type: 'bar',
            data: {
               labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
               datasets : [{
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
                        beginAtZero:true
                     }
                  }]
               },
            }
         });
      })
   </script>
   @endpush
   
@endsection