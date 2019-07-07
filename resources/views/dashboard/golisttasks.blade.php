@extends('layouts.app')
@section('title', 'Coming Soon')

@section('content')
    <div class="row w-100 card text-center p-2 text-google">
        <p>
            {!! nl2br(App\SiteSetting::getSetting('golisttasks_filler_1')) !!}
        </p>
    </div>

    <br>

    <div class="col-md-12 text-center">
        <a href="{{ route('get.listtasks') }}" class="btn btn-success btn-lg"> <i class="mdi mdi-book-multiple mdi-24px"></i><br><br> View Pending Tasks</a>
    </div>

    <br>

    <div class="row w-100 card text-center p-2 text-google">
        <p>
            {!! nl2br(App\SiteSetting::getSetting('golisttasks_filler_2')) !!}
        </p>
    </div>
@endsection
