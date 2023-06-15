{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')
   @section('title')
      Verify Your Email
   @endsection
@section('content')
   
   <div class="page-inner">
      {{-- <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verify Your Email</li>
         </ol>
      </nav> --}}
      <div class="page-header d-flex">
         <h5 class="page-title">Verify Email</h5>
         <ul class="breadcrumbs">
            <li class="nav-home">
               <a href="/">
                  <i class="flaticon-home"></i>
               </a>
            </li>
            <li class="separator">
               <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
               <a href="#">Verify Email</a>
            </li>
         </ul>
      </div>
      
      <div class="card shadow-none border">
         {{-- <div class="card-header d-flex align-items-center"> 
            <img src="{{asset('img/flaticon/danger.png')}}" class="mr-2" height="40" alt="">
            <h2>{{ __('Verify Your Email Address') }}</h2>
         </div>  --}}
         <div class="card-body">
            <div class="row align-items-center">
               <div class="col-md-2">
                  <img src="{{asset('img/flaticon/danger.png')}}" class="" height="130"  alt="">
                  {{-- <img src="{{asset('img/undraw/mailbox.png')}}" class="img-thumbnail" alt=""> --}}
               </div>
               <div class="col-md-10">
                  {{-- @if (session('resent'))
                     <div class="alert alert-success shadow-none border" role="alert">
                           {{ __('A fresh verification link has been sent to your email address.') }}
                     </div>
                  @endif --}}
                  <h1>{{ __('Verify Your Email Address') }}</h1>
                  {{ __('Before proceeding, please check your email for a verification link.') }} <br>
                  {{ __('If you did not receive the email') }},   
               
                  <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                     @csrf
                     <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                  </form>
               </div>
            </div>
         </div>
         {{-- <div class="card-footer">
            <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small>
         </div> --}}
      </div>
   </div>

@endsection
