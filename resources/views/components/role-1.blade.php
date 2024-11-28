@if ($employee->user->hasRole('Karyawan'))
    Karyawan
    @elseif ($employee->user->hasRole('Leader'))
    Leader
    @elseif($employee->user->hasRole('Supervisor'))
    SPV
    @elseif ($employee->user->hasRole('Manager'))
   Manager
   @elseif ($employee->user->hasRole('Asst. Manager'))
    Asst. Manager
    @else
    Empty
@endif

