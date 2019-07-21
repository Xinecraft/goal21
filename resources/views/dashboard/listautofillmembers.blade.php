@extends('layouts.app')
@section('title', 'Autofill Members')

@section('content')
    <div class="row card text-center p-2">
        <div class="alert alert-primary alert-dismissible fade show col-md-12" role="alert">
            <strong>YOUR AUTOFILL MEMBERS LIST</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #308ee0;">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            View Level #1 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        @if(!empty($levelArray[1]) && !$levelArray[1]->isEmpty())
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Task Pending</th>
                                <th>Referred By</th>
                                <th>Premium User</th>
                            </tr>
                            @foreach($levelArray[1] as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->total_task_pending }}</td>
                                    <td>{{ $user->referredbyauto->username }}</td>
                                    <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                </tr>
                            @endforeach
                        </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #42e0c1;">
                <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            View Level #2 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        @if(!empty($levelArray[2]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[2] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #00e04a;">
                <div class="panel-heading" role="tab" id="headingThree">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            View Level #3 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="panel-body">
                        @if(!empty($levelArray[3]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[3] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #e0c500;">
                <div class="panel-heading" role="tab" id="headingFour">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            View Level #4 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                    <div class="panel-body">
                        @if(!empty($levelArray[4]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[4] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #e0763c;">
                <div class="panel-heading" role="tab" id="headingFive">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            View Level #5 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                    <div class="panel-body">
                        @if(!empty($levelArray[5]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[5] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #e03668;">
                <div class="panel-heading" role="tab" id="headingSix">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            View Level #6 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                    <div class="panel-body">
                        @if(!empty($levelArray[6]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[6] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #b24ee0;">
                <div class="panel-heading" role="tab" id="headingSeven">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                            View Level #7 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                    <div class="panel-body">
                        @if(!empty($levelArray[7]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[7] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #2530e0;">
                <div class="panel-heading" role="tab" id="headingEight">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                            View Level #8 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                    <div class="panel-body">
                        @if(!empty($levelArray[8]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[8] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #e00d00;">
                <div class="panel-heading" role="tab" id="headingNine">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                            View Level #9 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                    <div class="panel-body">
                        @if(!empty($levelArray[9]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[9] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel panel-default panel-bordered-mlm-list" style="border: 1px solid #9ce076;">
                <div class="panel-heading" role="tab" id="headingTen">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                            View Level #10 Members
                        </a>
                    </h4>
                </div>
                <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                    <div class="panel-body">
                        @if(!empty($levelArray[10]))
                            <table class="table table-bordered table-responsive">
                                <tr>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Task Pending</th>
                                    <th>Referred By</th>
                                    <th>Premium User</th>
                                </tr>
                                @foreach($levelArray[10] as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->full_name }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->total_task_pending }}</td>
                                        <td>{{ $user->referredbyauto->username }}</td>
                                        <td>{{ $user->payment_confirmed > 0 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p class="text-google">No Members at this level</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
