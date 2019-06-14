@extends('layouts.app')
@section('title', 'Add Referral Member')

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
            <h2 class="text-center mb-4 card-title">NEW REFERRAL MEMBER FORM</h2>
            <div class="auto-form-wrapper">
                {{ Form::open() }}

                    <div class="form-group row">
                        <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>

                        <div class="col-md-7">
                            <input id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" required autofocus>

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
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Mobile Number') }}</label>

                        <div class="col-md-7">
                            <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required>

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
                            <input id="referral_user" name="referral_user" type="text" class="form-control" value="{{ old('referral_user') }}">
                        </div>

                        @if ($errors->has('referral_user'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('referral_user') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="form-group row">
                        <div class="col-md-7 offset-4">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Add Member</button>
                        </div>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small text-muted">Note: We will send an email to him with a system generated username and password. User need to login and complete his/her profile before he can appear in your Referral Tree.</span>
                    </div>
                {{ Form::close() }}
            </div>
            </div>
        </div>
    </div>
@endsection
