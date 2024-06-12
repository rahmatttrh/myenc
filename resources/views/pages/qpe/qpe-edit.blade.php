@extends('layouts.app')
@section('title')
PE
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('qpe')}}">PE</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>


    @if($pd->pdds->count() < 6) <div class="row">
        <div class="col md-12">
            <div class="card shadow-none border">
                <div class="card-header d-flex bg-warning">
                    Informasi !
                </div>
                <div class="card-body">
                    @if($pd->pdds->count() < 6) <h4 class="text-center"> Anda belum bisa melakukan submit karena : </h4>
                        <h3 class="text-center">
                            - Data Discipline (Absensi) masih belum lengkap !</h3>
                        @endif </div>
            </div>
        </div>
</div>
@endif

<div class="row" id="boxCreate">
    <div class="col-md-3">
        <x-qpe.performance-appraisal :kpa="$kpa" />
    </div>
    <div class="col-md-9">
        <div class="card shadow-none border">
            <div class="card-header d-flex bg-primary">
                <div class="d-flex  align-items-center">
                    <div class="card-title text-white">KPI</div>
                </div>

                @if(($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202') && (auth()->user()->hasRole('Leader') || auth()->user()->hasRole('Administrator') ) )
                <div class="btn-group btn-group-page-header ml-auto">
                    <div class="button-group">
                        @if(isset($pd) && $pd->pdds->count() == 6)
                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#modal-submit-{{$kpa->id}}"><i class="fas fa-rocket"></i> Submit </button>
                        <!-- <x-modal.submit :id="$pe->id" :body="'KPI ' . $kpa->employe->biodata->fullName() . ' semester '. $kpa->semester.' '. $pe->tahun " url="{{route('qpe.submit', enkripRambo($pe->id))}}" /> -->

                        <div class="modal fade" id="modal-submit-{{$kpa->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form method="POST" action="{{route('qpe.submit', enkripRambo($pe->id))}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{$pe->id}}">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Submit KPI

                                            <?php echo $kpa->employe->biodata->fullName() . ' semester ' . $kpa->semester . ' ' . $pe->tahun; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-warning ">
                                                Submit
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    &nbsp;
                    <button type="button" class="btn btn-light btn-xs btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-ellipsis-h"></i>
                    </button>
                    <div class="dropdown-menu">
                        <btn data-target="#modalAddtional" data-toggle="modal" class="dropdown-item" style="text-decoration: none">Addtional Objective</btn>
                    </div>
                </div>
                @endif

                @if (auth()->user()->hasRole('Administrator|HRD'))
                @if($isDone)
                <button onclick="doneValidasi({{$kpa->id}})" class=" btn btn-sm btn-primary ml-auto"><i class="fa fa-check"></i> Done</button>
                <form id="done-validasi" action="{{route('kpa.done.validasi', $kpa->id)}}" method="POST"> @csrf @method('patch')</form>
                @elseif($isReject)
                <button onclick="rejectValidasi({{$kpa->id}})" class="btn btn-sm btn-danger ml-auto"><i class="fa fa-reply"></i> Reject</button>
                <form id="reject-validasi" action="{{route('kpa.reject.validasi', $kpa->id)}}" method="POST"> @csrf @method('patch') </form>
                @endif
                @endif

                {{-- @if (auth()->user()->hasRole('Manager') && $kpa->status == '1' ) --}}
                @if ( $kpa->status == '1' )
                <div class="button-group ml-auto">
                    <button onclick="doneVerifikasi({{$kpa->id}})" class=" btn btn-sm btn-warning  "><i class="fa fa-check"></i> Approved</button>
                    <button data-target="#modalReject" data-toggle="modal" class="btn btn-sm btn-danger "><i class="fa fa-reply"></i> Reject</button>

                    <form id="done-validasi" action="{{route('kpa.done.verifikasi', $kpa->id)}}" method="POST"> @csrf @method('patch')</form>
                </div>
                @endif

                <!-- Resubmit -->
                @if($kpa->status == '202')
                <button onclick="resendingValidasi({{$kpa->id}})" class=" btn btn-sm btn-primary ml-auto"><i class="fa fa-rocket"></i> Resending</button>
                <form id="resending-validasi" action="{{route('kpa.resending.validasi', $kpa->id)}}" method="POST"> @csrf @method('patch')</form>
                @endif
            </div>
            <input type="hidden" id="kpi_id" name="kpi_id">
            <input type="hidden" id="employee_id" name="employe_id">
            <input type="hidden" id="date" name="date">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tableCreate" class="displays table table-striped ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Objective</th>
                                <th>Weight</th>
                                <th>Target</th>
                                <th>Value</th>
                                <th>Achievement</th>
                                @if($kpa->status == '2' || $kpa->status == '202')
                                <th>Status</th>
                                <th>Keterangan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalAcv = 0;
                            @endphp
                            @foreach ($datas as $data)

                            @php
                            $urlPdf = Storage::url($data->evidence) ;
                            @endphp
                            <tr>
                                <td>{{++$i}}</td>
                                <td><a href="#" data-target="#myModal-{{$data->id}}" data-toggle="modal"> {{$data->kpidetail->objective}} </a></td>
                                <td> {{$data->kpidetail->weight}}</td>
                                <td> {{$data->kpidetail->target}}</td>
                                <td> {{$data->value}}</td>
                                <td class="text-right"> <b>{{$data->achievement}}</b></td>
                                @if($kpa->status == '2' || $kpa->status == '202')
                                <td>
                                    @if($data->status == '0')
                                    <span class="badge badge-default">Open</span>
                                    @elseif($data->status == '1')
                                    <span class="badge badge-success">Valid</span>
                                    @elseif($data->status == '202')
                                    <span class="badge badge-danger">Invalid</span>
                                    @endif
                                </td>
                                <td>
                                    <br>{{$data->reason_rejection}}
                                </td>
                                @endif
                            </tr>


                            <div class="modal fade" id="myModal-{{$data->id}}" data-bs-backdrop="static">
                                <div class="modal-dialog" style="max-width: 80%;">
                                    <div class="modal-content">

                                        <!-- Bagian header modal -->
                                        <div class="modal-header bg-primary">
                                            <h3 class="modal-title">{{$data->kpidetail->objective}} </h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Bagian konten modal -->
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card shadow-none border">
                                                        <form method="POST" action="{{route('kpa.update',$kpa->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')

                                                            <input type="hidden" name="id" value="{{$data->id}}">
                                                            <input type="hidden" name="kpa_id" value="{{$kpa->id}}">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex  align-items-center">
                                                                    <div class="card-title">Form Edit</div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="objective">Objective:</label>
                                                                    <input type="text" class="form-control" id="objective" name="objective" value="{{ $data->kpidetail->objective }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="weight">Weight:</label>
                                                                    <input type="text" class="form-control" id="weight" name="weight" value="{{ $data->kpidetail->weight }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="target">Target:</label>
                                                                    <input type="text" class="form-control" id="target" name="target" value="{{ $data->kpidetail->target }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="value">Value:</label>
                                                                    <input type="text" class="form-control value" {{ in_array($kpa->status, ['1', '2', '3', '4']) ? 'readonly' : '' }} id="value" name="value" data-key="{{ $data->id }}" data-target="{{ $data->kpidetail->target }}" data-weight="{{ $data->kpidetail->weight }}" value="{{ old('value', $data->value) }}" autocomplete="off">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="achievement">Achievement:</label>
                                                                    <input type="text" class="form-control" id="achievement-{{$data->id}}" name="achievement" value="{{ $data->achievement }}" readonly>
                                                                </div>
                                                                @if($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202' )
                                                                <div class="form-group">
                                                                    <label for="attachment">Evidence</label>
                                                                    <input type="file" class="form-control-file attachment" id="attachment" data-key="{{ $data->id }}" name="attachment" accept=".pdf">
                                                                    <label for="attachment">*opsional jika evidence ingin di rubah</label>
                                                                </div>
                                                                <div class="d-flex justify-content-between btn-group float-right">
                                                                    <!-- <button type="reset" class="btn btn-secondary ml-auto">
                                                                            <i class="fa fa-refresh"></i> Reset
                                                                        </button> -->
                                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                                </div>
                                                                @endif
                                                            </div>

                                                        </form>
                                                    </div>
                                                    @if($kpa->status == 2)
                                                    @if (auth()->user()->hasRole('Administrator|HRD'))
                                                    <!-- Form Validasi HRD -->
                                                    <div class="card shadow-none border">
                                                        <form method="POST" action="{{route('kpa.item.validasi',$kpa->id)}}">
                                                            @csrf
                                                            @method('patch')
                                                            <input type="hidden" name="id" value="{{$data->id}}">
                                                            <input type="hidden" name="act" class="act" value="valid">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex  align-items-center">
                                                                    <div class="card-title">Validasi</div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body boxPerbaikan">
                                                                <label for="form-control">Alasan Penolakan </label>
                                                                <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control alasan_penolakan" rows="4" placeholder="Tuliskan alasan penolakan disini!"></textarea>
                                                            </div>
                                                            <!-- Disini KHusus HRD  -->

                                                            <div class="card-footer ">
                                                                <div class="float-right">
                                                                    <button class="btn btn-success validBtn"><i class="fa fa-check"></i> Valid</button>
                                                                    <button type="button" class="btn btn-danger invalidBtn" id="invalidBtn"><i class="fa fa-window-close"></i> Invalid</button>
                                                                    <button class="btn btn-danger confirmBtn"><i class="fa fa-check"></i> Confirm</button>
                                                                    <button type="button" class="btn btn-default cancelBtn"><i class="fa fa-window-close"></i> Cancel</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    @endif
                                                    <!-- End Form Validasi HRD -->
                                                    @endif
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card shadow-none border">
                                                        <div class="card-header d-flex">
                                                            <div class="d-flex  align-items-center">
                                                                <div class="card-title">Evidence</div>
                                                            </div>

                                                        </div>
                                                        <div class="card-body">
                                                            @if ($data->evidence)
                                                            <iframe src="{{ Storage::url($data->evidence) }}" id="pdfPreview-{{$data->id}}" width=" 100%" height="575px"></iframe>
                                                            @else
                                                            <p>No attachment available.</p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <!-- Bagian footer modal -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @php
                            $totalAcv += $data->achievement;
                            @endphp

                            @endforeach
                        </tbody>
                        <tfoot>
                            @if($addtional)
                            <tr>
                                <td class="text-right" colspan="5">Achievement</td>
                                <td class="text-right"><b>{{$totalAcv}}</b></td>
                            </tr>
                            <tr>
                                <td>Addtional </td>
                                <td><b><a href="#" data-target="#modalEditAddtional" data-toggle="modal">{{$addtional->addtional_objective}}</a></b></td>
                                <td>{{$addtional->addtional_weight}}</td>
                                <td>{{$addtional->addtional_target}}</td>
                                <td>{{$addtional->value}}</td>
                                <td class="text-right"><b>{{$addtional->achievement}}</b></td>
                                @if($kpa->status == '2' || $kpa->status == '202')
                                <td>
                                    @if($addtional->status == '0')
                                    <span class="badge badge-default">Open</span>
                                    @elseif($addtional->status == '1')
                                    <span class="badge badge-success">Valid</span>
                                    @elseif($addtional->status == '202')
                                    <span class="badge badge-danger">Invalid</span>
                                    @endif
                                </td>
                                <td>
                                    <br>{{$addtional->reason_rejection}}
                                </td>
                                @endif
                            </tr>

                            <div class="modal fade" id="modalEditAddtional" data-bs-backdrop="static">
                                <div class="modal-dialog" style="max-width: 80%;">
                                    <div class="modal-content">

                                        <!-- Bagian header modal -->
                                        <div class="modal-header bg-success">
                                            <h3 class="modal-title">{{$addtional->addtional_objective}} </h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Bagian konten modal -->
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <form method="POST" action="{{route('kpa.addtional.update',$kpa->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="id" value="{{$addtional->id}}">
                                                        <input type="hidden" name="kpa_id" value="{{$addtional->kpa_id}}">

                                                        <div class="card shadow-none border">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex  align-items-center">
                                                                    <div class="card-title">Form Edit</div>
                                                                </div>

                                                            </div>
                                                            <div class="card-body">
                                                                <div class="form-group">
                                                                    <label for="objective">Objective:</label>
                                                                    <input type="text" class="form-control" id="objective" name="objective" value="{{ $addtional->addtional_objective }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="weight">Weight:</label>
                                                                    <input type="number" class="form-control" id="weight-edit" name="weight" min="1" max="20" value="{{ $addtional->addtional_weight }}">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="target">Target:</label>
                                                                    <input type="text" class="form-control" id="target-edit" name="target" value="{{ $addtional->addtional_target }}" readonly>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="value">Value:</label>
                                                                    <input type="text" class="form-control" {{$kpa->status > 0 ? 'readonly' : '' }} id="value-edit" name="value" data-key="{{ $addtional->id }}" data-target="{{ $addtional->addtional_target }}" data-weight="{{ $addtional->addtional_weight }}" value="{{ old('value', $addtional->value) }}" autocomplete="off">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="achievement">Achievement:</label>
                                                                    <input type="text" class="form-control" id="achievement-edit" name="achievement" value="{{ $addtional->achievement }}" readonly>
                                                                </div>
                                                                @if($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202')
                                                                <div class="form-group">
                                                                    <label for="attachment">Evidence</label>
                                                                    <input type="file" class="form-control-file attachment" id="attachment" data-key="{{ $addtional->id }}" name="attachment" accept=".pdf">
                                                                    <label for="attachment">*opsional jika evidence ingin di rubah</label>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202')
                                                        <a href="/kpa/addtional-delete/{{enkripRambo($addtional->id)}}" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')"><button type="button" class="btn btn-danger"> <i class="fa fa-trash "></i> Delete</button></a>
                                                        <button type="submit" class="btn btn-warning">Update</button>
                                                        @endif
                                                    </form>


                                                    @if($kpa->status == 2)
                                                    @if (auth()->user()->hasRole('Administrator|HRD'))
                                                    <!-- Form Validasi HRD -->
                                                    <div class="card shadow-none border">
                                                        <form method="POST" action="{{route('kpa.item.validasi',$kpa->id)}}">
                                                            @csrf
                                                            @method('patch')
                                                            <input type="hidden" name="id" value="{{$addtional->id}}">
                                                            <input type="hidden" name="act" class="act" value="valid">
                                                            <div class="card-header d-flex">
                                                                <div class="d-flex  align-items-center">
                                                                    <div class="card-title">Validasi</div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body boxPerbaikan">
                                                                <label for="form-control">Alasan Penolakan </label>
                                                                <textarea name="alasan_penolakan" id="alasan_penolakan" class="form-control alasan_penolakan" rows="4" placeholder="Tuliskan alasan penolakan disini!"></textarea>
                                                            </div>
                                                            <!-- Disini KHusus HRD  -->

                                                            <div class="card-footer ">
                                                                <div class="float-right">
                                                                    <button class="btn btn-success validBtn"><i class="fa fa-check"></i> Valid</button>
                                                                    <button type="button" class="btn btn-danger invalidBtn" id="invalidBtn"><i class="fa fa-window-close"></i> Invalid</button>
                                                                    <button class="btn btn-danger confirmBtn"><i class="fa fa-check"></i> Confirm</button>
                                                                    <button type="button" class="btn btn-default cancelBtn"><i class="fa fa-window-close"></i> Cancel</button>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    @endif
                                                    <!-- End Form Validasi HRD -->
                                                    @endif

                                                </div>

                                                <div class="col-md-8">
                                                    <div class="card shadow-none border">
                                                        <div class="card-header d-flex">
                                                            <div class="d-flex  align-items-center">
                                                                <div class="card-title">Evidence</div>
                                                            </div>

                                                        </div>
                                                        <div class="card-body">
                                                            @if ($addtional->evidence)
                                                            <iframe src="{{ Storage::url($addtional->evidence) }}" id="pdfPreview-{{$addtional->id}}" width=" 100%" height="575px"></iframe>
                                                            @else
                                                            <p>No attachment available.</p>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <!-- Bagian footer modal -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <tr>
                                <th colspan="5" class="text-right">Achievement </th>
                                <th class="text-right" id="totalAchievement">{{$kpa->achievement}}</th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">Achievement Final
                                    <br><small>Bobot 70%</small>
                                </th>
                                <th class="text-right" id="totalAchievement">{{$kpa->contribute_to_pe}}</th>
                            </tr>
                        </tfoot>
                    </table>
                    @if($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202' )
                    <small class="text-danger">* Jika anda ingin mengupdate nilai value, silahkan klik objective</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="boxDetail">
    <div class="col-md-3">
        <div class="card shadow-none border">
            <div class="card-header d-flex bg-primary">
                <div class="d-flex  align-items-center">
                    <div class="card-title text-white">Discipline</div>
                </div>

            </div>
            <div class="card-body">
                <form>
                    @csrf
                    <div class="form-group form-group-default">
                        <label>Alpa</label>
                        <label for="" class="float-right">{{ $pd ? $pd->alpa : 0 }}</label>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Ijin</label>
                        <label for="" class="float-right">{{ $pd ? $pd->ijin : 0 }}</label>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Terlambat</label>
                        <label for="" class="float-right">{{ $pd ? $pd->terlambat : 0 }}</label>
                    </div>
                    <div class="form-group form-group-default bg-success">
                        <label>Value</label>
                        <label for="" class="float-right">{{ $pd ? $pd->achievement : 0 }}</label>
                    </div>
                    <div class="form-group form-group-default ">
                        <label>Bobot</label>
                        <label for="" class="float-right">15</label>
                    </div>
                    <div class="form-group form-group-default bg-success">
                        <label> <b>Achievement</b></label>
                        <label for="" class="float-right">
                            <h3>{{ $pd ? $pd->contribute_to_pe : 0 }}</h3>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card shadow-none border">
            <div class="card-header bg-primary">
                <div class="card-title text-white">Behavior</div>
            </div>
            @if($pba == null)

            <form action="{{route('qpe.behavior.store')}}" name="formBehavior" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">

                @endif

                @csrf
                <input type="hidden" name="employe_id" value="{{$kpa->employe_id}}">
                <input type="hidden" name="kpa_id" value="{{$kpa->id}}">
                <input type="hidden" name="pe_id" value="{{$kpa->pe_id}}">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="displays table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Objective</th>
                                    <th>Description</th>
                                    <th>Bobot</th>
                                    <th>Value</th>
                                    <th>Achievement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($pba == null)
                                @foreach($behaviors as $key => $behavior)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $behavior->objective }}</td>
                                    <td>{{ $behavior->description }}</td>
                                    <td>{{ $behavior->bobot }}</td>
                                    <td>
                                        <input type="text" name="valBehavior[{{ $behavior->id }}]" value="0" min="0.01" max="4" step="0.01">
                                        <br><span><small>*Max 4 point</small></span>
                                    </td>
                                    <td>
                                        <input type="text" name="acvBehavior[{{ $behavior->id }}]" readonly>
                                        <br><span>-</span>
                                    </td>
                                </tr>
                                @endforeach
                                @else

                                @foreach($pbads as $key => $pbda)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>
                                        <a href="#" data-target="#modalBehavior-{{$pbda->id}}" data-toggle="modal">{{ $pbda->behavior->objective }}</a>
                                    </td>
                                    <td>{{ $pbda->behavior->description }}</td>
                                    <td>{{ $pbda->behavior->bobot }}</td>
                                    <td>{{ $pbda->value }}</td>
                                    <td>{{ $pbda->achievement }}</td>
                                </tr>

                                <div class="modal fade" id="modalBehavior-{{$pbda->id}}" data-bs-backdrop="static">
                                    <div class="modal-dialog" style="max-width: 50%;">
                                        <div class="modal-content">
                                            <form method="POST" action="{{route('qpe.behavior.update',$pbda->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                @method('patch')

                                                <input type="hidden" name="id" value="{{$pbda->id}}">
                                                <input type="hidden" name="kpa_id" value="{{$kpa->id}}">
                                                <input type="hidden" name="pba_id" value="{{$pbda->pba_id}}">
                                                <!-- Bagian header modal -->
                                                <div class="modal-header bg-primary">
                                                    <h3 class="modal-title text-white">{{$pbda->behavior->objective}} </h3>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Bagian konten modal -->
                                                <div class="modal-body">
                                                    <div class="card-body">

                                                        <div class="form-group">
                                                            <label for="objective">Objective :</label>
                                                            <input type="text" class="form-control" id="objective" name="objective" value="{{ $pbda->behavior->objective }}" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="objective">Description :</label>
                                                            <textarea type="text" rows="5" class="form-control" id="objective" name="objective" readonly>{{ $pbda->behavior->description }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="weight">Weight :</label>
                                                            <input type="text" class="form-control" id="weight" name="weight" value="{{ $pbda->behavior->bobot }}" readonly>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="value">Value :</label>
                                                            <input type="text" class="form-control value" id="value" name="valBv" data-key="{{ $pbda->id }}" data-target="{{ $pbda->behavior->target }}" data-weight="{{ $pbda->behavior->weight }}" value="{{ old('value', $pbda->value) }}" autocomplete="off">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="achievement">Achievement :</label>
                                                            <input type="text" class="form-control" id="achievementBv-{{$pbda->id}}" name="achievement" value="{{ $pbda->achievement }}" readonly>
                                                        </div>

                                                    </div>

                                                </div>

                                                <!-- Bagian footer modal -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-warning">Update</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @endforeach


                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right">Achievement</th>
                                    @if(isset($pba))
                                    <th><span id="totalAcvBehavior" name="totalAcvBehavior">{{$pba->achievement}}</span></th>
                                    @else
                                    <th><span id="totalAcvBehavior" name="totalAcvBehavior">-</span></th>
                                    @endif
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <a data-target="#modalPanduan" data-toggle="modal" class="text-danger "><span class="fa fa-info"></span> Panduan Pengisian Nilai Behavior</a>

                    <div class="modal fade" id="modalPanduan" data-bs-backdrop="static">
                        <div class="modal-dialog" style="max-width: 90%;">
                            <div class="modal-content">

                                <!-- Bagian header modal -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Panduan Pengisian Nilai Behavior</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Konten modal -->
                                <div class="modal-body">
                                    <!-- Isi konten modal disini -->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th class="text-center">Obyektif</th>
                                                <th class="text-center">Deskripsi</th>
                                                <th class="text-center">Bobot</th>
                                                <th class="text-center">Periode Target</th>
                                                <th class="text-center">1</th>
                                                <th class="text-center">2</th>
                                                <th class="text-center">3</th>
                                                <th class="text-center">4</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center text-bold">Kreatifitas dan Inovasi</td>
                                                <td class="text-center">Memberikan ide, inovasi terkait lingkup pekerjaan dalam departemen</td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">Semester</td>
                                                <td class="text-center">Tidak pernah memberikan masukan dan inovasi terkait pekerjaan</td>
                                                <td class="text-center">Bersama-sama dengan rekan yang lain berkontribusi dalam memberikan ide maupun inovasi baru</td>
                                                <td class="text-center">Memberikan Ide atau inovasi minimal 1 dalam 1 semester</td>
                                                <td class="text-center">Memberikan Ide atau inovasi minimal 1 dalam 1 semester dan dapat diaplikasikan dalam pekerjaan</td>
                                            </tr>
                                            <tr>
                                                <td class="">Kerjasama</td>
                                                <td class="">kemampuan untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait; merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta saling menghargai pendapat dan masukan guna peningkatan kinerja tim</td>
                                                <td class="">5</td>
                                                <td class="">Semester</td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan yang sangat rendah untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;
                                                    <br>- Tidak mampu merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta
                                                    <br>- Tidak bisa menghargai pendapat dan masukan guna peningkatan kinerja tim.
                                                </td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan yang terbatas untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;
                                                    <br>- Kurang mampu merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan;
                                                    <br>- Kurang bisa menghargai pendapat dan masukan guna peningkatan kinerja tim.
                                                </td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan yang memadai untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait;
                                                    <br>- Mampu merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta
                                                    <br>- Saling menghargai pendapat dan masukan guna peningkatan kinerja tim
                                                </td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan untuk merencanakan dan mengendalikan proses koordinasi dan komunikasi dengan berbagai pihak yang terkait;
                                                    <br>- Memiliki kemampuan yang sangat baik dalam merumuskan tujuan bersama dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan; serta
                                                    <br>- Saling menghargai pendapat dan masukan guna peningkatan kinerja tim
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="">Inisiatif</td>
                                                <td class="">kemampuan untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah; bersikap proaktif dan memiliki self-motivation yang tinggi untuk menuntaskan pekerjaan; serta mampu dalam mengajukan usulan/masukan untuk peningkatan mutu kerja</td>
                                                <td class="">5</td>
                                                <td class="">Semester</td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan yang sangat rendah untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah;
                                                    <br>- Bersikap pasif dan tidak memiliki self-motivation untuk menuntaskan pekerjaan;
                                                    <br>- Tidak pernah mengutarakan usulan/masukan untuk peningkatan mutu kerja
                                                </td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan yang terbatas untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah;
                                                    <br>- Kadang-kadang bersikap pasif dan kurang memiliki self-motivation untuk menuntaskan pekerjaan;
                                                    <br>- Terbatas dalam mengutarakan usulan/masukan untuk peningkatan mutu kerja
                                                </td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan yang memadai untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah;
                                                    <br>- Bersikap proaktif dan memiliki self-motivation untuk menuntaskan pekerjaan;
                                                    <br>- Mampu dalam mengutarakan usulan/masukan untuk peningkatan mutu kerja
                                                </td>
                                                <td class="">
                                                    <br>- Memiliki kemampuan untuk merencanakan, dan mengimplementasikan inisiatif perbaikan mutu kerja;
                                                    <br>- Selalu bersikap proaktif dan memiliki self-motivation yang tinggi dan konsisten untuk menuntaskan pekerjaan;
                                                    <br>- Mampu dalam mengutarakan usulan/masukan untuk peningkatan mutu kerja
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Bagian footer modal -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="col-md-3 float-right mb-3">
                        @if($pba == null)
                        <button type="submit" class="btn btn-block btn-primary ">Save</button>
                        @endif
                    </div>
                </div>
                @if($pba == null)
            </form>
            @endif
        </div>
    </div>
</div>

@php

if($pd){

$pdAchievement = $pd->contribute_to_pe;

} else {

$pdAchievement = 0;

}

if($pba) {
$pbaAchievement = $pba->achievement;
}else {
$pbaAchievement = 0;
}




@endphp
<!-- rangkuman nilai -->
<div class="row">
    <div class="col-md-12">
        <div class="card shadow-none border">
            <div class="card-header bg-primary">
                <div class="card-title text-white text-center">RANGKUMAN HASIL PENILAIAN AKHIR </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="displays table table-striped ">
                        <thead>
                            <tr>
                                <th rowspan="2" colspan="2" class="text-white text-center">Indikator</th>
                                <th rowspan="2" class="text-white text-center">Total Indikator</th>
                                <th rowspan="2" class="text-white text-center">Bobot</th>
                                <th rowspan="2" class="text-white text-center"> Nilai</th>
                                <!-- <th rowspan="2" class="text-white text-center"> Nilai 4</th> -->
                                <th rowspan="2" class="text-white text-center"> (Bobot/100)xNilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-center">DISIPLIN</td>
                                <td class="text-center">3</td>
                                <td class="text-center">15</td>
                                <td class="text-center"><b>{{round(($pdAchievement/15)*100)}}</b></td>
                                <!-- <td class="">{{round((4.00/4)* 4 , 2)}}</td> -->
                                <td class="text-center text-bold"><b>{{ $pdAchievement }}</b></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-center">KPI</td>
                                <td class="text-center">{{$datas->count()}}</td>
                                <td class="text-center">{{$kpa->weight}}</td>
                                <td class="text-center text-bold"><b>{{$kpa->achievement }}</b></td>
                                <!-- <td class="  text-bold"><b>{{ ($kpa->achievement/100) * 4 }}</b></td> -->
                                <td class="text-center text-bold"><b>{{$kpa->contribute_to_pe}}</b></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-center">BEHAVIOR</td>
                                @if(isset($pba))
                                <td class="text-center">{{$behaviors->count()}}</td>
                                <td class="text-center">{{$pba->weight}}</td>
                                <td class="text-center text-bold"><b>{{round(($pba->achievement / $pba->weight) * 100)}}</b></td>
                                <td class="text-center text-bold"><b>{{$pba->contribute_to_pe}}</b></td>
                                @else
                                <td class="text-center">-</td>
                                <td class="text-center">-</td>
                                <td class="text-center text-bold"><b>-</b></td>
                                <td class="text-center text-bold"><b>-</b></td>
                                @endif
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">
                                    <h3><b> Total Nilai </b></h3>
                                </th>
                                <th class="text-center"><span id="totalAcvBehavior" name="totalAcvBehavior">
                                        <h3>
                                            <b> {{$pe->achievement}} </b>
                                        </h3>
                                    </span></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="table-responsive mt-3">
                    <table class="displays table table-striped ">
                        <tr>
                            <td colspan="2">Note : </td>
                            <td colspan="2">Pengurang</td>
                            <td colspan="4">Bobot Pencapaian</td>
                        </tr>
                        <tbody>
                            <tr>
                                <td>MGR</td>
                                <td>: Manager</td>
                                <td>SP</td>
                                <td>0</td>
                                <td colspan="2">100 - 91</td>
                                <td colspan="2">Memuaskan</td>
                            </tr>
                            <tr>
                                <td>SPV</td>
                                <td>: Supervisor</td>
                                <td></td>
                                <td></td>
                                <td colspan="2">90 - 76</td>
                                <td colspan="2">Baik</td>
                            </tr>
                            <tr>
                                <td>TL</td>
                                <td>: Team Leader</td>
                                <td></td>
                                <td></td>
                                <td colspan="2">75 - 61</td>
                                <td colspan="2">Cukup</td>
                            </tr>
                            <tr>
                                <td>S</td>
                                <td>: Staff</td>
                                <td></td>
                                <td></td>
                                <td colspan="2">60 - 51</td>
                                <td colspan="2">Kurang</td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td> </td>
                                <td></td>
                                <td></td>
                                <td colspan="2">50 - 0</td>
                                <td colspan="2">Sangat Kurang</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<div class="modal fade" id="modalAddtional" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Bagian header modal -->
            <div class="modal-header">
                <h3 class="modal-title"> </h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{route('kpa.addtional.store',$kpa->id) }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$data->id}}">
                <input type="hidden" name="kpa_id" value="{{$kpa->id}}">

                <!-- Bagian konten modal -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-none border">
                                <div class="card-header d-flex">
                                    <div class="d-flex  align-items-center">
                                        <div class="card-title">Form Addtional Objective</div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="objective">Objective:</label>
                                        <input type="text" class="form-control" id="objective" name="objective" value="" placeholder="isi objective" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="weight">Weight:</label>
                                        <input type="number" class="form-control" id="weight-addtional" name="weight" min="1" max="20" value="20">
                                    </div>

                                    <div class="form-group">
                                        <label for="target">Target:</label>
                                        <input type="text" class="form-control" id="target-addtional" name="target" value="4" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="value">Value:</label>
                                        <input type="text" class="form-control" id="value-addtional" name="value" data-target="4" value="4" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label for="achievement">Achievement:</label>
                                        <input type="text" class="form-control" id="achievement-addtional" name="achievement" value="20" readonly>
                                    </div>
                                    @if($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202')
                                    <div class="form-group">
                                        <label for="attachment">Evidence</label>
                                        <input type="file" class="form-control-file attachment" id="attachment" name="attachment" accept=".pdf">
                                        <label for="attachment">*opsional jika evidence ingin di rubah</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    @if($kpa->status == '0' || $kpa->status == '101' || $kpa->status == '202')
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    @endif
                </div>
            </form>

        </div>
    </div>
</div>


<!-- Modal Reject  -->
<div class="modal fade" id="modalReject" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!-- Bagian header modal -->
            <div class="modal-header">
                <h3 class="modal-title"> </h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form method="POST" action="{{route('kpa.verifikasi.reject',$kpa->id) }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="kpa_id" value="{{$kpa->id}}">

                <!-- Bagian konten modal -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card shadow-none border">
                                <div class="card-header d-flex">
                                    <div class="d-flex  align-items-center">
                                        <div class="card-title">Konfirmasi Reject</div>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <label for="" class="label-control">Alasan Penolakan</label>
                                    <textarea name="alasan_reject" class="form-control" id="" cols="30" rows="10" placeholder="Isikan alasan penolakan disini"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bagian footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- End Modal Reject  -->
@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        $('.boxPerbaikan').hide();

        // $('#invalidBtn').click(function() {
        //     console.log('test');
        // });
        $('.confirmBtn').hide();
        $('.cancelBtn').hide();

        $('.invalidBtn').click(function() {
            // Tindakan yang akan dijalankan saat tombol diklik
            $('.boxPerbaikan').show();
            $('.validBtn').hide();
            $('.invalidBtn').hide();

            $('.confirmBtn').show();
            $('.cancelBtn').show();
            // Menambahkan atribut 'required' ke elemen input

            $('.alasan_penolakan').prop('required', true);

            $('.act').val('invalid');
        });

        $('.cancelBtn').click(function() {
            // Tindakan yang akan dijalankan saat tombol diklik
            $('.boxPerbaikan').hide();
            $('.validBtn').show();
            $('.invalidBtn').show();

            $('.confirmBtn').hide();
            $('.cancelBtn').hide();

            // Menghapus atribut 'required' dari elemen input
            $('.alasan_penolakan').removeAttr('required');

            $('.act').val('valid');
        });

        // Update Behavior Value
        // Event listener for input change
        $('input[name^="valBv"]').on('change', function() {
            var value = validateInputNew(this);
            // var inputName = $(this).attr('name');
            // var id = inputName.match(/\[([0-9]+)\]/)[1]; // Extract ID from name

            var acv = Math.round(((value / 4) * 5));

            var key = parseFloat($(this).data('key'));

            $('#achievementBv-' + key).val(acv);


            // $('input[name="acvBehavior[' + id + ']"]').val(acv);

        });

        // Baru Behavior
        // Function to validate the input value
        function validateInputNew(input) {
            var value = parseFloat($(input).val());
            var regex = /^\d+(\.\d{1,2})?$/;

            if (isNaN(value) || value < 0.01 || value > 4) {
                if (value > 4) {
                    value = 4;
                } else {
                    value = 1;
                }
                alert("Value must be between 0.01 and 4.");
            } else if (!regex.test(value.toFixed(2))) {
                alert("Value cannot have more than two decimal places.");
                value = value.toFixed(2);
            } else {
                value = value.toFixed(2);
            }

            $(input).val(value);

            return value;
        }

        // Function to update the total of acvBehavior values
        function updateTotalAcvBehavior() {
            var total = 0;
            $('input[name^="acvBehavior"]').each(function() {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('#totalAcvBehavior').text(total.toFixed(2));
        }

        // Event listener for input change
        $('input[name^="valBehavior"]').on('change', function() {
            var value = validateInputNew(this);
            var inputName = $(this).attr('name');
            var id = inputName.match(/\[([0-9]+)\]/)[1]; // Extract ID from name

            var acv = Math.round(((value / 4) * 5));

            $('input[name="acvBehavior[' + id + ']"]').val(acv);

            // Update totalAcvBehavior whenever valBehavior changes
            updateTotalAcvBehavior();
        });

        // Optional: Add validation on form submit
        $('form[name="formBehavior"]').on('submit', function(event) {
            var isValid = true;
            $('input[name^="valBehavior"]').each(function() {
                var value = parseFloat($(this).val());
                if (isNaN(value) || value < 0.01 || value > 4) {
                    alert("Value must be between 0.01 and 4.");
                    $(this).val("0");
                    isValid = false;
                }
            });
            if (!isValid) {
                event.preventDefault();
            }
        });

        // end Baru


        $('.attachment').on('change', function() {
            var input = $(this)[0];

            var key = $(this).data('key');

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    showPdf(e.target.result, key);

                };
                reader.readAsDataURL(input.files[0]);
            }
        });

        function showPdf(data, id) {
            $('#pdfPreview-' + id).attr('src', ''); // Mengosongkan atribut src
            $('#pdfPreview-' + id).attr('src', data); // Menetapkan atribut src dengan tampilan pratinjau baru
            $('#pdfPreview-' + id).show();
        }

        $('.value').on('input', function() {
            var inputValue = $(this).val();

            // Hapus angka 0 di depan jika ada
            inputValue = inputValue.replace(/^0+(?=\d)/, '');

            $(this).val(inputValue);

            var key = parseFloat($(this).data('key'));
            var targetValue = parseFloat($(this).data('target'));
            var weightValue = parseFloat($(this).data('weight'));



            validateInput($(this), targetValue);

            let achievementValue = Math.round(($(this).val() / targetValue) * weightValue);

            $('#achievement-' + key).val(achievementValue);

        });

        function calculateAchievement() {
            var value = parseFloat($('#value-addtional').val());
            var targetValue = parseFloat($('#target-addtional').val());
            var weightValue = parseFloat($('#weight-addtional').val());

            if (isNaN(value) || value <= 0.1) {
                value = 0;
                $('#value-addtional').val(value);
            }

            validateInput($('#value-addtional'), targetValue);

            let achievementValue = Math.round((value / targetValue) * weightValue);

            // Batasi nilai achievementValue menjadi rentang 1 hingga 20
            achievementValue = Math.min(Math.max(achievementValue, 1), 20);

            $('#achievement-addtional').val(achievementValue);
        }

        $('#value-addtional').on('input', function() {
            var inputValue = $(this).val().replace(/^0+(?=\d)/, '');
            $(this).val(inputValue);
            calculateAchievement();
        });

        $('#weight-addtional').on('input', function() {
            var weightValue = parseFloat($(this).val());

            // Jika weightValue kosong, set nilai menjadi 1
            if (isNaN(weightValue) || weightValue <= 0) {
                weightValue = 1;
                $('#weight-addtional').val(weightValue);
            }

            // Batasi nilai weightValue menjadi maksimal 20
            weightValue = Math.min(weightValue, 20);

            $('#weight-addtional').val(weightValue);

            calculateAchievement();
        });


        // Edit
        function calculateAchievementEdit() {
            var value = parseFloat($('#value-edit').val());
            var targetValue = parseFloat($('#target-edit').val());
            var weightValue = parseFloat($('#weight-edit').val());

            if (isNaN(value) || value <= 0.1) {
                value = 0;
                $('#value-edit').val(value);
            }

            validateInput($('#value-edit'), targetValue);

            let achievementValue = Math.round((value / targetValue) * weightValue);

            // Batasi nilai achievementValue menjadi rentang 1 hingga 20
            achievementValue = Math.min(Math.max(achievementValue, 1), 20);

            $('#achievement-edit').val(achievementValue);
        }

        $('#value-edit').on('input', function() {
            var inputValue = $(this).val().replace(/^0+(?=\d)/, '');
            $(this).val(inputValue);
            calculateAchievementEdit();
        });

        $('#weight-edit').on('input', function() {
            var weightValue = parseFloat($(this).val());

            // Jika weightValue kosong, set nilai menjadi 1
            if (isNaN(weightValue) || weightValue <= 0) {
                weightValue = 1;
                $('#weight-edit').val(weightValue);
            }

            // Batasi nilai weightValue menjadi maksimal 20
            weightValue = Math.min(weightValue, 20);

            $('#weight-edit').val(weightValue);

            calculateAchievementEdit();
        });

        $('.calculateAdd').on('input', function() {

            let weightAdd = $("#weight-addtional").val();
            let valueAdd = $("#value-addtional").val();

            console.log('test');

            let totalAdd = Math.round((valueAdd / 4) * weightAdd); // 4 DI AMBIL Dari nilai default target

            $('#achievement-addtional').val(totalAdd);
        });




        function validateInput(input, targetValue) {
            var inputValue = parseFloat(input.val());

            if (isNaN(inputValue) || inputValue < 0.1) {
                input.removeClass('is-valid');
                input.addClass('is-invalid');
            } else if (inputValue > targetValue) {
                input.val(targetValue);
                input.removeClass('is-invalid');
                input.addClass('is-valid');
            } else {
                input.removeClass('is-invalid');
                input.addClass('is-valid');
            }
        }

    })

    function hitungYuk() {
        return $('#value-addtional').val();
    }

    function doneValidasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Done",
                text: pesan + ",Yakin ingin menyelesaikan validasi ini ?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#done-validasi').submit();
                }
            });
    }

    function doneVerifikasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Konfirmasi",
                text: " Anda yakin ingin menyelesaikan verifikasi ini ?",
                icon: "info",
                buttons: true,
                dangerMode: false,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#done-validasi').submit();
                }
            });
    }


    function rejectValidasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Reject",
                text: pesan + ",Anda Yakin ingin mereject data ini ?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#reject-validasi').submit();
                }
            });
    }

    function resendingValidasi(id, pesan = 'Konfirmasi') {
        swal({
                title: "Konfirmasi",
                text: "Anda Yakin ingin mengirimkan kembali data ini?",
                icon: "info",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $('#resending-validasi').submit();
                }
            });
    }
</script>
@endpush