<div class="card card-invoice">
                  
   <div class="card-body pt-4 px-4">
      <div class="d-flex justify-content-between">
         <div>
            <img src="{{asset('img/logo/enc2.jpg')}}" alt="company logo"><br>
            {{-- <p>FM.PS.HRD.12</p> --}}

         </div>
         <div class="text-right">
            <h3><b>SURAT PERINGATAN {{$sp->level}}</b></h3>
            <b>{{$sp->code}}</b>
         </div>
      </div>
      
      <hr>
      <br>
      <p>Kepada Yth.</p>

      <div class="row">
         <div class="col-12">
            <div class="row">
               <div class="col-2">Nama</div>
               <div class="col-10">: {{$sp->employee->biodata->fullName()}}</div>
            </div>
            <div class="row">
               <div class="col-2">NIK</div>
               <div class="col-10">: {{$sp->employee->nik}}</div>
            </div>
            <div class="row">
               <div class="col-2">Jabatan</div>
               <div class="col-10">: {{$sp->employee->position->name}}</div>
            </div>
            <div class="row">
               <div class="col-2">Departemen/Divisi</div>
               <div class="col-10">: {{$sp->employee->department->name}}</div>
            </div>
            <div class="row mt-4">
               <div class="col-12">Sehubungan dengan pelanggaran yang {{$gen}} lakukan, yaitu :</div>
            </div>
            <br>
            <div class="row mb-4 mt-2">
               <div class="col">
                  <b>{{$sp->reason}}</b>
               </div>
            </div>
         </div>
      </div>

      <br>
      <p>Maka sesuai dengan peraturan yang berlaku ( <b>Peraturan Perusahaan {{$sp->rule}}</b> ) kepada {{$gen}} diberikan sanksi berupa <b>SURAT PERINGATAN {{$sp->level}}</b>.</p>

      <p>Setelah {{$gen}} menerima SURAT PERINGATAN {{$sp->level}} ini, diharapkan {{$gen}} dapat merubah sikap {{$gen}} dan kembali bekerja dengan baik.</p>

      <p>Surat peringatan ini berlaku selama 6 bulan, Efektif tanggal <b>{{formatDate($sp->date_from)}}</b> s/d <b>{{formatDate($sp->date_to)}}</b>.</p>

      <p>Apabila ternyata {{$gen}} kembali berbuat sesuatu kesalahan atau pelanggaran yang dapat diberikan sanksi, maka kepada <Saudara>
            <i></i> akan diberikan sanksi yang lebih keras dan dapat berakibat pemutusan hubungan kerja antara perusahaan dengan {{$gen}}.</p>

      <p>Semoga dapat dimengerti dan dimaklumi.</p>

      <br><br>
      <div class="page-divider"></div>
      <table>
         <tbody>
            <tr>
               <th>Diajukan oleh</th>
               <th>Disetujui oleh</th>
               <th>Diketahui oleh</th>
               <th>Diterima</th>
            </tr>
            <tr>
               <td style="height: 80px" class="">
                  
                  @if ($user)
                  {{$user->employee->biodata->fullName()}} <br>
                  {{$user->employee->position->name}}
                  @else
                  -
                  @endif

               </td>
               <td>
                  @if ($manager)
                  {{$manager->employee->biodata->fullName()}} <br>
                  {{$manager->employee->position->name}}
                  @else
                  -
                  @endif

               </td>
               <td>
                  @if ($hrd)
                  {{$hrd->employee->biodata->fullName()}} <br>
                  {{$hrd->employee->position->name}}
                  @else
                  -
                  @endif

               </td>
               <td>
                  @if ($suspect)
                  {{$suspect->employee->biodata->fullName()}} <br>
                  {{$suspect->employee->position->name}}
                  @else
                  -
                  @endif
               </td>
            </tr>
            <tr>
               <td>
                  @if ($user)
                  {{formatDateTime($user->created_at)}}
                  @else
                  -
                  @endif
               </td>
               <td>
                  @if ($manager)
                  {{formatDateTime($manager->created_at)}}
                  @else
                  -
                  @endif
               </td>
               <td>
                  @if ($hrd)
                  {{formatDateTime($hrd->created_at)}}
                  @else
                  -
                  @endif
               </td>
               <td>
                  @if ($suspect)
                  {{formatDateTime($suspect->created_at)}}
                  @else
                  -
                  @endif
               </td>
               
            </tr>
         </tbody>
      </table>
   </div>
   <br><br>
   <div class="card-footer">
      @if ($sp->complain_reason)
      {{-- <div class=" col-12 col-lg-10 col-xl-11 text-muted master "> --}}
         #Note dari Karyawan <br>

         <b>{{$sp->complain_reason}}</b>

      {{-- </div> --}}
      @endif
   </div>
</div>