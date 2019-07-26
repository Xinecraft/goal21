<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create New Account - Goal-21.com</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="./vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="./images/favicon.png" />

</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-6 mx-auto">
                    <h2 class="text-center mb-4">Registration Form</h2>
                    <div class="auto-form-wrapper">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                                <div class="col-md-7">
                                    <input placeholder="Full name of user..." id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" required autofocus>

                                    @if ($errors->has('full_name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-7">
                                    <input placeholder="Valid email address..." id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-7">
                                    <input placeholder="***************" id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-7">
                                    <input placeholder="***************" id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                                <div class="col-md-7">
                                    <input placeholder="Active mobile number..." id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>

                                    @if ($errors->has('phone_number'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-7">
                                    {{ Form::select('gender', ['M' => 'Male', 'F' => 'Female', 'O' => 'Others'], null, ['placeholder' => 'Select your gender...', 'class' => 'form-control', 'id' => 'gender', 'required']) }}

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-7">
                                    {{ Form::date('dob', null, ['class' => 'form-control', 'id' => 'dob','required'] ) }}

                                    @if ($errors->has('dob'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="referral_user" class="col-md-4 col-form-label text-md-right">{{ __('Referral Username') }}</label>

                                <div class="col-md-7">
                                    @if(Request::has('referral'))
                                        <input id="referral_user" type="text" class="form-control{{ $errors->has('referral_user') ? ' is-invalid' : '' }}" value="{{ Request::get('referral') }}" disabled>
                                        <input id="referral_user" type="hidden" class="" name="referral_user" value="{{ Request::get('referral') }}">
                                    @else
                                        <input placeholder="Referral username..." id="referral_user" type="text" class="form-control{{ $errors->has('referral_user') ? ' is-invalid' : '' }}" name="referral_user" value="{{ old('referral_user') }}">
                                    @endif

                                    @if ($errors->has('referral_user'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('referral_user') }}</strong>
                                    </span>
                                    @else
                                        <small id="referralHelp" class="form-text text-muted">Enter username of user who referred you. You must have a Username, If you don't plz go to Social media and search Goal21. You will find many.</small>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-7 offset-4">
                                <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>
                                </div>
                            </div>
                            <div class="text-block text-center my-3">
                                <span class="text-small font-weight-semibold">Already have an account ?</span>
                                <a href="./login" class="text-black text-small">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="./vendors/js/vendor.bundle.base.js"></script>
<script src="./vendors/js/vendor.bundle.addons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.5/dist/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
@include('sweetalert::alert')
@include('partials._adsinclude')
<!-- endinject -->
<!-- inject:js -->
<script src="./js/off-canvas.js"></script>
<script src="./js/misc.js"></script>
<!-- endinject -->
@guest
@endguest
</body>

</html>
