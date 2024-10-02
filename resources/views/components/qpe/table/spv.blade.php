<div class="table-responsive">
   <table id="basic-datatables" class="display basic-datatables table-sm table-striped ">
       <thead>
           <tr>
               <th class="text-white text-center">No </th>
               @if (auth()->user()->hasRole('Administrator'))
               <th>ID</th>
               @endif
               <th class="text-white">Employe</th>
               <th class="text-white">Semester / Tahun</th>
               <th class="text-white text-center">Discipline</th>
               <th class="text-white text-center">KPI</th>
               <th class="text-white text-center">Behavior</th>
               <th class="text-white">Achievement</th>
               <th class="text-white">Status</th>
               <th class="text-right text-white">Action</th>
           </tr>
       </thead>
       <tbody>
        @if (auth()->user()->hasRole('HRD|HRD-Recruitment|HRD-Payroll'))
            @foreach ($allpes as $pe)
            <tr>
                <td class="text-center">{{++$i}} </td>
                <td>
                   @if($pe->status == '0' || $pe->status == '101')
                   <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                   @elseif($pe->status == '1' || $pe->status == '202' )
                   <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                   @else
                   <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                   @endif
                </td>
                <td>{{$pe->semester}} / {{$pe->tahun}} </td>
                <td class="text-center">
                    <span class="">{{$pe->discipline}}</span>
                 </td>
                 <td class="text-center">
                    <span class="">{{$pe->kpi}}</span>
                 </td>
                 <td class="text-center">
                    <span class="">{{$pe->behavior}}</span>
                 </td>
                <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                @if($pe->status == 0)
                <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                @elseif($pe->status == '1')
                <td>
                   @if (auth()->user()->hasRole('Manager'))
                   <span class="badge badge-warning badge-lg"><b>Perlu Diverifikasi</b></span>
                   @else
                   <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                   @endif
                </td>
                @elseif($pe->status == '2')
                <td><span class="badge badge-success badge-lg"><b>Done</b></span></td>
                @elseif($pe->status == '3')
                <td><span class="badge badge-primary badge-lg"><b>Validasi HRD</b></span></td>
                @elseif($pe->status == '101')
                <td><span class="badge badge-danger badge-lg"><b>Di Reject Manager</b></span></td>
                @elseif($pe->status == '202')
                <td><span class="badge badge-warning badge-lg"><b>Need Discuss</b></span></td>
                @endif
                <td class="text-right">
                   @if($pe->status == 0)
                   <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{$pe->id}}"><i class="fas fa-trash"></i> Delete</button> -->
                   @elseif(($pe->status == '1' || $pe->status == '2' || $pe->status == '101' || $pe->status == '202') && $pe->behavior > 0)
                   <a href="{{ route('export.qpe', $pe->id) }}" target="_blank"> Preview PDF</a>
                   @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                   <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                   @endif
                </td>
            </tr>
            @endforeach    

            @else

           @foreach ($allpes as $pe)
           @if ($pe->employe_id == $employee->id)
           <tr>
              <td class="text-center">{{++$i}} </td>
              <td>
                 @if($pe->status == '0' || $pe->status == '101')
                 <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                 @elseif($pe->status == '1' || $pe->status == '202' )
                 <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                 @else
                 <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                 @endif
              </td>
              <td>{{$pe->semester}} / {{$pe->tahun}} </td>
              <td class="text-center">
              <span class="">{{$pe->discipline}}</span>
              </td>
              <td class="text-center">
                 <span class="">{{$pe->kpi}}</span>
              </td>
              <td class="text-center">
                 <span class="">{{$pe->behavior}}</span>
              </td>
              <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
              @if($pe->status == 0)
              <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
              @elseif($pe->status == '1')
              <td>
                 @if (auth()->user()->hasRole('Manager'))
                 <span class="badge badge-warning badge-lg"><b>Perlu Diverifikasi</b></span>
                 @else
                 <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                 @endif
              </td>
              @elseif($pe->status == '2')
              <td><span class="badge badge-success badge-lg"><b>Done</b></span></td>
              @elseif($pe->status == '3')
              <td><span class="badge badge-primary badge-lg"><b>Validasi HRD</b></span></td>
              @elseif($pe->status == '101')
              <td><span class="badge badge-danger badge-lg"><b>Di Reject Manager</b></span></td>
              @elseif($pe->status == '202')
              <td><span class="badge badge-warning badge-lg"><b>Need Discuss</b></span></td>
              @endif
              <td class="text-right">
                 @if($pe->status == 0)
                 <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{$pe->id}}"><i class="fas fa-trash"></i> Delete</button> -->
                 @elseif(($pe->status == '1' || $pe->status == '2' || $pe->status == '101' || $pe->status == '202') && $pe->behavior > 0)
                 <a href="{{ route('export.qpe', $pe->id) }}" target="_blank"> Preview PDF</a>
                 @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                 <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                 @endif
              </td>
           </tr>
           @endif
           @endforeach

            @foreach ($myteams as $team)
               @foreach ($allpes as $pe)
                 
                   @if ($pe->employe_id == $team->id)
                   <tr>
                       <td class="text-center">{{++$i}} </td>
                       <td>
                          @if($pe->status == '0' || $pe->status == '101')
                          <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                          @elseif($pe->status == '1' || $pe->status == '202' )
                          <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                          @else
                          <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                          @endif
                       </td>
                       <td>{{$pe->semester}} / {{$pe->tahun}} </td>
                       <td class="text-center">
                        <span class="">{{$pe->discipline}}</span>
                     </td>
                     <td class="text-center">
                        <span class="">{{$pe->kpi}}</span>
                     </td>
                     <td class="text-center">
                        <span class="">{{$pe->behavior}}</span>
                     </td>
                       <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                       @if($pe->status == 0)
                       <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                       @elseif($pe->status == '1')
                       <td>
                          @if (auth()->user()->hasRole('Manager'))
                          <span class="badge badge-warning badge-lg"><b>Perlu Diverifikasi</b></span>
                          @else
                          <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                          @endif
                       </td>
                       @elseif($pe->status == '2')
                       <td><span class="badge badge-success badge-lg"><b>Done</b></span></td>
                       @elseif($pe->status == '3')
                       <td><span class="badge badge-primary badge-lg"><b>Validasi HRD</b></span></td>
                       @elseif($pe->status == '101')
                       <td><span class="badge badge-danger badge-lg"><b>Di Reject Manager</b></span></td>
                       @elseif($pe->status == '202')
                       <td><span class="badge badge-warning badge-lg"><b>Need Discuss</b></span></td>
                       @endif
                       <td class="text-right">
                          @if($pe->status == 0)
                          <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{$pe->id}}"><i class="fas fa-trash"></i> Delete</button> -->
                          @elseif(($pe->status == '1' || $pe->status == '2' || $pe->status == '101' || $pe->status == '202') && $pe->behavior > 0)
                          <a href="{{ route('export.qpe', $pe->id) }}" target="_blank"> Preview PDF</a>
                          @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                          <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                          @endif
                       </td>
                   </tr>
                   @endif
                @endforeach
            @endforeach
        @endif
            
       </tbody>
   </table>
</div>