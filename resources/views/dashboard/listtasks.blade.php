@extends('layouts.app')
@section('title', 'Your Daily Tasks')

@section('content')

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
                                    Description
                                </th>
                                <th>
                                    Reward
                                </th>
                                <th>
                                    Type
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Action
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
                                        {{ $task->description }}
                                    </td>
                                    <td>
                                        ₹ {{ $task->credit_inr }}
                                    </td>
                                    <td>
                                        {{ $task->type_name }}
                                    </td>
                                    <td>
                                        {{ $task->completed ? "completed" : "not completed" }}
                                    </td>
                                    <td>
                                        @if($task->completed)
                                            <button class="btn btn-success btn-sm" disabled="">Completed</button>
                                        @else
                                            {{ link_to_route('get.viewtask',"Complete Task", [$task->uuid],['class' => 'btn btn-primary btn-sm']) }}
                                        @endif
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
    <div class="pull-right">
        {{ $tasks->render() }}
    </div>
@endsection
