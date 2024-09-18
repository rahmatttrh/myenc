@extends('layouts.app')
@section('title')
SP
@endsection
@section('content')

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Surat Peringatan</li>
      </ol>
   </nav>

   <h4>Penerbitan SP dari HRD</h4>
   <hr>
   <form action="{{route('sp.hrd.store')}}" method="POST" enctype="multipart/form-data">
      @csrf
   <div class="row">
      <div class="col-md-6">
         <div class="row">
            <div class="col">
               <div class="form-group form-group-default">
                  <label>Employee*</label>
                  <select class="form-control employee js-example-basic-single" required id="employee" name="employee">
                     <option value="" selected disabled>Select Employee</option>
                     @foreach ($allEmployees as $emp)
                           <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}} </option>
                     @endforeach
                     
                  </select>
                  
   
               </div>
               
            </div>
         </div>
         <div class="row">
            <div class="col-md-7">
               <div class="form-group form-group-default">
                  <label>Type*</label>
                  <select class="form-control   required id="type" name="type">
                     <option value="" selected disabled>Select Type</option>
                     <option value="1">Existing</option>
                     <option value="2">Recomendation</option>
                  </select>
               </div>
            </div>
            <div class="col">
               <div class="form-group form-group-default">
                  <label>Date</label>
                  <input type="date"  class="form-control" name="date_from" id="date_from">
               </div>
            </div>
         </div>
        
            
            
            <div class="row">
               <div class="col-md-4">
                  <div class="form-group form-group-default">
                     <label>Level*</label>
                     <select class="form-control"  id="level" name="level">
                        {{-- <option value="" selected disabled>Select level</option> --}}
                        <option value="I">SP I</option>
                        <option value="II">SP II</option>
                        <option value="III">SP III</option>
                     </select>
   
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>To Leader*</label>
                     <select class="form-control to "  id="to" name="to">
                        
                        
                     </select>
                     
      
                  </div>
               </div>
               
            </div>

         
            <div class="form-group form-group-default">
               <label>Alasan*</label>
               <textarea  class="form-control" name="reason" id="reason" rows="3"></textarea>
            </div>
            <div class="form-group form-group-default">
               <label>Peraturan yang dilanggar*</label>
               <input type="text"  class="form-control" name="rule" id="rule">
            </div>

            
            
         
         
      </div>
      <div class="col-md-4">
         <div class="form-group form-group-default">
            <label>File attachment</label>
            <input type="file" class="form-control" name="file" id="file">
         </div>
         <hr>
         <button type="submit" class="btn btn-block btn-primary">Submit</button>
         <hr>
         <small>* SP akan otomatis aktif ketika klik Submit</small>
      </div>
   </div>
</form>


@push('myjs')
   <script>
      console.log('get_leaders');
   
      $(document).ready(function() {

         $('.employee').change(function() {
            var employee = $('.employee').val();
            var _token = $('meta[name="csrf-token"]').attr('content');
            // console.log('okeee');
            console.log('employee :' + employee);
            
            $.ajax({
               url: "/fetch/leader/" + employee ,
               method: "GET",
               dataType: 'json',

               success: function(result) {
                  
                  $.each(result.result, function(i, index) {
                     $('.to').html(result.result);

                  });
               },
               error: function(error) {
                  console.log(error)
               }

            })
         })
      })
   </script>
@endpush

@endsection