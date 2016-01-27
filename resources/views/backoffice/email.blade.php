@extends('layouts.backoffice')

@section('title', trans('backoffice.email'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>
                {{ trans('backoffice.email') }}
            </h1>
            <p>
                {{ trans('backoffice.page.email.about') }}
            </p>
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

            <form method="POST" action="{{ URL::route('admin::email') }}">
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
                           maxlength="255">
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
                           maxlength="255">
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
                           maxlength="255">
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
                           maxlength="255">
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.password.info') }}</span>
                </div>

                <div class="form-group">
                    <label for="emailEncryption">
                        {{ trans('setup.detail.mail.fields.encryption.name') }}
                    </label>
                    <select class="form-control" name="emailEncryption">
                        <option value="tls"
                        <?php
                                if (Request::old('emailEncryption')) {
                                    if (Request::old('emailEncryption') == "tls") { echo "selected"; };
                                } else {
                                    if ($data["emailEncryption"] == "tls") { echo "selected"; };
                                }
                                ?>
                        >TLS</option>
                        <option value="null"
                        <?php
                                if (Request::old('emailEncryption')) {
                                    if (Request::old('emailEncryption') == "null"
                                            || Request::old('emailEncryption') == "")
                                    { echo "selected"; };
                                } else {
                                    if ($data["emailEncryption"] == "null"
                                            || $data["emailEncryption"] == "")
                                    { echo "selected"; };
                                }
                                ?>
                        >Off</option>
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
                           maxlength="255">
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
                           maxlength="255">
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.mail.fields.name.info') }}</span>
                </div>

                <hr/>

                <button type="submit" class="btn btn-primary pull-right">
                    {{ trans('backoffice.save') }}
                </button>
            </form>
            <br/>
        </div>
    </div>
@endsection