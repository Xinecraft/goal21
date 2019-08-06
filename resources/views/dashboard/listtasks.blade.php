@extends('layouts.app')
@section('title', 'Your Daily Tasks')

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

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Your Daily Tasks</h4>
                @if($tasks->total() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Action
                                </th>
                                {{--<th>
                                    Status
                                </th>--}}
                                <th>
                                    Reward
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Description
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="py-1">
                                        {{ $task->id }}
                                    </td>
                                    <td>
                                        @if($task->completed)
                                            <button class="btn btn-success btn-sm" disabled="" data-toggle="tooltip" title="Completed"><span class=""><i class="mdi mdi-check-circle"></i></span></button>
                                        @else
                                            <a href="{{ route('get.viewtask', $task->uuid) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Pending"><span class=""><i class="mdi mdi-alert"></i></span></a>
                                        @endif
                                    </td>
                                    <td>
                                        ₹ {{ $task->credit_inr }}
                                    </td>
                                    <td>
                                        {{ $task->type_name }}
                                    </td>
                                    <td>
                                        {{ $task->description }}
                                    </td>
                                </tr>
                            @empty
                                <h3 class="text-danger">No Tasks Yet!</h3>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <h4 class="text-center"><i>No Tasks Yet. Comeback later.</i></h4>
                @endif
            </div>
        </div>
    </div>
    <div class="">
        {{ $tasks->render() }}
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 grid-margin">
            <img src="{{ \App\SiteSetting::getSetting('listtask_ad_banner_1') }}" alt="" class="img img-responsive">
        </div>
        <div class="col-md-4 grid-margin">
            <img src="{{ \App\SiteSetting::getSetting('listtask_ad_banner_2') }}" alt="" class="img img-responsive">
        </div>
    </div>
@endsection
