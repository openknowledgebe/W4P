@extends('layouts.backoffice')

@section('title', trans('backoffice.project'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>{{ trans('backoffice.pw_reset') }}</h1>
            <p>{{ trans('backoffice.page.pw_reset.about') }}</p>
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

            <form method="POST" action="{{ URL::route('admin::password', 1) }}">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="password">
                        {{ trans('setup.detail.admin.fields.passwordOld.name') }}
                    </label>
                    <input type="password" class="form-control" id="passwordOld" name="passwordOld"
                           placeholder="{{ trans('setup.detail.admin.fields.passwordOld.placeholder') }}" maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.admin.fields.passwordOld.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">
                        {{ trans('setup.detail.admin.fields.password.name') }}
                    </label>
                    <input  type="password" class="form-control" id="password" name="password"
                            placeholder="{{ trans('setup.detail.admin.fields.password.placeholder') }}" maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.admin.fields.password.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="password">
                        {{ trans('setup.detail.admin.fields.passwordConfirm.name') }}
                    </label>
                    <input type="password" class="form-control" id="passwordConfirm" name="passwordConfirm"
                           placeholder="{{ trans('setup.detail.admin.fields.passwordConfirm.placeholder') }}" maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.admin.fields.passwordConfirm.info') }}
                    </span>
                </div>
                <hr/>

                <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.change') }}</button>
            </form>

        </div>
    </div>
@endsection