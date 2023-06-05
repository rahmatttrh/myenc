{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	{{-- <title>E-Fleet</title> --}}
    <title>E-Fleet - @yield('title')</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	{{-- <link rel="icon" href="{{asset('img/icon.ico')}}" type="image/x-icon"/> --}}
    <link rel="icon" href="{{asset('/img/anchor.png')}}" type="image/x-icon"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   
	<!-- Fonts and icons -->
	<script src="{{asset('js/plugin/webfont/webfont.min.js')}}"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['{{asset('css/fonts.css')}}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/azzara.min.css')}}">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{asset('css/demo.css')}}">
   <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
   <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
   <style>
      .shadow-none{
         box-shadow: none
      }

      a {
         text-decoration: none;
      }

      .card-hover:hover{
         background-color: rgb(241, 240, 240);
         text-decoration: none;
      }
   </style>
</head>
<body>
	<div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')

        @yield('content')

        

</div>
</div>
<!--   Core JS Files   -->
<script src="{{asset('js/core/jquery.3.2.1.min.js')}}"></script>
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>

<!-- jQuery UI -->
<script src="{{asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js')}}"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>

<!-- Moment JS -->
<script src="{{asset('js/plugin/moment/moment.min.js')}}"></script>

<!-- Chart JS -->
<script src="{{asset('js/plugin/chart.js/chart.min.js')}}"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js')}}"></script>

<!-- Chart Circle -->
<script src="{{asset('js/plugin/chart-circle/circles.min.js')}}"></script>

<!-- Datatables -->
<script src="{{asset('js/plugin/datatables/datatables.min.js')}}"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>

<!-- Bootstrap Toggle -->
<script src="{{asset('js/plugin/bootstrap-toggle/bootstrap-toggle.min.js')}}"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

<!-- Google Maps Plugin -->
<script src="{{asset('js/plugin/gmaps/gmaps.js')}}"></script>

<!-- Sweet Alert -->
<script src="{{asset('js/plugin/sweetalert/sweetalert.min.js')}}"></script>

<!-- Azzara JS -->
<script src="{{asset('js/ready.min.js')}}"></script>

<!-- Azzara DEMO methods, don't include it in your project! -->
{{-- <script src="{{asset('js/setting-demo.js')}}"></script> --}}
{{-- <script src="{{asset('js/demo.js')}}"></script> --}}


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script >
    $(document).ready(function() {
        // $('.basic-datatables').DataTable({
        // });

        
      $('.select2').select2({});
      $('#material_usage').select2({});
      // $('.select2b').select2({});
      $('.js-example-basic-single').select2({});


        $('.basic-datatables').DataTable( {
            "lengthMenu": [[5, 10, 15, 25, 50, 100 , -1], [5, 10, 15, 25, 50, 100, "All"]],
            "pageLength": 10,
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control-sm "><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    // .appendTo( $(column.header()).empty())
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                            );

                        column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                    } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        });

        // Add Row
        $('#add-row').DataTable({
            "pageLength": 10,
        });

        var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

        $('#addRowButton').click(function() {
            $('#add-row').dataTable().fnAddData([
                $("#addName").val(),
                $("#addPosition").val(),
                $("#addOffice").val(),
                action
                ]);
            $('#addRowModal').modal('hide');

        });
    });
</script>

@stack('dynamic_equipments')
@stack('dynamic_equipmentslist')
@stack('dynamic_rank')
@stack('wo_form')
@stack('mon_job_add')
@stack('mon_job_edit')
@stack('get_history')
@stack('fetch-material')

    {{-- @if (session('success'))
        <script>
            $(document).ready(function() {
                swal("Good job!", "{!! Session::get('success') !!}", {
                    icon : "success",
                    buttons: {
                        confirm: {
                            className : 'btn btn-success'
                        }
                    },
                });
            });
        </script>
    @endif --}}

    @if (session('success'))
        <script>
            $(document).ready(function() {
                var content = {};
                content.message = "{{ Session::get('success') }}";
			    content.title = 'Success';
                content.icon = 'fa fa-check-circle';

                $.notify(content,{
				type: 'info',
				placement: {
					from: 'top',
					align: 'right'
				},
				time: 1000,
				delay: 0,
			    });
                
            });
        </script>
    @endif

    @if (session('status'))
        <script>
            $(document).ready(function() {
                var content = {};
                content.message = "{{ Session::get('status') }}";
			    content.title = 'Success';
                content.icon = 'fa fa-check-circle';

                $.notify(content,{
				type: 'success',
				placement: {
					from: 'top',
					align: 'right'
				},
				time: 1000,
				delay: 0,
			    });
                
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            $(document).ready(function() {

                var content = {};
                content.message = "{{ Session::get('warning') }}";
			    content.title = 'Failed';
                content.icon = 'fa fa-exclamation-circle';

                $.notify(content,{
				type: 'danger',
				placement: {
					from: 'top',
					align: 'right'
				},
				time: 1000,
				delay: 0,
			    });
                
            });
        </script>
        {{-- {{Session::forget('warning')}} --}}
        {{-- {{Session::forget('success')}} --}}
       {{-- request()->session()->forget('name'); --}}
    @endif


    @if ($errors->any())  
        @foreach ($errors->all() as $error)
        <script>
            $(document).ready(function() {
                var content = {};
                content.message = "{{ $error }}";
                content.title = 'Failed';
                content.icon = 'fa fa-exclamation-circle';

                $.notify(content,{
                type: 'danger',
                placement: {
                    from: 'top',
                    align: 'right'
                },
                time: 1000,
                delay: 0,
                });
            });
        </script>
        @endforeach     
    @endif
   

</body>
</html>
