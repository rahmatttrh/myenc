@extends('layouts.app')
@section('title')
SP
@endsection
@section('content')

<div class="page-inner">
   <div class="page-header d-flex">

      <h5 class="page-title">SP</h5>
      <ul class="breadcrumbs">
         <li class="nav-home">
            <a href="/">
               <i class="flaticon-home"></i>
            </a>
         </li>
         <li class="separator">
            <i class="flaticon-right-arrow"></i>
         </li>
         <li class="nav-item">
            <a href="#">SP</a>
         </li>
      </ul>
      <div class="ml-auto">
         <button class="btn btn-light border btn-round " data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu">


            {{-- <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a> --}}
            <a class="dropdown-item" style="text-decoration: none" data-toggle="modal" data-target="#modal-export">Export</a>
            <div class="dropdown-divider"></div>
            {{-- <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a> --}}
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-md-4">
         <h4>Form Create</h4>
         <hr>
         <form action="{{route('sp.store')}}" method="POST">
            @csrf
            <div class="form-group form-group-default">
               <label>Employee</label>
               <select class="form-control" required id="employee" name="employee">
                  <option value="" selected disabled>Select Employee</option>
                  @foreach ($employees as $emp)
                  <option value="{{$emp->id}}">{{$emp->biodata->first_name}} {{$emp->biodata->last_name}} </option>
                  @endforeach
               </select>

            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Level</label>
                     <select class="form-control" required id="level" name="level">
                        <option value="" selected disabled>Select level</option>
                        <option value="I">SP I</option>
                        <option value="II">SP II</option>
                        <option value="III">SP III</option>
                     </select>

                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Berlaku dari</label>
                     <input type="date" class="form-control" name="date_from" id="date_from">
                  </div>
               </div>

               {{-- <div class="col-md-6">
                  <small class="text-muted">Masa berlaku SP adalah 6 bulan</small>
                  <hr>
               </div> --}}
               {{-- <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Berlaku sampai</label>
                     <input type="date" class="form-control"  name="date_to" id="date_to">
                  </div>
               </div> --}}
            </div>

            <div class="form-group form-group-default">
               <label>Desc</label>
               <textarea class="form-control" name="desc" id="desc"></textarea>
            </div>
            <hr>
            <button type="submit" class="btn btn-block btn-primary">Submit</button>
         </form>
      </div>

      <div class="col-md-8">
         <div class="table-responsive">
            <table id="" class="display basic-datatables table-sm table-bordered  table-striped ">
               <thead>
                  <tr>
                     <th class="text-center" style="width: 10px">No</th>
                     <th>ID</th>
                     <th>Name</th>
                     <th>NIK</th>
                     <th>Status</th>
                     <th>Level</th>
                     {{-- <th>Date</th> --}}
                     {{-- <th style="width: 50px">Desc</th> --}}
                     {{-- <th></th> --}}
                  </tr>
               </thead>
               <tbody>
                  @foreach ($sps as $sp)
                  <tr>
                     <td class="text-center">{{++$i}}</td>
                     <td><a href="{{route('sp.detail', enkripRambo($sp->id))}}">{{$sp->code}}</a> </td>
                     <td>{{$sp->employee->biodata->first_name}} {{$sp->employee->biodata->last_name}}</td>
                     <td>{{$sp->employee->nik}}</td>
                     {{-- <td>{{formatDate($sp->date)}}</td> --}}
                     <td>
                        @if ($sp->status == 0)
                        Draft
                        @elseif ($sp->status == 1)
                        Approval Manager
                        @elseif ($sp->status == 2)
                        Active
                        @elseif ($sp->status == 101)
                        Reject Manager
                        @else
                        Non-Active
                        @endif
                     </td>
                     <td>SP {{$sp->level}}</td>
                     {{-- <td class="text-truncate" style="max-width: 240px">{{$sp->desc}}</td> --}}

                  </tr>


                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>



@endsection