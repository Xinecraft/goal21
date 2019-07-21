@extends('layouts.app')
@section('title', 'Upgrade your Id')

@section('content')
    <div class="alert alert-primary alert-dismissible fade show" role="alert">
        <strong>Hello {{ Auth::user()->username }}!</strong> Please pay ₹149 to any of below given payment method, select the method and valid screenshot and submit the form.
        <br>
        <strong>नमस्ते {{ Auth::user()->username }}!</strong> कृपया नीचे दिए गए किसी भी भुगतान विधि को ₹149 का भुगतान करें, विधि और मान्य स्क्रीनशॉट का चयन करें और फ़ॉर्म सबमिट करें।
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="col-md-6 d-flex align-items-stretch grid-margin mx-auto">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">UPGRADE YOUR ID TO TAKE FULL ADVANTAGES</h4>
                        <p class="card-description">
                        <table class="table table-bordered">
                            <tr>
                                <td class="py-1 font-weight-bold">
                                    PayTM Number: 7002364123<br>
                                    Google Pay: 70075909575
                                </td>
                                <td class="font-weight-bold">
                                    Account No: 2378643264823 <br>
                                    Holder Name: Test User <br>
                                    Bank Name: Bank of Baroda <br>
                                    IFSC: BARB0KAKAX
                                </td>
                            </tr>
                        </table>
                        </p>
                        {{ Form::open(['files' => 'true']) }}
                            <div class="form-group">
                                <label for="payment_method">Payment Method Used</label>
                                {{ Form::select('payment_method',
                                ["BANK" => "BANK", "PAYTM" => "PAYTM", "GOOGLE PAY" => "GOOGLE PAY"],
                                 null, ['placeholder' => 'Select your Payment type...', 'id' => 'payment_method', 'class' => 'form-control', 'required']) }}
                                @if ($errors->has('payment_method'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                @else
                                   <small class="text-muted">Payment method you paid using.</small>
                                @endif
                            </div>
                        <div class="form-group">
                            <label for="payment_screenshot">Payment Screenshot</label>
                            {{ Form::file('payment_screenshot', ['id' => 'payment_screenshot', 'class' => 'form-control', 'required']) }}
                            @if ($errors->has('payment_screenshot'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment_screenshot') }}</strong>
                                    </span>
                            @else
                                <small class="text-muted">Take a full screenshot of payment and upload.</small>
                            @endif
                        </div>
                        <button type="submit" class="btn confirmit btn-success mr-2" data-confirm-type="info" data-confirm-text="By clicking Upgrade you agree that you have actually sent the payment & this may take a while for admin to accept as per availability" data-confirm-btntext="Yes, I have made the Payment" data-confirm-btncolor="#00ce68">Upgrade Account</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-light">Cancel</a>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
