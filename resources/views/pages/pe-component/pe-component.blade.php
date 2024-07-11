@extends('layouts.app')
@section('title')
Department
@endsection
@section('content')

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Komponen - Perfomance Evaluation</li>
        </ol>
    </nav>
    <div class="card shadow-none border">
      <div class="card-header d-flex">
          <div class="d-flex  align-items-center">
              <div class="card-title">Komponen - Perfomance Evaluation</div>
          </div>
          <div class="btn-group btn-group-page-header ml-auto">
              <button type="button" class="btn btn-light btn-round btn-page-header-dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu">


                  {{-- <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a> --}}
                  {{-- <div class="dropdown-divider"></div>            --}}
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
              </div>
          </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table id="basic-datatables" class="display basic-datatables table-sm table-striped ">
                  {{-- id="basic-datatables" class="display table table-striped table-hover" --}}
                  <thead>
                      <tr>
                          {{-- <th>No</th> --}}
                          <th>Group</th>
                          <th>Komponen</th>
                          <th>Bobot</th>

                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($groups as $group)
                      <tr>
                          {{-- <td rowspan="{{$group->components->count()}}">{{++$i}}</td> --}}
                          <td rowspan=" {{$group->components->count()}}">{{$group->name}}</td>
                          @foreach ($group->components as $component)
                          <!-- <tr> -->

                          <td>{{$component->name}}</td>
                          <td>{{$component->weight}}%</td>
                      </tr>

                      @endforeach
                      <!-- <td>{{$group->weight}} % </td> -->
                      </tr>

                      <tr>
                          <td colspan="4"></td>
                      </tr>

                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>


@endsection