@if ($sp->status == 0)
    <span class="text-muted">Draft</span>
    @elseif($sp->status == 1)
    <span class="text-muted">Verifikasi HRD</span> 
    @elseif($sp->status == 2)
    <span class="text-muted">Konfirmasi User</span>
    @elseif($sp->status == 3)
    <span class="text-muted">Approval Manager</span>
    @elseif($sp->status == 4)
    <span class="text-muted">Published</span>
    @elseif($sp->status == 5)
    <span class="text-muted">Confirmed</span>
    @elseif($sp->status == 5)
    <span class="text-muted">Reject</span>

    @elseif($sp->status == 101)
    <span class="text-muted">Discussion Proccess</span>
    @elseif($sp->status == 202)
    <span class="text-muted">Complain Proccess</span>
@endif