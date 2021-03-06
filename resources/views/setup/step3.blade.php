@extends('layouts.setup')

@section('title', trans('setup.steps.platform') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">

            <h1>{{ trans('setup.detail.organisation.title') }}</h1>
            <hr/>
            <p>{{ trans('setup.detail.organisation.paragraph') }}</p>

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

            <form method="POST" action="{{ URL::route('setup::step', 3) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="organisationName">
                        {{ trans('setup.detail.organisation.fields.name.name') }}
                    </label>
                    <input type="text" class="form-control" name="organisationName"
                           placeholder="{{ trans('setup.detail.organisation.fields.name.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('organisationName')) {
                               echo Request::old('organisationName');
                           } else {
                               echo $data["organisationName"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.organisation.fields.name.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="organisationLogo">
                        {{ trans('setup.detail.organisation.fields.logo.name') }}
                    </label>
                    @if (file_exists(public_path() . "/organisation/logo.png"))
                        <br/>
                        <img class="logo" src="{{ URL::to("/organisation/logo.png") }}" width="100" height="100" />
                        <span id="helpBlock" class="help-block">{{ trans('setup.detail.organisation.fields.logo.existing') }}</span>
                    @endif
                    <input type="file" class="form-control" name="organisationLogo" id="organisationLogo">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.organisation.fields.logo.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="organisationDescription">
                        {{ trans('setup.detail.organisation.fields.description.name') }}
                    </label>
                     <textarea class="form-control" rows="3" name="organisationDescription"
                               placeholder="{{ trans('setup.detail.organisation.fields.description.placeholder') }}"><?php if (Request::old('organisationDescription')) { echo Request::old('organisationDescription');
                         } else if (isset($data["organisationDescription"])) { echo $data["organisationDescription"]; } ?></textarea>
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.organisation.fields.description.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="organisationWebsite">
                        {{ trans('setup.detail.organisation.fields.website.name') }}
                    </label>
                    <input type="text" class="form-control" name="organisationWebsite"
                           placeholder="{{ trans('setup.detail.organisation.fields.website.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('organisationWebsite')) {
                               echo Request::old('organisationWebsite');
                           } else {
                               echo $data["organisationWebsite"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.organisation.fields.website.info') }}
                    </span>
                </div>

            <hr/>

            <a class="btn4" href="{{ URL::route('setup::step', 2) }}">&larr; {{ trans('setup.generic.back') }}</a>
            <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
            </form>

        </div>
    </div>
@endsection