@extends('layouts.core')

@if ($page->default)
    @section('title', trans('generic.' . $page->title))
@else
    @section('title', $page->title)
@endif

@section('content')

    <div class="project">
        <div class="home-banner">
            <span class="banner-text">
                @if ($page->default)
                    <h1>{{ trans('generic.' . $page->title) }}</h1>
                @else
                    <h1>$page->title</h1>
                @endif
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