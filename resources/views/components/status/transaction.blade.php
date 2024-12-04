@if ($trans->status == 0)
    <span class="">Draft</span>
    @elseif($trans->status == 1)
    <span class="">Approval </span> 
    @elseif($trans->status == 2)
    <span class="">Approval </span>
    @elseif($trans->status == 3)
    <span class="">Approval </span>
    @elseif($trans->status == 4)
    <span class="">Approval </span>

    @elseif($trans->status == 5)
    <span class="">Complete</span>
    @elseif($trans->status == 6)
    <span class="">Publish</span>
@endif