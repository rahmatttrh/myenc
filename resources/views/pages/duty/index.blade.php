@extends('layouts.app')
@section('title')
Employee
@endsection
@section('content')


<style>
   table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table td, table th {
  border: 1px solid #ddd;
  padding: 4px;
}

table tr:nth-child(even){background-color: #f2f2f2;}

table tr:hover {background-color: #ddd;}

table th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #478091;
  color: white;
}
</style>


<div class="page-inner">
   <div class="page-header d-flex">

      <h5 class="page-title">SPT</h5>
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
            <a href="#">SPT</a>
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
      <div class="col-md-3">
         <form action="">
            <div class="row">
               <div class="col-md-12">
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input id="Name" type="date" class="form-control" placeholder="Fill Name">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>Start</label>
                     <input id="Name" type="time" class="form-control" placeholder="Fill Name">
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group form-group-default">
                     <label>End</label>
                     <input id="Name" type="time" class="form-control" placeholder="Fill Name">
                  </div>
               </div>
            </div>
            <div class="form-group form-group-default">
               <label>Location</label>
               <select class="form-control" name="" id="">
                  <option value="">HW</option>
                  <option value="">JGC</option>
                  <option value="">KJ</option>
                  <option value="">GS</option>
               </select>
               {{-- <input id="Name" type="text" class="form-control" > --}}
            </div>
            <div class="form-group form-group-default">
               <label>Desc</label>
               <input id="Name" type="text" class="form-control" placeholder="Deskripsi pekerjaan" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
         </form>
      </div>
      <div class="col-md-9">
         <div class="table-responsive p--0">
            <table id="basic-datatables" class="basic-datatables " >
               <thead>
                  <tr>
                     
                     <th>Date</th>
                     <th>Time</th>
                     <th>Loc</th>
                     <th style="max-width: 50px">Desc</th>
                     <th>Status</th>
                     {{-- <th></th> --}}
                     {{-- <th>Desc</th> --}}
                     
                  </tr>
               </thead>
              
               <tbody>
                  <tr>
                     
                     <td><a href="{{route('spkl.detail')}}">19/04/24</a></td>
                     <td>17.00 - 21.00</td>
                     <td>HW</td>
                     <td style="max-width: 300px" class="text-truncate">Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque, sed suscipit perferendis dolorum quis nesciunt! Amet aliquid temporibus possimus eius. Expedita, quae in!</td>
                     <td>Approved</td>
                     {{-- <td>
                        <a href="{{route('spkl.detail')}}" class="btn btn-sm btn-primary">Detail</a>
                     </td> --}}
                  
                  </tr>
                  <tr>
                     
                     <td><a href="{{route('spkl.detail')}}">18/04/24</a></td>
                     <td>17.00 - 20.00</td>
                     <td>HW</td>
                     <td style="max-width: 250px" class="text-truncate">Consectetur adipisicing elit. Itaque, sed suscipit perferendis dolorum quis nesciunt! Amet aliquid temporibus possimus eius. Expedita, quae in!</td>
                     <td>Approved</td>
                     {{-- <td>
                        <a href="" class="btn btn-sm btn-primary">Detail</a>
                     </td> --}}
                  
                  </tr>
                  
               </tbody>
            </table>
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