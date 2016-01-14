@extends('layouts.setup')

@section('title', trans('setup.steps.welcome') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.progress')
        </div>
        <div class="col-md-6">
            <h1>{{ trans('setup.detail.welcome.title') }}</h1>
            <hr/>
            <p>{{ trans('setup.detail.welcome.paragraph') }}</p>
            <hr/>
            <a class="btn btn-primary btn-sm pull-right" href="{{ URL::route('setup::step', 1) }}">{{ trans('setup.detail.welcome.button') }} &rarr;</a>
        </div>
    </div>
@endsection