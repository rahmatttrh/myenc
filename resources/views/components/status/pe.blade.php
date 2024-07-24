@if($pe->status == 0)
<span class="badge badge-dark badge-lg"><b>Draft</b></span>
@elseif($pe->status == '1')

      @if (auth()->user()->hasRole('Manager'))
      <span class="badge badge-warning badge-lg"><b>Perlu Diverifikasi</b></span>
      @else
      <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
      @endif

@elseif($pe->status == '2')
<span class="badge badge-success badge-lg"><b>Done</b></span>
@elseif($pe->status == '3')
<span class="badge badge-primary badge-lg"><b>Validasi HRD</b></span>
@elseif($pe->status == '101')
<span class="badge badge-danger badge-lg"><b>Di Reject Manager</b></span>
@elseif($pe->status == '202')
<span class="badge badge-warning badge-lg"><b>Need Discuss</b></span>
@endif