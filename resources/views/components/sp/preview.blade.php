<style>
   .card-body *{
      font-size: 16px
   }
</style>
<div class="card card-invoice">
   <div class="card-header text-center">
      <br>
      <h2><b>SURAT PERINGATAN {{$sp->level}}</b></h2>
            <b>{{$sp->code}}</b>
   </div>
   <div class="card-body pt-4 px-4">
      {{-- <div class="d-flex justify-content-between">
         <div>
            <img src="{{asset('img/logo/enc2.jpg')}}" alt="company logo"><br>
         </div>
         <div class="text-center">
            <h3><b>SURAT PERINGATAN {{$sp->level}}</b></h3>
            <b>{{$sp->code}}</b>
         </div>
      </div> --}}
      
      {{-- <hr> --}}
      <br>
      <p >Kepada Yth.</p>

      <div class="row">
         <div class="col-12">
            <div class="row">
               <div class="col-3">Nama</div>
               <div class="col">: {{$sp->employee->biodata->fullName()}}</div>
            </div>
            <div class="row">
               <div class="col-3">NIK</div>
               <div class="col">: {{$sp->employee->nik}}</div>
            </div>
            <div class="row">
               <div class="col-3">Jabatan</div>
               <div class="col">: {{$sp->employee->position->name}}</div>
            </div>
            <div class="row">
               <div class="col-3">Departemen/Divisi</div>
               <div class="col">: {{$sp->employee->department->name}}</div>
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
            {{-- Test : {{$sp->by->biodata->fullName()}} --}}
            @if ($sp->note)
               <tr>
                  <td style="height: 80px" class="">
                     {{-- {{$sp->id}} --}}
                     @if ($user)
                     {{-- {{$user->id}} --}}
                        {{$user->employee->biodata->fullName()}} <br>
                        <small class="text-muted">{{$user->employee->position->name}}</small>
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
                     {{-- @if ($sp->note)
                     <br> {{$sp->note}} HRD
                        @else
                        
                     @endif --}}
                     

                  </td>
                  <td>
                     {{-- {{$suspect->id}} --}}
                     @if ($sp->status == 5)
                     {{$sp->employee->biodata->fullName()}} <br>
                     {{$sp->employee->position->name}}
                     @endif
                     {{-- @if ($suspect)
                     {{$suspect->employee->biodata->fullName()}} <br>
                     {{$suspect->employee->position->name}}
                     @else
                     -
                     @endif --}}
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
               @else
               <tr>
                  <td style="height: 80px" class="">
                     {{-- @if ($sp->note)
                        @if ($sp->note == 'Recommendation')
                            
                        @endif
                        {{$sp->note}} HRD
                         @else
   
                         @if ($user)
                        {{$user->employee->biodata->fullName()}} <br>
                        {{$user->employee->position->name}}
                        @else
                        -
                        @endif
                        
                     @endif --}}
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
                     @if ($sp->note)
                       <br> {{$sp->note}} HRD
                         @else
                         
                     @endif
                     
   
                  </td>
                  <td>
                     {{-- {{$suspect->id}} --}}
                     @if ($sp->status == 5)
                     {{$sp->employee->biodata->fullName()}} <br>
                     {{$sp->employee->position->name}}
                     @endif
                     {{-- @if ($suspect)
                     {{$suspect->employee->biodata->fullName()}} <br>
                     {{$suspect->employee->position->name}}
                     @else
                     -
                     @endif --}}
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
            @endif

            @if ($sp->note)
            {{-- {{$sp->note}} --}}
            <tr>
               <td colspan="4">
                  @if ($sp->note == 'Recomendation')
                      <small style="font-size: 12px">Rekomendasi HRD</small>
                      @else
                      <small style="font-size: 12px">Excisting SP</small>
                  @endif
               </td>
            </tr>
            @endif

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