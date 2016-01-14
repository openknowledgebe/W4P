@extends('layouts.setup')

@section('title', trans('setup.steps.mail') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.progress')
        </div>
        <div class="col-md-6">
            <h1>
                {{ trans('setup.detail.mail.title') }}
            </h1>
            <p>
                {{ trans('setup.detail.mail.paragraph') }}
            </p>
            <hr/>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="{{ URL::route('setup::step', 4) }}">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="emailHost">
                        {{ trans('setup.detail.mail.fields.host.name') }}
                    </label>
                    <input type="text" class="form-control" name="emailHost"
                           placeholder="{{ trans('setup.detail.mail.fields.host.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('emailHost')) {
                               echo Request::old('emailHost');
                           } else {
                               echo $data["emailHost"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.host.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailPort">
                        {{ trans('setup.detail.mail.fields.port.name') }}
                    </label>
                    <input type="text" class="form-control" name="emailPort" style="width:50%;"
                           placeholder="{{ trans('setup.detail.mail.fields.port.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('emailPort')) {
                               echo Request::old('emailPort');
                           } else {
                               echo $data["emailPort"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.port.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailUsername">
                        {{ trans('setup.detail.mail.fields.username.name') }}
                    </label>
                    <input type="text" class="form-control" name="emailUsername"
                           placeholder="{{ trans('setup.detail.mail.fields.username.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('emailUsername')) {
                               echo Request::old('emailUsername');
                           } else {
                               echo $data["emailUsername"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.username.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailPassword">
                        {{ trans('setup.detail.mail.fields.password.name') }}
                    </label>
                    <input type="password" class="form-control" name="emailPassword"
                           placeholder="{{ trans('setup.detail.mail.fields.password.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('emailPassword')) {
                               echo Request::old('emailPassword');
                           } else {
                               echo $data["emailPassword"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.password.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailEncryption">
                        {{ trans('setup.detail.mail.fields.encryption.name') }}
                    </label>
                    <select class="form-control" name="emailEncryption">
                        <option value="tls">TLS</option>
                        <option value="null">Off</option>
                    </select>
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.encryption.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailFrom">
                        {{ trans('setup.detail.mail.fields.from.name') }}
                    </label>
                    <input type="text" class="form-control" name="emailFrom"
                           placeholder="{{ trans('setup.detail.mail.fields.from.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('emailFrom')) {
                               echo Request::old('emailFrom');
                           } else {
                               echo $data["emailFrom"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.from.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailName">
                        {{ trans('setup.detail.mail.fields.name.name') }}
                    </label>
                    <input type="text" class="form-control" name="emailName"
                           placeholder="{{ trans('setup.detail.mail.fields.name.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('emailName')) {
                               echo Request::old('emailName');
                           } else {
                               echo $data["emailName"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.name.info') }}</span>
                </div>

                <hr/>

                <a class="btn btn-primary btn-sm"
                   href="{{ URL::route('setup::step', 3) }}">
                    &larr; {{ trans('setup.generic.back') }}
                </a>
                <button type="submit" class="btn btn-primary btn-sm pull-right">
                    {{ trans('setup.generic.next') }} &rarr;
                </button>
            </form>
            <br/>
        </div>
    </div>
@endsection