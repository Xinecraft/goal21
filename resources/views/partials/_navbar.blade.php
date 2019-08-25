<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ route('landing') }}">
            <img src="/images/logo.png" alt="logo">
        </a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('landing') }}">
            <img src="/images/logo.png" alt="logo">
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
            <li class="nav-item active">
                <a href="#" class="nav-link">
                    <i class="mdi mdi-monitor"></i>Dashboard</a>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            @include('partials._notifications')
            <li class="nav-item dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                    <span class="profile-text">Hello, {{ Auth::user()->full_name }} !</span>
                    <img class="img-xs rounded-circle" src="{{ Auth::user()->profile_photo }}" alt="DP">
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a class="dropdown-item mt-2" href="{{ route('get.editprofile') }}">
                        View Profile
                    </a>
                    <a class="dropdown-item"href="{{ route('get.resetpassword') }}">
                        Change Password
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
