@php
    $notifications = Auth::user()->Notifications()->latest()->limit(5)->get();
@endphp
<li class="nav-item dropdown">
    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
        <i class="mdi mdi-bell"></i>
        @if($nCount = Auth::user()->unreadNotifications()->count())
            <span class="count">{{ $nCount }}</span>
        @endif
    </a>
    <div id="notificationdropdown" class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
         aria-labelledby="notificationDropdown">
        <span class="dropdown-item">
            <p class="mb-0 font-weight-normal float-left">You have {{ $nCount }}
                new {{ str_plural('notification', $nCount) }}
            </p>
            <a href="/dashboard/notifications"><span class="badge badge-pill badge-warning float-right">View all</span></a>
        </span>
        <div class="dropdown-divider"></div>

        @forelse($notifications as $notification)
            @switch(snake_case(class_basename($notification->type)))
                @case('payment_verified')
                <a href="{{ route('get.paytodata') }}" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-success">
                            <i class="mdi mdi-check-circle mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="font-weight-semibold small-text">
                            Your payment of ₹{{ $notification->data['payment_amount'] }}
                            to {{ $notification->data['payment_receiver_name'] }} is verified by him.
                        </p>
                        <p class="font-weight-light small-text">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                @break
                @case('payment_declined')
                <a href="{{ route('get.paytodata') }}" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-danger">
                            <i class="mdi mdi-cancel mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="font-weight-semibold small-text">
                            Your payment of ₹{{ $notification->data['payment_amount'] }}
                            to {{ $notification->data['payment_receiver_name'] }} is declined by him.
                        </p>
                        <p class="font-weight-light small-text">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                @break
                @case('payment_sent')
                <a href="{{ route('get.recvpayments') }}" class="dropdown-item preview-item">
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-warning">
                            <i class="mdi mdi-alert-circle-outline mx-0"></i>
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="font-weight-semibold small-text">
                            You have received a payment of ₹{{ $notification->data['payment_amount'] }}
                            from {{ $notification->data['payment_sender_name'] }}. Verify it asap!
                        </p>
                        <p class="font-weight-light small-text">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                @break
                @default
                {{ snake_case(class_basename($notification->type)) }}
            @endswitch
        @empty
            <div class="preview-item-content text-center" style="padding: 10px;">
                <span class="small-text">
                    You have no notifications.
                </span>
            </div>
        @endforelse
    </div>
</li>
