<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Marie Curie -->'
    <div class="card shadow-none border">
        <div class="card-header d-flex bg-primary">
            <div class="d-flex  align-items-center">
                <div class="card-title text-white">KPI</div>
            </div>
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
                                                        </div>

                                                    </form>
                                                </div>

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
                            <th colspan="4" class="text-right">Achievement </th>
                            <th>{{$valueAvg}}</th>
                            <th class="text-right" id="totalAchievement">{{$kpa->achievement}}</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-right">Achievement Final
                                <br><small>Achievement * ( {{$kpa->weight}} / 100)</small>
                            </th>
                            <th class="text-right" id="totalAchievement">{{$kpa->contribute_to_pe}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>