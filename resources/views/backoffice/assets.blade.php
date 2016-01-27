@extends('layouts.backoffice')

@section('title', trans('backoffice.dashboard'))

@section('content')
    <h1>{{ trans('backoffice.assets') }}</h1>
    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($images as $image)
            <tr>
                <th><img height=120 src="{{ URL::to('images/' . $image) }}" /></th>
                <th><a href="{{ URL::route('admin::deleteAsset', $image) }}">Delete</a></th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection