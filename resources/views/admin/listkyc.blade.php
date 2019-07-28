@extends('layouts.app')
@section('title', 'KYC List')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                {{ Form::open(['route' => 'admin.post.approveallkyc']) }}
                <button type="submit" class="btn btn-warning btn-sm payedbutton float-right confirmit" data-confirm-type="info"
                        data-confirm-text="By clicking Yes, all KYC will be accepted. Are you sure?"
                        data-confirm-btntext="Yes, Do It" data-confirm-btncolor="#00ce68">Approve All KYC</button>
                {{ Form::close() }}

                <h4 class="card-title">KYC LISTs</h4>
                <p class="card-description text-info font-weight-semibold">
                    List of all pending & accepted KYCs
                </p>

                @if($kycs->total() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Wallet
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Filled At
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($kycs as $kyc)
                                <tr>
                                    <td class="py-1">
                                        {{ $kyc->id }}
                                    </td>
                                    <td class="text-{{ $kyc->is_kyc <= 0 ? 'warning' : 'success' }}" style="font-weight: 600;">
                                        {{ $kyc->username }}
                                    </td>
                                    <td>
                                        {{ $kyc->email }}
                                    </td>
                                    <td>
                                        ₹ {{ $kyc->balanceFloat }}
                                    </td>
                                    <td>
                                        {!! $kyc->is_kyc > 0 ? "<span class='text-success'>Approved</span>" : "<span class='text-danger'>Pending</span>" !!}
                                    </td>
                                    <td>
                                        {{ $kyc->kyc_request_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-primary btn-sm" href="{{ route('admin.get.kycdetail', $kyc->username) }}">View</a>
                                    </td>
                                </tr>
                            @empty
                                <h3 class="text-danger">No KYC Yet!</h3>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text-center"><i>No KYC Yet. Comeback later.</i></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $kycs->render() }}
    </div>
@endsection
