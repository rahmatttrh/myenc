@if ($employee->designation_id == 1)
    Staff
    @elseif ($employee->designation_id == 2)
    Staff
    @elseif ($employee->designation_id == 3)
    Team Leader
    @elseif ($employee->designation_id == 4)
    Supervisor
    @elseif ($employee->designation_id == 5)
    Asst. Manager
    @elseif ($employee->designation_id == 6)
    Manager
@endif

