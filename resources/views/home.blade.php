
@extends('layouts.app')
@section('title')
      Dashboard
@endsection
@section('content')
   <div class="page-inner mt--5">
      <div class="page-header">
         <h4 class="page-title">Dashboard Office</h4>
      </div>
      <div class="row">
         <div class="col-sm-6 col-md-3">
            <a href="" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Vessel">
               <div class="card card-stats card-round">
                  <div class="card-body ">
                        <div class="row align-items-center">
                           <div class="col-icon">
                              <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fa fa-ship"></i>
                              </div>
                           </div>
                           <div class="col col-stats ml-3 ml-sm-0">
                              <div class="numbers">
                                    <p class="card-category">Menu 1</p>
                                    <h4 class="card-title">3</h4>
                              </div>
                           </div>
                        </div>
                  </div>
               </div>
            </a>
         </div>
         <div class="col-sm-6 col-md-3">
               <a href="#" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Office">
                  <div class="card card-stats card-round">
                     <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col-icon">
                                 <div class="icon-big text-center icon-primary bubble-shadow-small">
                                       <i class="fa fa-building"></i>
                                 </div>
                              </div>
                              <div class="col col-stats ml-3 ml-sm-0">
                                 <div class="numbers">
                                       <p class="card-category">Menu 2</p>
                                       <h4 class="card-title">3</h4>
                                 </div>
                              </div>
                           </div>
                     </div>
                  </div>
               </a>
         </div>
         <div class="col-sm-6 col-md-3">
               <a href="" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Material">
                  <div class="card card-stats card-round">
                     <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col-icon">
                                 <div class="icon-big text-center icon-primary bubble-shadow-small">
                                       <i class="fa fa-swatchbook"></i>
                                 </div>
                              </div>
                              <div class="col col-stats ml-3 ml-sm-0">
                                 <div class="numbers">
                                       <p class="card-category">Menu 3</p>
                                       <h4 class="card-title">6</h4>
                                 </div>
                              </div>
                           </div>
                     </div>
                  </div>
               </a>
         </div>
         <div class="col-sm-6 col-md-3">
               <a href="#" style="text-decoration: none" data-toggle="tooltip" data-placement="top" title="Total Material Request">
                  <div class="card card-stats card-round">
                     <div class="card-body">
                           <div class="row align-items-center">
                              <div class="col-icon">
                                 <div class="icon-big text-center icon-primary bubble-shadow-small">
                                       <i class="fa fa-newspaper"></i>
                                 </div>
                              </div>
                              <div class="col col-stats ml-3 ml-sm-0">
                                 <div class="numbers">
                                       <p class="card-category">Menu 4</p>
                                       <h4 class="card-title">5</h4>
                                 </div>
                              </div>
                           </div>
                     </div>
                  </div>
               </a>
         </div>
      </div>
      <div class="row">
         <div class="col-md-8">
            <div class="card">
               <div class="card-header">
                  <div class="card-head-row">
                     <div class="card-title">Support Tickets</div>
                     <div class="card-tools">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                           role="tablist">
                           <li class="nav-item">
                              <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today"
                                 role="tab" aria-selected="true">Today</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link active" id="pills-week" data-toggle="pill" href="#pills-week"
                                 role="tab" aria-selected="false">Week</a>
                           </li>
                           <li class="nav-item">
                              <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month"
                                 role="tab" aria-selected="false">Month</a>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex">
                     <div class="avatar avatar-online">
                        <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                     </div>
                     <div class="flex-1 ml-3 pt-1">
                        <h5 class="text-uppercase fw-bold mb-1">Joko Subianto <span
                              class="text-warning pl-3">pending</span></h5>
                        <span class="text-muted">I am facing some trouble with my viewport. When i start
                           my</span>
                     </div>
                     <div class="float-right pt-1">
                        <small class="text-muted">8:40 PM</small>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="d-flex">
                     <div class="avatar avatar-offline">
                        <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                     </div>
                     <div class="flex-1 ml-3 pt-1">
                        <h5 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span
                              class="text-success pl-3">open</span></h5>
                        <span class="text-muted">I have some query regarding the license issue.</span>
                     </div>
                     <div class="float-right pt-1">
                        <small class="text-muted">1 Day Ago</small>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="d-flex">
                     <div class="avatar avatar-away">
                        <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                     </div>
                     <div class="flex-1 ml-3 pt-1">
                        <h5 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span
                              class="text-muted pl-3">closed</span></h5>
                        <span class="text-muted">Is there any update plan for RTL version near future?</span>
                     </div>
                     <div class="float-right pt-1">
                        <small class="text-muted">2 Days Ago</small>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="d-flex">
                     <div class="avatar avatar-offline">
                        <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                     </div>
                     <div class="flex-1 ml-3 pt-1">
                        <h5 class="text-uppercase fw-bold mb-1">Peter Parker <span
                              class="text-success pl-3">open</span></h5>
                        <span class="text-muted">I have some query regarding the license issue.</span>
                     </div>
                     <div class="float-right pt-1">
                        <small class="text-muted">2 Day Ago</small>
                     </div>
                  </div>
                  <div class="separator-dashed"></div>
                  <div class="d-flex">
                     <div class="avatar avatar-away">
                        <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                     </div>
                     <div class="flex-1 ml-3 pt-1">
                        <h5 class="text-uppercase fw-bold mb-1">Logan Paul <span
                              class="text-muted pl-3">closed</span></h5>
                        <span class="text-muted">Is there any update plan for RTL version near future?</span>
                     </div>
                     <div class="float-right pt-1">
                        <small class="text-muted">2 Days Ago</small>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-4">
            <div class="card card-secondary">
               <div class="card-header">
                  <div class="card-title">Daily Sales</div>
                  <div class="card-category">March 25 - April 02</div>
               </div>
               <div class="card-body pb-0">
                  <div class="mb-4 mt-2">
                     <h1>$4,578.58</h1>
                  </div>
                  <div class="pull-in">
                     <canvas id="dailySalesChart"></canvas>
                  </div>
               </div>
            </div>
            <div class="card card-info bg-info-gradient">
               <div class="card-body">
                  <h4 class="mb-1 fw-bold">Tasks Progress</h4>
                  <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection