@extends('layouts.app')
@section('title')
Employee
@endsection
@section('content')


<style>
   
</style>


<div class="page-inner">
   <div class="page-header d-flex">

      <h5 class="page-title">SPKL</h5>
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
         <li class="separator">
            <i class="flaticon-right-arrow"></i>
         </li>
         <li class="nav-item">
            <a href="#">SPKL</a>
         </li>
      </ul>
      <div class="ml-auto">
         <button class="btn btn-light border btn-round " data-toggle="dropdown">
            <i class="fa fa-ellipsis-h"></i>
         </button>
         <div class="dropdown-menu">


            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.create')}}">Create</a>
            <a class="dropdown-item" style="text-decoration: none" href="{{route('employee.import')}}">Import</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" style="text-decoration: none" href="" target="_blank">Print Preview</a>
         </div>
      </div>
   </div>

   

   <div class="row">
      
      <div class="col-md-12">
         {{-- <div class="row">
            <div class="col-md-4">
               <div class="card">
                  <div class="card-body">
                     April 12 Hours
                  </div>
               </div>
            </div>
         </div> --}}
         <div class="table-responsive p-0">
            <table id="" class="basic-datatables " >
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Date</th>
                     <th>Out</th>
                     <th>Loc</th>
                     <th style="max-width: 50px">Desc</th>
                     <th>Status</th>
                     {{-- <th></th> --}}
                     {{-- <th>Desc</th> --}}
                     
                  </tr>
               </thead>
              
               <tbody class="p-0">

                  @foreach ($spkls as $spkl)
                  <tr>
                     <td><a href="{{route('spkl.detail', enkripRambo($spkl->id))}}">{{$spkl->code}}</a></td>
                     <td>{{$spkl->employee->biodata->first_name}} {{$spkl->employee->biodata->last_name}}</td>
                     <td>{{formatDate($spkl->date)}}</td>
                     <td> {{formatTime($spkl->end)}}</td>
                     <td>{{$spkl->loc}}</td>
                     <td style="max-width: 250px" class="text-truncate">{{$spkl->desc}}</td>
                     <td>
                        <x-status.spkl :spkl="$spkl" />
                     </td>
                     {{-- <td>
                        <a href="{{route('spkl.detail')}}" class="btn btn-sm btn-primary">Detail</a>
                     </td> --}}
                  
                  </tr>
                  @endforeach
                  
                  
                  
               </tbody>
            </table>
         </div>
         
         <hr>

         <div class="row">
            <div class="col-md-7 ">
               <div class="table-responsive pl-3">
                  <table>
                     <tbody>
                        <tr>
                           <td>April</td>
                           <td>8 Hours</td>
                           <td>Mei</td>
                           <td>2 Hours</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
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