@extends('layouts.app')
   @section('title')
      Announcement
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Announcement</li>
         </ol>
      </nav>
      <a class="btn btn-light border" href="{{route('announcement.create')}}"><i class="fa fa-plus"></i> Create</a>
      <hr>
      <div class="table-responsive">
         <table class="display basic-datatables  table-sm table-bordered   ">
             <thead>
                
                <tr>
                   {{-- <th scope="col" class="text-center">ID</th> --}}
                   <th scope="col">Type</th>
                   <th>To</th>
                   <th>Title</th>
                   <th>Body</th>
                   <th>Status</th>
                </tr>
             </thead>
             <tbody>
                
                @foreach ($announcements as $announ)
                    <tr>
                     <td>
                        @if ($announ->type == 1)
                        Broadcast
                        @else
                        Personal
                    @endif
                     </td>
                     <td>
                        @if ($announ->type == 1)
                           All
                           @else
                           {{$announ->employee->nik}} {{$announ->employee->biodata->fullName() ?? ''}}
                        @endif
                     </td>
                     <td><a href="{{route('announcement.detail', enkripRambo($announ->id))}}">{{$announ->title}}</a> </td>
                     <td class="text-truncate" style="max-width: 250px">{{strip_tags($announ->body)}}</td>
                     <td>
                        @if ($announ->status == 1)
                           <span class="text-primary">Active</span>
                           @elseif($announ->status == 0)
                           <span class="text-muted">Off</span>
                        @endif
                     </td>
                    </tr>
                @endforeach
                
             </tbody>
          </table>
     </div>
   </div>

@endsection