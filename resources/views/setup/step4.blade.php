@extends('layouts.core')

@section('title', 'Project Setup | Setup')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.sidebar')
        </div>
        <div class="col-md-6">
            <h1>Get Started</h1>
            <hr/>
            <a class="btn btn-primary btn-sm" href="/setup/3">&larr; Back</a>
            <a href="" type="submit" class="btn btn-primary btn-sm pull-right">Finish &rarr;</a>
        </div>
    </div>
@endsection