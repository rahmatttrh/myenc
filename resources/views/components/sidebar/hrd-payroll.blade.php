
<li class="nav-item {{ (request()->is('payroll/transaction/*')) ? 'active' : '' }}">
   <a href="{{route('payroll.transaction')}}">
      <i class="fas fa-money-bill"></i>
      <p>Transaction</p>
   </a>
</li>
<li class="nav-item {{ (request()->is('payroll/overtime/*')) ? 'active' : '' }}">
   <a href="{{route('payroll.overtime')}}">
      <i class="fas fa-file-signature"></i>
      <p>SPKL</p>
   </a>
</li>

<li class="nav-item {{ (request()->is('payroll/absence/*')) ? 'active' : '' }}">
   <a href="{{route('payroll.absence')}}">
      <i class="fas fa-file-signature"></i>
      <p>Absence</p>
   </a>
</li>

<li class="nav-item {{ (request()->is('payroll/report/*')) ? 'active' : '' }}">
   <a href="{{route('payroll.report')}}">
      <i class="fas fa-search-plus"></i>
      <p>Report</p>
   </a>
</li>

<li class="nav-item {{ (request()->is('payroll/setup/*')) ? 'active' : '' }}">
   <a data-toggle="collapse" href="#payroll">
      <i class="fas fa-cog"></i>
      <p>Setup Payroll</p>
      <span class="caret"></span>
   </a>
   <div class="collapse" id="payroll">
      <ul class="nav nav-collapse">
         {{-- <li>
            <a href="{{route('payroll.transaction')}}">
               <span class="sub-item">Transaction</span>
            </a>
         </li> --}}
         {{-- <li>
            <a href="{{route('payroll.overtime')}}">
               <span class="sub-item">SPKL</span>
            </a>
         </li> --}}
         <li>
            <a href="{{route('holiday')}}">
               <span class="sub-item">Libur Nasional</span>
            </a>
         </li>
         {{-- <li>
            <a href="{{route('payroll.setup')}}">
               <span class="sub-item">Setup</span>
            </a>
         </li> --}}
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