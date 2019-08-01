@extends('layouts.app')
@section('title', 'Your Payment Transactions')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('get.withdrawrequest') }}" class="btn btn-success btn-sm payedbutton float-right"><i class="mdi mdi-check"></i>Make Withdraw Request</a>
                <h4 class="card-title">TRANSACTIONS</h4>

                <button type="button" class="btn btn-danger" disabled>
                    <span>Self Earnings</span>
                    <span>₹{{ auth()->user()->wallet_one }}</span>
                </button>

                <button type="button" class="btn btn-primary" disabled>
                    <span>Tasks Earnings</span>
                    <span>₹{{ auth()->user()->wallet_two }}</span>
                </button>

                <button type="button" class="btn btn-warning" disabled>
                    <span>Referral Earnings</span>
                    <span>₹{{ auth()->user()->wallet_three }}</span>
                </button>

                <button type="button" class="btn btn-success" disabled>
                    <span>Cashout Wallet</span>
                    <span>₹{{ auth()->user()->balanceFloat }}</span>
                </button>

                @if($transactions->total() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>
                                Transaction ID
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Type
                            </th>
                            <th>
                                Reason
                            </th>
                            <th>
                                Date
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td class="py-1">
                                    {{ $transaction->meta['txn_id'] }}
                                </td>
                                <td>
                                    ₹ {{ abs($transaction->amount/100) }}
                                </td>
                                <td>
                                    {{ $transaction->type }}
                                </td>
                                <td>
                                    {{ $transaction->meta['desc'] }}
                                </td>
                                <td>
                                    {{ $transaction->created_at->diffForHumans() }}
                                </td>
                            </tr>
                        @empty
                            <h3 class="text-danger">No Transactions Yet!</h3>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                @else
                    <h4 class="text-center"><i>No Transactions Yet. Comeback later after doing some task.</i></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $transactions->render() }}
    </div>
@endsection
