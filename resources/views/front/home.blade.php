@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div>
        <h1>{{ \W4P\Models\Setting::get('project.title') }}</h1>
        <p>{{ \W4P\Models\Setting::get('project.brief') }}</p>
    </div>
@endsection