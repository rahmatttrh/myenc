{{-- Master Data --}}
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
         <li>
            <a href="{{route('shift')}}">
               <span class="sub-item">Shift</span>
            </a>
         </li>
         {{-- <li>
            <a href="{{route('position')}}">
               <span class="sub-item">Jabatan</span>
            </a>
         </li> --}}
         <li>
            <a href="{{route('so')}}">
               <span class="sub-item">Struktur Organisasi</span>
            </a>
         </li>
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
         {{-- <li>
            <a href="{{route('kpa')}}">
               <span class="sub-item">KPI Apprasial</span>
            </a>
         </li> --}}
         {{-- <li>
            <a href="{{route('kpi')}}">
               <span class="sub-item">Behavior</span>
            </a>
         </li>
         <li>
            <a href="#">
               <span class="sub-item">...</span>
            </a>
         </li> --}}
      </ul>
   </div>
</li>

{{-- QPE --}}
<li class="nav-item">
   <a data-toggle="collapse" href="#qpe">
      <!-- <a  href="{{route('qpe')}}"> -->
      <i class="fas fa-file"></i>
      <p>Quick PE</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="qpe">
      <ul class="nav nav-collapse">
         {{-- <li>
            <a href="{{route('qpe.create')}}">
               <span class="sub-item">Create PE</span>
            </a>
         </li> --}}
         <li>
            <a href="{{route('qpe')}}">
               <span class="sub-item">Daftar PE</span>
            </a>
         </li>
         <li>
            <a href="{{route('qpe.report')}}">
               <span class="sub-item">Monitoring</span>
            </a>
         </li>
      </ul>
   </div>
</li>

{{-- Employee --}}
<li class="nav-item {{ (request()->is('employee/*')) ? 'active' : '' }}">
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
            <a href="{{route('employee.create')}}">
               <span class="sub-item">Create</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.draft')}}">
               <span class="sub-item">Draft</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.export.form')}}">
               <span class="sub-item">Export</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.import')}}">
               <span class="sub-item">Import by Excel</span>
            </a>
         </li>
         <li>
            <a href="{{route('employee.import.edit')}}">
               <span class="sub-item">Update by Excel</span>
            </a>
         </li>

      </ul>
   </div>
</li>

{{-- SP --}}
<li class="nav-item {{ (request()->is('sp/*')) ? 'active' : '' }}">
   <a href="{{route('sp')}}">
      <i class="fas fa-file-code"></i>
      <p>SP</p>
   </a>
</li>

{{-- <li class="nav-item {{ (request()->is('payroll/*')) ? 'active' : '' }}">
   <a data-toggle="collapse" href="#payroll">
      <i class="fas fa-money-bill"></i>
      <p>Payroll</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="payroll">
      <ul class="nav nav-collapse">
         <li>
            <a href="{{route('payroll.transaction')}}">
               <span class="sub-item">Transaction</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll.overtime')}}">
               <span class="sub-item">SPKL</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll.overtime')}}">
               <span class="sub-item">Libur Nasional</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll.setup')}}">
               <span class="sub-item">Setup</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll')}}">
               <span class="sub-item">Employee</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll.unit')}}">
               <span class="sub-item">Bisnis Unit</span>
            </a>
         </li> 
         
         

      </ul>
   </div>
</li> --}}

<li class="nav-item {{ (request()->is('announcement/*')) ? 'active' : '' }}">
   <a href="{{route('announcement')}}">
      <i class="fas fa-money-bill"></i>
      <p>Anouncement</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('task/*')) ? 'active' : '' }}">
   <a href="{{route('task')}}">
      <i class="fas fa-calendar"></i>
      <p>Task</p>
   </a>
</li>

<hr>
<li class="nav-item">
   <a data-toggle="collapse" href="#payroll">
      <i class="fas fa-file"></i>
      <p>Payroll</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="payroll">
      <ul class="nav nav-collapse">
         <li>
            <a href="{{route('payroll.transaction')}}">
               <span class="sub-item">Transaction</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll.overtime')}}">
               <span class="sub-item">SPKL</span>
            </a>
         </li>

         <li>
            <a href="{{route('payroll.absence')}}">
               <span class="sub-item">Absence</span>
            </a>
         </li>

         <li>
            <a href="{{route('payroll.additional')}}">
               <span class="sub-item">Others</span>
            </a>
         </li>
      </ul>
   </div>
</li>

<li class="nav-item {{ (request()->is('payroll/setup/*')) ? 'active' : '' }}">
   <a data-toggle="collapse" href="#setpayroll">
      <i class="fas fa-cog"></i>
      <p>Setup Payroll</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="setpayroll">
      <ul class="nav nav-collapse">
         
         <li>
            <a href="{{route('payroll')}}">
               <span class="sub-item">Gaji Karyawan</span>
            </a>
         </li>
         <li>
            <a href="{{route('payroll.unit')}}">
               <span class="sub-item">Potongan Unit</span>
            </a>
         </li>
         
         

      </ul>
   </div>
</li>