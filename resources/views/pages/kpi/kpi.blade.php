@extends('layouts.app')
@section('title')
Designation
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
        <div class="col-md-4">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Form Create</div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{route('kpi.store')}}" method="POST">
                        @csrf
                        <div class="form-group form-group-default">
                            <label>Title</label>
                            <input id="title" name="title" type="text" class="form-control" required placeholder="Fill Title">
                        </div>
                        <div class="form-group form-group-default">
                            <label>Bisnis Unit</label>
                            <select class="form-control" name="unit_id" id="unit_id">
                                <option value="">--Pilih Bisnis Unit--</option>
                                @foreach ($units as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-group-default boxDepartment">
                            <label>Departement</label>
                            <select class="form-control" name="departement_id" id="department_id">

                            </select>
                        </div>
                        <div class="form-group form-group-default boxSubDept">
                            <label>Sub Department</label>
                            <select class="form-control" name="sub_dept_id" id="sub_dept_id">

                            </select>
                        </div>
                        <div class="form-group form-group-default boxDesignation">
                            <label>Jabatan</label>
                            <select class="form-control" name="position_id" required id="designation_id">

                            </select>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Add</button>

                    </form>
                </div>
                <div class="card-footer">
                    {{-- <small>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni at neque inventore vel.</small> --}}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-none border">
                {{-- <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">KPI List</div>
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
                </div> --}}
                <div class="card-body p-0 py-2">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display basic-datatables table-sm  ">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Title</th>
                                    <th>Divisi</th>
                                    <th>Jabatan</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kpis as $kpi)
                                <tr>
                                    <td class="text-center">{{++$i}}</td>
                                    <td><a href="{{'kpi/'. enkripRambo($kpi->id)}}">
                                        @if (auth()->user()->hasRole('Administrator'))
                                        {{$kpi->id}}
                                        @endif
                                        {{$kpi->title}} </a></td>
                                    <td>
                                        @if (auth()->user()->hasRole('Administrator'))
                                            {{$kpi->department->id}} -
                                        @endif
                                        {{$kpi->departement->name}}</td>
                                    <td>
                                        @if (auth()->user()->hasRole('Administrator'))
                                            {{$kpi->position->id}} -
                                        @endif
                                        {{$kpi->position->name ?? '-'}}</td>
                                    <td class="text-right">
                                        {{--<a href="{{route('kpi.edit', enkripRambo($kpi->id) )}}">Edit</a>--}}
                                        @if (auth()->user()->hasRole('Leader|Supervisor'))
                                        -
                                            @else
                                            <a href="#" data-toggle="modal" data-target="#modal-delete-{{$kpi->id}}">Delete</a>
                                        @endif
                                        
                                    </td>
                                </tr>
                                <x-modal.delete :id="$kpi->id" :body="$kpi->title" url="{{route('kpi.delete', enkripRambo($kpi->id))}}" />
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js_footer')
<script>
    $(document).ready(function() {

        let host = 'http://' + window.location.hostname + ':' + window.location.port;

        $('.boxDepartment').hide();
        $('.boxSubDept').hide();
        $('.boxDesignation').hide();

        $('#unit_id').change(function() {
            let id = $(this).val();

            // Permintaan (request) GET menggunakan jQuery
            $.ajax({
                url: host + '/unit/fetch-data/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Menampilkan response 
                    // Bersihkan opsi yang ada sebelumnya
                    $('#department_id').empty();
                    $('.boxDepartment').show();

                    $('.boxSubDept').hide();
                    $('.boxDesignation').hide();

                    // Tambahkan opsi pertama (default)
                    $('#department_id').append('<option value="">-- Pilih Departemen --</option>');

                    // Loop melalui response.departments
                    $.each(response.departments, function(index, department) {
                        // Tambahkan opsi baru ke dalam elemen select
                        $('#department_id').append('<option value="' + department.id + '">' + department.name + '</option>');
                    });

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

        });

        $('#department_id').change(function() {
            let id = $(this).val();

            // Permintaan (request) GET menggunakan jQuery
            $.ajax({
                url: host + '/department/fetch-data/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    $('.boxSubDept').hide();
                    $('.boxDesignation').hide();

                    $('#designation_id').empty();
                    $('#sub_dept_id').empty();

                    // ada 2 kondisi , jika departement tersebut memiliki sub divisi
                    if (response.jmlSubDept == 1) {
                        // Langsung munculkan dan tampilkan data posisi atau jabatan 
                        // Menampilkan response 
                        // Bersihkan opsi yang ada sebelumnya
                        $('.boxDesignation').show();

                        // Tambahkan opsi pertama (default)
                        $('#designation_id').append('<option value="">-- Pilih Jabatan --</option>');

                        // Loop melalui response.departments
                        $.each(response.positions, function(index, position) {
                            // Tambahkan opsi baru ke dalam elemen select
                            $('#designation_id').append('<option value="' + position.id + '">' + position.name + '</option>');
                        });


                    } else {
                        // pilih sub dept terlebih dahulu
                        $('.boxSubDept').show();

                        // Tambahkan opsi pertama (default)
                        $('#sub_dept_id').append('<option value="">-- Pilih Sub Department --</option>');

                        // Loop melalui response.departments
                        $.each(response.subDepts, function(index, subdept) {
                            // Tambahkan opsi baru ke dalam elemen select
                            $('#sub_dept_id').append('<option value="' + subdept.id + '">' + subdept.name + '</option>');
                        });
                    }

                    // console.log(response.subDepts);




                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

        });

        $('#sub_dept_id').change(function() {
            let id = $(this).val();

            // Permintaan (request) GET menggunakan jQuery
            $.ajax({
                url: host + '/sub-dept/fetch-data/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Menampilkan response 
                    // Bersihkan opsi yang ada sebelumnya
                    $('#designation_id').empty();
                    // Menampilkan response 
                    // Bersihkan opsi yang ada sebelumnya
                    $('.boxDesignation').show();

                    // Tambahkan opsi pertama (default)
                    $('#designation_id').append('<option value="">-- Pilih Jabatan --</option>');

                    // Loop melalui response.departments
                    $.each(response.positions, function(index, position) {
                        // Tambahkan opsi baru ke dalam elemen select
                        $('#designation_id').append('<option value="' + position.id + '">' + position.name + '</option>');
                    });

                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

        });

    });
</script>

@endpush