@extends('layouts.app')
@section('title', 'Website Settings')

@section('content')

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show text-small" role="alert">
            <strong>Error!</strong> {{ $errors->first() }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="col-12 grid-margin">
        <div class="card">

            <div class="card-body">
                <h4 class="card-title">SITE SETTINGS</h4>

                {{ Form::open() }}
                @foreach($sitesettings as $setting)
                <div class="form-group row">
                    <label for="{{ $setting->setting }}" class="col-md-3 col-form-label text-md-right">{{ $setting->setting_display }}</label>
                    <div class="col-md-7">
                        <textarea class="form-control" placeholder="Any description here if any..." name="{{ $setting->setting }}" id="{{ $setting->setting }}" cols="30" rows="5">{!! $setting->value !!}</textarea>
                    </div>
                </div>
                @endforeach
                <div class="form-group">
                    <div class="col-md-4 offset-4">
                        <button type="submit" class="btn btn-primary submit-btn btn-block">Submit Setting</button>
                    </div>
                </div>
                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
