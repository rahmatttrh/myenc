<!-- Sidebar -->
<div class="sidebar">
   <div class="sidebar-wrapper scrollbar-inner">
      <div class="sidebar-content">
         <div class="user">
            <div class="avatar-sm border rounded float-left mr-2">
               @if (auth()->user()->hasRole('Administrator'))
               <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-muted  ">
               @else
               @if (auth()->user()->getEmployee()->picture == null)
               <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-muted  ">
               @else
               <img src="{{asset('storage/' . auth()->user()->getEmployee()->picture)}}" alt="..." class="avatar-img bg-muted  ">
               @endif
               @endif


            </div>
            <div class="info">
               <a href="/" aria-expanded="true">
                  <span>
                     {{auth()->user()->name}}
                     @if (auth()->user()->hasRole('Administrator'))
                     <span class="user-level">{{auth()->user()->getRoleName()}}</span>
                     @else
                     <span class="user-level">{{auth()->user()->getEmployee()->position->name}}</span>
                     @endif
                  </span>
               </a>
            </div>
         </div>

         <ul class="nav">

            <li class="nav-item {{ (request()->is('/')) ? 'active' : '' }}">
               <a href="/">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
               </a>
            </li>

            <li class="nav-section">
               <span class="sidebar-mini-icon">
                  <i class="fa fa-ellipsis-h"></i>
               </span>
               <h4 class="text-section">Main Menu</h4>
            </li>

            @if (auth()->user()->hasRole('Karyawan'))

            <li class="nav-item {{ (request()->is('employee/spkl/*')) ? 'active' : '' }}">
               <a href="{{route('employee.spkl')}}">
                  <i class="fas fa-clock"></i>
                  <p>SPKL</p>
               </a>
            </li>

            <li class="nav-item {{ (request()->is('employee/spt/*')) ? 'active' : '' }}">
               <a href="{{route('employee.spt')}}">
                  <i class="fas fa-briefcase"></i>
                  <p>SPT</p>
               </a>
            </li>

            <li class="nav-item">
               <a href="{{route('employee.detail', [enkripRambo(auth()->user()->employee->id), enkripRambo('contract')])}}">
                  <i class="fas fa-calendar"></i>
                  <p>Cuti</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('employee.detail', [enkripRambo(auth()->user()->employee->id), enkripRambo('contract')])}}">
                  <i class="fas fa-hospital"></i>
                  <p>Permit</p>
               </a>
            </li>
            @endif

            @if (auth()->user()->hasRole('Manager'))
            <li class="nav-item {{ (request()->is('employee/detail/*')) ? 'active' : '' }}">
               <a href="{{route('employee.detail', [enkripRambo(auth()->user()->employee->id), enkripRambo('contract')])}}">
                  <i class="fas fa-user"></i>
                  <p>My Profile</p>
               </a>
            </li>
            <li class="nav-item {{ (request()->is('employee/spkl/*')) ? 'active' : '' }}">
               <a href="{{route('manager.spkl')}}">
                  <i class="fas fa-clock"></i>
                  <p>SPKL</p>
               </a>
            </li>

            <li class="nav-item {{ (request()->is('employee/spt/*')) ? 'active' : '' }}">
               <a href="{{route('employee.spt')}}">
                  <i class="fas fa-briefcase"></i>
                  <p>SPT</p>
               </a>
            </li>

            <li class="nav-item">
               <a href="{{route('employee.detail', [enkripRambo(auth()->user()->employee->id), enkripRambo('contract')])}}">
                  <i class="fas fa-calendar"></i>
                  <p>Cuti</p>
               </a>
            </li>
            <li class="nav-item">
               <a href="{{route('employee.detail', [enkripRambo(auth()->user()->employee->id), enkripRambo('contract')])}}">
                  <i class="fas fa-hospital"></i>
                  <p>Permit</p>
               </a>
            </li>
            @endif

            @if (auth()->user()->hasRole('Supervisor') || auth()->user()->hasRole('Leader'))

            <li class="nav-item {{ (request()->is('supervisor/spkl/*')) ? 'active' : '' }}">
               <a href="{{route('supervisor.spkl')}}">
                  <i class="fas fa-clock"></i>
                  <p>SPKL</p>
               </a>
            </li>

            <li class="nav-item {{ (request()->is('employee/spt/*')) ? 'active' : '' }}">
               <a href="{{route('employee.spt')}}">
                  <i class="fas fa-briefcase"></i>
                  <p>SPT</p>
               </a>
            </li>
            <li class="nav-item {{ (request()->is('sp/*')) ? 'active' : '' }}">
               <a href="{{route('sp')}}">
                  <i class="fas fa-file-code"></i>
                  <p>SP</p>
               </a>
            </li>

            @endif

            @if (auth()->user()->hasRole('Administrator|HRD|Leader|Supervisor|Manager'))

            <!-- Master Data -->
            @if (auth()->user()->hasRole('Administrator|HRD'))
            <li class="nav-item">
               <a data-toggle="collapse" href="#vessel">
                  <i class="fas fa-server"></i>
                  <p>Master Data</p>
                  <span class="caret"></span>
               </a>
               <div class="collapse" id="vessel">
                  <ul class="nav nav-collapse">
                     <li>
                        <a href="{{route('unit')}}">
                           <span class="sub-item">Bisnis Unit</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('department')}}">
                           <span class="sub-item">Department</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('designation')}}">
                           <span class="sub-item">Level</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('position')}}">
                           <span class="sub-item">Jabatan</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('so')}}">
                           <span class="sub-item">Struktur Organisasi</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <!-- End Master Data -->
            @endif

            <li class="nav-item">
               <a data-toggle="collapse" href="#kpi">
                  <i class="fas fa-file-contract"></i>
                  <p>Performance</p>
                  <span class="caret"></span>
               </a>
               <div class="collapse" id="kpi">
                  <ul class="nav nav-collapse">
                     @if (auth()->user()->hasRole('Administrator|HRD'))
                     <li>
                        <a href="{{route('pe.component')}}">
                           <span class="sub-item">Component</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('discipline')}}">
                           <span class="sub-item">Discipline</span>
                        </a>
                     </li>
                     @endif
                     <li>
                        <a href="{{route('kpi')}}">
                           <span class="sub-item">KPI</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('kpa')}}">
                           <span class="sub-item">KPI Apprasial</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('kpi')}}">
                           <span class="sub-item">Behavior</span>
                        </a>
                     </li>
                     <li>
                        <a href="#">
                           <span class="sub-item">...</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li class="nav-item">
               <a data-toggle="collapse" href="#qpe">
                  <!-- <a  href="{{route('qpe')}}"> -->
                  <i class="fas fa-file"></i>
                  <p>Quick PE</p>
                  <span class="caret"></span>
               </a>
               <div class="collapse" id="qpe">
                  <ul class="nav nav-collapse">
                     <li>
                        <a href="{{route('qpe.create')}}">
                           <span class="sub-item">Create PE</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('qpe')}}">
                           <span class="sub-item">Daftar PE</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>

            @if (auth()->user()->hasRole('Administrator|HRD'))
            <li class="nav-item">
               <a data-toggle="collapse" href="#employee">
                  <i class="fas fa-users"></i>
                  <p>Employee</p>
                  <span class="caret"></span>
               </a>
               <div class="collapse" id="employee">
                  <ul class="nav nav-collapse">
                     <li>
                        <a href="{{route('employee', enkripRambo('active'))}}">
                           <span class="sub-item">Active</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{route('employee.draft')}}">
                           <span class="sub-item">Import</span>
                        </a>
                     </li>

                  </ul>
               </div>
            </li>
            @endif

            <li class="nav-item {{ (request()->is('sp/*')) ? 'active' : '' }}">
               <a href="{{route('sp')}}">
                  <i class="fas fa-file-code"></i>
                  <p>SP</p>
               </a>
            </li>
            @endif
         </ul>

      </div>
   </div>
</div>
<!-- End Sidebar -->