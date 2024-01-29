@extends('layouts.app')
@section('title')
KPA
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page"><a href="{{route('kpa')}}">KPA</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="row" id="boxCreate">
        <div class="col-md-3">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Give Performance Apprasial</div>
                    </div>

                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group form-group-default">
                            <label><b>Employee</b></label>
                            {{$kpa->employe->biodata->fullName()}}
                        </div>
                        <div class="form-group form-group-default">
                            <label>Month</label>
                            {{ date('M Y', strtotime($kpa->date))}}
                        </div>
                        <div class="form-group form-group-default">
                            <label>Status</label>
                            @if($kpa->status == 0)
                            <td><span class="badge badge-dark badge-lg"><b>Draft</b></span></td>
                            @elseif($kpa->status == '1')
                            <td>
                                @if (auth()->user()->hasRole('Manager'))
                                <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                                @else
                                <span class="badge badge-warning badge-lg"><b>Verifikasi Manager</b></span>
                                @endif
                            </td>
                            @elseif($kpa->status == '2')
                            <td><span class="badge badge-primary badge-lg"><b>Validasi HRD</b></span></td>
                            @elseif($kpa->status == '3')
                            <td><span class="badge badge-success badge-lg"><b>Done</b></span></td>
                            @elseif($kpa->status == '202')
                            <td><span class="badge badge-danger badge-lg"><b>Di Reject</b></span></td>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Objective KPI</div>
                    </div>
                    @if($kpa->status == '0')
                    <div class="btn-group btn-group-page-header ml-auto">
                        <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                    @if (auth()->user()->hasRole('Manager') && $kpa->status == '1' )
                    <div class="button-group ml-auto">
                        <button onclick="doneVerifikasi({{$kpa->id}})" class=" btn btn-sm btn-primary  "><i class="fa fa-check"></i> Done</button>
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
                                                                        <input type="text" class="form-control value" {{ in_array($kpa->status, ['1', '2']) ? 'readonly' : '' }} id="value" name="value" data-key="{{ $data->id }}" data-target="{{ $data->kpidetail->target }}" data-weight="{{ $data->kpidetail->weight }}" value="{{ old('value', $data->value) }}" autocomplete="off">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="achievement">Achievement:</label>
                                                                        <input type="text" class="form-control" id="achievement-{{$data->id}}" name="achievement" value="{{ $data->achievement }}" readonly>
                                                                    </div>
                                                                    @if($kpa->status == '0' || $kpa->status == '202')
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
                                                                    @if($kpa->status == '0')
                                                                    <div class="form-group">
                                                                        <label for="attachment">Evidence</label>
                                                                        <input type="file" class="form-control-file attachment" id="attachment" data-key="{{ $addtional->id }}" name="attachment" accept=".pdf">
                                                                        <label for="attachment">*opsional jika evidence ingin di rubah</label>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            @if($kpa->status == '0')
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
                                    <th colspan="5" class="text-right">Achievement Final</th>
                                    <th class="text-right" id="totalAchievement">{{$kpa->achievement}}</th>
                                </tr>
                            </tfoot>
                        </table>
                        @if($kpa->status == '0'|| $kpa->status == '202')
                        <small class="text-danger">* Jika anda ingin mengupdate nilai value, silahkan klik objective</small>
                        @endif
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
                                    @if($kpa->status == '0')
                                    <div class="form-group">
                                        <label for="attachment">Evidence</label>
                                        <input type="file" class="form-control-file attachment" id="attachment" name="attachment" accept=".pdf" required>
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
                    @if($kpa->status == '0')
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