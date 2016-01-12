@extends('layouts.core')

@section('title', 'Welcome | Setup')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.sidebar')
        </div>
        <div class="col-md-6">
            <h1>Welcome</h1>
            <hr/>
            <p>It seems this is the first time you are trying to set up W4P. We have included a handy wizard for you to get started.</p>
            <hr/>
            <a class="btn btn-primary btn-sm pull-right" href="/setup/1">Get started &rarr;</a>
        </div>
    </div>
@endsection