@if($pe->status == 0)
   <span >Draft</span>
   @elseif($pe->status == '1')
   
      @if (auth()->user()->hasRole('Manager'))
      <span >Perlu Diverifikasi</span>
      @else
      <span >Verifikasi Manager</span>
      @endif
   
   @elseif($pe->status == '2')
   <span >Done</span>
   @elseif($pe->status == '3')
   <span >Validasi HRD</span>
   @elseif($pe->status == '101')
   <span >Di Reject Manager</span>
   @elseif($pe->status == '202')
   <span >Need Discuss</span>
   @endif