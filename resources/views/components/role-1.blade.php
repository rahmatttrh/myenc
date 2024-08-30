@if ($employee->user->hasRole('Karyawan'))
    Karyawan
    @elseif($employee->user->hasRole('Supervisor'))
    SPV
@endif

@if ($employee->user->hasRole('Supervisor'))
    SPV
@endif

@if ($employee->user->hasRole('Manager'))
   Manager
@endif

@if ($employee->user->hasRole('Ast. Manager'))
    Ast. Manager
@endif


@if ($employee->user->hasRole('Leader'))
    Leader
@endif