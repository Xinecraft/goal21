@extends('layouts.app')
@section('title', 'PayTo Confirmation Form')

@section('content')
    <div class="col-md-6 d-flex align-items-stretch grid-margin mx-auto">
        <div class="row flex-grow">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">PAYMENT CONFIRMATION FORM</h4>
                        <p class="card-description">
                        <table class="table table-bordered">
                            <tr>
                                <td class="py-1">
                                    {{ $pay->receiver->username }}<br><small class="text-muted">{{ $pay->receiver->full_name }}</small>
                                </td>
                                <td>
                                    Receiver Preferred Method: {{ $pay->receiver->preferred_payment_method }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Amount: <b>₹ {{ $pay->payment_amount }}</b>
                                </td>
                                <td>
                                    {!! nl2br(e($pay->receiver->paytextdata)) !!}
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
                                   <small class="text-muted">Payment method you used to send him payment.</small>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="txnid">Transaction ID</label>
                                <input type="text" class="form-control{{ $errors->has('txn_id') ? ' is-invalid' : '' }}" value="{{ old('txn_id') }}" id="txnid" placeholder="Payment Transaction Id" name="txn_id" required>
                                @if ($errors->has('txn_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('txn_id') }}</strong>
                                    </span>
                                @else
                                    <small class="text-muted">Transaction Id you get after payment.</small>
                                @endif
                            </div>
                            <button type="submit" class="btn confirmit btn-success mr-2" data-confirm-type="info" data-confirm-text="By clicking confirm you agree that you have made the payment successfully and details you provided are correct. Forgery or faking may result in a ban." data-confirm-btntext="Yes, Confirm Payment" data-confirm-btncolor="#00ce68">Confirm Payment</button>
                            <a href="{{ route('get.paytodata') }}" class="btn btn-light">Cancel</a>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
