{{-- Master Data --}}
<li class="nav-item {{ (request()->is('master/*')) ? 'active' : '' }}">
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
         {{-- <li>
            <a href="{{route('department')}}">
               <span class="sub-item">Department</span>
            </a>
         </li> --}}
         <li>
            <a href="{{route('designation')}}">
               <span class="sub-item">Level</span>
            </a>
         </li>
         {{-- <li>
            <a href="{{route('position')}}">
               <span class="sub-item">Jabatan</span>
            </a>
         </li> --}}
         {{-- <li>
            <a href="{{route('so')}}">
               <span class="sub-item">Struktur Organisasi</span>
            </a>
         </li> --}}
      </ul>
   </div>
</li>

{{-- Performance --}}
<li class="nav-item">
   <a data-toggle="collapse" href="#kpi">
      <i class="fas fa-file-contract"></i>
      <p>Performance</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="kpi">
      <ul class="nav nav-collapse">
         
         <li>
            <a href="{{route('discipline')}}">
               <span class="sub-item">Discipline</span>
            </a>
         </li>
      </ul>
   </div>
</li>

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
            <a href="{{route('employee.nonactive')}}">
               <span class="sub-item">Non Active</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.draft')}}">
               <span class="sub-item">Draft</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.create')}}">
               <span class="sub-item">Create</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.draft')}}">
               <span class="sub-item">Import by Excel</span>
            </a>
         </li>

      </ul>
   </div>
</li>
<hr>


{{-- <li class="nav-section">
   <span class="sidebar-mini-icon">
      <i class="fa fa-ellipsis-h"></i>
   </span>
   <h4 class="text-section">Employee</h4>
</li>
<li class="nav-item {{ (request()->is('employee/tab/*')) ? 'active' : '' }}">
   <a href="{{route('employee', enkripRambo('active'))}}">
      <i class="fas fa-users"></i>
      <p>Active</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('employee/nonactive')) ? 'active' : '' }}">
   <a href="{{route('employee.nonactive')}}">
      <i class="fas fa-users"></i>
      <p>Non Active</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('employee/draft')) ? 'active' : '' }}">
   <a href="{{route('employee.draft')}}">
      <i class="fas fa-users"></i>
      <p>Draft</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('employee/import')) ? 'active' : '' }}">
   <a href="{{route('employee.import')}}">
      <i class="fas fa-download"></i>
      <p>Import</p>
   </a>
</li> --}}
{{-- Employee --}}
{{-- <li class="nav-item">
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
            <a href="{{route('employee.nonactive')}}">
               <span class="sub-item">Non Active</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.draft')}}">
               <span class="sub-item">Import</span>
            </a>
         </li>

      </ul>
   </div>
</li> --}}