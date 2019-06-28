@extends('layouts.app')
@section('title', 'Add New Task')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-small" role="alert">
            <strong>Error!</strong> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row w-100">
        <div class="col-lg-6 mx-auto card">
            <div class="card-body">
                <h2 class="text-center mb-4 card-title">ADD NEW TASK</h2>
                <div class="auto-form-wrapper">
                    {{ Form::open() }}

                    <div class="form-group row">
                        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Task Type') }}</label>

                        <div class="col-md-7">
                            {{ Form::select('type',
                                    [0 => 'GoogleApp Download',
                                     1 => 'Website Link',
                                     2 => 'Youtube Video',
                                     ],
                                     null, ['placeholder' => 'Select task type...', 'id' => 'type', 'class' => 'form-control', 'required']) }}
                        @if ($errors->has('type'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="link" class="col-md-4 col-form-label text-md-right">{{ __('Task URL') }}</label>

                        <div class="col-md-7">
                            <input id="link" type="text" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" name="link" value="{{ old('link') }}" required>

                            @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="credit_inr" class="col-md-4 col-form-label text-md-right">{{ __('Reward (₹)') }}</label>

                        <div class="col-md-7">
                            <input placeholder="₹0 - ₹1000" id="credit_inr" type="text" class="form-control{{ $errors->has('credit_inr') ? ' is-invalid' : '' }}" name="credit_inr" value="{{ old('credit_inr') }}" required>

                            @if ($errors->has('credit_inr'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('credit_inr') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="wait_in_seconds" class="col-md-4 col-form-label text-md-right">{{ __('Wait in Seconds') }}</label>

                        <div class="col-md-7">
                            <input id="wait_in_seconds" type="number" class="form-control{{ $errors->has('wait_in_seconds') ? ' is-invalid' : '' }}" name="wait_in_seconds" value="{{ old('wait_in_seconds') }}" required>

                            @if ($errors->has('wait_in_seconds'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('wait_in_seconds') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-7">
                            <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Any description here if any..." name="description" id="description" cols="30" rows="5">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="is_active" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                        <div class="col-md-7">
                            {{ Form::select('is_active', [1 => 'Active', 0 => 'Disabled'], null, ['placeholder' => 'Select task status...', 'class' => 'form-control', 'id' => 'is_active', 'required']) }}

                            @if ($errors->has('is_active'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('is_active') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-7 offset-4">
                            <button type="submit" class="btn btn-primary submit-btn btn-block">Create Task</button>
                        </div>
                    </div>
                    <div class="text-block text-center my-3">
                        <span class="text-small text-muted">Note: Disabled Tasks will not be shown to Users. Set Wait in seconds to 0 for App Download and Youtube Video Type.</span>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
