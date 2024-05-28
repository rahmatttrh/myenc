@if ($spkl->status == 0)
    <span class="text-muted">Draft</span>
    @elseif($spkl->status == 1)
    <span class="text-muted">Approval SPV</span>
    @elseif($spkl->status == 2)
    <span class="text-muted">Approval Manager</span>
    @elseif($spkl->status == 3)
    <span class="text-muted">Verifikasi HRD</span>
    @elseif($spkl->status == 4)
    <span class="text-muted">Complete</span>
@endif