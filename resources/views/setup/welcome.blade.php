@extends('layouts.setup')

@section('title', trans('setup.steps.welcome') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>{{ trans('setup.detail.welcome.title') }}</h1>
            <hr/>
            <p>{{ trans('setup.detail.welcome.paragraph') }}</p>
            <a class="btn4 pull-right" href="{{ URL::route('setup::step', 1) }}">{{ trans('setup.detail.welcome.button') }} &rarr;</a>
        </div>
    </div>
@endsection