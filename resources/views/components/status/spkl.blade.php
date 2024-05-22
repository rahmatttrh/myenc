@if ($spkl->status == 0)
    <span class="text-muted">Draft</span>
    @elseif($spkl->status == 1)
    <span class="text-muted">Approval SPV/Manager</span>
@endif