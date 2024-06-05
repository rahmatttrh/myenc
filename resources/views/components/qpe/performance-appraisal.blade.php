<!-- resources/views/components/performance-appraisal.blade.php -->

<div class="card shadow-none border">
    <div class="card-header d-flex">
        <div class="d-flex  align-items-center">
            <div class="card-title">Give Performance Apprasial</div>
        </div>
    </div>
    <div class="card-body">
        <form>
            @csrf
            <div class="form-group form-group-default">
                <label><b>NIK</b></label>
                {{ $kpa->employe->nik }}
            </div>
            <div class="form-group form-group-default">
                <label><b>Name</b></label>
                {{ $kpa->employe->biodata->fullName() }}
            </div>
            <div class="form-group form-group-default">
                <label><b>Divisi</b></label>
                {{ $kpa->employe->department->name }}
            </div>
            <div class="form-group form-group-default">
                <label>Semester / Tahun</label>
                {{ $kpa->semester }} / {{ $kpa->tahun }}
            </div>
            <div class="form-group form-group-default">
                <label>Status</label>
                @if($kpa->status == 0)
                <span class="badge badge-dark badge-lg"><b>Draft</b></span>
                @elseif($kpa->status == '1')
                <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                @elseif($kpa->status == '2')
                <span class="badge badge-primary badge-lg"><b>Validasi HRD</b></span>
                @elseif($kpa->status == '3')
                <span class="badge badge-success badge-lg"><b>Done</b></span>
                @elseif($kpa->status == '101')
                <span class="badge badge-danger badge-lg"><b>Di Reject Manager</b></span>
                <label class="mt-3">Alasan Penolakan</label>
                <span class="text-danger">{{ $kpa->alasan_reject }}</span>
                @elseif($kpa->status == '202')
                <span class="badge badge-danger badge-lg"><b>Di Reject HRD</b></span>
                @endif
            </div>
        </form>
    </div>
    <div class="card-footer">
        <a href="{{ route('export.kpi') }}" target="_blank">Export PDF</a>
    </div>
</div>