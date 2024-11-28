@if ($sp->status == 0)
    <span class="">Draft</span>
    @elseif($sp->status == 1)
    <span class="">Verifikasi HRD</span> 
    @elseif($sp->status == 2)
    <span class="">Konfirmasi User</span>
    @elseif($sp->status == 3)
    <span class="">Approval Manager</span>
    @elseif($sp->status == 4)
    <span class="">Published</span>
    @elseif($sp->status == 5)
    <span class="">Confirmed</span>
    @elseif($sp->status == 606)
    <span class="">Reject Manager</span>
    @elseif($sp->status == 505)
    <span class="">Reject HRD</span>
    @elseif($sp->status == 404)
    <span class="">Reject User</span>

    @elseif($sp->status == 101)
    <span class="">Discussion Proccess</span>
    @elseif($sp->status == 202)
    <span class="">Complain Proccess</span>
@endif