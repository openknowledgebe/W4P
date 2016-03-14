@extends('layouts.core')

@section('title', trans('generic.how_does_it_work'))

@section('content')
    <div class="project">
        <div class="home-banner">
            <span class="banner-text">{{ trans('generic.how_does_it_work') }}</span>
        </div>
        <div class="container">
            <div class="row">
                {!! trans('pages.how.content') !!}
            </div>
        </div>
@endsection