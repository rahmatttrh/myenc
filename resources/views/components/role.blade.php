@if (auth()->user()->hasRole('HRD-Manager'))
    <span class="badge badge-lights">HRD Manager</span>
@endif

@if (auth()->user()->hasRole('HRD'))
    <span class="badge badge-light">HRD</span>
@endif

@if (auth()->user()->hasRole('HRD-Recruitment'))
    <span class="badge badge-light">HRD Recruitment</span>
@endif

@if (auth()->user()->hasRole('HRD-Payroll'))
    <span class="badge badge-light">HRD Payroll</span>
@endif

@if (auth()->user()->hasRole('HRD-KJ45'))
    <span class="badge badge-light">HRD KJ 45</span>
@endif

{{-- @if (auth()->user()->hasRole('Manager'))
    <span class="badge badge-light">Manager</span>
@endif

@if (auth()->user()->hasRole('Leader'))
    <span class="badge badge-light">Leader</span>
@endif

@if (auth()->user()->hasRole('Karyawan'))
    <span class="badge badge-light">Staff</span>
@endif --}}