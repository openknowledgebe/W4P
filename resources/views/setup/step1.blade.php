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
            <form>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control" id="passwordConfirm" placeholder="Password (again)">
                </div>
            </form>
            <hr/>
            <a class="btn btn-primary btn-sm" href="/setup">&larr; Back</a>
            <a class="btn btn-primary btn-sm pull-right" href="/setup/2">Next &rarr;</a>
        </div>
    </div>
@endsection