<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{asset('admin-assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/summernote/summernote-bs4.css')}}">
    <!-- datatable -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/bootstrap-sweetalert/dist/sweetalert.css')}}">
    <!-- toastr -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/toastr/toastr.min.css')}}">
    <!-- pace-progress -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/pace-progress/themes/black/pace-theme-flat-top.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

     <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">


    {{-- dropzone --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css"
        integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA=="
        crossorigin="anonymous" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">

    <!--bootstrap  datetime picker -->
    <link rel="stylesheet"
        href="{{ asset('admin-assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">


    <!-- jQuery -->
    <script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>

    {{-- ajax header setup --}}
    <script src="{{asset('js/ajaxSetup.js')}}"></script>

    {{-- basic functions --}}
    <script src="{{asset('js/basicFunctions.js')}}"></script>

    {{-- console warning --}}
    <script src="{{asset('js/consoleWarning.js')}}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed pace-primary">
    <div class="wrapper">

        <!-- Navbar -->
        @include('admin.layouts.partials.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('admin.layouts.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @yield('breadcrumb')

                        </div><!-- /.col -->
                        <div class="col-sm-6 float-right text-right">
                        <div>{{date_format(Carbon\Carbon::now(), 'D, F j, Y')}} <span class="clock"></span></div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.layouts.partials.footer')

        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script>
        function clock() { // We create a new Date object and assign it to a variable called "time".
            var time = new Date(),

                // Access the "getHours" method on the Date object with the dot accessor.
                hours = time.getHours(),

                // Access the "getMinutes" method with the dot accessor.
                minutes = time.getMinutes(),


                seconds = time.getSeconds();

            document.querySelectorAll('.clock')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(
                seconds);

            function harold(standIn) {
                if (standIn < 10) {
                    standIn = '0' + standIn
                }
                return standIn;
            }
        }
        setInterval(clock, 1000);

    </script>


    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('admin-assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Datatables -->
    <script src="{{asset('admin-assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <!-- moment -->
    <script src="{{asset('admin-assets/plugins/moment/moment.min.js')}}"></script>
    <!--bootstrap  datetime picker -->
    <script
        src="{{asset('admin-assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js')}}">
    </script>
    <!--sweet alert -->
    <script src="{{asset('admin-assets/plugins/bootstrap-sweetalert/dist/sweetalert.min.js')}}"></script>
    <!-- toastr -->
    <script src="{{asset('admin-assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- pace-progress -->
    <script src="{{asset('admin-assets/plugins/pace-progress/pace.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('admin-assets/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('admin-assets/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('admin-assets/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('admin-assets/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- jquery Validation -->
    <script src="{{asset('admin-assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('admin-assets/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('admin-assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}">
    </script>

    <!-- Select2 -->
    <script src="{{asset('admin-assets/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('admin-assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('admin-assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin-assets/dist/js/adminlte.js')}}"></script>
    <!-- dropzonejs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.js"
        integrity="sha512-8l10HpXwk93V4i9Sm38Y1F3H4KJlarwdLndY9S5v+hSAODWMx3QcAVECA23NTMKPtDOi53VFfhIuSsBjjfNGnA=="
        crossorigin="anonymous"></script>

    {{-- log viewer     --}}
    @yield('modals')
    @yield('scripts')
</body>

</html>
