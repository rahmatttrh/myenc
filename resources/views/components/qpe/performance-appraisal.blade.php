<!-- resources/views/components/performance-appraisal.blade.php -->

<div class="card shadow-none border">
    <div class="card-header d-flex">
        <div class="d-flex  align-items-center">
            <small class="">Performance Apprasial</small>
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
                @if($kpa->pe->status == 0)
                <span class="badge badge-dark badge-lg"><b>Draft</b></span>
                @elseif($kpa->pe->status == '1')
                <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                @elseif($kpa->pe->status == '2')
                <span class="badge badge-success badge-lg"><b>Done</b></span>
                @elseif($kpa->pe->status == '3')
                <span class="badge badge-success badge-lg"><b>Done</b></span>
                @elseif($kpa->pe->status == '101')
                <span class="badge badge-danger badge-lg"><b>Di Reject Manager</b></span>
                <label class="mt-3">Alasan Penolakan</label>
                <span class="text-danger">{{ $kpa->pe->alasan_reject }}</span>
                @elseif($kpa->pe->status == '202')
                <span class="badge badge-warning badge-lg"><b>Need Discuss</b></span>
                <br><br>
                {{$kpa->pe->nd_dibuat}} : <i> {{$kpa->pe->nd_alasan}} </i>
                <br><br>

                Yang di Undang :
                <br>
                @if($kpa->pe->nd_for == '1')
                Team Leader atau Supervisor
                @elseif ($kpa->pe->nd_for == '2')
                Karyawan yang bersangkutan
                @elseif ($kpa->pe->nd_for == '3')
                Karyawan & Atasan Langsung
                @endif


                <br>
                <br><br>
                Tanggal : {{formatDate($kpa->pe->nd_date)}}


                @endif
            </div>
            @if($kpa->pe->complained == '1')
            <div class="form-group form-group-default">
                <label for="" class="text-danger">Karyawan Komplain</label>
                <br>
                [{{formatDate($kpa->pe->complain_date)}}] {{$kpa->employe->biodata->fullName()}} :
                <br>
                {{$kpa->pe->complain_alasan}}
            </div>
            @endif
        </form>
    </div>
    <div class="card-footer">
        <!-- <a href="{{ route('export.qpe', $kpa->pe_id) }}" target="_blank">Export PDF</a> -->
    </div>
</div>