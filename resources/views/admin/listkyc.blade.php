@extends('layouts.app')
@section('title', 'KYC List')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">

                {{ Form::open(['route' => 'admin.post.approveallkyc']) }}
                <button type="submit" class="btn btn-warning btn-sm payedbutton float-right confirmit" data-confirm-type="info"
                        data-confirm-text="By clicking Yes, all KYC will be accepted. Are you sure?"
                        data-confirm-btntext="Yes, Do It" data-confirm-btncolor="#00ce68">Approve All KYC</button>
                {{ Form::close() }}

                <h4 class="card-title">KYC LISTs</h4>
                <p class="card-description text-info font-weight-semibold">
                    List of all pending & accepted KYCs
                </p>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="kyc-table">
                            <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>
                                    Username
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Wallet
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Filled At
                                </th>
                                <th>
                                    Action
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            $('#kyc-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.any.kyclist') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'wallet', name: 'wallet'},
                    {data: 'status', name: 'status'},
                    {data: 'kyc_request_at', name: 'kyc_request_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection
