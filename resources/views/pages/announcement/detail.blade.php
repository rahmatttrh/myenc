@extends('layouts.app')
   @section('title')
      Announcement Detail
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item " aria-current="page">Announcement</li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
         </ol>
      </nav>
      
      @if (auth()->user()->hasRole('Administrator|HRD'))
          @if ($announcement->status == 0)
            <a href="#" data-target="#activate-announcement" data-toggle="modal" class="btn btn-light border">Status : Deactivate</a>
            @elseif($announcement->status == 1)
            <a href="#" data-target="#deactivate-announcement" data-toggle="modal" class="btn btn-success">Status : Active</a>
          @endif
          <hr>
      @endif
      
      
      <div class="card shadow-none border">
         <div class="card-header">
            <h3>{{$announcement->title}}</h3>
         </div>
         <div class="card-body">
            From : HRD <br>
            To : @if ($announcement->type == 1)
                Broadcast
                @else
                {{$announcement->employee->nik}} {{$announcement->employee->biodata->fullName()}}
            @endif
            <hr>
            {!! $announcement->body !!}
         </div>
         <div class="card-footer">
            Created at {{formatDate($announcement->created_at)}}
         </div>
      </div>
   </div>

   <div class="modal fade" id="deactivate-announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content text-dark">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Deactivate Announcement</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body ">
               Deactivate {{$announcement->title}} ?
               <hr>
               <small class="text-muted">Announcement akan di hilangkan dari Dashboard Employee</small>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-danger ">
                  <a class="text-light" href="{{route('announcement.deactivate', enkripRambo($announcement->id))}}">Deactivate</a>
               </button>
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="activate-announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content text-dark">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Activate Announcement</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body ">
               Activate {{$announcement->title}} ?
               <hr>
               <small class="text-muted">Announcement akan di munculkan di Dashboard Employee</small>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-light border" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary ">
                  <a class="text-light" href="{{route('announcement.activate', enkripRambo($announcement->id))}}">Activate</a>
               </button>
            </div>
         </div>
      </div>
   </div>

@endsection