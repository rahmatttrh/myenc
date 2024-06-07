@if ($sp->status == 0)
    <span class="text-muted">Draft</span>
    @elseif($sp->status == 1)
    <span class="text-muted">Approval Manager</span>
    @elseif($sp->status == 2)
    <span class="text-muted">Approval HRD</span>
    @elseif($sp->status == 3)
    <span class="text-muted">Published</span>
    @elseif($sp->status == 4)
    <span class="text-muted">Received</span>
@endif