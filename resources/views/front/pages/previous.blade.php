@extends('layouts.core')

@section('title', trans('generic.previous'))

@section('meta')
    @include('partials.meta.default')
@endsection

@section('html', 'class="gray"')

@section('content')

    <div class="project previous">
        @foreach ($previous as $project)
        <div class="container">
            <div class="row project-overview">
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
            </div>
        </div>
        <hr/>
        @endforeach
    </div>
@endsection
