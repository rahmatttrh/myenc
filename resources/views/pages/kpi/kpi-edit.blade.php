@extends('layouts.app')
@section('title')
KPI
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">KPI</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">{{$kpi->title}}</div>
                    </div>

                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="form-group form-group-default">
                            <label>Department</label>
                            <i class="fa fa-user"></i> {{$kpi->departement->name}}
                        </div>
                        <div class="form-group form-group-default">
                            <label>Jabatan</label>
                            <i class="fa fa-user"></i> {{$kpi->position->name}}
                        </div>
                    </form>
                </div>
            </div>


            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Form Create</div>
                    </div>

                </div>
                <div class="card-body">
                    <form action="{{route('kpidetail.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="kpi_id" value="{{$kpi->id}}">
                        <input type="hidden" name="metode" value="cum">
                        <div class="form-group form-group-default">
                            <label>Objective</label>
                            <textarea required name="objective" id="" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group form-group-default">
                            <label>KPI</label>
                            <textarea required name="kpi" id="" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group form-group-default">
                            <label>Weight</label>
                            <input required placeholder="0-100" min="1" id="weight" name="weight" type="number" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Target</label>
                            <input required value="4" id="target" name="target" type="text" class="form-control">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Priode Target</label>
                            <input required placeholder="Daily/Weekly/Monthly" id="priode_target" name="priode_target" type="text" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Add</button>

                    </form>
                </div>
                <div class="card-footer">
                    <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni at neque inventore vel.</small>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!-- Table Objective KPI -->
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Objective KPI</div>
                    </div>
                    <div class="btn-group btn-group-page-header ml-auto">
                        <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-ellipsis-h"></i>
                        </button>
                        <div class="dropdown-menu">


                            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display basic-datatables table table-striped ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Objective</th>
                                    <th>KPI</th>
                                    <th>Weight</th>
                                    <th>Target</th>
                                    <th>Priode Target</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td><a href="" data-toggle="modal" data-target="#detail-{{$data->id}}"> {{$data->objective}}</a></td>
                                    <td>{{$data->kpi}}</td>
                                    <td><b> {{$data->weight}} % </b></td>
                                    <td> <a href="" data-toggle="modal" data-target="#poin-{{$data->id}}"> <i>{{$data->target}}</i> </a></td>
                                    <td>{{$data->priode_target}}</td>
                                    <td class="text-right">
                                        {{--<a href="{{route('data.edit', enkripRambo($data->id) )}}">Edit</a>--}}
                                        <a href="#" data-toggle="modal" data-target="#modal-delete-{{$data->id}}">Delete</a>
                                    </td>
                                </tr>
                                <x-modal.delete :id="$data->id" :body="$data->objective" url="{{route('kpi.objective.delete', enkripRambo($data->id))}}" />

                                <!-- Modal -->
                                <div class="modal fade " id="detail-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form>
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel"><br><i>{{$data->objective}}</i></h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="card shadow-none border">
                                                                <div class="card-header d-flex">
                                                                    <div class="d-flex  align-items-center">
                                                                        <div class="card-title">Detail</div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="form-group form-group-default">
                                                                        <label>Objective</label>
                                                                        {{$data->objective}}
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>KPI</label>
                                                                        {{$data->kpi}}
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Weight</label>
                                                                        {{$data->weight}} %
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Target</label>
                                                                        {{$data->target}}
                                                                    </div>
                                                                    <div class="form-group form-group-default">
                                                                        <label>Priode Target</label>
                                                                        {{$data->priode_target}}

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                        $points = $data->points;
                                                        @endphp
                                                        <div class="col-md-6">
                                                            <div class="card shadow-none border">
                                                                <div class="card-header d-flex">
                                                                    <div class="d-flex  align-items-center">
                                                                        <div class="card-title">KPI Point</div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body">

                                                                    @if($points->count() > 0)
                                                                    @foreach ($points as $point)

                                                                    <div class="form-group form-group-default">
                                                                        <div class="d-flex justify-content-between mb-3">
                                                                            <label>
                                                                                <h3>{{ $point->point }}</h3>
                                                                            </label>
                                                                            <a href="{{route('kpi.point.delete', enkripRambo($point->id))}}" class="btn btn-danger btn-xs"> <i class="fas fa-trash"></i> </a>
                                                                        </div>
                                                                        {{$point->keterangan}}
                                                                    </div>
                                                                    @endforeach
                                                                    @else
                                                                    <div class="form-group form-group-default">
                                                                        <label>
                                                                        </label>
                                                                        - Tidak ada data KPI poin -
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade " id="poin-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="{{route('kpi.point.store')}}" method="POST">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Create KPI Poin <br><i>{{$data->objective}}</i></h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card shadow-none border">
                                                        <div class="card-header d-flex">
                                                            <div class="d-flex  align-items-center">
                                                                <div class="card-title">Form Create KPI Poin</div>
                                                            </div>
                                                        </div>
                                                        <div class="card-body">
                                                            @csrf
                                                            <input type="hidden" name="kpi_id" value="{{$kpi->id}}">
                                                            <input type="hidden" name="pekpi_detail_id" value="{{$data->id}}">
                                                            <div class="form-group form-group-default">
                                                                <label>Poin</label>
                                                                <input required value="4" id="point" min="1" max="4" name="point" type="number" class="form-control">
                                                            </div>
                                                            <div class="form-group form-group-default">
                                                                <label>Keterangan</label>
                                                                <textarea required name="keterangan" id="" class="form-control" rows="5"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                @endforeach
                            </tbody>
                        </table>
                        <small class="text-danger">*Untuk melihat KPI Point silahkan klik data pada kolom objective </small>
                        <br>
                        <small class="text-danger">*Dan untuk menambahkan KPI Point silahkan klik data pada kolom target</small>
                    </div>
                </div>
            </div>
            <!--  -->
            <div class="row">

                <div class="col-md-6">
                    <!-- Table User  -->
                    <div class="card shadow-none border">
                        <div class="card-header d-flex">
                            <div class="d-flex  align-items-center">
                                <div class="card-title">Employees With This KPI</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display  table table-striped ">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $no=1;
                                        @endphp
                                        @foreach ($users as $user)

                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$user->biodata->fullName()}}</td>
                                            <td class="text-right">
                                                <a href="" data-toggle="modal" class="text-danger" data-target="#modal-revoke-{{$user->id}}">Revoke</a>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-revoke-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form action="{{route('kpi.revoke.user', $user->id)}}" method="post">
                                                        @csrf
                                                        @method('patch')
                                                        <input type="hidden" name="kpi_id" value="{{$kpi->id}}">
                                                        <input type="hidden" name="employe_id" value="{{$user->id}}">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Revoke {{$user->biodata->fullName()}} from This KPI ?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Revoke
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Table -->
                </div>
                <!-- Form Assign KPI -->
                <div class="col-md-5">
                    <div class="card shadow-none border">
                        <div class="card-header d-flex">
                            <div class="d-flex  align-items-center">
                                <div class="card-title">Add User To KPI</div>
                            </div>

                        </div>
                        <div class="card-body">
                            <form action="{{route('kpi.add.user')}}" method="POST">
                                @csrf
                                <input type="hidden" name="kpi_id" value="{{$kpi->id}}">
                                <div class="form-group form-group-default">
                                    <label>Employe</label>
                                    <select class="form-control" name="employe_id">
                                        @foreach ($employes as $employe)
                                        <option value="{{$employe->id}}">{{$employe->biodata->first_name}} {{$employe->biodata->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-block btn-primary">Add</button>

                            </form>
                        </div>
                        <div class="card-footer">
                            <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni at neque inventore vel.</small>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection