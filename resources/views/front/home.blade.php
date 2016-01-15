@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div>
        @if (file_exists(public_path() . "/project/banner.png"))
            <img class="banner" src="{{ URL::to("/project/banner.png") }}"/>
        @endif

        <h1>{{ $project->title }}</h1>
        <p>{{ $project->brief }}</p>
        <div>
            {!! Markdown::convertToHtml($project->description) !!}
        </div>
    </div>
@endsection