@if ($employee->user->hasRole('HRD-Manager'))
    <span class="badge badge-lights">HRD Manager</span>
@endif

@if ($employee->user->hasRole('HRD'))
    <span class="badge badge-lights">HRD</span>
@endif

@if ($employee->user->hasRole('HRD-Recruitment'))
    <span class="badge badge-light">HRD Recruitment</span>
@endif

@if ($employee->user->hasRole('HRD-Payroll'))
    <span class="badge badge-light">HRD Payroll</span>
@endif
@if ($employee->user->hasRole('HRD-KJ45'))
    <span class="badge badge-light">HRD KJ 4-5</span>
@endif