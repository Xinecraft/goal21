@extends('layouts.app')
@section('title', 'PayTo Information')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">PAYTO INFORMATION</h4>
                <p class="card-description text-info font-weight-semibold">
                    List of all users you have to send money to. Please refer the details & amount specified below and
                    click "Pay Now" button to launch payment confirmation form.
                </p>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>
                                To User
                            </th>
                            <th>
                                Amount
                            </th>
                            <th data-toggle="tooltip" title="Preferred Payment Method">
                                PPM
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
                        @forelse($payTo as $pay)
                            <tr>
                                <td class="py-1">
                                    {{ $pay->receiver->username }}<br>
                                    <small class="text-muted">{{ $pay->receiver->full_name }}</small>
                                    <br>
                                    <small class="text-muted">{{ $pay->receiver->phone_number }}</small>
                                </td>
                                <td>
                                    ₹ {{ $pay->payment_amount }}
                                </td>
                                <td>
                                    @if($pay->payment_status == 1)
                                        {{ $pay->payment_method }}
                                    @else
                                        {{ $pay->receiver->preferred_payment_method }}
                                    @endif
                                </td>
                                <td>
                                    @if($pay->payment_status == 1)
                                        {!! nl2br(e($pay->payment_data)) !!}
                                    @else
                                        {!! nl2br(e($pay->receiver->paytextdata)) !!}
                                    @endif
                                </td>
                                @if($pay->payment_status == -1)
                                    <td>
                                        <label class="badge badge-danger" data-toggle="tooltip"
                                               title="Payment has not been send by you. Please pay ASAP.">Pending</label>
                                    </td>
                                    <td>
                                        @if($pay->receiver->is_banned)
                                            <button class="btn btn-danger btn-sm" onclick="swal(
  'User is banned',
  'The user whom you trying to send money is banned. Contact admin to resolve this issue.',
  'error'
)">
                                                <i class="mdi mdi-security"></i>Banned
                                            </button>
                                        @else
                                            <a href="{{ route('get.paytodataform',[$pay->uuid]) }}"
                                               class="btn btn-success btn-sm payedbutton">
                                                <i class="mdi mdi-check"></i>Pay Now</a>
                                        @endif
                                    </td>
                                @elseif($pay->payment_status == 0)
                                    <td>
                                        <label class="badge badge-warning" data-toggle="tooltip"
                                               title="Payment is done but pending verification from receiver.">In
                                            Progress</label>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" disabled>
                                            <i class="mdi mdi-checkbox-marked-circle-outline"></i>Paid
                                        </button>
                                        @if($pay->receiver->is_banned)
                                            <button data-toggle="tooltip" data-placement="left"
                                                    title="This user has been Banned & might not be able to verify your payment. Contact Admin as soon as possible."
                                                    type="button" class="btn btn-danger btn-sm" onclick="swal(
  'User is banned',
  'This user is banned and will not be able to verify your payment until he is unbanned which is very unlikely. Please contact admin to resolve this issue as soon as possible.',
  'warning'
)">B
                                            </button>
                                        @endif
                                    </td>
                                @elseif($pay->payment_status == 1)
                                    <td>
                                        <label data-toggle="tooltip" title="Payment is done & verified."
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
                            <h3 class="text-danger">No Payment Data. Contact Admin ASAP!</h3>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
