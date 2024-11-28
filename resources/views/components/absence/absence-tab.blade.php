<div>
    <!-- resources/views/components/tab-absence.blade.php -->

    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'payroll.absence' ? ' active' : '' }}" href="{{ route('payroll.absence') }}">List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'payroll.absence.create' ? ' active' : '' }}" href="{{ route('payroll.absence.create') }}">Create</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'payroll.absence.import' ? ' active' : '' }}" href="{{ route('payroll.absence.import') }}">Import</a>
        </li>
        
    </ul>

</div>