<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>DSP - 500</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('stisla/modules/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('stisla/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('stisla/css/components.css')}}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="page-error">
          <div class="page-inner">
            <h1>ERROR</h1>
            <div class="page-description">
            	<b>Maaf, ada kesalahan</b> <br>
               Screenshoot halaman ini dan segera laporkan kepada tim IT/HRD, terimakasih :)
            </div>
            <div class="page-search">
              
              <div class="mt-3">
                  {{-- <button onclick="history.back()" class="btn btn-primary btn-lg">take me back</button> --}}
                <a href="/" class="btn btn-primary btn-lg">Back Home</a>
              </div>
              <hr>
              {{Request::url()}} <br>
              {{$exception->getMessage() . ' line: ' . __LINE__}}
            </div>
          </div>
        </div>
        <div class="simple-footer mt-5">
          Copyright &copy; 2024 MyENC | ENC Development
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('stisla/modules/jquery.min.js')}}"></script>
  <script src="{{asset('stisla/modules/popper.js')}}"></script>
  <script src="{{asset('stisla/modules/tooltip.js')}}"></script>
  <script src="{{asset('stisla/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('stisla/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('stisla/modules/moment.min.js')}}"></script>
  <script src="{{asset('stisla/js/stisla.js')}}"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{asset('stisla/js/scripts.js')}}"></script>
  <script src="{{asset('stisla/js/custom.js')}}"></script>
</body>
</html>