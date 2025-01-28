<!DOCTYPE html>
<html lang="en">


<!-- molla/index-2.html  22 Nov 2019 09:55:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $meta_title ?? '' }}</title>
    <meta name="keywords" content="{{ $meta_keywords ?? '' }}">
    <meta name="description" content="{{ $meta_description ?? '' }}">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/client/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/client/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/client/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/assets/client/images/icons/site.html">
    <link rel="mask-icon" href="/assets/client/images/icons/safari-pinned-tab.svg" color="#666666">
    <link rel="shortcut icon" href="/assets/client/images/icons/favicon.ico">
    <meta name="apple-mobile-web-app-title" content="Molla">
    <meta name="application-name" content="Molla">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="/assets/client/images/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="/assets/client/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/client/css/plugins/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/assets/client/css/plugins/magnific-popup/magnific-popup.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="/assets/client/css/style.css">
    @yield('stylesheets')
</head>

<body>
    <div class="page-wrapper">
        @include('layouts._header')

        <main class="main">
            @yield('content')
        </main><!-- End .main -->

        @include('layouts._footer')
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    @include('layouts._mobileMenu')

    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register"
                                        role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <form action="#">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email"
                                                name="singin-email" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password"
                                                name="singin-password" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember
                                                    Me</label>
                                            </div><!-- End .custom-checkbox -->

                                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                    </form>
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel"
                                    aria-labelledby="register-tab">
                                    <form id="submitUserFormRegister">
                                        @csrf
                                        <div class="form-group">
                                            <label for="register-name">Name <span class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                id="register-name" name="name">
                                        </div><!-- End .form-group -->
                                        @error('name')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="register-email">Your email address <span
                                                    class="text-danger {{ $errors->has('email') ? 'is-invalid' : '' }}">*</span></label>
                                            <input type="email" class="form-control" id="register-email"
                                                name="email">
                                        </div><!-- End .form-group -->
                                        @error('email')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-group">
                                            <label for="register-password">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control  {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                id="password" name="password">
                                        </div><!-- End .form-group -->
                                        @error('password')
                                            <div class="text-danger" style="margin-top: -15px; margin-bottom: 10px">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="register-policy" required>
                                                <label class="custom-control-label" for="register-policy">I agree to
                                                    the <a href="#">privacy policy</a> *</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .form-footer -->
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->


    @include('layouts._newsletterPopup')
    <!-- Plugins JS File -->
    <script src="/assets/client/js/jquery.min.js"></script>
    <script src="/assets/client/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/client/js/jquery.hoverIntent.min.js"></script>
    <script src="/assets/client/js/jquery.waypoints.min.js"></script>
    <script src="/assets/client/js/superfish.min.js"></script>
    <script src="/assets/client/js/owl.carousel.min.js"></script>
    <script src="/assets/client/js/bootstrap-input-spinner.js"></script>
    <script src="/assets/client/js/jquery.elevateZoom.min.js"></script>
    <script src="/assets/client/js/jquery.magnific-popup.min.js"></script>
    <!-- Main JS File -->
    @yield('scripts')
    <script src="/assets/client/js/main.js"></script>
    <script type="text/javascript">
        $('body').delegate('#submitUserFormRegister', 'submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ url('auth-register') }}",
                data: $('#submitUserFormRegister').serialize(),
                dataType: "json",
                success: function(data) {
                    alert(data.message)
                    if (data.status == true) {
                        location.reload();
                    }
                },
                error: function(data) {}
            })
        })
    </script>
</body>


<!-- molla/index-2.html  22 Nov 2019 09:55:42 GMT -->

</html>
