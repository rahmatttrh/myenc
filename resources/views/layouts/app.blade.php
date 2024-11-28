
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      {{-- <title>E-Fleet</title> --}}
      <title>MY ENC - @yield('title')</title>
      <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
      {{-- <link rel="icon" href="{{asset('img/icon.ico')}}" type="image/x-icon"/> --}}
      <link rel="icon" href="{{asset('/img/material.png')}}" type="image/x-icon"/>
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
      <script src="https://balkan.app/js/OrgChart.js"></script>
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

         #tree {
                  width: 100%;
                  height: 100%;
               }

         .custom-node{
            padding-top: 30px; /* Atur padding sesuai kebutuhan Anda */
            padding-bottom: 30px; /* Atur padding sesuai kebutuhan Anda */
            /* Atur properti lain jika diperlukan */
         }

         table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
         }

         table td, table th {
            border: 1px solid #ddd;
            /* padding: 4px; */
         }

         table tr:nth-child(even){background-color: #f2f2f2;}

         table tr:hover {background-color: #ddd;}

         table thead th {
            /* padding-top: 8px;
            padding-bottom: 8px; */
            text-align: left;
            background-color: #478091;
            color: white;
         }
      </style>

      <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
      <script>

      document.addEventListener('DOMContentLoaded', function() {
         var calendarEl = document.getElementById('calendar');
         var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth'
         });
         calendar.render();
      });

      </script>

      <style>
         table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            table td, table th {
            border: 1px solid #ddd;
            padding: 4px;
            }
      </style>

      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   </head>
   <body>
      <div class="wrapper">
         @include('layouts.header')
         @include('layouts.sidebar')

         <div class="main-panel">
            <div class="content">
               @yield('content')
            </div>
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

      @stack('js_footer')
      @stack('chart-dashboard')
      @stack('myjs')

      <script >


         $(document).ready(function() {
            
            $('.select2').select2({});
            $('#material_usage').select2({});
            // $('.select2b').select2({});
            $('.js-example-basic-single').select2({});


            $('.basic-datatables').DataTable( {
               "lengthMenu": [[5,8, 10, 15, 25, 50, 100 , -1], [5,8, 10, 15, 25, 50, 100, "All"]],
               "pageLength": 8,
               "ordering": true,
               initComplete: function () {
                     this.api().columns([5,6,7]).every( function () {
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
               "pageLength": 5,
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

      @if (session('danger'))
         <script>
            $(document).ready(function() {

                  var content = {};
                  content.message = "{{ Session::get('danger') }}";
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

      @if (session('resent'))
         <script>
            $(document).ready(function() {
                  var content = {};
                  content.message = "A fresh verification link has been sent to your email address.";
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
