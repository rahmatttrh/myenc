@extends('layouts.app-doc')
@section('title')
   PDF Example
@endsection
@section('content')

<style>
   html { -webkit-print-color-adjust: exact; }
   table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

.ttd {
   font-size: 10px;
}

table td {
  font-size: 10px;
  /* padding-top: 5px;
  padding-bottom: 5px; */
  padding-left: 5px;
  padding-right: 5px;
}



table {
   width: 100%;
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
                     <td class="text-center" colspan="2">
                        <img src="{{asset('img/logo/enc1.png')}}" alt="" width="100">
                     </td>
                     <td class="text-center" colspan="2">
                        <h2>PENILAIAN KARYAWAN</h2>
                     </td>
                     <td class="text-center" colspan="2">
                        <img src="{{asset('img/logo/ekanuri.png')}}" alt="" width="100"><br>
                        <span>PT Ekanuri</span>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">No. Dok : FM.PS.HRD.11</td>
                     <td colspan="2">Rev: 3</td>
                     <td colspan="2">Hal : 1 dari 2</td>
                  </tr>
                  <tr>
                     <td colspan="2">Periode</td>
                     <td>:</td>
                     <td></td>
                     <td colspan="2" class="text-center" style="background-color: rgb(227, 243, 149)"><b>Level : Staf</b></td>
                  </tr>
                  <tr>
                     <td colspan="2">Nama</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2">Nik</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2">Departemen</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2">Jabatan</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2">Lokasi Kerja</td>
                     <td>:</td>
                     <td></td>
                     <td></td>
                     <td></td>
                  </tr>

                  <tr style="background-color: rgb(21, 21, 80); color:aqua">
                     <td style="width: 50px" class="text-center"><b>NO</b></td>
                     <td style="width: 100px"></td>
                     <td><b>ASPEK PENILAIAN</b></td>
                     <td style="width: 100px" class="text-center"><b>BOBOT</b></td>
                     <td style="width: 100px" class="text-center"><b>NILAI</b></td>
                     <td style="width: 100px" class="text-center"><b>POIN BOBOT x NILAI</b></td>
                  </tr>

                  <tr style="background-color: rgb(121, 168, 250);">
                     <td class="text-center"><b>1</b></td>
                     <td colspan="2"><b>DISIPLIN</b></td>
                     {{-- <td></td> --}}
                     <td colspan="" class="text-center"><b>15</b></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">a</td>
                     <td>Tingkat kehadiran dan kepatuhan waktu kerja</td>
                     <td></td>
                     <td class="text-center">4</td>
                     <td style="background-color: yellow" class="text-end">15,0</td>
                  </tr>
                  <tr style="background-color: rgb(121, 168, 250);"">
                     <td class="text-center"><b>2</b></td>
                     <td colspan="2"><b>KPI</b></td>
                     {{-- <td></td> --}}
                     <td colspan="" class="text-center"><b>70</b></td>
                     <td></td>
                     <td></td>
                  </tr>

                  <tr>
                     <td colspan="3" class="text-center"><b>Objektif</b></td>
                     <td class="text-center"><b>Hasil</b></td>
                     <td colspan="2"></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">a</td>
                     <td></td>
                     <td class="text-center">40</td>
                     <td class="text-center">4</td>
                     <td style="" class="text-end">40</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">b</td>
                     <td></td>
                     <td class="text-center">10</td>
                     <td class="text-center">4</td>
                     <td style="" class="text-end">10</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">c</td>
                     <td></td>
                     <td class="text-center">50</td>
                     <td class="text-center">4</td>
                     <td style="" class="text-end">50</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">d</td>
                     <td>Additional</td>
                     <td class="text-center"></td>
                     <td class="text-center"></td>
                     <td style="" class="text-end">0</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end"></td>
                     <td>Sub Total</td>
                     <td class="text-center"></td>
                     <td class="text-center"></td>
                     <td style="" class="text-end">100</td>
                  </tr>
                  <tr>
                     <td colspan="3" class="text-center"><b>Total Hasil</b></td>
                     <td></td>
                     <td></td>
                     <td style="background-color: yellow" class="text-center">70</td>
                  </tr>

                  <tr style="background-color: rgb(121, 168, 250);"">
                     <td class="text-center"><b>3</b></td>
                     <td colspan="2"><b>BEHAVIOR</b></td>
                     {{-- <td></td> --}}
                     <td colspan="" class="text-center"><b>15</b></td>
                     <td></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">a</td>
                     <td>Kreatifitas dan Inovasi</td>
                     <td class="text-center">5</td>
                     <td class="text-center">4</td>
                     <td style="" class="text-end">5,0</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">b</td>
                     <td>Kerjasama</td>
                     <td class="text-center">5</td>
                     <td class="text-center">4</td>
                     <td style="" class="text-end">5,0</td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">b</td>
                     <td>Inisiatif</td>
                     <td class="text-center">5</td>
                     <td class="text-center">4</td>
                     <td style="" class="text-end">5,0</td>
                  </tr>

                  <tr>
                     <td colspan="2" class="text-end"></td>
                     <td>Sub Total</td>
                     <td class="text-center"></td>
                     <td class="text-center"></td>
                     <td style="background-color: yellow" class="text-end">15,0</td>
                  </tr>

                  <tr style="background-color: rgb(21, 21, 80); color:aqua">
                     <td colspan="3" class="text-center">TOTAL NILAI</td>
                     <td class="text-center">100</td>
                     <td></td>
                     <td class="text-end">100,0</td>
                  </tr>

                  <tr style="background-color: rgb(121, 168, 250);"">
                     <td class="text-center"><b>4</b></td>
                     <td colspan="2"><b>NILAI PENGURANG</b></td>
                     {{-- <td></td> --}}
                     <td colspan="" class="text-center"><b>3</b></td>
                     <td></td>
                     <td></td>
                  </tr>

                  <tr>
                     <td colspan="2" class="text-end"></td>
                     <td>Terbit Surat Peringatan : </td>
                     <td class="text-center"></td>
                     <td class="text-center"></td>
                     <td style="" class="text-end"></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">a</td>
                     <td>SP </td>
                     <td class="text-center"></td>
                     <td class="text-center"></td>
                     <td style="" class="text-end"></td>
                  </tr>
                  <tr>
                     <td colspan="2" class="text-end">b</td>
                     <td></td>
                     <td class="text-center"></td>
                     <td class="text-center"></td>
                     <td style="" class="text-end"></td>
                  </tr>

                  <tr style="background-color: rgb(121, 168, 250);"">
                     {{-- <td class="text-center"><b>4</b></td> --}}
                     <td colspan="3" class="text-center"><b>TOTAL PENGURANG</b></td>
                     {{-- <td></td> --}}
                     <td colspan="" class="text-center"><b>1</b></td>
                     <td></td>
                     <td style="background-color: yellow" class="text-end">5,0</td>
                  </tr>

                  <tr style="background-color: rgb(21, 21, 80); color:aqua">
                     <td colspan="5" class="text-center">NILAI AKHIR (Total Nilai - Total Pengurang)</td>
                     
                     <td class="text-end" >95,0</td>
                  </tr>




                  <tr>
                     <td></td>
                     <td class="text-center">Range Nilai</td>
                     <td colspan="4"></td>
                  </tr>
                  <tr>
                     <td class="text-center">A</td>
                     <td class="text-center">91 - 100</td>
                     <td colspan="4">: Baik sekali (Diatas ekspektasi, mencapai hasil lebih dari yang diharapkan)</td>
                  </tr>
                  <tr>
                     <td class="text-center">B</td>
                     <td class="text-center">76 - 90</td>
                     <td colspan="4">: Baik (Memenuhi ekspektasi, mencapai hasil yang diharapkan)</td>
                  </tr>
                  <tr>
                     <td class="text-center">C</td>
                     <td class="text-center">61 - 75</td>
                     <td colspan="4">: Cukup (Dibawah ekspekasi, sebagian mencapai hasil yang diharapkan)</td>
                  </tr>
                  <tr>
                     <td class="text-center">D</td>
                     <td class="text-center">0 - 60</td>
                     <td colspan="4">: Kurang (Perlu evaluasi perbaikan, tidak mencapai hasil yang diharapkan)</td>
                  </tr>

                  <tr style="background-color: rgb(121, 168, 250);"">
                     {{-- <td class="text-center"><b>4</b></td> --}}
                     <td colspan="6" class="text-center"><b>TRAINING DEVELOPMENT</b></td>
                     
                  </tr>
                  <tr>
                     <td colspan="6">
                        (Meningkatkan kompetensi yang belum terpenuhi sesuai dengan kebutuhan karyawan seperti : 
                        program pelatihan/pengembangan, coaching, mentoring)
                     </td>
                  </tr>
                  <tr>
                     <td class="text-center">1</td>
                     <td colspan="2"></td>
                     <td colspan="3">Alasan :</td>
                  </tr>
                  <tr>
                     <td class="text-center">2</td>
                     <td colspan="2"></td>
                     <td colspan="3">Alasan :</td>
                  </tr>
                  <tr>
                     <td class="text-center">3</td>
                     <td colspan="2"></td>
                     <td colspan="3">Alasan :</td>
                  </tr>

                  <tr style="background-color: rgb(121, 168, 250);"">
                     {{-- <td class="text-center"><b>4</b></td> --}}
                     <td colspan="6" class="text-center"><b>KOMENTAR EVALUATOR</b></td>
                     
                  </tr>
                  <tr>
                     <td colspan="6" style="height: 60px"></td>
                  </tr>


                  <tr style="background-color: black; color: white">
                     <td colspan="2" class="text-center">Evaluator</td>
                     <td class="text-center">Menyetujui</td>
                  </tr>
                  <tr>
                     <td colspan="2">Atasan Langsung</td>
                     <td>Manager</td>
                  </tr>
                  <tr>
                     <td colspan="2" style="height: 50px"></td>
                     <td></td>
                  </tr>
                  <tr>
                     <td colspan="2">Nama :</td>
                     <td>Nama :</td>
                  </tr>
                  <tr>
                     <td colspan="2">Tanggal :</td>
                     <td>Tanggal :</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection