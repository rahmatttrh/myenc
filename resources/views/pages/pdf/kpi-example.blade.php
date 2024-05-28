@extends('layouts.app-doc')
@section('title')
   PDF Example
@endsection
@section('content')

<style>
   table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.ttd {
   font-size: 10px;
}

table td {
  font-size: 10px
}



table {
   width: 100%;
}

table td {
  font-size: 10px
}

   .border-none {
      border: none;
   }
</style>

<div class="container-xl">
   <!-- Page title -->
   <div class="page-header d-print-none">
     <div class="row align-items-center">
       <div class="col">
         <h2 class="page-title">
           Preview PE
         </h2>
       </div>
       <!-- Page title actions -->
       <div class="col-auto ms-auto d-print-none">
         <button type="button" class="btn btn-light" onclick="javascript:window.print();">
           <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><rect x="7" y="13" width="10" height="8" rx="2" /></svg>
           Print
         </button>
       </div>
     </div>
   </div>
 </div>
<div class="page-body" >
   <div class="container-xl">
      <div class="card card-lg">
         <div class="card-body">
            <table>
               <tbody>
                  <tr>
                     <td class="px-4 pt-4" rowspan="4" style="border-bottom: none">
                        <div class="d-flex justify-content-between">
                           <img src="{{asset('img/logo/enc1.png')}}" alt="" width="150"><h2>FORM.B</h2>
                        </div>
                        
                     </td>
                     {{-- <td><h2>FORM.B</h2></td> --}}
                     <td class="px-2">-</td>
                  </tr>
                  <tr>
                     <td class="px-2" style="border-top: none"><b>No. Dokumen :</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  
                  <tr>
                     <td class="px-2" style="border-top: none"><b>FM.PS.HRD.11</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  <tr>
                     <td class="px-2" style="border-top: none"><b>Revisi : 2</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  <tr>
                     <td class="px-4" style="border-top: none; border-bottom: none"><b><h4>PT. EKANURI</h4></b></td>
                     <td class="px-2"><b>Tgl. Mulai Efektif : 1 Juli 2021 </b></td>
                  </tr>

                  <tr>
                     <td class="px-4 text-center" style="border-top: none; border-bottom: none"><b><h4>DIVISI IT</h4></b></td>
                     <td class="px-2">-</td>
                  </tr>
                  <tr>
                     <td colspan="2">-</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-center pt-2"><h3>PERIHAL : PENILAIAN KARYAWAN</h3></td>
                  </tr>


                  <tr>
                     <td colspan="2" style="height: 140px">-</td>
                  </tr>


                  <tr>
                     <td class="text-center pt-2"><h3>PERIODE</h3></td>
                     <td class="text-center pt-2"><h3>JAN - JUN 2023</h3></td>
                  </tr>
                  <tr>
                     <td class="text-center pt-2"><h3>NAMA</h3></td>
                     <td class="text-center pt-2"><h3>ABDUL FIKRI</h3></td>
                  </tr>
                  <tr>
                     <td class="text-center pt-2"><h3>POSISI</h3></td>
                     <td class="text-center pt-2"><h3>STAFF</h3></td>
                  </tr>
                  <tr>
                     <td class="text-center pt-2"><h3>N.I.K</h3></td>
                     <td class="text-center pt-2"><h3>EN-4-086</h3></td>
                  </tr>
                  <tr>
                     <td class="text-center pt-2"><h3>DIVISI / DEPARTEMEN</h3></td>
                     <td class="text-center pt-2"><h3>IT</h3></td>
                  </tr>


                  <tr>
                     <td colspan="2" style="height: 140px">-</td>
                  </tr>


                  <tr>
                     <td class="text-center pt-2"><h3>EVALUATOR</h3></td>
                     <td class="text-center pt-2"><h3>ABDUL ROZAK</h3></td>
                  </tr>
                  <tr>
                     <td class="text-center pt-2"><h3>JABATAN</h3></td>
                     <td class="text-center pt-2"><h3>MANAGER IT</h3></td>
                  </tr>
                  <tr>
                     <td class="text-center pt-2" style="height: 100px"><h3>TANDA TANGAN</h3></td>
                     <td class="text-center pt-2"></td>
                  </tr>

               </tbody>
            </table>
            <div class="text-center mt-4">
               <h3>SANGAT RAHASIA</h3>
            </div>
            <hr>
            <table>
               <tbody>
                  

                  <tr>
                     <td class="px-4 pt-4" colspan="2" rowspan="4" style="border-bottom: none">
                        <div class="d-flex justify-content-between">
                           <img src="{{asset('img/logo/enc1.png')}}" alt="" width="150"><h2>FORM.B</h2>
                        </div>
                        
                     </td>
                     {{-- <td><h2>FORM.B</h2></td> --}}
                     <td class="px-2" colspan="10">-</td>
                  </tr>
                  <tr>
                     <td class="px-2" style="border-top: none" colspan="10"><b>No. Dokumen :</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  
                  <tr>
                     <td class="px-2" style="border-top: none" colspan="10"><b>FM.PS.HRD.11</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  <tr>
                     <td class="px-2" style="border-top: none" colspan="10"><b>Revisi : 2</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  <tr>
                     <td class="px-4" colspan="2" style="border-top: none; border-bottom: none"><b><h4>PT. EKANURI</h4></b></td>
                     <td class="px-2" colspan="10"><b>Tgl. Mulai Efektif : 1 Juli 2021 </b></td>
                  </tr>

                  <tr>
                     <td class="px-4 text-center" colspan="2" style="border-top: none; border-bottom: none"><b><h4>DIVISI IT</h4></b></td>
                     <td class="px-2" colspan="10">-</td>
                  </tr>
                  <tr>
                     <td colspan="12">-</td>
                  </tr>
                  <tr>
                     <td colspan="12" class="text-center"><b>SKALA PENILAIAN / PREDIKAT</b></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="px-2" style="border-right: none; border-bottom: none">M : Memuaskan</td>
                     <td colspan="10" style="border-left: none; border-bottom: none">B : Baik</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="px-2" style="border-right: none; border-top: none; border-bottom: none">M : Memuaskan</td>
                     <td colspan="10" style="border-left: none; border-top: none; border-bottom: none">SK : Sangat Kurang</td>
                  </tr>
                  <tr>
                     <td colspan="12" class="px-2" style="border-top: none;">C : Cukup</td>
                     {{-- <td colspan="9"></td> --}}
                  </tr>
                  <tr>
                     <td class="text-center " rowspan="2" style="width: 40px"><b>No.</b></td>
                     <td class="text-center " rowspan="2"><b>Kriteria</b></td>
                     <td class="text-center "><b>Predikat</b></td>
                     <td class="text-center "><b> M </b></td>
                     <td class="text-center "><b> B </b></td>
                     <td class="text-center "><b> C </b></td>
                     <td class="text-center "><b> K </b></td>
                     <td class="text-center "><b>SK</b></td>
                     <td class="text-center " rowspan="2" colspan="2"><b>Total Nilai</b></td>
                     <td class="text-center " rowspan="2"><b>EVR</b></td>
                     <td class="text-center " rowspan="2"><b>Prosentase</b></td>
                  </tr>
                  <tr>
                     <td colspan="" class="text-center "><b>Nilai</b></td>
                     <td class="text-center "><b>5</b></td>
                     <td class="text-center "><b>4</b></td>
                     <td class="text-center "><b>3</b></td>
                     <td class="text-center "><b>2</b></td>
                     <td class="text-center "><b>1</b></td>
                  </tr>
                  <tr>
                     <td colspan="12"></td>
                  </tr>
                  

                  <tr>
                     <td class="text-center "><b>1</b></td>
                     <td class="text-center "><b>DISIPLIN</b></td>
                     <td class="text-center "><b>15</b></td>
                     <td colspan="5"></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>

                  <tr>
                     <td colspan="2" class="px-2">Indikator :</td>
                  </tr>
                  <tr>
                     <td class="text-center">I.1</td>
                     <td>Alpha</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">I.2</td>
                     <td>Izin</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">I.3</td>
                     <td>Terlambat</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>
                  <tr>
                     <td class="text-center "><b>2</b></td>
                     <td class="text-center "><b>KPI</b></td>
                     <td class="text-center "><b>70</b></td>
                     <td colspan="5"></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="px-2">Indikator :</td>
                  </tr>
                  <tr>
                     <td class="text-center">II.1</td>
                     <td>Plan Maintenance</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">II.2</td>
                     <td>Maintenance & Repair (PC, Laptop, Printer, CCTV Network, Server , Finger Print & NVR)</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">II.3</td>
                     <td>Backup & Cloning Data</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">II.4</td>
                     <td>Troubleshooting, Installasi/update & Testing</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr> 
                  <tr>
                     <td></td>
                  </tr>
       
                  <tr>
                     <td class="text-center "><b>3</b></td>
                     <td class="text-center "><b>BEHAVIOR * </b></td>
                     <td class="text-center "><b>15</b></td>
                     <td colspan="5"></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="px-2">Indikator :</td>
                  </tr>
                  <tr>
                     <td class="text-center">III.1</td>
                     <td>Memberikan ide, inovasi terkait lingkup pekerjaan dalam departemen	</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">III.2</td>
                     <td>kemampuan untuk melakukan koordinasi dan komunikasi dengan berbagai pihak yang terkait merumuskan tujuan bersama <br> dan berbagi tugas untuk mencapai sasaran kerja yang telah ditetapkan serta saling menghargai pendapat <br> dan masukan guna peningkatan kinerja tim</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr>
                  <tr>
                     <td class="text-center">III.3</td>
                     <td>kemampuan untuk menjalankan inisiatif perbaikan mutu kerja tanpa harus diperintah; bersikap proaktif <br> dan memiliki self-motivation yang tinggi untuk menuntaskan pekerjaan; serta mampu dalam mengajukan usulan/masukan <br> untuk peningkatan mutu kerja</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>

                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-end px-2"> %</td>
                  </tr> 
                  <tr>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-center pt-1"><b><h4>TOTAL NILAI</h4></b></td>
                     <td class="text-center"><b>20</b></td>
                     <td colspan="7"></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td></td>
                  </tr>

                  <tr>
                     <td colspan="12" class="text-center"><b>NILAI PENGURANG</b></td>
                  </tr>


               </tbody>
            </table>
            <table>
               <tbody>
                  <tr>
                     <td class="px-2 text-center" style="width: 130px"><b>BOBOT</b></td>
                     <td class="px-2 text-center"><b>KETERANGAN</b></td>
                  </tr>
                  <tr>
                     <td class="px-2 text-center">0</td>
                     <td class="px-2">SP</td>
                  </tr>
                  <tr>
                     <td class="px-2">-</td>
                     <td class="px-2">-</td>
                  </tr>
                  <tr>
                     <td class="px-2">-</td>
                     <td class="px-2">-</td>
                  </tr>
               </tbody>
            </table>

            <hr>
            <table>
               <tbody>

                  <tr>
                     <td class="px-4 pt-4" colspan="2" rowspan="4" style="border-bottom: none">
                        <div class="d-flex justify-content-between">
                           <img src="{{asset('img/logo/enc1.png')}}" alt="" width="150"><h2>FORM.B</h2>
                        </div>
                        
                     </td>
                     {{-- <td><h2>FORM.B</h2></td> --}}
                     <td class="px-2" colspan="6">-</td>
                  </tr>
                  <tr>
                     <td class="px-2" style="border-top: none" colspan="6"><b>No. Dokumen :</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  
                  <tr>
                     <td class="px-2" style="border-top: none" colspan="6"><b>FM.PS.HRD.11</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  <tr>
                     <td class="px-2" style="border-top: none" colspan="6"><b>Revisi : 2</b></td>
                     {{-- <td></td> --}}
                  </tr>
                  <tr>
                     <td class="px-4" colspan="2" style="border-top: none; border-bottom: none"><b><h4>PT. EKANURI</h4></b></td>
                     <td class="px-2" colspan="6"><b>Tgl. Mulai Efektif : 1 Juli 2021 </b></td>
                  </tr>

                  <tr>
                     <td class="px-4 text-center" colspan="2" style="border-top: none; border-bottom: none"><b><h4>DIVISI IT</h4></b></td>
                     <td class="px-2" colspan="6">-</td>
                  </tr>
                  {{-- <tr>
                     <td colspan="8"></td>
                  </tr> --}}

                  
                  <tr>
                     <td colspan="8" class="text-center"><b>RANGKUMAN HASIL PENILAIAN AKHIR</b></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-center">-</td>
                     <td class="text-center">Total</td>
                     <td class="text-center">Jabatan</td>
                     <td class="text-center">MGR</td>
                     <td class="text-center">KDR</td>
                     <td class="text-center">SPV</td>
                     <td class="text-center">S</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-center">Indikator</td>
                     <td class="text-center">Indikator</td>
                     <td class="text-center">Nilai</td>
                     <td colspan="4" class="text-center">Total Nilai / Total Indikator</td>
                  </tr>

                  <tr>
                     <td class="text-center" style="width: 40px">1</td>
                     <td class="px-2">DISIPLIN</td>
                     <td class="text-center">3</td>
                     <td class="text-center">15</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-center">0</td>
                  </tr>
                  <tr>
                     <td class="text-center" style="width: 40px">2</td>
                     <td class="px-2">KPI</td>
                     <td class="text-center">4</td>
                     <td class="text-center">70</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-center">0</td>
                  </tr>
                  <tr>
                     <td class="text-center" style="width: 40px">3</td>
                     <td class="px-2">BEHAVIOR</td>
                     <td class="text-center">3</td>
                     <td class="text-center">15</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-center">0</td>
                  </tr>
                   
                  <tr>
                     <td colspan="2" class="text-end"><b>Jumlah Nilai :</b></td>
                     <td class="text-center"><b>4</b></td>
                     <td class="text-center"><b>20</b></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td class="text-center">0</td>
                  </tr>

                  <tr>
                     <td></td>
                     <td><b>Note : </b></td>
                     <td></td>
                     <td></td>
                  </tr>
               </tbody>
            </table>

            <table class="table-border-none" >
               <tbody>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none"><b>Note : </b></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"><b>Pengurang</b></td>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="4">Bobot Pencapaian</td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none">MGR</td>
                     <td class="border-none">: Manager</td>
                     <td class="border-none"></td>
                     <td class="border-none">SP :</td>
                     <td class="border-none">5</td>
                     <td class="border-none">100</td>
                     <td class="border-none">-</td>
                     <td class="border-none">91</td>
                     <td class="border-none">Memuaskan</td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none">SPV</td>
                     <td class="border-none">: Supervisor</td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none">90</td>
                     <td class="border-none">-</td>
                     <td class="border-none">76</td>
                     <td class="border-none">Baik</td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none">KDR</td>
                     <td class="border-none">: Koordinator</td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none">75</td>
                     <td class="border-none">-</td>
                     <td class="border-none">61</td>
                     <td class="border-none">Cukup</td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none">S</td>
                     <td class="border-none">: Staff</td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none">60</td>
                     <td class="border-none">-</td>
                     <td class="border-none">51</td>
                     <td class="border-none">Kurang</td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td class="border-none">50</td>
                     <td class="border-none">-</td>
                     <td class="border-none">0</td>
                     <td class="border-none">Sangat Kurang</td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td colspan="3" class="text-center"><b>Nilai Akhir - (Nilai SP)</b></td>
                     <td colspan="2" ></td>
                     <td >0</td>
                     <td >0</td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none"></td>
                     <td colspan="4" class="text-center"><b>Predikat : Memuaskan / Baik / Cukup / Kurang / Sangat Kurang</b></td>
                     
                     <td ></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>

                  <tr>
                     <td class="" style="border-bottom: none" colspan="10">Komentar Karyawan :</td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>

                  <tr>
                     <td class="" style="border-bottom: none" colspan="10">Komentar Evaluator (Untuk motivasi dan pengembangan) :</td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px">1.</td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px">2.</td>
                  </tr>
                  <tr>
                     <td class="text-center" colspan="10"><b>Karyawan yang dinilai</b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="2"><b>Nama</b></td>
                     <td class="border-none"><b>: Abdul Fikri</b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="2"><b>Jabatan</b></td>
                     <td class="border-none"><b>: Staff</b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="2"><b>NIK</b></td>
                     <td class="border-none"><b></b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="text-center" colspan="10"><b>Evaluator</b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="2"><b>Nama</b></td>
                     <td class="border-none"><b>: Nurdiansah</b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="2"><b>Jabatan</b></td>
                     <td class="border-none"><b>: SPV IT</b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
                  <tr>
                     <td class="border-none"></td>
                     <td class="border-none" colspan="2"><b>Divisi</b></td>
                     <td class="border-none"><b></b></td>
                  </tr>
                  <tr>
                     <td class="border-none" style="height: 10px"></td>
                  </tr>
               </tbody>
            </table>
            <div class="text-end px-4 mt-4">
               <span>Jakarta, 23 Juli 2023</span>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection