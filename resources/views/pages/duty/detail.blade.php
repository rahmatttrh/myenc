@extends('layouts.app')
@section('title')
SPKL Detail
@endsection
@section('content')

<style>
   @media print {
   header, footer, nav, aside, .sidebar, .main-header, .hide {
      display: none;
   }

   .main-panel {
      width: 100%;
   }

   @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }

}
</style>

<div class="page-inner">
   <div class="row justify-content-center">
      <div class="col-12 col-lg-10 col-xl-11">
         <div class="row hide align-items-center">
            <div class="col">
               <h6 class="page-pretitle">
                  Detail
               </h6>
               <h4 class="page-title">SPKL #FDS9876KD</h4>
            </div>
            <div class="col-auto">
               {{-- <a href="#" class="btn btn-light btn-border">
                  Download
               </a> --}}
               <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                  <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                  
                  Print
                </button>
               <a href="#" class="btn btn-primary ml-2">
                  Pay
               </a>
            </div>
         </div>
         <div class="page-divider hide"></div>
         <div class="row">
            <div class="col-md-12">
               <div class="card card-invoice">
                  {{-- <div class="card-header">
                     <div class="invoice-header">
                        
                        <div class="invoice-logo">
                           <img src="{{asset('img/logo/enc2.jpg')}}" alt="company logo">
                        </div>
                     </div>
                     <div class="invoice-desc">
                        Bandung, West Java, Indonesia<br>
                        Fax 621113
                     </div>
                  </div> --}}
                  <div class="card-body">
                     <div class="d-flex justify-content-between">
                        <div>
                           <img src="{{asset('img/logo/enc2.jpg')}}"  alt="company logo">
                           <p>FM.PS.HRD.12</p>
                        </div>
                        <div class="text-right">
                           <h3>FORMULIR</h3>
                           <h3>SURAT PERINTAH KERJA LEMBUR</h3>
                        </div>
                     </div>
                    
                     <div class="separator-solid"></div>
                     <p>Dengan ini kami memberikan tugas kerja lembur kepada :</p>
                     <div class="row">
                        <div class="col-md-2">Nama</div>
                        <div class="col-md-10">: Rahmat Hidayat</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">NIK</div>
                        <div class="col-md-10">: EN-095</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Jabatan</div>
                        <div class="col-md-10">: Staff</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Departmen</div>
                        <div class="col-md-10">: IT</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Hari/Tanggal</div>
                        <div class="col-md-10">: Selasa, 18/04/24</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Waktu</div>
                        <div class="col-md-10">: 17.00 s/d 21.00</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Lama lembur</div>
                        <div class="col-md-10">: 5 Jam</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Lokasi Pekerjaan</div>
                        <div class="col-md-10">: Hayam Wuruk</div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">Pekerjaan</div>
                        <div class="col-md-10">: Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque corporis maxime nulla, quas distinctio inventore a rerum! Ipsa.</div>
                     </div>
                     <br>
                     <p>Demikian untuk dilaksanakan. <br>Jakarta, 18 April 2024</p>
                     
                     {{-- <div class="row">
                        <div class="col-md-12">
                           <div class="invoice-detail">
                              <div class="invoice-top">
                                 <h3 class="title"><strong>Order summary</strong></h3>
                              </div>
                              <div class="invoice-item">
                                 <div class="table-responsive">
                                    <table class="table table-striped">
                                       <thead>
                                          <tr>
                                             <td><strong>Item</strong></td>
                                             <td class="text-center"><strong>Price</strong></td>
                                             <td class="text-center"><strong>Quantity</strong></td>
                                             <td class="text-right"><strong>Totals</strong></td>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr>
                                             <td>BS-200</td>
                                             <td class="text-center">$10.99</td>
                                             <td class="text-center">1</td>
                                             <td class="text-right">$10.99</td>
                                          </tr>
                                          <tr>
                                             <td>BS-400</td>
                                             <td class="text-center">$20.00</td>
                                             <td class="text-center">3</td>
                                             <td class="text-right">$60.00</td>
                                          </tr>
                                          <tr>
                                             <td>BS-1000</td>
                                             <td class="text-center">$600.00</td>
                                             <td class="text-center">1</td>
                                             <td class="text-right">$600.00</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-center"><strong>Subtotal</strong></td>
                                             <td class="text-right">$670.99</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-center"><strong>Shipping</strong></td>
                                             <td class="text-right">$15</td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-center"><strong>Total</strong></td>
                                             <td class="text-right">$685.99</td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>	
                           <div class="separator-solid  mb-3"></div>
                        </div>	
                     </div> --}}
                     <div class="page-divider"></div>
                     <div class="row">
                        <div class="col-md-4">
                           <p>Request by : <br>
                           Atasan Langsung
                           </p>
                           <br><br><br>

                           <p>Nama : Nurdiansah</p>
                        </div>
                        <div class="col-md-4">
                           <p>Approved by : <br>
                           GM/Manager
                           </p>
                           <br><br><br>

                           <p>Nama : Abdul Rozak</p>
                        </div>
                        <div class="col-md-4">
                           <p>Employee <br>
                              -
                           </p>
                           <br><br><br>

                           <p>Nama : </p>
                        </div>
                     </div>
                  </div>
                  <div class="card-footer">
                     {{-- <div class="row">
                        <div class="col-sm-7 col-md-5 mb-3 mb-md-0 transfer-to">
                           <h5 class="sub">Bank Transfer</h5>
                           <div class="account-transfer">
                              <div><span>Account Name:</span><span>Syamsuddin</span></div>
                              <div><span>Account Number:</span><span>1234567890934</span></div>
                              <div><span>Code:</span><span>BARC0032UK</span></div>
                           </div>
                        </div>
                        <div class="col-sm-5 col-md-7 transfer-total">
                           <h5 class="sub">Total Amount</h5>
                           <div class="price">$685.99</div>
                           <span>Taxes Included</span>
                        </div>
                     </div> --}}
                     {{-- <div class="separator-solid"></div> --}}
                     <h6 class="text-uppercase mt-4 mb-3 fw-bold">
                        Notes
                     </h6>
                     <p class="text-muted mb-0">
                        We really appreciate your business and if there's anything else we can do, please let us know! Also, should you need us to add VAT or anything else to this order, it's super easy since this is a template, so just ask!
                     </p>
                  </div>
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