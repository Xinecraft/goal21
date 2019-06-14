<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ Auth::user()->profile_photo }}" alt="DP">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::user()->full_name }}</p>
                        <div>
                            <small class="designation text-muted">{{ Auth::user()->username }}</small>
                            @if(Auth::user()->status)
                                <span data-toggle="tooltip" title="Active" class="status-indicator online"></span>
                            @else
                                <span data-toggle="tooltip" title="Inactive" class="status-indicator text-danger"></span>
                            @endif
                        </div>
                    </div>
                </div>
                @if(Auth::user()->isAdmin())
                <a href="{{ route('get.addmember') }}" class="btn btn-inverse-success btn-block">Add Member
                    <i class="mdi mdi-plus"></i>
                </a>
                @endif
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        {{--<li class="nav-item">
            <a class="nav-link" href="{{ route('get.recvpayments') }}">
                <i class="menu-icon mdi mdi-cash-multiple"></i>
                <span class="menu-title">Received Payments</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.paytodata') }}">
                <i class="menu-icon mdi mdi-send"></i>
                <span class="menu-title">Sent Payments</span>
            </a>
        </li>--}}
        @if(!Auth::user()->is_profile_completed)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.completeyourprofile') }}">
                <i class="menu-icon mdi mdi-send"></i>
                <span class="menu-title">Complete KYC</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.userdetails',Auth::user()->uuid) }}">
                <i class="menu-icon mdi mdi-sitemap"></i>
                <span class="menu-title">Members Tree</span>
            </a>
        </li>
        <li class="nav-item">
            <a target="_blank" class="nav-link" href="">
                <i class="menu-icon mdi mdi-headset"></i>
                <span class="menu-title">Raise a Ticket</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">Account</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get.editprofile') }}">Manage Profile </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get.resetpassword') }}">Change Password </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="menu-icon mdi mdi-logout"></i>
                <span class="menu-title">{{ __('Logout') }}</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#more" aria-expanded="false" aria-controls="more">
                <i class="menu-icon mdi mdi-flash-circle"></i>
                <span class="menu-title">More Stuffs</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="more">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/coming-soon">Donations </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/coming-soon">Advertisements </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/coming-soon">Play2Win </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard/coming-soon">Bonus Stuffs </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
