@extends('layouts.app')
@section('title', 'Change Password')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-small" role="alert">
            <strong>Error!</strong> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row w-100">
        <div class="col-lg-6 mx-auto card">
            <div class="card-body">
                <h2 class="text-center mb-4 card-title">RESET PASSWORD</h2>
                <div class="auto-form-wrapper">
                    {{ Form::open() }}

                    <div class="form-group row">
                        <label for="curr_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                        <div class="col-md-7">
                            <input id="curr_password" type="password" class="form-control{{ $errors->has('curr_password') ? ' is-invalid' : '' }}" name="curr_password" required autofocus>

                            @if ($errors->has('curr_password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('curr_password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                        <div class="col-md-7">
                            <input id="password" type="text" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Password Again') }}</label>

                        <div class="col-md-7">
                            <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-7 offset-4">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Reset Password</button>
                        </div>
                    </div>

                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
