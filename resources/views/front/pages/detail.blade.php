@extends('layouts.core')

@if ($page->default)
    <?php $page->title = trans('generic.' . $page->title) ?>
@endif

@section('title', $page->title)

@section('meta')
    @include('partials.meta.page')
@endsection

@section('content')

    <div class="project">
        <div class="home-banner">
            <span class="banner-text">
                <h1>{{ $page->title }}</h1>
            </span>
        </div>
        <div class="container">
            <div nlass="row">
                <br/>
                <div class="post">
                    {!! Markdown::convertToHtml($page->content) !!}
                </div>
            </div>
        </div>
    </div>

@endsection