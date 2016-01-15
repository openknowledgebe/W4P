@extends('layouts.setup')

@section('title', trans('setup.steps.finish') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.progress')
        </div>
        <div class="col-md-6">
            <h1>{{ trans('setup.detail.finish.title') }}</h1>
            <hr/>
            <a class="btn btn-primary btn-sm" href="{{ URL::route('setup::step', 5) }}">&larr; {{ trans('setup.generic.back') }}</a>
            <a href="{{ URL::route('admin::login') }}" class="btn btn-primary btn-sm pull-right">{{ trans('setup.generic.finish') }} &rarr;</a>
        </div>
    </div>
@endsection