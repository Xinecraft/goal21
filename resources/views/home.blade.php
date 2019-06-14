@extends('layouts.app')

@section('content')

    @if(!Auth::user()->is_profile_completed || !Auth::user()->payment_confirmed)
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Complete your KYC to get started!</h4>
        <p>Congrats! You have successfully registered with Goal21 Network. Before you can start referring people you need to follow the mandatory instructions:</p>
        <ul class="list-ticked">
            @if(!Auth::user()->is_profile_completed)
            <li>Complete your profile by adding your payment preferences.</li>
            @endif
        </ul>
        <hr>
        @if(!Auth::user()->is_profile_completed)
        <a href="{{ route('get.completeyourprofile') }}" class="btn btn-outline-danger">Complete your KYC <i class="mdi mdi-account-box-outline"></i>
        </a>
        @endif
    </div>
    @endif

    {{--Dashboard OverView--}}
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-cash-100 text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Income</p>
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
                            <i class="mdi mdi-account-multiple-plus text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Referrals</p>
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
                            <i class="mdi mdi-wallet text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Wallet</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">₹{{ Auth::user()->wallet }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Money in wallet
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-calendar-clock text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Days Spent</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ Auth::user()->created_at->diffInDays() }} {{ str_plural('day',Auth::user()->created_at->diffInDays()) }}</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Since registration
                    </p>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h3 class="title text-center text-primary">Your Top 4 Referrals</h3>
    <div class="row">
        @forelse(Auth::user()->referrals as $referral)
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Referral User {{ $loop->iteration }}</h4>
                        <div class="media">
                            <img style="margin-right: 5px;" class="img img-sm rounded-circle" src="{{ $referral->profile_photo }}" alt="DP">
                            <div class="media-body">
                                <address>
                                    <a href="{{ route('get.userdetails', $referral->uuid) }}"><p class="font-weight-bold">{{ $referral->username }}</p></a>
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
                            <p class="card-text font-italic">Your Referral Code/Username is <b>{{ Auth::user()->username }}</b></p>
                        </div>
                    </div>
                </div>
        @endfor
    </div>
@endsection
