
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>E-Fleet - Login</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('/img/anchor.png')}}" type="image/x-icon"/>

	<script src="{{asset('js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Open+Sans:300,400,600,700"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"],
				urls: ['{{asset('
					css / fonts.css ')}}'
				]
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/atlantis.min.css')}}">

</head>

<body class="login" style="background-image: url({{asset('img/bg-blue.jpg')}}); background-size: cover;">
	
	
	<div class="container">
        <div class="row justify-content-center">
			<div class="col-xl-10 col-lg-12 col-md-9">
				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<div class="row">
							<div class="col-lg-6 d-none d-lg-block " style="background-image: url({{asset('img/vessel/vessel1.jpg')}});background-repeat: no-repeat;background-size: cover;border-radius: 5px;">
								<img class="mt-3" src="{{asset('img/logo/enc2.jpg')}}" alt="">
							</div>
							<div class="col-lg-6">
								<div class="p-5">
									<div class="text-center">
										<h4 class="text-gray-900">Welcome Back!</h4>
										<h1 class="font-weight-bold">MY-ENC</h1>
									</div>
									<hr>
									<form class="user" method="POST" action="{{ route('login') }}">
										@csrf
										<div class="form-group form-group-default">
											<label for="email" class="placeholder"><b>Email</b></label>
											<input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" required>
											@error('email')
											<span class="invalid-feedback bg-danger p-2 rounded mb-2 text-light" role="alert">
												<strong>Fail! {{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group form-group-default">
											<label for="password" class="placeholder"><b>Password</b></label>
											<div class="position-relative">
												<input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
												<div class="show-password">
													<i class="far fa-eye-slash"></i>
												</div>
											</div>
											@error('password')
											<span class="invalid-feedback bg-danger p-2 rounded mb-2 text-light" role="alert">
												<strong>Fail! {{ $message }}</strong>
											</span>
											@enderror
										</div>
										
										<button type="submit" class="btn btn-primary btn-block">Login</button>
									
										<hr>
										<p class="small">E-Fleet adalah system management Material Request dan PMS Monitoring yang digunakan oleh PT PEIP</p>
									</form>
									<hr>
									<div class="login-account">
										<span class="msg">Copyright &copy; 2021 ENC IT</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
	{{-- <div class="wrapper wrapper-login">
		<div class="container container-login animated fadeIn">
			<div class="d-flex  justify-content-center align-items-center">
				<img style="width: 65px;" class="center mr-2 mb-2" src="{{asset('img/enc2.jpg')}}" alt="">
			</div>
			<h1 style=" text-align:center; font-size:32px" class="font-weight-bold "><span class="">E</span>-FLEET</h1>
			<h5 class="text-center">PT PEIP</h5>
			<hr>
			<form method="POST" action="{{ route('login') }}" class="login-form">
				@csrf
				<div class="login-form">
					<div class="form-group">
						<label for="username" class="placeholder"><b>Username</b></label>
						<input id="username" name="username" type="text" class="form-control @error('username') is-invalid @enderror" required>
						@error('username')
						<span class="invalid-feedback bg-danger p-2 rounded mb-2 text-light" role="alert">
							<strong>Fail! {{ $message }}</strong>
						</span>
						@enderror
					</div>
					<div class="form-group">
						<label for="password" class="placeholder"><b>Password</b></label>
						<div class="position-relative">
							<input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required>
							<div class="show-password">
								<i class="far fa-eye-slash"></i>
							</div>
						</div>
						@error('email')
						<span class="invalid-feedback bg-danger p-2 rounded mb-2 text-light" role="alert">
							<strong>Fail! {{ $message }}</strong>
						</span>
						@enderror
					</div>

					<div class="form-group form-action-d-flex mb-3">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="rememberme">
							<label class="custom-control-label m-0" for="rememberme">Remember Me</label>
						</div>
						<button class="btn btn-primary col-md-5  mt-3 mt-sm-0 fw-bold">Sign In</button>
					</div>
					<div class="login-account">
						<span class="msg">Copyright &copy; 2021 ENC IT</span>
					</div>
				</div>
			</form>
		</div>

	
	</div> --}}
	<script src="{{asset('js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('js/core/popper.min.js')}}"></script>
	<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
	<script src="{{asset('js/ready.js')}}"></script>
</body>

</html>