{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app-old')
   @section('title')
      Reset Password
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
         </ol>
      </nav>
      
      <div class="row">
         <div class="col-sm-12 col-md-12">
            <div class="card">
               <div class="card-header d-flex"> 
                  <div class="d-flex  align-items-center">
                     <div class="card-title">Reset Password</div> 
                  </div>
                  
               </div> 
               <div class="card-body">
                  <form method="POST" action="{{ route('password.update') }}">
                     @csrf

                     <input type="hidden" name="token" value="{{ $token }}">

                     <div class="row mb-3">
                         <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                         <div class="col-md-6">
                             <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                             @error('email')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="row mb-3">
                         <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                         <div class="col-md-6">
                             <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                             @error('password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                             @enderror
                         </div>
                     </div>

                     <div class="row mb-3">
                         <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                         <div class="col-md-6">
                             <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                         </div>
                     </div>

                     <div class="row mb-0">
                         <div class="col-md-6 offset-md-4">
                             <button type="submit" class="btn btn-primary">
                                 {{ __('Reset Password') }}
                             </button>
                         </div>
                     </div>
                 </form>
               </div>
               <div class="card-footer">
                  <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quo, autem laborum?</small>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection
