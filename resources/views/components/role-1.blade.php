@if ($employee->user->hasRole('Karyawan'))
    Karyawan
    
@endif

@if ($employee->user->hasRole('Leader'))
    Leader
    
    @endif

    @if($employee->user->hasRole('Supervisor'))
    SPV
    
    @endif

    @if ($employee->user->hasRole('Manager'))
    Manager
    
     @endif

     @if ($employee->user->hasRole('Asst. Manager'))
     Asst. Manager
     
     @endif

     @if ($employee->user->hasRole('BOD'))
     BOD
     
     @endif


     {{-- @if
     Empty --}}

