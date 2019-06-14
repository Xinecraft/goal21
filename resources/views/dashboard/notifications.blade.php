@extends('layouts.app')
@section('title', 'Notifications')

@section('content')
    <div class="col-lg-10 mx-auto grid-margin stretch-card card">
        <div class="card-body">
            <h5 class="card-title mb-4">Notifications ({{ $notifications->total() }})</h5>
            <div class="fluid-container">
                @forelse($notifications as $notification)
                    @switch(snake_case(class_basename($notification->type)))
                        @case('payment_verified')
                        <a href="{{ route('get.paytodata') }}" class="notify-a-class">
                            <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3 {{ $notification->unread() ? "unread" : "read" }}">
                                <div class="col-md-1">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success notification">
                                            <i class="mdi mdi-check-circle mx-0"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-details col-md-10">
                                    <div class="d-flex">
                                        <p class="text-success font-weight-semibold mr-2 mb-0 no-wrap">Payment
                                            Verified</p>
                                    </div>
                                    <p class="text-gray ellipsis mb-2">Your payment of
                                        ₹{{ $notification->data['payment_amount'] }}
                                        to {{ $notification->data['payment_receiver_name'] }} is verified by him.
                                    </p>
                                    <div class="row text-gray d-md-flex d-none">
                                        <div class="col-4 d-flex">
                                            <small class="mb-0 mr-2 text-muted text-muted">Time :</small>
                                            <small
                                                class="Last-responded mr-2 mb-0 text-muted text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @break
                        @case('payment_declined')
                        <a href="{{ route('get.paytodata') }}" class="notify-a-class">
                            <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3 {{ $notification->unread() ? "unread" : "read" }}">
                                <div class="col-md-1">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-danger notification">
                                            <i class="mdi mdi-cancel mx-0"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-details col-md-10">
                                    <div class="d-flex">
                                        <p class="text-danger font-weight-semibold mr-2 mb-0 no-wrap">Payment
                                            Declined</p>
                                    </div>
                                    <p class="text-gray ellipsis mb-2">Your payment of
                                        ₹{{ $notification->data['payment_amount'] }}
                                        to {{ $notification->data['payment_receiver_name'] }} is declined by him.
                                    </p>
                                    <div class="row text-gray d-md-flex d-none">
                                        <div class="col-4 d-flex">
                                            <small class="mb-0 mr-2 text-muted text-muted">Time :</small>
                                            <small
                                                class="Last-responded mr-2 mb-0 text-muted text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @break
                        @case('payment_sent')
                        <a href="{{ route('get.recvpayments') }}" class="notify-a-class">
                            <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3 {{ $notification->unread() ? "unread" : "read" }}">
                                <div class="col-md-1">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning notification">
                                            <i class="mdi mdi-alert-circle-outline mx-0"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="ticket-details col-md-10">
                                    <div class="d-flex">
                                        <p class="text-warning font-weight-semibold mr-2 mb-0 no-wrap">Payment Pending
                                            Verification</p>
                                    </div>
                                    <p class="text-gray ellipsis mb-2">You have received a payment of
                                        ₹{{ $notification->data['payment_amount'] }}
                                        from {{ $notification->data['payment_sender_name'] }}. Verify it asap!
                                    </p>
                                    <div class="row text-gray d-md-flex d-none">
                                        <div class="col-4 d-flex">
                                            <small class="mb-0 mr-2 text-muted text-muted">Time :</small>
                                            <small
                                                class="Last-responded mr-2 mb-0 text-muted text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @break
                        @default
                        {{ snake_case(class_basename($notification->type)) }}
                    @endswitch
                        {{ $notification->markAsRead() }}
                @empty
                    <div class="card">
                        <div class="preview-item-content text-center" style="padding: 10px;">
                <span class="small-text">
                    You have no notifications.
                </span>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="mx-auto">
            {{ $notifications->links() }}
        </div>
    </div>
@endsection
