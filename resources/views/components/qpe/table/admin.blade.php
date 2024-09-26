<div class="row">
   <div class="col-md-2">
      <div class="card">
         <div class="card-header p-2 bg-primary text-white">
            <i class="fas fa-desktop"></i> <small>Monitoring</small>
         </div>
         <div class="card-body p-0">
            <table>
               <thead>
                  <tr>
                     <th>Status</th>
                     <th class="text-center">Qty</th>
                     {{-- <th>Action</th> --}}
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td><a href="{{route('qpe')}}">All</a></td>
                     <td class="text-center">{{count($total)}}</td>
                  </tr>
                  <tr>
                     <td><a href="{{route('qpe.draft')}}">Draft</a></td>
                     <td class="text-center">{{count($draft)}}</td>
                  </tr>
                  <tr>
                     <td><a href="{{route('qpe.verification')}}">Verifikasi</a></td>
                     <td class="text-center">{{count($verification)}}</td>
                  </tr>
                  <tr>
                     <td><a href="{{route('qpe.done')}}">Complete</a></td>
                     <td class="text-center">{{count($done)}}</td>
                  </tr>
                  <tr>
                     <td colspan="2"></td>
                  </tr>
                  <tr>
                     <td><a href="{{route('qpe.reject')}}" class="text-danger">Reject</a></td>
                     <td class="text-center">{{count($reject)}}</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      
      <hr>
      <a href="{{route('kpa.summary')}}">Summary</a>
   </div>

   <div class="col-md-10">
      <div class="card shadow-none border">
         <div class="card-header">
             <h3>{{$title}}</h3>
         </div>
         
         <div class="card-body p-1 py-2">
            <div class="table-responsive">
               <table id="basic-datatables" class="display basic-datatables table-sm table-striped ">
                   <thead>
                       <tr>
                           <th class="text-white text-center" style="width: 20px">No </th>
                           {{-- @if (auth()->user()->hasRole('Administrator'))
                              <th>ID</th>
                              @endif --}}
                           <th>NIK</th>
                           <th class="text-white">Employe</th>
                           <th class="text-white">Semester</th>
                           <th class="text-white text-center">Disc</th>
                           <th class="text-white text-center">KPI</th>
                           <th class="text-white text-center">Behav</th>
                           
                           <th class="text-white text-center">Achieve</th>
                           <th class="text-white">Status</th>
                           <th class="text-right text-white"></th>
                       </tr>
                   </thead>
                   <tbody>
                     @foreach ($pes->sortByDesc('updated_at') as $pe)
                        <tr>
                           <td class="text-center text-truncate">{{++$i}} - 
                              @if (auth()->user()->hasRole('Administrator'))
                           
                                 {{$pe->id}} 
                              
                              @endif   
                           </td>
                          
                              {{-- @if (auth()->user()->hasRole('Administrator'))
                              <td>
                                 {{$pe->id}} 
                              </td>
                              @endif --}}
                           
                           <td class="text-truncate" >
                              @if($pe->status == '0' || $pe->status == '101')
                              <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}}  </a>
                              @elseif($pe->status == '1' || $pe->status == '202' )
                              <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}}  </a>
                              @else
                              <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}}  </a>
                              @endif
                           </td>
                           <td class="text-truncate" style="max-width: 150px">
                              @if($pe->status == '0' || $pe->status == '101')
                              <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->biodata->fullName()}} </a>
                              @elseif($pe->status == '1' || $pe->status == '202' )
                              <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->biodata->fullName()}} </a>
                              @else
                              <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->biodata->fullName()}} </a>
                              @endif
                           </td>
                           <td>{{$pe->semester}} / {{$pe->tahun}}</td>
                           <td class="text-center">
                              <span class="">{{$pe->discipline}}</span>
                           </td>
                           <td class="text-center">
                              <span class="">{{$pe->kpi}}</span>
                           </td>
                           <td class="text-center">
                              <span class="">{{$pe->behavior}}</span>
                           </td>
                           
                           <td class="text-center">
                              {{-- <span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span> --}}
                              <span class="">{{$pe->achievement}}</span>
                           </td>
                           <td>
                              <x-status.qpe-plain :pe="$pe" />
                           </td>
                           {{-- @if($pe->status == 0)
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
                           @endif --}}
                           <td class="text-right">
                              @if($pe->status == 0)
                              <!-- <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-delete-{{$pe->id}}"><i class="fas fa-trash"></i> Delete</button> -->
                              @elseif(($pe->status == '1' || $pe->status == '2' || $pe->status == '101' || $pe->status == '202') && $pe->behavior > 0)
                              <a href="{{ route('export.qpe', $pe->id) }}" target="_blank">PDF</a>
                              @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                              <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                              @endif
                           </td>
                        </tr>
                        <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                        <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                     @endforeach
                   </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>



