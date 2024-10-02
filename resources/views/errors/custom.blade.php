<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Maintenance</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="{{asset('img/icon.ico')}}" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="{{asset('js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['../assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/azzara.min.css')}}">
</head>
<body class="page-not-found" style="background-image: none">
	<div class="wrapper not-found text-center" style="background-image: none">
		<h1>MAINTENANCE</h1>
      <hr>
		<span>Sistem dalam tahap pemeliharaan untuk meningkatkan kualitas layanan. <br> Mohon maaf atas ketidaknyamanan yang ditimbulkan, sistem akan kembali dalam beberapa saat lagi.</span>
      <hr>
		{{-- <a href="#" class="btn btn-primary btn-back-home mt-4 Up">
			
			Go to New MyENC Address
		</a> --}}
		<hr>
      <hr>
      <div >
         Salam,  <br>
         - IT Development Ekanuri -
      </div>
		{{-- {{Request::url()}} <br>
    	{{$exception->getMessage() . ' line: ' . __LINE__}} --}}
	</div>
	<script src="{{asset('js/core/jquery.3.2.1.min.js')}}"></script>
	<script src="{{asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
	<script src="{{asset('js/core/popper.min.js')}}"></script>
	<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="//themera.net/embed/themera.js?id=71769"></script>
</body>
</html>