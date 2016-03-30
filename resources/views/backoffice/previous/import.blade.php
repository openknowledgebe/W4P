@extends('layouts.backoffice')

@section('title', trans('backoffice.tiers'))

@section('content')
    <div class="row">
        <div class="col-md-push-3 col-md-6">

            <h1>{{ trans('backoffice.import.title') }}</h1>
            <p>{{ trans('backoffice.import.about') }}</p>
            <hr/>

            @if(Session::has('info'))
                <div class="alert alert-info" role="alert">
                    {{ Session::get('info') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="{{ URL::route('admin::importProject') }}" enctype="multipart/form-data">

                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="url">
                        {{ trans('backoffice.import_form.url.name') }}
                    </label>
                    <input type="text" class="form-control" name="url"
                           placeholder="{{ trans('backoffice.import_form.url.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('url')) {
                               echo Request::old('url');
                           } else if (isset($data["url"])) {
                               echo $data["url"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.import_form.url.info') }}
                    </span>
                </div>
                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.do_import') }}</button>

            </form>
        </div>
    </div>
@endsection