@extends('layouts.app')
@section('title', 'Withdraw Request Form')

@section('content')
    <div class="col-md-6 d-flex align-items-stretch grid-margin mx-auto">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">WITHDRAW REQUEST FORM</h4>
                        <p class="card-description">
                        <table class="table table-bordered">
                            <tr>
                                <td class="py-1"><b>
                                    Wallet Balance: ₹ {{ auth()->user()->balanceFloat }}
                                    </b>
                                </td>
                                <td>
                                    Preferred Method: {{ auth()->user()->preferred_payment_method }}
                                </td>
                            </tr>
                        </table>
                        </p>
                        {{ Form::open() }}
                            <div class="form-group">
                                <label for="payment_method">Payment Method Used</label>
                                {{ Form::select('payment_method',
                                $selector,
                                 null, ['placeholder' => 'Select your PPM type...', 'id' => 'payment_method', 'class' => 'form-control', 'required']) }}
                                @if ($errors->has('payment_method'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment_method') }}</strong>
                                    </span>
                                @else
                                   <small class="text-muted">Payment method you want your payment at.</small>
                                @endif
                            </div>
                        <div class="form-group">
                            <label for="payment_method">Payment Amount</label>
                            {{ Form::select('payment_amount',
                            $paymentAmountOptions,
                             null, ['placeholder' => 'Select your Payment Amount...', 'id' => 'payment_amount', 'class' => 'form-control', 'required']) }}
                            @if ($errors->has('payment_amount'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('payment_amount') }}</strong>
                                    </span>
                            @else
                                <small class="text-muted">Payment amount you want to withdraw. Must be smaller than your wallet balance.</small>
                            @endif
                        </div>
                        <button type="submit" class="btn confirmit btn-success mr-2" data-confirm-type="info" data-confirm-text="By clicking confirm you agree that this may take a while for admin to accept as per availability" data-confirm-btntext="Yes, Request Payment" data-confirm-btncolor="#00ce68">Request Payment</button>
                            <a href="{{ route('get.withdrawrequest') }}" class="btn btn-light">Cancel</a>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
