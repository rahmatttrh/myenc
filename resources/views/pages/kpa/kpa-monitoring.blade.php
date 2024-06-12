@extends('layouts.app')
@section('title')
KPA
@endsection
@section('content')
<style>
   table {
      width: 100%;
   }
</style>

<div class="page-inner">
    <nav aria-label="breadcrumb ">
        <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">KPA</li>
            <li class="breadcrumb-item active" aria-current="page">Monitoring</li>
        </ol>
    </nav>
    {{-- <div class="chart-container">
      <canvas id="radarChart"></canvas>
   </div> --}}
   {{-- <div class="row">
      <div class="col-md-6">
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="15" rowspan="">Ekanuri</th>
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>1</th>
                     <th>2</th>
                     <th>3</th>
                     <th>4</th>
                     <th>5</th>
                     <th>6</th>
                     <th>7</th>
                     <th>8</th>
                     <th>9</th>
                     <th>10</th>
                     <th>11</th>
                     <th>12</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>IT</td>
                     <td>IT</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     
                  </tr>
                  <tr>
                     <td>Finance</td>
                     <td>GA</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>General Service</td>
                     <td>General Service</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Maintenance</td>
                     <td>Maintenance</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="15" rowspan="">Ekanuri</th>
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>1</th>
                     <th>2</th>
                     <th>3</th>
                     <th>4</th>
                     <th>5</th>
                     <th>6</th>
                     <th>7</th>
                     <th>8</th>
                     <th>9</th>
                     <th>10</th>
                     <th>11</th>
                     <th>12</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>IT</td>
                     <td>IT</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     
                  </tr>
                  <tr>
                     <td>Finance</td>
                     <td>GA</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>GS</td>
                     <td>GS</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Maintenance</td>
                     <td>Maintenance</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <div class="col-md-6">
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="15" rowspan="">Ekanuri</th>
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>1</th>
                     <th>2</th>
                     <th>3</th>
                     <th>4</th>
                     <th>5</th>
                     <th>6</th>
                     <th>7</th>
                     <th>8</th>
                     <th>9</th>
                     <th>10</th>
                     <th>11</th>
                     <th>12</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>IT</td>
                     <td>IT</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     
                  </tr>
                  <tr>
                     <td>Finance</td>
                     <td>GA</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>GS</td>
                     <td>GS</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Maintenance</td>
                     <td>Maintenance</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="15" rowspan="">Ekanuri</th>
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>1</th>
                     <th>2</th>
                     <th>3</th>
                     <th>4</th>
                     <th>5</th>
                     <th>6</th>
                     <th>7</th>
                     <th>8</th>
                     <th>9</th>
                     <th>10</th>
                     <th>11</th>
                     <th>12</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>IT</td>
                     <td>IT</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     
                  </tr>
                  <tr>
                     <td>Finance</td>
                     <td>GA</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>GS</td>
                     <td>GS</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
                  <tr>
                     <td>Maintenance</td>
                     <td>Maintenance</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                     <td class="text-center">4</td>
                     <td class="text-center">14</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div> --}}

   <div class="row">
      <div class="col-md-4">
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">Ekanuri</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  <tr>
                     <td>IT</td>
                     <td>IT</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td>Finance</td>
                     <td>GA</td>
                     <td class="text-center bg-success">51%</td>
                     <td class="text-center">2</td>
                  </tr>
                  <tr>
                     <td>General Service</td>
                     <td>General Service</td>
                     <td class="text-center">35%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">55%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>Maintenance</td>
                     <td>Maintenance</td>
                     <td class="text-center">70%</td>
                     <td class="text-center">32</td>
                  </tr>
               </tbody>
            </table>
         </div>
         
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">Ekajaya Kridatama</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="">Operation</td>
                     <td>Operation</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td>GA</td>
                     <td>GA</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>Oil & Gas</td>
                     <td>Oil & Gas</td>
                     <td class="text-center">35%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>Chemical</td>
                     <td>Chemical</td>
                     <td class="text-center">55%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>Driving</td>
                     <td>Driving</td>
                     <td class="text-center">70%</td>
                     <td class="text-center">32</td>
                  </tr>
                  
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">PEIPerkasa Agency</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="">Operation</td>
                     <td>Operation</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td>Accounting & Finance</td>
                     <td>Accounting & Finance</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  
                  
               </tbody>
            </table>
         </div>
      </div>

      <div class="col-md-4">
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">PEIPerkasa</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="3">Finance</td>
                     <td>Fnance</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     {{-- <td>Finance</td> --}}
                     <td>Accounting</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     {{-- <td></td> --}}
                     <td>GA</td>
                     <td class="text-center">35%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>HRD</td>
                     <td>HRD</td>
                     <td class="text-center">55%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td>Sekretariat</td>
                     <td>Sekretariat</td>
                     <td class="text-center">70%</td>
                     <td class="text-center">32</td>
                  </tr>
                  <tr>
                     <td>QHSSE</td>
                     <td>QHSSE</td>
                     <td class="text-center">70%</td>
                     <td class="text-center">32</td>
                  </tr>
               </tbody>
            </table>
         </div>

         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">PEIPratama</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td rowspan="">General Service</td>
                     <td>General Service</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td rowspan="">Accounting & Finance</td>
                     <td>Accounting & Finance</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  
                  
                  
                  
               </tbody>
            </table>
         </div>

         <div class="table-responsive mb-2">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">EN Anugrah</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  
               </tbody>
            </table>
         </div>

         
      </div>

      <div class="col-md-4">
         

         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">KCI Cirebon</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  <tr>
                     <td rowspan="">Sekretariat</td>
                     <td>Sekretariat</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  
                  
               </tbody>
            </table>
         </div>
         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">KCI Ancol</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td rowspan="">Busines Development</td>
                     <td>Busines Development</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td rowspan="">GA</td>
                     <td>GA</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  
                  
                  
               </tbody>
            </table>
         </div>

         <div class="table-responsive">
            <table>
               <thead>
                  
                  <tr>
                     <th colspan="4" rowspan="">KCI Semarang</th>
                     {{-- <th colspan="" class="text-center">Pending</th> --}}
                     
                  </tr>
                  <tr>
                     <th>Department</th>
                     <th>Sub Dept</th>
                     <th>Complete</th>
                     <th>Pending</th>
                  </tr>
                  {{-- <tr>
                     Pending
                  </tr> --}}
               </thead>
               <tbody>
                  
                  <tr>
                     <td>Operation</td>
                     <td>Operation</td>
                     <td class="text-center">51%</td>
                     <td class="text-center">23</td>
                  </tr>
                  <tr>
                     <td rowspan="">QHSSE</td>
                     <td>QHSSE</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td rowspan="">Accounting & Finance</td>
                     <td>Accounting & Finance</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  <tr>
                     <td rowspan="">Maintenance</td>
                     <td>Maintenance</td>
                     <td class="text-center">40%</td>
                     <td class="text-center">41</td>
                     
                  </tr>
                  
                  
                  
               </tbody>
            </table>
         </div>
      </div>

      <div class="col-md-4">
         
      </div>
      
   </div>
    <div class="row" id="boxCreate">
        <!-- <div class="col-md-2">
            <div class="card shadow-none border">
                <div class="card-header d-flex">
                    <div class="d-flex  align-items-center">
                        <div class="card-title">Monitoring KPI</div>
                    </div>

                </div>
                <form action="{{route('kpa.summary.detail')}}" method="GET">
                    @csrf
                    <div class="card-body">

                        <div class="form-group form-group-default">
                            <label>Department</label>
                            <select class="form-control" name="employe_id" id="employe_id" required>
                                <option value="">--- Choose Employe ---</option>
                                @foreach ($employes as $employe)
                                <option value="{{$employe->id}}">{{$employe->biodata->first_name}} {{$employe->biodata->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group form-group-default">
                            <label>Bisnis Unit</label>
                            <select class="form-control" name="employe_id" id="employe_id" required>
                                <option value="">--- Choose Employe ---</option>
                                @foreach ($employes as $employe)
                                <option value="{{$employe->id}}">{{$employe->biodata->first_name}} {{$employe->biodata->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary ml-auto"><i class="fas fa-check"></i> Cek</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> -->
        <div class="col-md-12">
            <div class="card shadow-none border">
                <div class="card-header">
                    <div class="col-md-1 float-right mb-3">
                        <!-- <button type="button" id="hide" class="btn btn-block btn-danger"><i class="fa fa-minus"></i> Hide </button> -->
                    </div>
                    <div class="card-title">Monitoring Outstanding Penilaian KPI </div>
                </div>
                <form action="{{route('kpa.store')}}" method="POST" enctype="multipart/form-data" accept=".jpg, .jpeg, .png, .pdf">
                    @csrf
                    <input type="hidden" id="kpi_id" name="kpi_id">
                    <input type="hidden" id="employee_id" name="employe_id">
                    <input type="hidden" id="date" name="date">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table" class="displays table table-striped  border">
                                <thead>
                                    <tr>
                                        <th rowspan="3">Bisnis Unit</th>
                                        <th rowspan="3">Department</th>
                                        <th rowspan="3">Sub Dept</th>
                                    </tr>
                                    <tr>
                                        <th colspan="12" class="text-center"> 2024
                                            <br><small>(Jumlah Karyawan)</small>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Jan</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Apr</th>
                                        <th>Mei</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Agu</th>
                                        <th>Sep</th>
                                        <th>Okt</th>
                                        <th>Nov</th>
                                        <th>Des</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $unit = new \App\Models\Unit();
                                    $modelSubDept = new \App\Models\SubDept();
                                    @endphp

                                    @foreach($units as $unit)
                                    <tr>

                                        @php
                                        $totalSubDept = $unit->totalSubDept($unit->id);
                                        @endphp

                                        <td rowspan="{{$totalSubDept}}">{{$unit->name}} </td>
                                        @foreach($unit->departments as $dept)

                                        @if($dept->sub_depts->count() == 1)
                                        <td colspan="">{{$dept->name}}</td>
                                        @else
                                        <td rowspan="{{$dept->sub_depts->count()}}">{{$dept->name}}</td>
                                        @endif

                                        @foreach($dept->sub_depts as $sub_dept)

                                        <td>{{$sub_dept->name}} </td>

                                        <!-- Looping nilai outstanding -->
                                        <?php
                                        $outs = $modelSubDept->outstandingKPI($sub_dept->id, '2024');

                                        foreach ($outs as $key => $value) {

                                            if (is_numeric($value)) {
                                                # code...
                                                echo "<td> <span class='badge badge-danger'>" . $value . "</span></td>";
                                            } else if ($value == 0) {
                                                # code...
                                                echo "<td> <span class='badge badge-success'>" . $value . "</span></td>";
                                            } else {
                                                # code...
                                                echo "<td> <span class='badge badge-dark'>" . $value . "</span></td>";
                                            }
                                        }
                                        ?>


                                    </tr>
                                    @endforeach


                                    </tr>
                                    @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('chart-dashboard')
   <script>
       $(document).ready(function() {
         var radarChart = document.getElementById('radarChart').getContext('2d');

         var myRadarChart = new Chart(radarChart, {
            type: 'radar',
            data: {
               labels: [
                  'Eating',
                  'Drinking',
                  'Sleeping',
                  'Designing',
                  'Coding',
                  'Cycling',
                  'Running'
               ],
               datasets: [{
                  label: 'My First Dataset',
                  data: [65, 59, 90, 81, 56, 55, 40],
                  fill: true,
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgb(255, 99, 132)',
                  pointBackgroundColor: 'rgb(255, 99, 132)',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: 'rgb(255, 99, 132)'
               }, {
                  label: 'My Second Dataset',
                  data: [28, 48, 40, 19, 96, 27, 100],
                  fill: true,
                  backgroundColor: 'rgba(54, 162, 235, 0.2)',
                  borderColor: 'rgb(54, 162, 235)',
                  pointBackgroundColor: 'rgb(54, 162, 235)',
                  pointBorderColor: '#fff',
                  pointHoverBackgroundColor: '#fff',
                  pointHoverBorderColor: 'rgb(54, 162, 235)'
               }]
               },
            options: {
               elements: {
                  line: {
                  borderWidth: 3
                  }
               }
            },
         });
      })
   </script>
   @endpush

@push('js_footer')
<script>
    $(document).ready(function() {

        bulanPenilaian();

        $("#btnCreate").click(function() {

            $('#boxCreate').show();
            // Tambahkan kode lain yang ingin Anda eksekusi saat tombol diklik di sini
        });

        $("#hide").click(function() {

            $('#boxCreate').hide();
            // Tambahkan kode lain yang ingin Anda eksekusi saat tombol diklik di sini
        });

        $('.date').change(function() {
            bulanPenilaian();
        });

        $('#employe_id').change(function() {
            let employeeId = $(this).val();

            $('#employee_id').val(employeeId);

            $("#tableCreate tbody").empty();

            $.ajax({
                url: '/kpi/employe/' + employeeId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {

                    $('#kpi_id').val(data[0].kpi_id);

                    var table = $("#tableCreate tbody");
                    $.each(data, function(index, rowData) {
                        var row = $("<tr>").attr("id", "row_" + rowData.id); // Tambahkan ID indeks pada baris
                        row.append($("<td>").text(index + 1));
                        row.append($("<td>").text(rowData.objective));
                        row.append($("<td>").text(rowData.weight));
                        row.append($("<td>").text(rowData.target));
                        var input = $("<input>").attr({
                            "type": "text",
                            "class": "form-control",
                            "name": `qty[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            "value": 0,
                            "min": 0 I,
                            "max": rIIData.target,
                            "step": "0.01" // Step untuk 2 digit desimal
                        }).on('input', function() {
                            // Menghapus angka nol di depan input jika ada
                            var inputValue = $(this).val();
                            inputValue = inputValue.replace(/^0+/, '');
                            $(this).val(inputValue);

                            calculateAchievement(rowData.id, rowData.target);
                            calculateTotalAchievement();
                        });

                        row.append($("<td>").append(input));
                        var achievementInput = $("<input>").attr({
                            "type": "text",
                            "class": "form-control text-bold",
                            "name": "achievement_" + rowData.id,
                            "placeholder": "0",
                            "readonly": true
                        }).css("font-weight", "bold"); // Menambahkan style font-weight: bold

                        row.append($("<td>").append(achievementInput));

                        var attachmentInput = $("<input>").attr({
                            "type": "file",
                            "class": "form-control",
                            "name": `attachment[${rowData.id}]`, // Menggunakan ID sebagai bagian dari array name
                            "required": true, // Tambahkan atribut readonly
                            "accept": ".pdf" // Hanya izinkan file PDF
                        });

                        row.append($("<td>").append(attachmentInput));


                        table.append(row);
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });

        });

        function validasiInput(index) {

            var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val());

        }

        function calculateAchievement(index, target) {

            // validasi dulu
            // validasiInput(index);

            var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val()) || 0; // Menggantikan dengan nilai 0 jika null atau kosong
            // var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val()) || 0.1; // Ganti 0 dengan 0.1 jika null atau kosong

            // var inputVal = parseFloat($(`input[name="qty[${index}]"]`).val());

            // if (isNaN(inputVal) || inputVal <= 0) {
            //     inputVal = 0; // Set nilai ke 0.1 jika kosong atau bernilai 0
            //     $(`input[name="qty[${index}]"]`).val(inputVal)
            // }

            var targetVal = parseFloat($(`#tableCreate tbody #row_${index} td:eq(3)`).text());
            var weightVal = parseFloat($(`#tableCreate tbody #row_${index} td:eq(2)`).text());

            if (!isNaN(inputVal) && inputVal >= 0.1 && inputVal <= target) {
                var result = (inputVal / targetVal) * weightVal;
                $(`input[name="achievement_${index}"]`).val(Math.round(result));
            } else {
                $(`input[name="achievement_${index}"]`).val("Invalid Input");
            }
        }

        function calculateTotalAchievement() {
            var totalAchievement = 0;
            $("input[name^='achievement_']").each(function() {
                var value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    totalAchievement += value;
                }
            });

            $("#totalAchievement").text(totalAchievement.toFixed(2));
        }

        // Fungsi untuk mengosongkan tabel
        function clearTable() {
            $("#tableCreate tbody").empty();
        }

        function bulanPenilaian() {
            let bulan = $('#bulan').val();
            let tahun = $('#tahun').val();

            let date = tahun + '-' + bulan + '-01';

            $('#date').val(date);

        }

    })
</script>
@endpush