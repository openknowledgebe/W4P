@extends('layouts.setup')

@section('title', trans('setup.steps.admin') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">

            <h1>{{ trans('setup.detail.admin.title') }}</h1>
            <hr/>
            <p>{{ trans('setup.detail.admin.paragraph') }}</p>

            @if(W4P\Models\Setting::exists('pwd'))
                <div class="alert alert-info" role="alert">
                    <p>{{ trans('setup.detail.admin.warnings.alreadySet') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="{{ URL::route('setup::step', 1) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
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

            <a class="btn4" href="{{ URL::route('setup::index') }}">&larr; {{ trans('setup.generic.back') }}</a>
            <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
            </form>

        </div>
    </div>
@endsection