@extends('layouts.app')
@section('title', 'Daily Task '.$task->id)

@section('styles')
    <style>
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            padding-top: 30px; height: 0; overflow: hidden;
        }
        .video-container iframe,
        .video-container object,
        .video-container embed {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Square -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7092046166701332"
         data-ad-slot="4259765943"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>

    <div class="row w-100 card text-center p-2 text-twitter">
        <h3>Daily Task {{$task->id}}: {{ $task->description }}</h3>
    </div>
    @switch($task->type)
        @case(\App\Task::TYPE_APP_DOWNLOAD)
        @break;
        @case(\App\Task::TYPE_VIDEO)
        <div class="row w-100 card text-center p-2">
            <h3 id="timerH3">Watch this Video for <span class="label label-primary"
                                                        id="secondCounter">{{ $task->wait_in_seconds }}</span> Seconds
            </h3>
        </div>
        <div class="row w-100 card text-center p-2">
            <div class="video-container">
                <iframe height="500" src="{{ $task->link }}" frameborder="0"
                        allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
        <div class="row w-100 card text-center p-2">
            <div id="timerForm">
                {{ Form::open() }}
                <button class="btn btn-success btn-lg" type="submit">Complete</button>
                {{ Form::close() }}
            </div>
        </div>
        @break;
        @case(\App\Task::TYPE_WEBSITE)
        <div class="row w-100 card text-center p-2">
            <h3 id="timerH3">Stay On this Page for <span class="label label-primary"
                                                         id="secondCounter">{{ $task->wait_in_seconds }}</span> Seconds
            </h3>
            <b class="text-danger">Do some activity on the below website. Click on some links.</b>
            <b class="text-danger">नीचे की वेबसाइट पर कुछ गतिविधि करें। कुछ लिंक पर क्लिक करें।</b>
        </div>
        <div class="row w-100 card text-center p-2">
            <iframe src="{{ $task->link }}" frameborder="0" height="700"></iframe>
        </div>
        <div class="row w-100 card text-center p-2">
            <div id="timerForm">
                {{ Form::open() }}
                <button class="btn btn-success btn-lg" type="submit">Complete</button>
                {{ Form::close() }}
            </div>
        </div>
        @break;
        @default
        <h1>Unknown</h1>
    @endswitch

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <!-- Square -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-7092046166701332"
         data-ad-slot="4259765943"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var window_focus = true;
            var myVar = setInterval(myTimer, 1000);

            var wait_in_seconds = {{ $task->wait_in_seconds }}

            function myTimer() {
                if (wait_in_seconds <= 1) {
                    clearInterval(myVar);
                    $('#timerH3').text("Scroll to Bottom and Click 'Complete'");
                    $('#timerForm').show();
                }
                if (window_focus) {
                    wait_in_seconds -= 1;
                }
                $('#secondCounter').html(wait_in_seconds);
            }
        });
    </script>
@endsection
