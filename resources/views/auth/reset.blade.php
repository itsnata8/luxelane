@extends('layouts.app')

@section('content')
    <main class="main">
        <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17"
            style="background-image: url('/assets/client/images/backgrounds/login-bg.jpg')">
            <div class="container">
                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill" role="tablist">
                            <li class="nav-item">
                                <p class="nav-link" id="signin-tab-2" href="#signin-2" role="tab"
                                    aria-controls="signin-2" aria-selected="false">Reset Password</p>
                            </li>
                        </ul>
                        <div class="">
                            <div class="pt-2" aria-labelledby="signin-tab-2">
                                @include('layouts._message')
                                <form action="{{ url('/forgot-password') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="singin-email-2">New Password *</label>
                                        <input type="password" class="form-control" id="singin-email-2" name="password"
                                            required="">
                                    </div><!-- End .form-group -->
                                    <div class="form-group">
                                        <label for="singin-email-2">Confirm Password *</label>
                                        <input type="password" class="form-control" id="singin-email-2" name="cpassword"
                                            required="">
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Reset</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </div><!-- End .form-footer -->
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
            </div><!-- End .container -->
        </div><!-- End .login-page section-bg -->
    </main>
@endsection
