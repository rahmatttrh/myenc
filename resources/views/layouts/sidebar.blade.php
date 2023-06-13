<!-- Sidebar -->
   <div class="sidebar">
      {{-- <div class="sidebar-background"></div> --}}
      <div class="sidebar-wrapper scrollbar-inner">
         <div class="sidebar-content">
            <div class="user">
               <div class="avatar-sm float-left mr-2">
                  <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-info rounded">
               </div>
               <div class="info">
                  <a  href="/" aria-expanded="true">
                     <span>
                        Admin
                        <span class="user-level">Administrator</span>
                     </span>
                  </a>
               </div>
            </div>
            <ul class="nav">
               <li class="nav-item">
                  <a data-toggle="collapse" href="#vessel">
                     <i class="fas fa-server"></i>
                     <p>Master Data</p>
                     <span class="caret"></span>
                  </a>
                  <div class="collapse" id="vessel">
                     <ul class="nav nav-collapse">
                        <li>
                           <a href="{{route('department')}}">
                              <span class="sub-item">Department</span>
                           </a>
                        </li>
                        <li>
                           <a href="{{route('designation')}}">
                              <span class="sub-item">Designation</span>
                           </a>
                        </li>
                        <li>
                           <a href="#">
                              <span class="sub-item">Shift</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </li>

               <li class="nav-section">
                  <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                  </span>
                  <h4 class="text-section">Main Menu</h4>
               </li>
               <li class="nav-item">
                  <a href="{{route('employee', enkripRambo('active'))}}">
                     <i class="fas fa-burn"></i>
                     <p>Employee</p>
                  </a>
               </li>
               {{-- <li class="nav-item">
                  <a data-toggle="collapse" href="#pms">
                     <i class="fas fa-desktop"></i>
                     <p>Employee</p>
                     <span class="caret"></span>
                  </a>
                  <div class="collapse" id="pms">
                     <ul class="nav nav-collapse">
                        <li>
                           <a href="{{route('employee')}}">
                              <span class="sub-item">Active</span>
                           </a>
                        </li>
                        <li>
                           <a href="{{route('employee.draft')}}">
                              <span class="sub-item">Draft</span>
                           </a>
                        </li>
                     </ul>
                  </div>
               </li>
               <li class="nav-item">
                  <a href="#">
                     <i class="fas fa-burn"></i>
                     <p>Example</p>
                  </a>
               </li> --}}

              
            </ul>
         </div>
      </div>
   </div>
    <!-- End Sidebar -->