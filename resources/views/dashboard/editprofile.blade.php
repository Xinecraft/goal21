@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-small" role="alert">
            <strong>Error!</strong> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">EDIT PROFILE</h4>
                {!! Form::model($user,['files' => 'true']) !!}
                <p class="card-description">
                    Personal info
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                {{ Form::text('username', null, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                {{ Form::email('email', null, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="full_name" class="col-sm-3 col-form-label">Full Name<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::text('full_name', null, ['class' => 'form-control', 'id' => 'full_name', 'placeholder' => 'Your Full Name...', 'required', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="phone_number" class="col-sm-3 col-form-label">Mobile No.<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::text('phone_number', null, ['class' => 'form-control', 'id' => 'phone_number', 'placeholder' => '10 digit mobile number', 'required', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="gender" class="col-sm-3 col-form-label">Gender<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::select('gender', ['M' => 'Male', 'F' => 'Female', 'O' => 'Others'], null, ['placeholder' => 'Select your gender...', 'class' => 'form-control', 'id' => 'gender', 'required', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="dob" class="col-sm-3 col-form-label">Date of Birth<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::date('dob', null, ['class' => 'form-control', 'id' => 'dob', 'required', 'disabled']) }}
                            </div>
                        </div>
                    </div>
                </div>

                <p class="card-description">
                    Address
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="addr_line1" class="col-sm-3 col-form-label">Address line 1</label>
                            <div class="col-sm-9">
                                {{ Form::text('addr_line1', null, ['class' => 'form-control', 'id' => 'addr_line1', 'placeholder' => 'House Number or Landmark', 'disabled']) }}
                                @if ($errors->has('addr_line1'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr_line1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="state" class="col-sm-3 col-form-label">State<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::select('state', getIndianStates(), null, ['class' => 'form-control', 'placeholder' => 'Select a state...', 'id' => 'state', 'required', 'disabled']) }}
                                @if ($errors->has('state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="addr_line2" class="col-sm-3 col-form-label">Address line 2</label>
                            <div class="col-sm-9">
                                {{ Form::text('addr_line2', null, ['class' => 'form-control', 'id' => 'addr_line2', 'placeholder' => 'Village or Society', 'disabled']) }}
                                @if ($errors->has('addr_line2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr_line2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="pincode" class="col-sm-3 col-form-label">Pincode<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::text('pincode', null, ['class' => 'form-control', 'id' => 'pincode', 'placeholder' => 'Village or Society', 'required', 'disabled']) }}
                                @if ($errors->has('pincode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pincode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label">City<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::text('city', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Your City', 'required', 'disabled']) }}
                                @if ($errors->has('city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="district" class="col-sm-3 col-form-label">District<b>*</b></label>
                            <div class="col-sm-9">
                                {{ Form::text('district', null, ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'Your District', 'required', 'disabled']) }}
                                @if ($errors->has('district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <p class="card-description">
                    Banking Details
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_account_number" class="col-sm-3 col-form-label">Acc. Number</label>
                            <div class="col-sm-9">
                                {{ Form::text('bank_account_number', null, ['class' => 'form-control', 'id' => 'bank_account_number', 'placeholder' => 'Bank Account Number...', 'disabled']) }}
                                @if ($errors->has('bank_account_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_account_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_account_holdername" class="col-sm-3 col-form-label">Holder Name</label>
                            <div class="col-sm-9">
                                {{ Form::text('bank_account_holdername', null, ['class' => 'form-control', 'id' => 'bank_account_holdername', 'placeholder' => 'Bank Account Holder Name...', 'disabled']) }}
                                @if ($errors->has('bank_account_holdername'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_account_holdername') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_account_bankname" class="col-sm-3 col-form-label">Bank Name</label>
                            <div class="col-sm-9">
                                {{ Form::text('bank_account_bankname', null, ['class' => 'form-control', 'id' => 'bank_account_bankname', 'placeholder' => 'Name of the Bank...', 'disabled']) }}
                                @if ($errors->has('bank_account_bankname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_account_bankname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_account_ifsc" class="col-sm-3 col-form-label">IFSC Code</label>
                            <div class="col-sm-9">
                                {{ Form::text('bank_account_ifsc', null, ['class' => 'form-control', 'id' => 'bank_account_ifsc', 'placeholder' => 'Bank Branch IFSC Code...', 'disabled']) }}
                                @if ($errors->has('bank_account_ifsc'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_account_ifsc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_account_type" class="col-sm-3 col-form-label">Acc. Type</label>
                            <div class="col-sm-9">
                                {{ Form::select('bank_account_type',
                                ['SA' => 'Saving Account',
                                 'CA' => 'Current Account',
                                 'RDA' => 'Recurring Deposit Account',
                                 'FDA' => 'Fixed Deposit Account',
                                 'DTA' => 'DEMAT Account',
                                 'NRA' => 'NRI Accounts'
                                 ],
                                 null, ['placeholder' => 'Select account type...', 'id' => 'bank_account_type', 'class' => 'form-control', 'disabled']) }}
                                @if ($errors->has('bank_account_type'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_account_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="paytm_number" class="col-sm-3 col-form-label">PayTM Number</label>
                            <div class="col-sm-9">
                                {{ Form::text('paytm_number', null, ['class' => 'form-control', 'id' => 'paytm_number', 'placeholder' => 'Your PayTM Mobile Number...', 'disabled']) }}
                                @if ($errors->has('paytm_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('paytm_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="upi_id" class="col-sm-3 col-form-label">UPI ID</label>
                            <div class="col-sm-9">
                                {{ Form::text('upi_id', null, ['class' => 'form-control', 'id' => 'upi_id', 'placeholder' => 'Your UPI ID...', 'disabled']) }}
                                @if($errors->has('upi_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('upi_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group row">
                            <label for="preferred_payment_method" class="col-sm-4 col-form-label">Preferred Payment Method<b>*</b></label>
                            <div class="col-sm-7">
                                {{ Form::select('preferred_payment_method',
                                ['BANK' => 'Bank Account',
                                 'PAYTM' => 'PayTM Number',
                                 'UPI' => 'UPI ID'
                                 ],
                                 null, ['placeholder' => 'Select your PPM type...', 'id' => 'preferred_payment_method', 'class' => 'form-control', 'required', 'disabled']) }}
                                @if ($errors->has('preferred_payment_method'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('preferred_payment_method') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <small>Note: Preferred Payment Method is the mode via which you like to receive the payment. It will be displayed on top for your referrals to pay to, though other methods you specified will also be displayed as optional. If you don't want a method to be displayed then leave it blank. You need to enter atleast one of the 3 method.</small>
                </div>

                <br>
                {{--<button type="submit" class="btn btn-success mr-2 confirmit monitored-btn" data-confirm-title="Edit Profile" data-confirm-text="Are you sure you wanna make these changes to your profile?" data-confirm-btncolor="#00ce68" data-confirm-type="info">Edit Profile</button>--}}

                <a href="{{ route('dashboard') }}" class="btn btn-light">Back</a>

                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
