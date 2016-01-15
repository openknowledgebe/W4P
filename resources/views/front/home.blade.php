@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div>
        <h1>{{ $project->title }}</h1>
        <p>{{ $project->brief }}</p>
    </div>
@endsection