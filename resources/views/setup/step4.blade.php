@extends('layouts.core')

@section('title', 'Project Setup | Setup')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.progress')
        </div>
        <div class="col-md-6">
            <h1>{{ trans('setup.detail.finish.title') }}</h1>
            <hr/>
            <a class="btn btn-primary btn-sm" href="/setup/3">&larr; {{ trans('setup.generic.back') }}</a>
            <a href="/" type="submit" class="btn btn-primary btn-sm pull-right">{{ trans('setup.generic.finish') }} &rarr;</a>
        </div>
    </div>
@endsection