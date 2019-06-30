@extends('layouts.app')
@section('title', 'Task Lists')

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">TASKS LIST</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="tasks-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Link</th>
                            <th>Wait In Seconds</th>
                            <th>Credit INR</th>
                            <th>Description</th>
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
            $('#tasks-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('admin.any.listtask') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'type', name: 'type'},
                    {data: 'link', name: 'link'},
                    {data: 'wait_in_seconds', name: 'wait_in_seconds'},
                    {data: 'credit_inr', name: 'credit_inr'},
                    {data: 'description', name: 'description'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
    </script>
@endsection