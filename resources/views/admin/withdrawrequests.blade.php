@extends('layouts.app')
@section('title', 'Your Payment Transactions')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">PENDING WITHDRAW REQUEST</h4>
                @if($payments->total() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    Request ID
                                </th>
                                <th>
                                    User
                                </th>
                                <th>
                                    Requested
                                </th>
                                <th data-toggle="tooltip" title="Preferred Payment Method">
                                    PPM
                                </th>
                                <th>
                                    Payment Data
                                </th>
                                <th>
                                    Payment Status
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($payments as $payment)
                                <tr>
                                    <td class="py-1">
                                        {{ $payment->id }}
                                    </td>
                                    <td>
                                       <b>{{ $payment->user->username }}</b> <br>
                                        {{ $payment->user->email }} <br>
                                        {{ $payment->user->full_name }} <br>
                                        Remaining: ₹{{ $payment->user->balanceFloat }}
                                    </td>
                                    <td>
                                        ₹ {{ $payment->payment_amount }}
                                    </td>
                                    <td>
                                        {{ $payment->payment_method }}
                                    </td>
                                    <td>
                                        {!! nl2br(e($payment->payment_data)) !!}
                                    </td>
                                    <td>
                                        @if($payment->payment_status == 0)
                                            <label class="badge badge-warning" data-toggle="tooltip"
                                                   title="Withdraw Request is in progress...">In Progress</label>
                                        @elseif($payment->payment_status == 1)
                                            <label class="badge badge-success" data-toggle="tooltip"
                                                   title="Withdraw Request completed">Paid</label>
                                        @else
                                            <label class="badge badge-danger" data-toggle="tooltip"
                                                   title="Withdraw Request is rejected by Administrator">Rejected</label>
                                        @endif
                                    </td>
                                    <td>
                                        {{ Form::open(['method' => 'POST', 'route' => ['admin.post.approve-wr', $payment->uuid]]) }}
                                        <button class="btn btn-success btn-sm confirmit" type="submit" data-confirm-title="Complete Withdrawl Request?" data-confirm-text="Are you sure you want to complete this request. It cant be reverted." data-confirm-btncolor="green" data-confirm-type="info">Mark Paid</button>
                                        {{ Form::close() }}

                                        {{--{{ Form::open(['method' => 'DELETE', 'route' => ['admin.delete.reject-wr', $payment->uuid]]) }}
                                        <button class="btn btn-danger btn-sm confirmit" type="submit" data-confirm-title="Reject this Payment?" data-confirm-text="Are you sure you want to reject this Payment? All payment data related will be deleted." data-confirm-btncolor="#ffa800" data-confirm-type="error">Reject</button>
                                        {{ Form::close() }}--}}
                                    </td>
                                </tr>
                            @empty
                                <h3 class="text-danger">No Data Yet!</h3>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text-center"><i>No Withdraw Request Yet.</i></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $payments->render() }}
    </div>
@endsection
