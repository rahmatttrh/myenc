<!-- resources/views/components/behavior-form.blade.php -->
<div class="card shadow-none border">
    <div class="card-header bg-primary">
        <div class="card-title text-white">Behavior</div>
    </div>
    @if($pba == null)
    <form action="{{ route('qpe.behavior.store') }}" name="formBehavior" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">
        @endif
        @csrf
        <input type="hidden" name="employe_id" value="{{ $kpa->employe_id }}">
        <input type="hidden" name="kpa_id" value="{{ $kpa->id }}">
        <input type="hidden" name="pe_id" value="{{ $kpa->pe_id }}">
        <div class="card-body">
            <div class="table-responsive">
                <table class="displays table table-striped">
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
                                <a href="#" data-target="#modalBehavior-{{ $pbda->id }}" data-toggle="modal">{{ $pbda->behavior->objective }}</a>
                            </td>
                            <td>{{ $pbda->behavior->description }}</td>
                            <td>{{ $pbda->behavior->bobot }}</td>
                            <td>{{ $pbda->value }}</td>
                            <td>{{ $pbda->achievement }}</td>
                        </tr>
                        <div class="modal fade" id="modalBehavior-{{ $pbda->id }}" data-bs-backdrop="static">
                            <div class="modal-dialog" style="max-width: 50%;">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('qpe.behavior.update', $pbda->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <input type="hidden" name="id" value="{{ $pbda->id }}">
                                        <input type="hidden" name="kpa_id" value="{{ $kpa->id }}">
                                        <input type="hidden" name="pba_id" value="{{ $pbda->pba_id }}">
                                        <div class="modal-header bg-primary">
                                            <h3 class="modal-title text-white">{{ $pbda->behavior->objective }}</h3>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="objective">Objective :</label>
                                                    <input type="text" class="form-control" id="objective" name="objective" value="{{ $pbda->behavior->objective }}" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description :</label>
                                                    <textarea type="text" rows="5" class="form-control" id="description" name="description" readonly>{{ $pbda->behavior->description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="weight">Weight :</label>
                                                    <input type="text" class="form-control" id="weight" name="weight" value="{{ $pbda->behavior->bobot }}" readonly>
                                                </div>
                                                @if($pba->status == '0' || $pba->status == '1')
                                                <div class="form-group">
                                                    <label for="value">Value :</label>
                                                    <input type="text" class="form-control value" id="value" name="valBv" data-key="{{ $pbda->id }}" data-target="{{ $pbda->behavior->target }}" data-weight="{{ $pbda->behavior->weight }}" value="{{ old('value', $pbda->value) }}" autocomplete="off">
                                                </div>
                                                @endif
                                                <div class="form-group">
                                                    <label for="achievement">Achievement :</label>
                                                    <input type="text" class="form-control" id="achievementBv-{{ $pbda->id }}" name="achievement" value="{{ $pbda->achievement }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            @if($pba->status == '0' || $pba->status == '1')
                                            <button type="submit" class="btn btn-warning">Update</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                            @endif
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
                            <th><span id="totalAcvBehavior" name="totalAcvBehavior">{{ $pba->achievement }}</span></th>
                            @else
                            <th><span id="totalAcvBehavior" name="totalAcvBehavior">-</span></th>
                            @endif
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
        @if($pba == null)
    </form>
    @endif
</div>