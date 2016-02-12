@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <div class="home-banner">
            <span class="banner-text">{{ trans('core.howdoesitwork') }}</span>
        </div>
        <div class="container">
            <div class="row">
                {!! trans('pages.how.content') !!}
            </div>
        </div>
@endsection