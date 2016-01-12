@extends('layouts.core')

@section('title', 'Welcome | Setup')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.sidebar')
        </div>
        <div class="col-md-6">

            <h1>Administration Setup</h1>
            <hr/>
            <p>Before you can set up your organisation and such, you need to set up a password. This password is used for all administrative tasks.</p>

            @if(W4P\Models\Setting::exists('pwd'))
                <div class="alert alert-info" role="alert">
                    <p>You have already set up a password for the administrator. If you enter a password, the existing password will be replaced.</p>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>Oops!</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="/setup/1">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm" placeholder="Password (again)">
                </div>
            <hr/>

            <a class="btn btn-primary btn-sm" href="/setup">&larr; Back</a>
            <button type="submit" class="btn btn-primary btn-sm pull-right" href="/setup/2">Next &rarr;</button>
            </form>

        </div>
    </div>
@endsection