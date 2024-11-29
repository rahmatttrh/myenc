@extends('layouts.app')
@section('title')
Task Create
@endsection
@section('content')

<style>
   .card-bordered {
    border: 1px solid #ebebeb;
}

.card {
    border: 0;
    border-radius: 0px;
    margin-bottom: 30px;
    -webkit-box-shadow: 0 2px 3px rgba(0,0,0,0.03);
    box-shadow: 0 2px 3px rgba(0,0,0,0.03);
    -webkit-transition: .5s;
    transition: .5s;
}

.padding {
    padding: 3rem !important
}

body {
    background-color: #f9f9fa
}

.card-header:first-child {
    border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
}


.card-header {
    display: -webkit-box;
    display: flex;
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    padding: 15px 20px;
    background-color: transparent;
    border-bottom: 1px solid rgba(77,82,89,0.07);
}

.card-header .card-title {
    padding: 0;
    border: none;
}

h4.card-title {
    font-size: 17px;
}

.card-header>*:last-child {
    margin-right: 0;
}

.card-header>* {
    margin-left: 8px;
    margin-right: 8px;
}

.btn-secondary {
    color: #4d5259 !important;
    background-color: #e4e7ea;
    border-color: #e4e7ea;
    color: #fff;
}

.btn-xs {
    font-size: 11px;
    padding: 2px 8px;
    line-height: 18px;
}
.btn-xs:hover{
    color:#fff !important;
}




.card-title {
    font-family: Roboto,sans-serif;
    font-weight: 300;
    line-height: 1.5;
    margin-bottom: 0;
    padding: 15px 20px;
    border-bottom: 1px solid rgba(77,82,89,0.07);
}


.ps-container {
    position: relative;
}

.ps-container {
    -ms-touch-action: auto;
    touch-action: auto;
    overflow: hidden!important;
    -ms-overflow-style: none;
}

.media-chat {
    padding-right: 64px;
    margin-bottom: 0;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media .avatar {
    flex-shrink: 0;
}

.avatar {
    position: relative;
    display: inline-block;
    width: 36px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    border-radius: 100%;
    background-color: #f5f6f7;
    color: #8b95a5;
    text-transform: uppercase;
}

.media-chat .media-body {
    -webkit-box-flex: initial;
    flex: initial;
    display: table;
}

.media-body {
    min-width: 0;
}

.media-chat .media-body p {
    position: relative;
    padding: 6px 8px;
    margin: 4px 0;
    background-color: #f5f6f7;
    border-radius: 3px;
    font-weight: 100;
    color:#9b9b9b;
}

.media>* {
    margin: 0 8px;
}

.media-chat .media-body p.meta {
    background-color: transparent !important;
    padding: 0;
    opacity: .8;
}

.media-meta-day {
    -webkit-box-pack: justify;
    justify-content: space-between;
    -webkit-box-align: center;
    align-items: center;
    margin-bottom: 0;
    color: #8b95a5;
    opacity: .8;
    font-weight: 400;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media-meta-day::before {
    margin-right: 16px;
}

.media-meta-day::before, .media-meta-day::after {
    content: '';
    -webkit-box-flex: 1;
    flex: 1 1;
    border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
    content: '';
    -webkit-box-flex: 1;
    flex: 1 1;
    border-top: 1px solid #ebebeb;
}

.media-meta-day::after {
    margin-left: 16px;
}

.media-chat.media-chat-reverse {
    padding-right: 12px;
    padding-left: 64px;
    -webkit-box-orient: horizontal;
    -webkit-box-direction: reverse;
    flex-direction: row-reverse;
}

.media-chat {
    padding-right: 64px;
    margin-bottom: 0;
}

.media {
    padding: 16px 12px;
    -webkit-transition: background-color .2s linear;
    transition: background-color .2s linear;
}

.media-chat.media-chat-reverse .media-body p {
    float: right;
    clear: right;
    background-color: #48b0f7;
    color: #fff;
}

.media-chat .media-body p {
    position: relative;
    padding: 6px 8px;
    margin: 4px 0;
    background-color: #f5f6f7;
    border-radius: 3px;
}


.border-light {
    border-color: #f1f2f3 !important;
}

.bt-1 {
    border-top: 1px solid #ebebeb !important;
}

.publisher {
    position: relative;
    display: -webkit-box;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    padding: 12px 20px;
    background-color: #f9fafb;
}

.publisher>*:first-child {
    margin-left: 0;
}

.publisher>* {
    margin: 0 8px;
}

.publisher-input {
    -webkit-box-flex: 1;
    flex-grow: 1;
    border: none;
    outline: none !important;
    background-color: transparent;
}

button, input, optgroup, select, textarea {
    font-family: Roboto,sans-serif;
    font-weight: 300;
}

.publisher-btn {
    background-color: transparent;
    border: none;
    color: #8b95a5;
    font-size: 16px;
    cursor: pointer;
    overflow: -moz-hidden-unscrollable;
    -webkit-transition: .2s linear;
    transition: .2s linear;
}

.file-group {
    position: relative;
    overflow: hidden;
} 

.publisher-btn {
    background-color: transparent;
    border: none;
    color: #cac7c7;
    font-size: 16px;
    cursor: pointer;
    overflow: -moz-hidden-unscrollable;
    -webkit-transition: .2s linear;
    transition: .2s linear;
} 

.file-group input[type="file"] {
    position: absolute;
    opacity: 0;
    z-index: -1; 
    width: 20px;
}

.text-info {
    color: #48b0f7 !important;
}
</style>

<div class="page-inner">
   <nav aria-label="breadcrumb ">
      <ol class="breadcrumb  ">
         <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
         <li class="breadcrumb-item active" aria-current="page">Task Create</li>
      </ol>
   </nav>

   <div class="row">
      <div class="col-md-7">
         
         <div class="card">
            <div class="card-header bg-primary text-white p-2">
               <small class="text-uppercase">Task Detail</small>
            </div>
            <div class="card-body p-0">
               <table>
                  <tbody>
                     <tr>
                        <td style="min-width: 150px">Status</td>
                        @if ($task->status == 0)
                           <td class="bg-danger text-light">Open</td>
                           @elseif($task->status == 1)
                           <td class="bg-info text-light">Progress</td>
                           @else
                           <td class="bg-success text-light">Closed</td>
                           
                        @endif
                        
                     </tr>
                     <tr>
                        <td>Kategori</td>
                        <td>{{$task->category}}</td>
                     </tr>
                     <tr>
                        <td>Action Plan</td>
                        <td>{{$task->plan}}</td>
                     </tr>
                     <tr>
                        <td>Target</td>
                        <td>{{formatDate($task->target)}}</td>
                     </tr>
                     <tr>
                        <td>Closed</td>
                        <td>
                           @if ($task->closed)
                           {{formatDate($task->closed)}}
                           @else
                           -
                           @endif
                           </td>
                     </tr>
                     <tr>
                        <td>Keterangan</td>
                        <td>{{$task->desc}}</td>
                     </tr>
                     <tr>
                        <td class="d-flex justify-content-between">
                           <span>PIC</span>
                           
                        </td>
                        <td>
                           <a href="" data-toggle="modal" data-target="#modal-task-pic">Add New</a>
                           
                        </td>
                     </tr>
                     
                     {{-- <tr>
                        <td class="pl-4"><a href="" data-toggle="modal" data-target="#modal-task-pic">Add New PIC</a></td>
                        <td>-</td>
                     </tr> --}}
                     @foreach ($task->employees()->get() as $emp)
                         <tr>
                           <td>
                           
                           </td>
                           <td>{{$emp->nik}} {{$emp->biodata->fullName()}}</td>
                         </tr>
                     @endforeach
                     {{-- @if ($task->status > 0) --}}
                    
                     {{-- @endif --}}
                     {{--  --}}
                  </tbody>
               </table>
            </div>
         </div>
         <hr>
         @if ($task->status != 2)
             
         
         <form action="{{route('task.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="number" name="task" id="task" value="{{$task->id}}" hidden>
            <div class="row">
               <div class="col-md-7">
                  <div class="form-group form-group-default">
                     <label>Status</label>
                     <select name="status" id="status" class="form-control" required>
                        <option value="0">Open</option>
                        <option value="1">Progress</option>
                        <option value="2">Closed</option>
                     </select>
                     {{-- <input type="date"  class="form-control" name="target" id="target"> --}}
                  </div>
               </div>
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Date</label>
                     <input type="date"  class="form-control" required name="date" id="date">
                  </div>
               </div>
            </div>

            <div class="form-group form-group-default">
               <label>Keterangan</label>
               <input type="text"  class="form-control" required name="desc" id="desc">
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group form-group-default">
                     <label>Evidence</label>
                     <input type="file"  class="form-control" required name="evidence" id="evidence">
                  </div>
               </div>
               <div class="col-md-3">
                  <button type="submit" class="btn btn-block  btn-primary">Update</button>
               </div>
            </div>
            
            
            
         </form>
         <hr>
         @endif

         @if ($task->evidence)
         <img src="{{asset('storage/'. $task->evidence)}}" class="img-fluid" alt="Responsive image">
         @endif
            
         
      </div>
      <div class="col-md-5">
         <div class="card card-bordered">
            <div class="card-header">
               <h4 class="card-title text-primary"><i class="fa fa-comment"></i> <strong>MyENChat</strong></h4>
               {{-- <a class="btn btn-xs btn-secondary" href="#" data-abc="true">Let's Chat App</a> --}}
            </div>


            <div class="ps-container ps-theme-default ps-active-y" id="chat-content" style="overflow-y: scroll !important; height:400px !important;">
               

               @foreach ($chats as $chat)
                  @if ($chat->type == 'leader')
                     <div class="media media-chat mb-0">
                        <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                        
                        <div class="media-body">
                           <small>{{$chat->employee->biodata->fullName()}}</small>
                           <p class="text-dark">{{$chat->message}}</p>
                           
                           <p class="meta"><time datetime="2018">{{$chat->created_at->format('d-m-Y h:m')}}</time></p>
                        </div>
                     </div>
                     @else

                     <div class="media media-chat media-chat-reverse">
                        <img class="avatar" src="https://img.icons8.com/color/36/000000/user.png" alt="...">
                        {{-- small>{{$chat->employee->biodata->fullName()}}</small> --}}
                        <div class="media-body">
                           
                           <p>{{$chat->message}}</p>
                           
                           <p class="meta text-dark"><time datetime="2018">{{$chat->employee->biodata->first_name}} {{$chat->created_at->format('d-m-Y h:m')}}  </time></p>
                        </div>
                     </div>
                  @endif
                  
               @endforeach
               

              

               

               {{-- <div class="media media-chat media-chat-reverse">
                  <img class="avatar" src="https://img.icons8.com/color/36/000000/user.png" alt="...">
               <div class="media-body">
                  <p>Hiii, I'm good.</p>
                  <p>How are you doing?</p>
                  <p>Long time no see! Tomorrow office. will be free on sunday.</p>
                  <p class="meta"><time datetime="2018">00:06</time></p>
               </div>
               </div>

               <div class="media media-chat">
               <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
               <div class="media-body">
                  <p>Okay</p>
                  <p>We will go on sunday? </p>
                  <p class="meta"><time datetime="2018">00:07</time></p>
               </div>
               </div>

               <div class="media media-chat media-chat-reverse">
               <div class="media-body">
                  <p>That's awesome!</p>
                  <p>I will meet you Sandon Square sharp at 10 AM</p>
                  <p>Is that okay?</p>
                  <p class="meta"><time datetime="2018">00:09</time></p>
               </div>
               </div>

               <div class="media media-chat">
               <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
               <div class="media-body">
                  <p>Okay i will meet you on Sandon Square </p>
                  <p class="meta"><time datetime="2018">00:10</time></p>
               </div>
               </div>

               <div class="media media-chat media-chat-reverse">
                  <div class="media-body">
                     <p>Do you have pictures of Matley Marriage?</p>
                     <p class="meta"><time datetime="2018">00:10</time></p>
                  </div>
               </div>

               <div class="media media-chat">
               <img class="avatar" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
               <div class="media-body">
                  <p>Sorry I don't have. i changed my phone.</p>
                  <p class="meta"><time datetime="2018">00:12</time></p>
               </div>
               </div>

               <div class="media media-chat media-chat-reverse">
               <div class="media-body">
                  <p>Okay then see you on sunday!!</p>
                  <p class="meta"><time datetime="2018">00:12</time></p>
               </div>
               </div> --}}

               <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                  <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
               </div>
               <div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;">
                  <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div>
               </div>
            </div>

            <form action="{{route('chat.store')}}" method="POST">
               @csrf
               <input type="number" name="task" id="task" value="{{$task->id}}" hidden>

               <div class="publisher bt-1 border-light">
                @if (auth()->user()->hasRole('Karyawan'))
                <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/user.png" alt="...">
                    @else
                    <img class="avatar avatar-xs" src="https://img.icons8.com/color/36/000000/administrator-male.png" alt="...">
                @endif
                  
                  
                     <input class="publisher-input" id="message" name="message" required type="text" placeholder="Write something">
                     {{-- <span class="publisher-btn file-group">
                     <i class="fa fa-paperclip file-browser"></i>
                     <input type="file">
                     </span> --}}
                     {{-- <a class="publisher-btn" href="#" data-abc="true"><i class="fa fa-smile"></i></a> --}}
                     <button type="submit" class="btn btn-primary">
                        <i class="fa fa-paper-plane"></i>
                     </button>
                     {{-- <a class="publisher-btn text-info" href="#" data-abc="true"></a> --}}
                  
               </div>
            </form>

         </div>


         
             
          
      </div>
   </div>


   <div class="modal fade" id="modal-task-pic"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Form Add New PIC</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <form action="{{route('task.add.pic')}}" method="POST" >
               <div class="modal-body">
                  @csrf
                  <input type="number" name="task" id="task" value="{{$task->id}}" hidden>
                  <div class="">
                     {{-- <label>New PIC</label> --}}
                     <select class="form-control js-example-basic-single" style="width: 100%"  id="employee" name="employee" >
                        {{-- <option value="" disabled selected>Choose one</option> --}}
                        @foreach ($employees as $emp)
                           <option value="{{$emp->id}}">{{$emp->nik}} {{$emp->biodata->fullName()}}</option>
                        @endforeach
                        {{-- <option value="" selected disabled>Select</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Tetap">Tetap</option> --}}
                     </select>
                     @error('type')
                     <small class="text-danger"><i>{{ $message }}</i></small>
                     @enderror
                  </div>
                     
                     
   
                   
                     
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info ">Add</button>
               </div>
               <div class="modal-body text-start">
                  
               </div>
            </form>
         </div>
      </div>
   </div>
   
   


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