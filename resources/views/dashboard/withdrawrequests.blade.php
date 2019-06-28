@extends('layouts.app')
@section('title', 'Your Payment Transactions')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('get.withdrawrequest') }}" class="btn btn-success btn-sm payedbutton float-right"><i class="mdi mdi-check"></i>Make Withdraw Request</a>
                <h4 class="card-title">WITHDRAW REQUEST HISTORY</h4>
                <p class="card-description text-info font-weight-semibold">
                    Your Wallet Balance is ₹{{ auth()->user()->balanceFloat }}.
                </p>
                @if($payments->total() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    Request ID
                                </th>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Payment Method
                                </th>
                                <th>
                                    Payment Data
                                </th>
                                <th>
                                    Payment Status
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
                                </tr>
                            @empty
                                <h3 class="text-danger">No Data Yet!</h3>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text-center"><i>No Withdraw Request Yet. Comeback here after earning money.</i></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $payments->render() }}
    </div>
@endsection
