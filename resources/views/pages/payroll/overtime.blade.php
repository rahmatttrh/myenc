@extends('layouts.app')
@section('title')
SPKL
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">SPKL</li>
      </ol>
   </nav>
   {{-- <div class="page-header d-flex">

      <h5 class="page-title">Active Employee</h5>
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
            <a href="#">Employee</a>
         </li>
      </ul>
      <div class="ml-auto">
         <button class="btn btn-light border btn-round " data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu">


            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
            <a class="dropdown-item" style="text-decoration: none"  data-toggle="modal" data-target="#modal-export">Export</a>
            <div class="dropdown-divider"></div></div>
      </div>
   </div> --}}
   <div class="tab-content" id="v-pills-tabContent">
      <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
         <div class="card card-with-nav shadow-none border">
            <div class="card-header">
               <div class="row row-nav-line">
                  <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                     <li class="nav-item"> <a class="nav-link show active" id="pills-basic-tab-nobd" data-toggle="pill" href="#pills-basic-nobd" role="tab" aria-controls="pills-basic-nobd" aria-selected="true">List</a> </li>
                     <li class="nav-item"> <a class="nav-link " id="pills-doc-tab-nobd" data-toggle="pill" href="#pills-doc-nobd" role="tab" aria-controls="pills-doc-nobd" aria-selected="true"> Create</a> </li>
                     <li class="nav-item"> <a class="nav-link " id="pills-bpjs-tab-nobd" data-toggle="pill" href="#pills-bpjs-nobd" role="tab" aria-controls="pills-bpjs-nobd" aria-selected="true">Import</a> </li>
                  </ul>
               </div>
            </div>
            <div class="card-body">
               <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                  <div class="tab-pane fade show active" id="pills-basic-nobd" role="tabpanel" aria-labelledby="pills-basic-tab-nobd">
                     <div class="row">
                        <div class="col-md-3">
                           <h4>Form Filter Data</h4>
                           <hr>
                           <form action="{{route('payroll.overtime.filter')}}" method="POST">
                              @csrf
                              <div class="row">
                                 {{-- <div class="col-md-3 ">
                                    <div class="form-group form-group-default">
                                       <label>Month</label>
                                       <select class="form-control " required name="month" id="month">
                                          <option value="" disabled selected>Select</option>
                                          <option {{$month == 'all' ? 'selected' : '' }} value="all">All</option>
                                          <option {{$month == 'January' ? 'selected' : '' }} value="January">January</option>
                                          <option {{$month == 'February' ? 'selected' : '' }} value="February">February</option>
                                          <option {{$month == 'March' ? 'selected' : '' }} value="March">March</option>
                                          <option {{$month == 'April' ? 'selected' : '' }} value="April">April</option>
                                          <option {{$month == 'May' ? 'selected' : '' }} value="May">May</option>
                                          <option {{$month == 'June' ? 'selected' : '' }} value="June">June</option>
                                          <option {{$month == 'July' ? 'selected' : '' }} value="July">July</option>
                                          <option {{$month == 'August' ? 'selected' : '' }} value="August">August</option>
                                          <option {{$month == 'September' ? 'selected' : '' }} value="September">September</option>
                                          <option {{$month == 'October' ? 'selected' : '' }} value="October">October</option>
                                          <option {{$month == 'November' ? 'selected' : '' }} value="November">November</option>
                                          <option {{$month == 'December' ? 'selected' : '' }} value="December">December</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-md-3 ">
                                    <div class="form-group form-group-default">
                                       <label>Year</label>
                                       <select class="form-control " required name="year" id="year">
                                          <option value="" disabled selected>Select</option>
                                          <option {{$year == 'all' ? 'selected' : ''}} value="all">All</option>
                                          <option {{$year == '2024' ? 'selected' : ''}} value="2024">2024</option>
                                          <option {{$year == '2025' ? 'selected' : ''}} value="2025">2025</option>
                                       </select>
                                    </div>
                                 </div> --}}
                                 <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                       <label>From</label>
                                       <input type="date" name="from" id="from" value="{{$from}}" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="form-group form-group-default">
                                       <label>To</label>
                                       <input type="date" name="to" id="to" value="{{$to}}" class="form-control">
                                    </div>
                                 </div>
                                 <div class="col">
                                    <button class="btn btn-primary" type="submit" >Filter</button>
                                 </div>
                              </div>
                           </form>   
                        </div>
                        <div class="col">
                           <div class="table-responsive">
                              <table id="data" class="display basic-datatables table-sm">
                                 <thead>
                                    <tr>
                                       <th>Type</th>
                                       <th>Employee</th>
                                       <th class="text-right">Date</th>
                                       
                                       <th class="text-center">Hours</th>
                                       <th class="text-right">Rate</th>
                                       <th>-</th>
                                    </tr>
                                 </thead>
                                 
                                 <tbody>
                                    @foreach ($overtimes as $over)
                                        <tr>
                                          {{-- <td>{{++$i}}</td> --}}
                                          <td>
                                             @if (auth()->user()->hasRole('Administrator'))
                                                 {{$over->id}}
                                             @endif
                                             
                                             @if ($over->type == 1)
                                                 Lembur
                                                 @else
                                                 Piket
                                             @endif
                                          </td>
                                          <td>{{$over->employee->nik}} {{$over->employee->biodata->fullName()}}</td>
                                          <td class="text-right">
                                             @if ($over->holiday_type == 1)
                                                <span  class="text-info ">
                                                @elseif($over->holiday_type == 2)
                                                <span class="text-danger">
                                                @elseif($over->holiday_type == 3)
                                                <span class="text-danger">LN -
                                                @elseif($over->holiday_type == 4)
                                                <span class="text-danger">LR -
                                             @endif
                                             <a href="#" data-target="#modal-overtime-doc-{{$over->id}}" data-toggle="modal" class="text-white">{{formatDate($over->date)}}</a>
                                             </span>
                                          </td>
                                          
                                          
                                          <td class="text-center">{{$over->hours}} </td>
                                          <td class="text-right">{{formatRupiah($over->rate)}}</td>
                                          <td>
                                             <a href="#" data-target="#modal-delete-overtime-{{$over->id}}" data-toggle="modal">Delete</a>
                                          </td>
                                        </tr>
                  
                                       <div class="modal fade" id="modal-delete-overtime-{{$over->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                   @if ($over->type == 1)
                                                      Lembur
                                                      @else
                                                      Piket
                                                   @endif
                                                   {{$over->employee->nik}} {{$over->employee->biodata->fullName()}}
                                                   tanggal {{formatDate($over->date)}}
                                                   ?
                                                </div>
                                                <div class="modal-footer">
                                                   <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                                                   <button type="button" class="btn btn-danger ">
                                                      <a class="text-light" href="{{route('payroll.overtime.delete', enkripRambo($over->id))}}">Delete</a>
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
      
                  <div class="tab-pane fade" id="pills-doc-nobd" role="tabpanel" aria-labelledby="pills-doc-tab-nobd">
                     <form action="{{route('payroll.overtime.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                           <div class="col-6">
                              
                                 {{-- <input type="number" name="employee" id="employee" value="{{$transaction->employee_id}}" hidden>
                                 <input type="number" name="spkl_type" id="spkl_type" value="{{$transaction->employee->unit->spkl_type}}" hidden>
                                 <input type="number" name="transaction" id="transaction" value="{{$transaction->id}}" hidden> --}}
                                 <div class="form-group form-group-default">
                                    <label>Employee KJ 4-5</label>
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
                                          <label>Piket/Lembur</label>
                                          <select class="form-control " required name="type" id="type">
                                             <option value="" disabled selected>Select</option>
                                             <option value="1">Lembur</option>
                                             <option value="2">Piket</option>
                                          </select>
                                       </div>
                                    </div>
                                    
                                    
                                 </div>
                                 <div class="row">
                                    <div class="col">
                                       <div class="form-group form-group-default">
                                          <label>Masuk/Libur</label>
                                          <select class="form-control " required name="holiday_type" id="holiday_type">
                                             <option value="" disabled selected>Select</option>
                                             <option value="1">Masuk</option>
                                             <option value="2">Libur Off</option>
                                             <option value="3">Libur Nasional</option>
                                             <option value="4">Idul Fitri</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col">
                                       <div class="form-group form-group-default">
                                          <label>Hours</label>
                                          <input type="number" class="form-control" id="hours" name="hours" >
                                       </div>
                                    </div>
                     
                                 </div>
                                 <div class="form-group form-group-default">
                                    <label>Note</label>
                                    <input type="text"  class="form-control" id="desc" name="desc" >
                                 </div>
                                 
                                 
                                 
                                 
                              
                           </div>
                           <div class="col">
                              <div class="form-group form-group-default">
                                 <label>Document</label>
                                 <input type="file"  class="form-control" id="doc" name="doc" >
                              </div>
                              <button class="btn btn-primary" type="submit">Add</button>
                           </div>
                        </div>
                     </form>
                     
                  </div>

                  <div class="tab-pane fade " id="pills-bpjs-nobd" role="tabpanel" aria-labelledby="pills-bpjs-tab-nobd">
                     <div class="row">
                        <div class="col-md-5">
                           <img src="{{asset('img/xls-file.png')}}" class="img mb-4" height="110" alt="">
                           <form action="{{route('overtime.import.store')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="form-group ">
                                 <label>File Excel</label>
                                 <input id="excel" name="excel" type="file" class="form-control-file">
                                 @error('excel')
                                 <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                              <hr>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-primary">Import</button>
                              </div>
            
                           </form>
                        </div>
                        <div class="col-md-7">
                           <div class="card card-light border shadow-none">
                              <div class="card-body ">
                                 {{-- <div class="card-opening">Import Excel</div> --}}
                                 
                                 <div class="card-detail">
                                    <a href="/documents/template-spkl-rev.xlsx" class="btn btn-success btn-rounded">Download Template</a>
                                 </div>
                                 {{-- <div class="card-desc text-left">
                                    Kolom Business Unit, Department, Sub Department, Position diisi dengan angka ID yang bisa dilihat di Master Data
                                 </div> --}}
                              </div>
                              <div class="card-footer">
                                 <b>Panduan Pengisian Template Excel SPKL</b>
                                 <hr>
                                    - Kolom Type hanya bisa di isi ' <b>Lembur atau Piket</b> '<br>
                                    - Kolom Tipe Libur hanya bisa di isi ' <b>Masuk, Libur, Libur Nasional, Idhul Fitri</b> ' <br>
                                 
                                    
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
      
      
               </div>
      
            </div>
         </div>
      </div>
   </div>

   
   
</div>

<div class="modal fade" id="modal-export" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Excel</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         
         <div class="modal-body">

           
            
         </div>
         <div class="modal-footer">
            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">SIMPLE DATA</button> --}}
            {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
            <a  href="{{route('employee.export.simple')}}" class="btn btn-info">SIMPLE DATA</a>
            <a  href="{{route('employee.export')}}" class="btn btn-primary">FULL DATA</a>
         </div>
      </div>
   </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script>
   

   $(document).ready(function() {
      $('.tanggal').datepicker({
         format: "yyyy-mm-dd",
         autoclose: true
      });
   });

   var total = document.getElementById("total");

   $(function() {

      $("#selectall").change(function() {
         if (this.checked) {
            $(".case").each(function() {
               this.checked = true;
            });
            var jumlahCheck = $(".case").length;
         } else {
            $(".case").each(function() {
               this.checked = false;
            });
            var jumlahCheck = 0;
         }

         // menampilkan output ke elemen hasil
         total.innerHTML = jumlahCheck;
         // console.log(jumlahCheck);
      });

      $(".case").click(function() {
         if ($(this).is(":checked")) {
            var isAllChecked = 0;
            var jumlahCheck = $('input:checkbox:checked').length;

            $(".case").each(function() {
               if (!this.checked)
                  isAllChecked = 1;
            });

            if (isAllChecked == 0) {
               $("#selectall").prop("checked", true);

               jumlahCheck = $(".case").length;
            }


         } else {
            $("#selectall").prop("checked", false);

            jumlahCheck = $('input:checkbox:checked').length;
         }
         total.innerHTML = jumlahCheck;
         console.log(jumlahCheck);

      });


   });
</script>
@endsection