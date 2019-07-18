@extends('layouts.app')
@section('title', 'Pending Payment Approvals')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pending Payment Approvals</h4>
                @if($paymentUsers->total() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    User
                                </th>
                                <th>
                                    Applied At
                                </th>
                                <th>
                                    Method
                                </th>
                                <th>
                                    Screenshot
                                </th>
                                <th>
                                    KYC?
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($paymentUsers as $user)
                                <tr>
                                    <td class="py-1">
                                        {{ $user->username }} <br>({{ $user->email }})
                                    </td>
                                    <td>
                                        {{ $user->payment_applied_at }}
                                    </td>
                                    <td>
                                        {{ $user->payment_method }}
                                    </td>
                                    <td>
                                        <a href="{{ Storage::url($user->payment_screenshot) }}" target="_blank">Screenshot</a>
                                    </td>
                                    <td>
                                        {{ $user->is_kyc ? 'yes' : 'no' }}
                                    </td>
                                    <td>
                                        {{ Form::open(['method' => 'POST', 'route' => ['admin.post.approvepayment', $user->username]]) }}
                                        <button class="btn btn-success btn-sm confirmit" type="submit" data-confirm-title="Accept this Payment?" data-confirm-text="Are you sure you want to accept this Payment. It cant be reverted." data-confirm-btncolor="green" data-confirm-type="info">Approve</button>
                                        {{ Form::close() }}

                                        {{ Form::open(['method' => 'DELETE', 'route' => ['admin.delete.rejectpayment', $user->username]]) }}
                                        <button class="btn btn-danger btn-sm confirmit" type="submit" data-confirm-title="Reject this Payment?" data-confirm-text="Are you sure you want to reject this Payment? All payment data related will be deleted." data-confirm-btncolor="#ffa800" data-confirm-type="error">Reject</button>
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @empty
                                <h3 class="text-danger">No Payments Yet!</h3>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text-center"><i>No Payments Yet. Comeback later.</i></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $paymentUsers->render() }}
    </div>
@endsection
