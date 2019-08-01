@extends('layouts.app')
@section('title', 'Users List')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">USERS LIST</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="users-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Premium</th>
                            <th>Created At</th>
                            <th>Task Earning</th>
                            <th>Ref. Earning</th>
                            <th>Wallet Main</th>
                            <th>Total Payout</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.any.listusers') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'full_name', name: 'full_name'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'status', name: 'status'},
                    {data: 'payment_confirmed', name: 'payment_confirmed'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'wallet_two', name: 'wallet_two'},
                    {data: 'wallet_three', name: 'wallet_three'},
                    {data: 'wallet', name: 'wallet'},
                    {data: 'total_income', name: 'total_income'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection