{{-- <div class="main-header bg-primary"> --}}
   <div class="main-header" data-background-color="blue">
      <!-- Logo Header -->
      <div class="logo-header  " >
         <a href="/" class="logo " >
            {{-- <img src="{{asset('img/ENC.jpg')}}" alt="navbar brand" class="navbar-brand"> --}}
            <span class="navbar-brand text-white font-weight-bold font-italic">MY ENC  </span>
         </a>
         <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
               <i class="fa fa-bars"></i>
            </span>
         </button>
         <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
         <div class="navbar-minimize">
            <button class="btn btn-minimize btn-rounded">
               <i class="fa fa-bars"></i>
            </button>
         </div>
      </div>
      <!-- End Logo Header -->

      <!-- Navbar Header -->
      <nav class="navbar navbar-header navbar-expand-lg">
         <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
               <li class="nav-item toggle-nav-search hidden-caret">
                  <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                        <i class="fa fa-search"></i>
                  </a>
               </li>

            

               <li class="nav-item dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                     <div class="avatar-sm">
                        {{-- <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-light rounded"> --}}
                        @if (auth()->user()->getEmployee()->picture == null)
                        <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-light rounded">
                        @else
                        <img src="{{asset('storage/' . auth()->user()->getEmployee()->picture)}}" alt="..." class="avatar-img bg-light rounded">
                        @endif
                     </div>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                           <div class="user-box">
                              <div class="avatar-lg border rounded">
                                 {{-- <img src="{{asset('img/businessman.png')}}" alt="image profile" class="avatar-img bg-muted"> --}}
                                 @if (auth()->user()->getEmployee()->picture == null)
                                 <img src="{{asset('img/businessman.png')}}" alt="..." class="avatar-img bg-muted  ">
                                 @else
                                 <img src="{{asset('storage/' . auth()->user()->getEmployee()->picture)}}" alt="..." class="avatar-img bg-muted  ">
                                 @endif
                              </div>
                              
                              <div class="u-text">
                                    <h4>{{auth()->user()->name}}</h4>
                                    {{-- <small class="text-muted">{{auth()->user()->getRoleName()}}</small> --}}
                                    <small class="text-muted">{{auth()->user()->email}}</small>
                                    {{-- <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a> --}}
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="dropdown-divider"></div>
                           
                           {{-- <div class="dropdown-divider"></div> --}}
                           @if (auth()->user()->hasRole('Karyawan'))
                           <a class="dropdown-item" href="{{route('employee.detail', [enkripRambo(auth()->user()->employee->id), enkripRambo('contract')])}}">
                              My Profile
                           </a>
                           @endif
                           
                           
                           @if (Route::has('password.request'))
                              <a class="dropdown-item" href="{{ route('password.request') }}">
                                    Reset Password
                              </a>
                           @endif
                           
                           {{-- <a class="dropdown-item" href="{{route('change.password')}}">Change Password</a> --}}
                           <div class="dropdown-divider"></div>
                           <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                              <i class="fa fa-sign-out-alt" ></i> Logout
                           </a>

                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                           </form>
                        </li>
                  </ul>
               </li>
               
            </ul>
         </div>
      </nav>
      <!-- End Navbar -->
   </div>