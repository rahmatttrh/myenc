{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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


@extends('layouts.app')
   @section('title')
      Send Reset Password Link
   @endsection
@section('content')
   
   <div class="page-inner">
      <nav aria-label="breadcrumb ">
         <ol class="breadcrumb  ">
            <li class="breadcrumb-item " aria-current="page"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Send Reset Password Link</li>
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
                  @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row">
                           <div class="col-md-6">
                              {{-- <img src="{{asset('img/undraw/password.png')}}" class="img-thumbnail" alt=""> --}}
                              <div class="form-group form-group-default">
                                 <label>Email *</label>
                                 <input id="email" name="email" readonly type="text" value="{{auth()->user()->email}}" class="form-control">
                                 @error('email')
                                    <small class="text-danger"><i>{{ $message }}</i></small>
                                 @enderror
                              </div>
                              <hr>
                              <button type="submit" class="btn btn-primary">
                                 {{ __('Send Password Reset Link') }}
                             </button>
                           </div>
                           <div class="col-md-6">
                              <img src="{{asset('img/undraw/password.png')}}" class="img-thumbnail" alt="">
                           </div>
                        </div>
                        
                        {{-- <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        
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