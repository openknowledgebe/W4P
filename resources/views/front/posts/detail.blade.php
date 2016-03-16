@extends('layouts.core')

@section('title', $post->title)

@section('content')

    <div class="project">
        <div class="home-banner">
            <span class="banner-text">
                <h1>{{ $post->title }}</h1>
            </span>
        </div>
        <div class="container">
            <div nlass="row">
                <br/>
                <strong>
                    <p class="date">{{ trans('generic.posted_on') }} {{ $post->created_at->format("d/m/Y") }}</p>
                </strong>
                <div class="post">
                    {!! Markdown::convertToHtml($post->content) !!}
                </div>
            </div>
        </div>
    </div>

@endsection