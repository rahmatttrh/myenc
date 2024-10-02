@extends('layouts.app')
@section('title')
Payroll Additional
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Additional</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         <h4>Form add Additional</h4>
         <hr>
         <form action="{{route('payroll.additional.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
            <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
            <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
            <div class="form-group form-group-default">
               <label>Employee</label>
               <select class="form-control js-example-basic-single" style="width: 100%" required name="employee" id="employee">
                  <option value="" disabled selected>Select</option>
                  @foreach ($employees as $emp)
                      <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                  @endforeach
               </select>
               {{-- <input type="number" class="form-control" id="hours" name="hours" > --}}
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input type="date" required class="form-control" id="date" name="date" >
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Type</label>
                     <select class="form-control " required name="type" id="type">
                        <option value="" disabled selected>Select</option>
                        <option value="1">Penambahan</option>
                        <option value="2">Pengurangan</option>
                     </select>
                  </div>
               </div>
               
               
            </div>
            <div class="row">
               
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Value(Rupiah)</label>
                     <input type="number" required class="form-control" id="value" name="value" >
                  </div>
               </div>

            </div>
            <div class="form-group form-group-default">
               <label>Description</label>
               <input type="text"  class="form-control" id="desc" name="desc" >
            </div>
            <div class="form-group form-group-default">
               <label>Document</label>
               <input type="file"  class="form-control" id="doc" name="doc" >
            </div>
            
            
            <button class="btn btn-block btn-primary" type="submit">Add</button>
         </form>
         <hr>
         <small>
            Data pada form ini akan <b>Menambah / Mengurangi</b> nilai Transaksi Gaji Karyawan
         </small>
      </div>
      <div class="col">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     {{-- <th class="text-center">No</th> --}}
                     <th>Type</th>
                     <th>Employee</th>
                     <th class="">Date</th>
                     <th class="text-center">Value</th>
                     {{-- <th class="">Desc</th> --}}
                     <th></th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($additionals as $add)
                      <tr>
                        <td>
                           @if ($add->type == 1)
                               Penambah
                               @else
                               Pengurang
                           @endif
                        </td>
                        <td class="text-truncate">
                           {{$add->employee->nik}} {{$add->employee->biodata->fullName()}}
                        </td>
                        <td><a href="#" data-target="#modal-additional-doc-{{$add->id}}" data-toggle="modal">{{formatDate($add->date)}}</a></td>
                        <td class="text-right text-truncate">{{formatRupiah($add->value)}}</td>
                        {{-- <td>{{$add->desc}}</td> --}}
                        <td><a href="#" data-target="#modal-delete-additional-{{$add->id}}" data-toggle="modal">Delete</a></td>
                      </tr>

                      <div class="modal fade" id="modal-delete-additional-{{$add->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                           <div class="modal-content text-dark">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body ">
                                 Delete data 
                                 @if ($add->type == 1)
                                    Penambah
                                    @else
                                    Pengurang
                                 @endif
                                 {{$add->employee->nik}} {{$add->employee->biodata->fullName()}}
                                 tanggal {{formatDate($add->date)}}
                                 ?
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                 <button type="button" class="btn btn-danger ">
                                    <a class="text-light" href="{{route('payroll.additional.delete', enkripRambo($add->id))}}">Delete</a>
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>

@foreach ($additionals as $additional)
<div class="modal fade" id="modal-additional-doc-{{$additional->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Document Additional</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="modal-body">
         <div class="form-group form-group-default">
            <label>Desc</label>
            <b>{{$additional->desc}}</b>
         </div>
         <iframe src="{{asset('storage/' . $additional->doc)}}" frameborder="0" style="width:100%"  height="500px"></iframe>
        </div>
      </div>
   </div>
</div>
@endforeach





@endsection