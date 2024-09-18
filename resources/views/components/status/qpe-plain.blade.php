@if($pe->status == 0)
   <span class="text-muted" >Draft</span>
   @elseif($pe->status == '1')
   
      @if (auth()->user()->hasRole('Manager'))
      <span class="text-info">Perlu Diverifikasi</span>
      @else
      <span class="text-primary">Verifikasi</span>
      @endif
   
   @elseif($pe->status == '2')
   <span class="text-success" >Done</span>
   @elseif($pe->status == '3')
   <span >Validasi HRD</span>
   @elseif($pe->status == '101')
   <span >Di Reject Manager</span>
   @elseif($pe->status == '202')
   <span >Need Discuss</span>
   @endif