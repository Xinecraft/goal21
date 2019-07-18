@extends('layouts.app')
@section('title', 'Upgrade your Id')

@section('content')
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
                                <td class="py-1">
                                    PayTM Number: 70011111111<br>
                                    Google Pay: 70011111111
                                </td>
                                <td>
                                    Bank Account: 2378643264823 <br>
                                    IFSC: sjdkfhks
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
