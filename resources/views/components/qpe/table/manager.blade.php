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
                     {{-- <th class="text-center">Qty</th> --}}
                     {{-- <th>Action</th> --}}
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td class="{{$title == 'ALL QPE' ? 'bg-info' : ''}}"">
                        <a class="{{$title == 'ALL QPE' ? 'text-white' : ''}}" href="{{route('qpe')}}">All</a>
                     </td>
                  </tr>
                  <tr>
                     <td class="{{$title == 'DRAFT QPE' ? 'bg-info' : ''}}">
                        <a class="{{$title == 'DRAFT QPE' ? 'text-white' : ''}}" href="{{route('qpe.draft')}}">Draft</a>
                     </td>
                     {{-- <td class="text-center">{{count($draft)}}</td> --}}
                  </tr>
                  <tr>
                     <td class="{{$title == 'VERIFICATION QPE' ? 'bg-info' : ''}}">
                        <a class="{{$title == 'VERIFICATION QPE' ? 'text-white' : ''}}" href="{{route('qpe.verification')}}">Verifikasi</a>
                     </td>
                     {{-- <td class="text-center">{{count($verification)}}</td> --}}
                  </tr>
                  <tr>
                     <td class="{{$title == 'COMPLETE QPE' ? 'bg-info' : ''}}">
                        <a class="{{$title == 'COMPLETE QPE' ? 'text-white' : ''}}" href="{{route('qpe.done')}}">Complete</a>
                     </td>
                     {{-- <td class="text-center">{{count($done)}}</td> --}}
                  </tr>
                  <tr>
                     <td colspan=""></td>
                  </tr>
                  <tr>
                     <td class="{{$title == 'REJECT QPE' ? 'bg-danger' : ''}}">
                        <a class="{{$title == 'REJECT QPE' ? 'text-white' : ''}}" href="{{route('qpe.reject')}}" class="text-danger">Reject</a>
                     </td>
                     {{-- <td class="text-center">{{count($reject)}}</td> --}}
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      
      <hr>
      <a href="{{route('kpa.summary')}}">Summary</a>
   </div>

   <div class="col-md-10">
      {{-- <h3>{{$title}}</h3> --}}
      <form action="{{route('qpe.apply')}}" method="post" enctype="multipart/form-data">
         @if ($title == 'VERIFICATION QPE')
         <button class="btn btn-sm btn-success mb-3 ml-3" name="apply" value="1" type="submit"><i class="fas fa-check"></i> Approve</button>
         @endif
         <div class="table-responsive">
            <table id="basic-datatables" class="display basic-datatables table-sm table-striped ">
               <thead>
                  <tr>
                     @if ($title == 'VERIFICATION QPE')
                        <th><input type="checkbox" name="" id="checkboxAll"></th>
                     @endif
                        <th class="text-white text-center">No </th>
                        @if (auth()->user()->hasRole('Administrator'))
                        <th>ID</th>
                        @endif
                        <th class="text-white">Employe</th>
                        <th class="text-white">Semester</th>
                        
                        <th class="text-white text-center">Discipline</th>
                        <th class="text-white text-center">KPI</th>
                        <th class="text-white text-center">Behav</th>
                        <th class="text-white">Achieve</th>
                        <th class="text-white">Status</th>
                        <th class="text-right text-white"></th>
                  </tr>
               </thead>
               <tbody>
                  @if (count($employee->positions) > 0)

                     @foreach ($employee->positions as $pos)
                        @if ($title == 'ALL QPE')
                              {{-- ALL --}}
                              @foreach ($pos->department->pes->where('status', '>=', 0)->sortByDesc('updated_at') as $pe)
                                 <tr>
                                    <td class="text-center text-truncate">{{++$i}}</td>
                                    <td  class=" text-truncate">
                                       @if($pe->status == '0' || $pe->status == '101')
                                       <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @elseif($pe->status == '1' || $pe->status == '202' )
                                       <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @else
                                       <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
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
                                    
                                    <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                                    @if($pe->status == 0)
                                    <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                                    @elseif($pe->status == '1')
                                    <td>
                                       @if (auth()->user()->hasRole('Manager'))
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
                                       @else
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
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
                                       <a href="{{ route('export.qpe', $pe->id) }}" target="_blank">PDF</a>
                                       @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                                       <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                                       @endif
                                    </td>
                                 </tr>
                                 <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                                 <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                        
                              @endforeach
                           @elseif($title == 'DRAFT QPE')
                              {{-- Draft --}}
                              @foreach ($pos->department->pes->where('status', '=', 0)->sortByDesc('updated_at') as $pe)
                                 <tr>
                                    
                                    <td class="text-center text-truncate">{{++$i}}</td>
                                    <td  class=" text-truncate">
                                       @if($pe->status == '0' || $pe->status == '101')
                                       <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @elseif($pe->status == '1' || $pe->status == '202' )
                                       <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @else
                                       <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
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
                                    
                                    <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                                    @if($pe->status == 0)
                                    <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                                    @elseif($pe->status == '1')
                                    <td>
                                       @if (auth()->user()->hasRole('Manager'))
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
                                       @else
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
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
                                       <a href="{{ route('export.qpe', $pe->id) }}" target="_blank">PDF</a>
                                       @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                                       <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                                       @endif
                                    </td>
                                 </tr>
                                 <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                                 <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                        
                              @endforeach
                           @elseif($title == 'VERIFICATION QPE')
                              {{-- verifikasi --}}
                              @foreach ($pos->department->pes->where('status', '=', 1)->sortByDesc('updated_at') as $pe)
                                 <tr>
                                    @if ($title == 'VERIFICATION QPE')
                                    <td><input type="checkbox" name="check[]" value="{{$pe->id}}" id="check-{{$pe->id}}"></td>
                                    @endif
                                    <td class="text-center text-truncate">{{++$i}}</td>
                                    <td  class=" text-truncate">
                                       @if($pe->status == '0' || $pe->status == '101')
                                       <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @elseif($pe->status == '1' || $pe->status == '202' )
                                       <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @else
                                       <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
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
                                    
                                    <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                                    @if($pe->status == 0)
                                    <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                                    @elseif($pe->status == '1')
                                    <td>
                                       @if (auth()->user()->hasRole('Manager'))
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
                                       @else
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
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
                                       <a href="{{ route('export.qpe', $pe->id) }}" target="_blank">PDF</a>
                                       @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                                       <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                                       @endif
                                    </td>
                                 </tr>
                                 <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                                 <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                        
                              @endforeach
                           @elseif($title == 'COMPLETE QPE')
                              {{-- complete --}}
                              @foreach ($pos->department->pes->where('status', '=', 2)->sortByDesc('updated_at') as $pe)
                                 <tr>
                                    <td class="text-center text-truncate">{{++$i}}</td>
                                    <td  class=" text-truncate">
                                       @if($pe->status == '0' || $pe->status == '101')
                                       <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @elseif($pe->status == '1' || $pe->status == '202' )
                                       <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @else
                                       <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
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
                                    
                                    <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                                    @if($pe->status == 0)
                                    <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                                    @elseif($pe->status == '1')
                                    <td>
                                       @if (auth()->user()->hasRole('Manager'))
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
                                       @else
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
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
                                       <a href="{{ route('export.qpe', $pe->id) }}" target="_blank">PDF</a>
                                       @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                                       <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                                       @endif
                                    </td>
                                 </tr>
                                 <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                                 <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                        
                              @endforeach
                           @elseif($title == 'REJECT QPE')
                              {{-- complete --}}
                              @foreach ($pos->department->pes->where('status', '=', 101)->sortByDesc('updated_at') as $pe)
                                 <tr>
                                    <td class="text-center text-truncate">{{++$i}}</td>
                                    <td  class=" text-truncate">
                                       @if($pe->status == '0' || $pe->status == '101')
                                       <a href="/qpe/edit/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @elseif($pe->status == '1' || $pe->status == '202' )
                                       <a href="/qpe/approval/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
                                       @else
                                       <a href="/qpe/show/{{enkripRambo($pe->kpa->id)}}">{{$pe->employe->nik}} {{$pe->employe->biodata->fullName()}} </a>
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
                                    
                                    <td><span class="badge badge-primary badge-lg"><b>{{$pe->achievement}}</b></span></td>
                                    @if($pe->status == 0)
                                    <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                                    @elseif($pe->status == '1')
                                    <td>
                                       @if (auth()->user()->hasRole('Manager'))
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
                                       @else
                                       <span class="badge badge-warning badge-lg"><b>Verifikasi</b></span>
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
                                       <a href="{{ route('export.qpe', $pe->id) }}" target="_blank">PDF</a>
                                       @elseif(($pe->status == 0 || $pe->status == 101 || $pe->status == 202) && auth()->user()->hasRole('Leader'))
                                       <!-- <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-submit-{{$pe->id}}"><i class="fas fa-rocket"></i> Submit</button> -->
                                       @endif
                                    </td>
                                 </tr>
                                 <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                                 <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                        
                              @endforeach
                        @endif
                        
                     @endforeach


                     @else

                     @if ($title == 'ALL QPE')
                     @endif
                        @foreach ($pes->sortByDesc('updated_at') as $pe)
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
                                    <span class="">{{$pe->kpi}}</span>
                                 </td>
                                 <td class="text-center">
                                    <span class="">{{$pe->behavior}}</span>
                                 </td>
                                 <td class="text-center">
                                    <span class="">{{$pe->discipline}}</span>
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
                           <x-modal.submit :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="" />
                           <x-modal.delete :id="$pe->id" :body="'KPI ' . $pe->employe->biodata->fullName() . ' bulan '. date('F Y', strtotime($pe->date))   " url="qpe/delete/{{$pe->id}}" />
                        @endforeach
                  @endif
               </tbody>
            </table>
         </div>
      </form>
   </div>
</div>

@push('js_footer')
<script>
    $(document).ready(function() {
        // $('#button-group').hide();

        // Ketika checkboxAll dicentang, ceklis semua checkbox dengan name=check
        $("#checkboxAll").change(function() {
            $("input[name='check[]']").prop('checked', $(this).prop('checked'));
        });

        // Ketika salah satu checkbox dengan name=check dicentang atau dicentang ulang
        $("input[name='check[]']").change(function() {
            // Periksa apakah semua checkbox dengan name=check tercentang
            var allChecked = ($("input[name='check[]']:checked").length === $("input[name='check[]']").length);

            // Terapkan status checked pada checkboxAll sesuai hasil pengecekan di atas
            $("#checkboxAll").prop('checked', allChecked);
        });

        // Saat tombol Terapkan atau Delete ditekan
        $("#button-group button").click(function() {
            // Dapatkan nilai atribut 'name' dan 'value' dari tombol yang ditekan
            var action = $(this).attr('name');
            var value = $(this).val();

            // Jika tombol yang ditekan adalah 'apply' atau 'delete'
            if (action === 'apply' || action === 'delete') {
                // Lakukan sesuatu sesuai dengan kebutuhan Anda
                // Misalnya, tampilkan pesan alert:
                alert("Tombol " + action + " ditekan dengan nilai " + value);
            }
        });
    })
</script>
@endpush