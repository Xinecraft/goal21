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
                            <small class="designation text-muted" data-toggle="tooltip" title="Remember It! Your Username as well as your Referral Code">{{ Auth::user()->username }}</small>
                            @if(Auth::user()->status)
                                <span data-toggle="tooltip" title="Active" class="status-indicator online"></span>
                            @else
                                <span data-toggle="tooltip" title="Inactive" class="status-indicator text-danger"></span>
                            @endif
                        </div>
                        <br>
                        @if(Auth::user()->payment_confirmed == 1)
                        <small class="text-success" data-toggle="tooltip" title="Congrats! You have successfully upgrade this account to Premium">Premium Account</small>
                        @else
                        <small class="text-warning" data-toggle="tooltip" title="Warning! You are using Free Account. Try upgrading for just INR 149 to get full benefits.">Free Account</small>
                        @endif
                    </div>
                </div>
                {{--@if(Auth::user()->isAdmin())
                <a href="{{ route('get.addmember') }}" class="btn btn-inverse-success btn-block">Add Member
                    <i class="mdi mdi-plus"></i>
                </a>
                @endif--}}
            </div>
        </li>
        @if(Auth::user()->isAdmin())
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#more" aria-expanded="false" aria-controls="more">
                    <i class="menu-icon mdi mdi-flash-circle"></i>
                    <span class="menu-title">Admin Section</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="more">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.listtask') }}">View Tasks </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.createtask') }}">Add New Tasks </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.listusers') }}">View Users </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.kyclist') }}">View KYCs </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.listpaymentapprovals') }}">Approve Payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.withdrawrequests') }}">Withdraw Requests</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.get.sitesettings') }}">Site Settings </a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        @if(!Auth::user()->is_profile_completed)
            <li class="nav-item">
                <a class="nav-link" href="{{ route('get.completeyourprofile') }}">
                    <i class="menu-icon mdi mdi-account-check"></i>
                    <span class="menu-title">Complete KYC</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.golisttasks') }}">
                <i class="menu-icon mdi mdi-book-multiple"></i>
                <span class="menu-title">Daily Tasks</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.transactions') }}">
                <i class="menu-icon mdi mdi-cash-multiple"></i>
                <span class="menu-title">Transactions/Wallet</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.withdrawrequests') }}">
                <i class="menu-icon mdi mdi-send"></i>
                <span class="menu-title">Withdraw Requests</span>
            </a>
        </li>

        @if(auth()->user()->payment_confirmed < 0)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('get.applyforpremium') }}">
                <i class="menu-icon mdi mdi-star"></i>
                <span class="menu-title">Upgrade Account</span>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#membertree" aria-expanded="false" aria-controls="membertree">
                <i class="menu-icon mdi mdi-sitemap"></i>
                <span class="menu-title">Members Tree</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="membertree">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get.listmatrixmembers') }}">Matrix Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('get.listautofillmembers') }}">Autofill Members</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a target="_blank" class="nav-link" href="javascript:void(Tawk_API.toggle())">
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

        @impersonating
        <li class="nav-item">
            <a class="nav-link" href="{{ route('impersonate.leave') }}">
                <i class="menu-icon mdi mdi-book-minus"></i>
                <span class="menu-title">Leave Impersonation</span>
            </a>
        </li>
        @endImpersonating

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
    </ul>
</nav>
