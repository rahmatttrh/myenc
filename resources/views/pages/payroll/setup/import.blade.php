@extends('layouts.app')
@section('title')
Payroll Import
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item" aria-current="page">Setup Payroll</li>
         <li class="breadcrumb-item active" aria-current="page">Import</li>
      </ol>
   </nav>
   
   <div>
      
      <div class="card shadow-none border">
         <div class="card-header d-flex">
            <div class="d-flex  align-items-center">
               <div class="card-title">Payroll Import by Excel</div>
            </div>
   
         </div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-5">
                  <img src="{{asset('img/xls-file.png')}}" class="img mb-4" height="110" alt="">
                  <form action="{{route('payroll.import.store')}}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group ">
                        <label>File Excel</label>
                        <input id="excel" name="excel" required type="file" class="form-control-file">
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
                        <div class="">
                           Fitur ini digunakan untuk import data-data Gaji Karyawan seperti : <br><br>
                           - Gaji Pokok <br>
                           - Tunjangan Jabatan <br>
                           - Tunjangan Operasional <br>
                           - Tunjangan Kinerja <br>
                           - Tunjangan Fungsional <br>
                           - Insentif <br>
                        </div>
                        <hr>
                        <div class="card-detail">
                           <a href="/documents/template-gaji-karyawan.xlsx" class="btn btn-success btn-rounded">Download Template</a>
                        </div>
                        {{-- <div class="card-desc text-left">
                           Kolom Business Unit, Department, Sub Department, Position diisi dengan angka ID yang bisa dilihat di Master Data
                        </div> --}}
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card-footer">
            {{-- <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small> --}}
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