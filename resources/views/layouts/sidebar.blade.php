<!-- Sidebar -->
<div class="sidebar">
   <div class="sidebar-wrapper scrollbar-inner">
      <div class="sidebar-content">
         <div class="user">
            <div class="avatar-sm border rounded float-left mr-2">
               @if (auth()->user()->hasRole('Administrator'))
               <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-muted  ">
               @elseif(auth()->user()->hasRole('Karyawan'))
                  @if (auth()->user()->getEmployee()->picture == null)
                  <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-muted  ">
                  @else
                  <img src="{{asset('storage/' . auth()->user()->getEmployee()->picture)}}" alt="..." class="avatar-img bg-muted  ">
                  @endif
               @else
               <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-muted  ">
               @endif


            </div>
            <div class="info">
               <a href="/" aria-expanded="true">
                  <span>
                     {{auth()->user()->name}}
                     @if (auth()->user()->hasRole('Administrator'))
                     <span class="user-level">{{auth()->user()->getRoleName()}}</span>
                     @else
                     <span class="user-level">{{auth()->user()->getEmployee()->designation->name}}</span>
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
            @if (auth()->user()->hasRole('Administrator|HRD'))
               <x-sidebar.administrator />
            @endif

            @if (auth()->user()->hasRole('HRD-Spv'))
               <x-sidebar.hrd-spv />
            @endif
            
            @if (auth()->user()->hasRole('HRD-Recruitment'))
               <x-sidebar.hrd-recruitment />
            @endif

            @if (auth()->user()->hasRole('Manager'))
            <x-sidebar.manager />
            @endif

            @if (auth()->user()->hasRole('Leader|Supervisor'))
               <x-sidebar.leader />
            @endif

            @if (auth()->user()->hasRole('Karyawan'))
               <x-sidebar.employee />
            @endif

           

            {{-- @if (auth()->user()->hasRole('Administrator|HRD|Leader|Supervisor|Manager'))

            

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

            

            <li class="nav-item {{ (request()->is('sp/*')) ? 'active' : '' }}">
               <a href="{{route('sp')}}">
                  <i class="fas fa-file-code"></i>
                  <p>SP</p>
               </a>
            </li>

            @endif --}}


            

            
         </ul>

      </div>
   </div>
</div>
<!-- End Sidebar -->