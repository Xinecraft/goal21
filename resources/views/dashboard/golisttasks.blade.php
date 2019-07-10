@extends('layouts.app')
@section('title', 'Tasks')

@section('content')
    <div class="row w-100 card text-center p-2 text-google">
        <p>
            {!! nl2br(App\SiteSetting::getSetting('golisttasks_filler_1')) !!}
        </p>
    </div>

    <br>

    <div class="col-md-12 row text-center">
        <div class="col-md-4">
            <img src="{{ \App\SiteSetting::getSetting('golisttask_ad_banner_1') }}" alt="" class="pull-left img img-responsive">
        </div>
        <div class="col-md-4">
            <a href="{{ route('get.listtasks') }}" class="btn btn-success btn-lg"> <i class="mdi mdi-book-multiple mdi-24px"></i><br><br> View Pending Tasks</a>
        </div>
        <div class="col-md-4">
            <img src="{{ \App\SiteSetting::getSetting('golisttask_ad_banner_2') }}" alt="" class="pull-right img img-responsive">
        </div>
    </div>

    <br>

    <div class="row w-100 card text-center p-2 text-google">
        <p>
            {!! nl2br(App\SiteSetting::getSetting('golisttasks_filler_2')) !!}
        </p>
    </div>
@endsection
