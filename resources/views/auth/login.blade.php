{{--
<!DOCTYPE html>
<html lang="en">

<head>

    <title>Wonder Box</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <link href="plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->


<link rel="stylesheet" href="{{asset('client-assets/plugins/toastr/toastr.min.css')}}">

<link rel="stylesheet" href="{{asset('client-assets/css/log.css')}}" />

<script src="{{asset('client-assets/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('js/basicFunctions.js')}}"></script>
<script src="{{asset('js/ajaxSetup.js')}}"></script>
<title>Wonder Box</title>
</head>

<body>
    <style>
        .alert {
            padding: 20px;
            background-color: #f44336;
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            margin-bottom: 15px;
        }

        .alert.success {
            background-color: #4CAF50;
        }

        .alert.info {
            background-color: #2196F3;
        }

        .alert.warning {
            background-color: #ff9800;
        }

        .closebtn {
            margin-left: 15px;
            color: white;
            font-weight: bold;
            float: right;
            font-size: 22px;
            line-height: 20px;
            cursor: pointer;
            transition: 0.3s;
        }

        .closebtn:hover {
            color: black;
        }

    </style>

    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">

                <form class="sign-in-form" id="loginForm">
                    <h2 class="title">Sign in</h2>
                    <div>
                        @if (session('status'))
                        <div class="alert success">
                            <span class="closebtn">&times;</span>
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>
                    <div id="login-errors">

                    </div>
                    @csrf
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" autofocus placeholder="Email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password" minlength="6"
                            required />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn solid" id="btn-login"
                        data-loading-text='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging In...'
                        data-normal-text="Login">
                        <span class="ui-button-text">Login</span>
                    </button>


                </form>
                <form class="sign-up-form" id="registerForm">
                    @csrf
                    <h2 class="title">Register</h2>
                    <div id="register-errors">

                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" autofocus placeholder="Name" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" id="email" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Password" id="password" name="password" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Re-Write Password" id="password-confirm"
                            name="password_confirmation" required />
                    </div>
                    <button type="submit" class="btn" id="btn-register"
                        data-loading-text='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...'
                        data-normal-text="Register">
                        <span class="ui-button-text">Register</span>
                    </button>



                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>Are You New Here ?</h3>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis,
                        ex ratione. Aliquid!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Register
                    </button>
                </div>
                <!-- <img src="img/log.svg" class="image" alt="" /> -->
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Sign In Now</h3>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum
                        laboriosam ad deleniti.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Sign in
                    </button>
                </div>
                <!-- <img src="img/register.svg" class="image" alt="" /> -->
            </div>
        </div>

    </div>







    <script src="{{asset('client-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>



    <script src="{{asset('client-assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('client-assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>


    <script src="{{asset('client-assets/plugins/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('client-assets/js/log.js')}}"></script>
    <script>
        $(document).ready(() => {

            errorStyleInit();


            /**
             * @name form onsubmit
             * @description override the default form submission and submit the form manually.
             *              also validate with .validate() method from jquery validation
             * @parameter formid
             * @return
             */
            $('#loginForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData($('#loginForm')[0]);
                $.ajax({
                    url: "{{ url('login') }}",
                    method: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    cache: false,
                    contentType: false,
                    timeout: 600000,
                    beforeSend: function () {
                        btnLoadStart("btn-login");
                    },
                    complete: function () {
                        btnLoadEnd("btn-login");
                    },
                    success: function (result) {
                        console.log(result);
                        if (result.auth) {
                            toastr.success(
                                "Login Successful!",
                                'Success!', {
                                    timeOut: 2000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-top-center",
                                });

                            redirect(result.intended, 200);
                        }

                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.Verify Network.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });

                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 413) {
                            msg = 'Request entity too large. [413]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 419) {
                            msg = 'CSRF error or Unknown Status [419]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else {
                            console.log(jqXHR.responseJSON.errors);
                            var errorMarkup = '';

                            $.each(jqXHR.responseJSON.errors, function (key, val) {

                                errorMarkup += '<div class="alert">';
                                errorMarkup +=
                                    '<span class="closebtn">&times;</span>';
                                errorMarkup += '<strong>Error!</strong>' + val +
                                    '</div>';

                            });

                            $("#login-errors").append(errorMarkup);
                            errorStyleInit();

                            btnLoadEnd("btn-login");
                            //$("#sign-up-btn").click();
                        }

                    }
                });



            });

            /**
             * @name form onsubmit
             * @description override the default form submission and submit the form manually.
             *              also validate with .validate() method from jquery validation
             * @parameter formid
             * @return
             */
            $('#registerForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData($('#registerForm')[0]);
                $.ajax({
                    url: "{{ url('register') }}",
                    method: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    cache: false,
                    contentType: false,
                    timeout: 600000,
                    beforeSend: function () {
                        btnLoadStart("btn-register");
                    },
                    complete: function () {
                        btnLoadEnd("btn-register");
                    },
                    success: function (result) {
                        console.log(result);
                        if (result.auth) {
                            toastr.success(
                                "Registration Successful!",
                                'Success!', {
                                    timeOut: 2000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-top-center",
                                });

                            redirect(result.intended, 200);
                        }

                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.Verify Network.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });

                            btnLoadEnd("btn-register");
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else if (jqXHR.status == 413) {
                            msg = 'Request entity too large. [413]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else if (jqXHR.status == 419) {
                            msg = 'CSRF error or Unknown Status [419]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-register");
                        } else {
                            console.log(jqXHR.responseJSON.errors);
                            var errorMarkup = '';

                            $.each(jqXHR.responseJSON.errors, function (key, val) {

                                errorMarkup += '<div class="alert">';
                                errorMarkup +=
                                    '<span class="closebtn">&times;</span>';
                                errorMarkup += '<strong>Error!</strong>' + val +
                                    '</div>';

                            });

                            $("#register-errors").append(errorMarkup);
                            errorStyleInit();

                            btnLoadEnd("btn-register");
                            //$("#sign-up-btn").click();
                        }

                    }
                });



            });
        });

        function errorStyleInit() {
            var close = $(".closebtn");
            var i;

            for (i = 0; i < close.length; i++) {
                close[i].onclick = function () {
                    var div = this.parentElement;
                    div.style.opacity = "0";
                    setTimeout(function () {
                        div.style.display = "none";
                    }, 600);
                }
            }
        }

    </script>
</body>

</html> --}}

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
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('admin-assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-assets/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{asset('admin-assets/plugins/jquery/jquery.min.js')}}"></script>

    <script src="{{asset('js/basicFunctions.js')}}"></script>
    <script src="{{asset('js/ajaxSetup.js')}}"></script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{url('/')}}"><b>Assignment</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="loginForm">
                    <div>
                        @if (session('status'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Error!</strong> {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        {{-- <div class="alert success">
                            <span class="closebtn">&times;</span>
                            {{ session('status') }}
                    </div> --}}
                    @endif
            </div>
            <div id="login-errors">

            </div>
            <div class="input-group mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required minlength="6">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-12">
                    {{-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> --}}
                    <button type="submit" class="btn btn-primary btn-block" id="btn-login"
                        data-loading-text='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
                        data-normal-text="Login">
                        <span class="ui-button-text">Login</span>
                    </button>
                </div>
                <!-- /.col -->
            </div>
            </form>

            {{-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}
            <!-- /.social-auth-links -->

            {{-- <p class="mb-1">
                <a href="forgot-password.html">I forgot my password</a>
            </p> --}}
            {{-- <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->


    <!-- Bootstrap 4 -->
    <script src="{{asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin-assets/dist/js/adminlte.min.js')}}"></script>

    <script src="{{asset('admin-assets/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin-assets/plugins/jquery-validation/additional-methods.min.js')}}"></script>

    <script src="{{asset('admin-assets/plugins/toastr/toastr.min.js')}}"></script>


    <script>
        $(document).ready(() => {


            /**
             * @name form onsubmit
             * @description override the default form submission and submit the form manually.
             *              also validate with .validate() method from jquery validation
             * @parameter formid
             * @return
             */
            $('#loginForm').submit(function (e) {
                e.preventDefault();

                var formData = new FormData($('#loginForm')[0]);
                $.ajax({
                    url: "{{ url('login') }}",
                    method: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    cache: false,
                    contentType: false,
                    timeout: 600000,
                    beforeSend: function () {
                        btnLoadStart("btn-login");
                    },
                    complete: function () {
                        btnLoadEnd("btn-login");
                    },
                    success: function (result) {
                        console.log(result);
                        if (result.auth) {
                            toastr.success(
                                "Login Successful!",
                                'Success!', {
                                    timeOut: 2000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-top-center",
                                });

                            redirect(result.intended, 100);
                        }

                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.Verify Network.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });

                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 413) {
                            msg = 'Request entity too large. [413]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 419) {
                            msg = 'CSRF error or Unknown Status [419]';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                            toastr.warning(
                                msg,
                                'Error!', {
                                    timeOut: 5000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            btnLoadEnd("btn-login");
                        } else {
                            console.log(jqXHR.responseJSON.errors);
                            var errorMarkup = '';

                            $.each(jqXHR.responseJSON.errors, function (key, val) {


                                errorMarkup +=
                                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                                errorMarkup +=  val;
                                errorMarkup +=
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                                errorMarkup +=
                                    '<span aria-hidden="true">&times;</span></button>';

                                errorMarkup += '</div>';

                            });

                            $("#login-errors").append(errorMarkup);
                            //errorStyleInit();

                            btnLoadEnd("btn-login");
                            //$("#sign-up-btn").click();
                        }

                    }
                });



            });

        });

    </script>

</body>




</html>
