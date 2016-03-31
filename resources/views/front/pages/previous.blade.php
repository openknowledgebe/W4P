@extends('layouts.core')

@section('title', trans('generic.previous'))

@section('meta')
    @include('partials.meta.default')
@endsection

@section('content')

    <div class="project">
        <div class="home-banner">
            <span class="banner-text">
                <h1>{{ trans('generic.previous') }}</h1>
            </span>
        </div>
        <div class="container">
            @foreach ($previous as $project)
                {{--
                PREVIOUS PROJECTS
                First, we find out what version of the previous project was deployed on.
                This version is used to render the box with relevant information. If a newer
                or unknown version is used, the project will not be displayed here.
                --}}
                <?php
                    $version = json_decode($project->meta)->version;
                    $available_partials = scandir(base_path() . '/resources/views/partials/previous/');
                ?>
                @if (in_array($version . ".blade.php", $available_partials))
                    @include('partials.previous.' . $version)
                @endif
            @endforeach
        </div>
    </div>
@endsection
