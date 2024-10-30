{{-- <li class="nav-item">
   <a data-toggle="collapse" href="#qpe">
      <!-- <a  href="{{route('qpe')}}"> -->
      <i class="fas fa-file"></i>
      <p>Quick PE</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="qpe">
      <ul class="nav nav-collapse">
         <li>
            <a href="{{route('qpe')}}">
               <span class="sub-item">PE</span>
            </a>
         </li>
      </ul>
   </div>
</li> --}}
<li class="nav-item {{ (request()->is('employee/detail/*')) ? 'active' : '' }}">
   <a href="{{route('employee.detail', [enkripRambo(auth()->user()->getEmployeeId()), enkripRambo('contract')])}}">
      <i class="fas fa-user"></i>
      <p>My Profile</p>
   </a>
</li>
<hr>
<li class="nav-item {{ (request()->is('qpe')) ? 'active' : '' }}">
   <a href="{{route('qpe')}}">
      <i class="fas fa-file"></i>
      <p>Quick PE</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('task/*')) ? 'active' : '' }}">
   <a href="{{route('task')}}">
      <i class="fas fa-calendar"></i>
      <p>Task</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('employee/spkl/*')) ? 'active' : '' }}">
   <a href="#">
      <i class="fas fa-clock"></i>
      <p>SPKL</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('employee/spkl/*')) ? 'active' : '' }}">
   <a href="#">
      <i class="fas fa-file"></i>
      <p>SP</p>
   </a>
</li>
<hr>
<li class="nav-item {{ (request()->is('pass/reset')) ? 'active' : '' }}">
   <a href="{{ route('pass.reset') }}">
      <i class="fas fa-lock"></i>
      <p>Reset Password</p>
   </a>
</li>

{{-- <li class="nav-item {{ (request()->is('employee/spt/*')) ? 'active' : '' }}">
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
</li> --}}

