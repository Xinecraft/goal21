@extends('layouts.app')

@section('content')

    @if(Auth::user()->is_kyc == -1)
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Complete your KYC to get started!</h4>
            <p>Congrats! You have successfully registered with Goal21 Network. Complete Profile & KYC now to start
                earning!</p>
            <ul class="list-ticked">
                    <li>Complete KYC & Profile.</li>
            </ul>
            <hr>
                <a href="{{ route('get.completeyourprofile') }}" class="btn btn-outline-danger">Complete your KYC <i
                            class="mdi mdi-account-box-outline"></i>
                </a>
        </div>
    @endif

    @if(Auth::user()->is_kyc == 0)
        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">KYC Applied and is pending admin approval!</h4>
            <p>Congrats! You have successfully filled your KYC. Please wait while admin verify it.</p>
        </div>
    @endif

    @if(Auth::user()->payment_confirmed == 0)
        <div class="alert alert-primary" role="alert">
            <h4 class="alert-heading">Upgrade Account Applied and is pending admin approval!</h4>
            <p>Congrats! You have successfully applied for Account Upgrade. Please wait while admin verify your Payment</p>
        </div>
    @endif

    {{--Dashboard OverView--}}
    <div class="row sharelinks">
        <div class="col-md-12">
            {!! Share::page(route('register',['referral' => auth()->user()->username]), 'Join Goal21 Now and Earn Bonus')
	->facebook()
	->twitter()
	->googlePlus()
	->linkedin('Join for Free')
	->whatsapp(); !!}
            <div class="imput-copier pull-right col-md-4" style="margin-top: 10px;">
                <p class="pull-left" style="margin-top: 8px;">Your Referral Link: &nbsp;</p>
                <input type="text" class="form-control col-md-8" id="copyInput" onclick="copyFunction()" value="{{ route('register',['referral' => auth()->user()->username]) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <marquee behavior="" direction=""><h4
                    class="text-danger">{{ \App\SiteSetting::getSetting('dashboard_marquee_1') }}</h4></marquee>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-cash-100 text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Payouts</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">₹{{ Auth::user()->total_income }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> All time record
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-wallet text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Self Earnings</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">₹{{ Auth::user()->wallet_one }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Self Earnings
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-wallet text-primary icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Tasks Earnings</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">₹{{ Auth::user()->wallet_two }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Earning this month
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-wallet text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Cashout Wallet</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">₹{{ Auth::user()->balanceFloat }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Amount that can be withdrawn
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-account-multiple-plus text-primary icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">My Direct</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ Auth::user()->total_referrals }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Out of ∞ total
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-trophy text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">My Rank</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">X</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Coming Soon
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-calendar-clock text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Pending Tasks</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $pending_tasks_count }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> <a
                                href="{{ route('get.golisttasks') }}">View Tasks</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-calendar-check text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Completed Tasks</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $completed_tasks_count }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> <a
                                href="{{ route('get.golisttasks') }}">View Tasks</a>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin">
            <img src="{{ \App\SiteSetting::getSetting('dashboard_ad_banner_1') }}" alt="" class="img img-responsive">
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin">
            <img src="{{ \App\SiteSetting::getSetting('dashboard_ad_banner_2') }}" alt="" class="img img-responsive">
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin">
            <img src="{{ \App\SiteSetting::getSetting('dashboard_ad_banner_3') }}" alt="" class="img img-responsive">
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin">
            <img src="{{ \App\SiteSetting::getSetting('dashboard_ad_banner_4') }}" alt="" class="img img-responsive">
        </div>
    </div>

    <hr>
    {{--<h3 class="title text-center text-primary">Your Direct Referrals</h3>
    <div class="row">
        @forelse(Auth::user()->referrals as $referral)
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Referral User {{ $loop->iteration }}</h4>
                        <div class="media">
                            <img style="margin-right: 5px;" class="img img-sm rounded-circle"
                                 src="{{ $referral->profile_photo }}" alt="DP">
                            <div class="media-body">
                                <address>
                                    <a href="{{ route('get.userdetails', $referral->uuid) }}"><p
                                                class="font-weight-bold">{{ $referral->username }}</p></a>
                                    <p>
                                        {{ $referral->full_name }}
                                    </p>
                                    <p class="text-small">
                                        Added: {{ $referral->created_at->diffForHumans() }}
                                    </p>

                                    <p class="text-small">
                                        Status: {{ $referral->status ? "Active" : "Inactive" }}
                                    </p>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse

        @for($i = 0; $i < (4 - Auth::user()->total_referrals); $i++)
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card text-center">
                    <div class="card-body" style="border: 2px dashed #e8d91a;">
                        <h5 class="card-title">Empty Referral Slot</h5>
                        <p class="card-text font-italic">This slot is empty. Start Adding People to Earn $.</p>
                        <p class="card-text font-italic">Your Referral Code/Username is
                            <b>{{ Auth::user()->username }}</b></p>
                    </div>
                </div>
            </div>
        @endfor
    </div>--}}

    <div class="row col-sm-12">
        <div class="panel card" style="padding: 10px">
            <p>
                {!! nl2br(App\SiteSetting::getSetting('dashboard_filler_1')) !!}
            </p>
        </div>
    </div>
    <br>
    <div class="row col-sm-12">
        <div class="panel card" style="padding: 10px">
            <p>
                {!! nl2br(App\SiteSetting::getSetting('dashboard_filler_2')) !!}
            </p>
        </div>
    </div>
@endsection

@section('styles')
    <script src="https://kit.fontawesome.com/22e39e4126.js"></script>
    <script>
        function copyFunction() {
            var copyText = document.getElementById("copyInput");
            copyText.select();
            document.execCommand("copy");
            alert("Copied to Clipboard!");
        }
    </script>
@endsection