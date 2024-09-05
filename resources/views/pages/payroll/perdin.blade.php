@extends('layouts.app')
@section('title')
PERDIN
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         {{-- <li class="breadcrumb-item" aria-current="page">Payroll</li> --}}
         <li class="breadcrumb-item active" aria-current="page">PERDIN</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-4">
         <h4>Form add PERDIN</h4>
         <hr>
         <form action="{{route('perdin.store')}}" method="POST" enctype="multipart/form-data">
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
                     <label>Value(Rp.)</label>
                     <input type="number" required class="form-control" id="value" name="value" >
                  </div>
               </div>
               
               
            </div>
            
            <div class="form-group form-group-default">
               <label>Desc</label>
               <input type="text"  class="form-control" id="desc" name="desc" >
            </div>
            
            
            <button class="btn btn-block btn-primary" type="submit">Add</button>
         </form>
         <hr>
         <small>
            Data pada form ini <b>Tidak Mempengaruhi</b> nilai Transaksi Gaji Karyawan
         </small>
        
      </div>
      <div class="col">
         <div class="table-responsive">
            <table id="data" class="display basic-datatables table-sm">
               <thead>
                  <tr>
                     <th>Employee</th>
                     <th >Date</th>
                     <th class="text-right">Value</th>
                     <th></th>
                  </tr>
               </thead>
               
               <tbody>
                  @foreach ($perdins as $perdin)
                      <tr>
                        <td>{{$perdin->employee->nik}} {{$perdin->employee->biodata->fullName()}}</td>
                        <td>{{formatDate($perdin->date)}}</td>
                        <td>{{formatRupiah($perdin->value)}}</td>
                      </tr>
                  @endforeach
               </tbody>
               
            </table>
         </div>
      </div>
   </div>
   
   
   
</div>


{{-- @foreach ($overtimes as $over)
<div class="modal fade" id="modal-overtime-doc-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Document SPKL</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
        <div class="modal-body">

         <iframe src="{{asset('storage/' . $over->doc)}}" frameborder="0" style="width:100%"  height="500px"></iframe>
        </div>
      </div>
   </div>
</div>
@endforeach --}}


@endsection