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
                    {{-- <div class="btn-group btn-group-page-header ml-auto">
                     <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa fa-ellipsis-h"></i>
                     </button>
                     <div class="dropdown-menu">
                        
                        
                        <a  class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
                </div>
            </div> --}}
        </div>
        <div class="card-body">
            <form action="{{route('kpi.store')}}" method="POST">
                @csrf
                <div class="form-group form-group-default">
                    <label>Title</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Fill Title">
                </div>
                <div class="form-group form-group-default">
                    <label>Departement</label>
                    <select class="form-control" name="departement_id">
                        @foreach ($departements as $departement)
                        <option value="{{$departement->id}}">{{$departement->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group form-group-default">
                    <label>Posisi</label>
                    <select class="form-control" name="designation_id">
                        @foreach ($designations as $designation)
                        <option value="{{$designation->id}}">{{$designation->name}}</option>
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
<div class="col-md-8">
    <div class="card shadow-none border">
        <div class="card-header d-flex">
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
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display basic-datatables table table-striped ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Divisi</th>
                            <th>Position</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kpis as $kpi)
                        <tr>
                            <td>{{++$i}}</td>
                            <td><a href="{{'kpi/'. enkripRambo($kpi->id)}}"> {{$kpi->title}} </a></td>
                            <td>{{$kpi->departement->name}}</td>
                            <td>{{$kpi->designation->name}}</td>
                            <td class="text-right">
                                {{--<a href="{{route('kpi.edit', enkripRambo($kpi->id) )}}">Edit</a>--}}
                                <a href="#" data-toggle="modal" data-target="#modal-delete-{{$kpi->id}}">Delete</a>
                            </td>
                        </tr>
                        <x-modal.delete :id="$kpi->id" :body="$kpi->name" url="" />
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