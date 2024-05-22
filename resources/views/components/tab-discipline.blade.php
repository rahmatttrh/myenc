<div>
    <!-- resources/views/components/tab-discipline.blade.php -->

    <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'discipline.import' ? ' active' : '' }}" href="{{ route('discipline.import') }}">Import</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'discipline.draft' ? ' active' : '' }}" href="{{ route('discipline.draft') }}">Draft</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'discipline' ? ' active' : '' }}" href="{{ route('discipline') }}">List</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $activeTab === 'monitoring' ? ' active' : '' }}" href="{{ route('discipline.monitoring') }}">Monitoring</a>
        </li>
    </ul>

</div>