@extends('layouts.app')
@section('title', 'Received Payments')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">RECEIVED PAYMENTS</h4>
                <p class="card-description text-info font-weight-semibold">
                    List of all payment you have received from your referrals and its siblings. Please verify all "In
                    Progress" cases if any as soon as you can.
                </p>
                <div class="table-responsive">
                    <table class="table table-striped table-sm table-bordered">
                        <thead>
                        <tr>
                            <th>
                                From User
                            </th>
                            <th>
                                Amount
                            </th>
                            <th data-toggle="tooltip" title="Payment Method your got payment at.">
                                Paid via
                            </th>
                            <th data-toggle="tooltip" title="Payment Transaction ID">
                                TXN ID
                            </th>
                            <th>
                                Payment Details
                            </th>
                            <th>
                                Status
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($payments as $pay)
                            <tr>
                                <td class="py-1">
                                    {{ $pay->sender->username }}<br>
                                    <small class="text-muted">{{ $pay->sender->full_name }}</small>
                                    <br>
                                    <small class="text-muted">{{ $pay->sender->phone_number }}</small>
                                    @if($pay->payment_status == 0 || $pay->payment_status == 1)
                                        <br><br>
                                        <small class="text-muted" data-toggle="tooltip"
                                               title="{{ $pay->paid_at->toDayDateTimeString() }}">
                                            <i>Paid {{ $pay->paid_at->diffForHumans() }}</i></small>
                                    @endif
                                </td>
                                <td>
                                    ₹ {{ $pay->payment_amount }}
                                </td>
                                <td>
                                    {{ $pay->payment_method }}
                                </td>
                                <td>
                                    {{ $pay->payment_txn_id }}
                                </td>
                                <td>
                                    {!! nl2br(e($pay->payment_data)) !!}
                                </td>
                                @if($pay->payment_status == -1)
                                    <td>
                                        <label class="badge badge-danger" data-placement="left" data-toggle="tooltip"
                                               title="Sender has not sent you the amount yet. You will be able to accept it after he mark it as paid.">Pending</label>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-success btn-sm" disabled>
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" disabled>
                                                <i class="mdi mdi-cancel"></i>
                                            </button>
                                        </div>
                                    </td>
                                @elseif($pay->payment_status == 0)
                                    <td>
                                        <label class="badge badge-warning" data-placement="left" data-toggle="tooltip"
                                               title="Sender has mark it as paid and pending your verification.">In
                                            Progress</label>
                                    </td>
                                    <td>
                                        {{ Form::open(['route' => 'post.recvpayments']) }}
                                        {{ Form::hidden('id', $pay->uuid) }}
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button data-toggle="tooltip" data-placement="bottom"
                                                    title="Set as Payment Received" type="submit" name="action"
                                                    value="accept" class="btn btn-success btn-sm"
                                                    onclick="if(!confirm('Verify Payment Received? By clicking OK you agree that you have received the payment.')){return false}">
                                                <i class="mdi mdi-check"></i>
                                            </button>
                                            <button data-toggle="tooltip" data-placement="bottom"
                                                    title="Set as Payment Not Received" type="submit" name="action"
                                                    value="deny" class="btn btn-danger btn-sm"
                                                    onclick="if(!confirm('Deny Payment Status? By clicking OK you agree that you have NOT received the payment. It will be sent back to sender for recheck. If method is BANK it may take upto 7 days to reflect in your Bank.')){return false}">
                                                <i class="mdi mdi-cancel"></i>
                                            </button>
                                        </div>
                                        {{ Form::close() }}
                                    </td>
                                @elseif($pay->payment_status == 1)
                                    <td>
                                        <label data-toggle="tooltip"
                                               title="Payment is verified by you {{ $pay->verified_at->diffForHumans() }}."
                                               class="badge badge-success">Verified</label>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-inverse-success btn-sm" disabled>
                                            <i class="mdi mdi-checkbox-marked-circle"></i>Paid
                                        </button>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <h3>No Payment Data</h3>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mx-auto">
                {{ $payments->links() }}
            </div>
        </div>
    </div>
@endsection
