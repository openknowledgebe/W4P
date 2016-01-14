@extends('layouts.core')

@section('title', 'Log In')

@section('content')

    <div class="row">
        <div class="col-md-push-3 col-md-6 col-sm-12">
            <form role="form" method="POST" action="{{ URL::route('admin::login') }}">
                <p>Please sign in using your administrator's credentials.</p>
                <hr/>
                @if(Session::has('message'))
                    <div class="alert alert-info">
                        {{ Session::get('message') }}
                    </div>
                    <hr/>
                @endif
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="pwd">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <hr/>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Sign In</button>
            </form>
            @if($errors->has())
                <br/>
                <div class="panel panel-default">
                    <div class="panel-body">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

