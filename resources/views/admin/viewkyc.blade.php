@extends('layouts.app')
@section('title', 'Complete Profile')

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
                <h4 class="card-title">KYC DETAILS of {{ $kyc->username }} {!! $kyc->is_kyc > 0 ? "(<span class='text-success'>Approved</span>)" : "(<span class='text-danger'>Pending Approval</span>)" !!}</h4>
                <p class="card-description">
                    Personal info
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $kyc->username }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Email Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{ $kyc->email }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="photo" class="col-sm-3 col-form-label">Upload Photo</label>
                            <div class="col-sm-9">
                                <img src="{{ $kyc->profile_photo }}" alt="" width="100">
                                @if ($errors->has('photo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="pancard" class="col-sm-3 col-form-label">PAN Card</label>
                            <div class="col-sm-9">
                                <input id="pancard" type="text"
                                       class="form-control{{ $errors->has('pancard') ? ' is-invalid' : '' }}"
                                       name="pancard" value="{{ $kyc->pancard }}" disabled>
                                @if ($errors->has('pancard'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pancard') }}</strong>
                                    </span>
                                @endif
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
                                <input id="addr_line1" type="text"
                                       class="form-control{{ $errors->has('addr_line1') ? ' is-invalid' : '' }}"
                                       name="addr_line1" value="{{ $kyc->addr_line1 }}"
                                       disabled>
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
                            <label for="addr_state" class="col-sm-3 col-form-label">State<b>*</b></label>
                            <div class="col-sm-9">
                                <input id="addr_line1" type="text"
                                       class="form-control{{ $errors->has('addr_line1') ? ' is-invalid' : '' }}"
                                       name="addr_line1" value="{{ $kyc->state }}"
                                       disabled>
                                @if ($errors->has('addr_state'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr_state') }}</strong>
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
                                <input id="addr_line2" type="text"
                                       class="form-control{{ $errors->has('addr_line2') ? ' is-invalid' : '' }}"
                                       name="addr_line2" value="{{ $kyc->addr_line2 }}"
                                       disabled>
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
                            <label for="addr_pincode" class="col-sm-3 col-form-label">Pincode<b>*</b></label>
                            <div class="col-sm-9">
                                <input id="addr_pincode" type="text"
                                       class="form-control{{ $errors->has('addr_pincode') ? ' is-invalid' : '' }}"
                                       name="addr_pincode" value="{{ $kyc->pincode }}"
                                       disabled>
                                @if ($errors->has('addr_pincode'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr_pincode') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="addr_city" class="col-sm-3 col-form-label">City<b>*</b></label>
                            <div class="col-sm-9">
                                <input id="addr_city" type="text"
                                       class="form-control{{ $errors->has('addr_city') ? ' is-invalid' : '' }}"
                                       name="addr_city" value="{{ $kyc->city }}" disabled>
                                @if ($errors->has('addr_city'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr_city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="addr_district" class="col-sm-3 col-form-label">District<b>*</b></label>
                            <div class="col-sm-9">
                                <input id="addr_district" type="text"
                                       class="form-control{{ $errors->has('addr_district') ? ' is-invalid' : '' }}"
                                       name="addr_district" value="{{ $kyc->district }}" disabled>
                                @if ($errors->has('addr_district'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('addr_district') }}</strong>
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
                                <input id="bank_account_number" type="text"
                                       class="form-control{{ $errors->has('bank_account_number') ? ' is-invalid' : '' }}"
                                       name="bank_account_number" value="{{ $kyc->bank_account_number }}" disabled>
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
                            <label for="bank_holder_name" class="col-sm-3 col-form-label">Holder Name</label>
                            <div class="col-sm-9">
                                <input id="bank_holder_name" type="text"
                                       class="form-control{{ $errors->has('bank_holder_name') ? ' is-invalid' : '' }}"
                                       name="bank_holder_name" value="{{ $kyc->bank_account_holdername }}" disabled>
                                @if ($errors->has('bank_holder_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_holder_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_bank_name" class="col-sm-3 col-form-label">Bank Name</label>
                            <div class="col-sm-9">
                                <input id="bank_bank_name" type="text"
                                       class="form-control{{ $errors->has('bank_bank_name') ? ' is-invalid' : '' }}"
                                       name="bank_bank_name" value="{{ $kyc->bank_account_bankname }}" disabled>
                                @if ($errors->has('bank_bank_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_bank_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="bank_ifsc_code" class="col-sm-3 col-form-label">IFSC Code</label>
                            <div class="col-sm-9">
                                <input id="bank_ifsc_code" type="text"
                                       class="form-control{{ $errors->has('bank_ifsc_code') ? ' is-invalid' : '' }}"
                                       name="bank_ifsc_code" value="{{ $kyc->bank_account_ifsc }}" disabled>
                                @if ($errors->has('bank_ifsc_code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bank_ifsc_code') }}</strong>
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
                                <input id="bank_ifsc_code" type="text"
                                       class="form-control{{ $errors->has('bank_account_type') ? ' is-invalid' : '' }}"
                                       name="bank_account_type" value="{{ $kyc->bank_account_type }}" disabled>
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
                                <input id="paytm_number" type="text"
                                       class="form-control{{ $errors->has('paytm_number') ? ' is-invalid' : '' }}"
                                       name="paytm_number" value="{{ $kyc->paytm_number }}" disabled>
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
                                <input id="upi_id" type="text"
                                       class="form-control{{ $errors->has('upi_id') ? ' is-invalid' : '' }}"
                                       name="upi_id" value="{{ $kyc->upi_id }}" disabled>
                                @if ($errors->has('upi_id'))
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
                                <input id="preferred_payment_method" type="text"
                                       class="form-control{{ $errors->has('preferred_payment_method') ? ' is-invalid' : '' }}"
                                       name="preferred_payment_method" value="{{ $kyc->preferred_payment_method }}" disabled>
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
                @if($kyc->is_kyc == 0)
                {{ Form::open(['class' => 'col-sm-1 pull-right']) }}
                <input type="hidden" name="action" value="accept">
                <button type="submit" class="btn btn-success mr-2 confirmit monitored-btn" data-confirm-title="Accept this KYC?" data-confirm-text="Please confirm all details before accepting KYC" data-confirm-btncolor="#00ce68" data-confirm-type="info">Accept</button>
                {{ Form::close() }}
                @endif
                {{ Form::open(['class' => 'col-sm-1 pull-right']) }}
                <input type="hidden" name="action" value="reject">
                <button type="submit" class="btn btn-danger mr-2 confirmit monitored-btn" data-confirm-title="Reject this KYC?" data-confirm-text="This will be sent back to user so he can reapply" data-confirm-btncolor="#ffa800" data-confirm-type="info">Reject</button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
