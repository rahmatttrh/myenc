@extends('layouts.app-doc')
@section('title')
Employee
@endsection
@section('content')

<style>
   html {
      -webkit-print-color-adjust: exact;
   }

   table,
   th,
   td {
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
         
         <!-- Page title actions -->
         <div class="col-auto ms-auto d-print-none">
            <button type="button" class="btn btn-light" onclick="javascript:window.print();">
               <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
               <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                  <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                  <rect x="7" y="13" width="10" height="8" rx="2" />
               </svg>
               Print
            </button>
         </div>
      </div>
   </div>
</div>
<div class="page-body">
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
                        <h2>DOKUMEN KARYAWAN</h2>
                     </td>
                     <td class="text-center" colspan="2">
                        <img src="{{asset('img/logo/ekanuri.png')}}" alt="" width="100"><br>
                        <span>PT Ekanuri</span>
                     </td>
                  </tr>
                  {{-- <tr>
                     <td colspan="2">No. Dok : FM.PS.HRD.11</td>
                     <td colspan="2">Rev: 3</td>
                     <td colspan="2">Hal : 1 dari 1</td>
                  </tr> --}}
                  <tr>
                     <td colspan="">BSU</td>
                     <td colspan="">: Ekanuri</td>
                     <td colspan="3"></td>
                  </tr>
                  <tr>
                     <td colspan="">Location</td>
                     <td colspan="">: HW</td>
                     <td colspan="3"></td>
                  </tr>
                  <tr>
                     <td colspan="">Gender</td>
                     <td colspan="">: L</td>
                     <td colspan="3"></td>
                  </tr>
                  <tr>
                     <td colspan="">Type</td>
                     <td colspan="">: Kontrak</td>
                     <td colspan="3"></td>
                  </tr>
                  
               </tbody>
            </table>
            <table class="mt-2">
               <thead>
                  <tr>
                     <td><b>NIK</b></td>
                     <td><b>Name</b></td>
                     <td><b>Position</b></td>
                     <td><b>Email</b></td>
                     <td><b>Phone</b></td>
                     <td><b>Agama</b></td>
                     <td><b>TTL</b></td>
                     <td><b>Kota</b></td>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($employees as $emp)
                      <tr>
                        <td>{{$emp->nik}} </td>
                        <td>{{$emp->biodata->fullName()}}</td>
                        <td>{{$emp->position->name  ?? ''}}</td>
                        <td>{{$emp->biodata->email}}</td>
                        <td>{{$emp->biodata->phone}}</td>
                        <td>{{$emp->biodata->religion}}</td>
                        <td>{{$emp->biodata->birth_place}} {{$emp->biodata->birth_date}}</td>
                        <td>{{$emp->biodata->city}}</td>
                      </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection