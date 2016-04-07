@extends('layouts.setup')

@section('title', trans('setup.steps.platform') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">

            <h1>{{ trans('setup.detail.platform.title') }}</h1>
            <hr/>
            <p>{{ trans('setup.detail.platform.paragraph') }}</p>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="{{ URL::route('setup::step', 2) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="platformOwnerName">
                        {{ trans('setup.detail.platform.fields.owner.name') }}
                    </label>
                    <input type="text" class="form-control" name="platformOwnerName"
                           placeholder="{{ trans('setup.detail.platform.fields.owner.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('platformOwnerName')) {
                               echo Request::old('platformOwnerName');
                           } else {
                               echo $data["platformOwnerName"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.owner.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="platformOwnerLogo">
                        {{ trans('setup.detail.platform.fields.logo.name') }}
                    </label>
                    @if (file_exists(public_path() . "/platform/logo.png"))
                        <br/>
                        <img class="logo" src="{{ URL::to("/platform/logo.png") }}" width="100" height="100" />
                        <span id="helpBlock" class="help-block">{{ trans('setup.detail.platform.fields.logo.existing') }}</span>
                    @endif
                    <input type="file" class="form-control" name="platformOwnerLogo" id="platformOwnerLogo">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.logo.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="GAID">{{ trans('setup.detail.platform.fields.gaid.name') }}</label>
                    <input type="text" class="form-control" name="analyticsId"
                           placeholder="{{ trans('setup.detail.platform.fields.gaid.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('analyticsId')) {
                               echo Request::old('analyticsId');
                           } else {
                               echo $data["analyticsId"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.gaid.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="mollieApiKey">{{ trans('setup.detail.platform.fields.mollie.name') }}</label>
                    <input type="text" class="form-control" name="mollieApiKey"
                           placeholder="{{ trans('setup.detail.platform.fields.mollie.placeholder') }}"
                           value="<?php
                           if (Request::old('mollieApiKey')) {
                               echo Request::old('mollieApiKey');
                           } else {
                               echo $data["mollieApiKey"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.mollie.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="platformOrganisationName">
                        {{ trans('setup.detail.platform.fields.name.name') }}
                    </label>

                    <input type="text" class="form-control" name="platformOrganisationName"
                           placeholder="{{ trans('setup.detail.platform.fields.name.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('platformOrganisationName')) {
                               echo Request::old('platformOrganisationName');
                           } else {
                               echo $data["platformOrganisationName"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.name.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="platformOrganisationAddress">
                        {{ trans('setup.detail.platform.fields.address.name') }}
                    </label>

                     <textarea class="form-control" rows="3" name="platformOrganisationAddress"
                               placeholder="{{ trans('setup.detail.platform.fields.address.placeholder') }}"><?php if (Request::old('platformOrganisationAddress')) { echo Request::old('platformOrganisationAddress');
                         } else if (isset($data["platformOrganisationAddress"])) { echo $data["platformOrganisationAddress"]; } ?></textarea>
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.address.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="platformOrganisationVAT">
                        {{ trans('setup.detail.platform.fields.vat.name') }}
                    </label>
                    <input type="text" class="form-control" name="platformOrganisationVAT"
                           placeholder="{{ trans('setup.detail.platform.fields.vat.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('platformOrganisationVAT')) {
                               echo Request::old('platformOrganisationVAT');
                           } else {
                               echo $data["platformOrganisationVAT"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.vat.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="platformOrganisationEmail">
                        {{ trans('setup.detail.platform.fields.email.name') }}
                    </label>

                    <input type="text" class="form-control" name="platformOrganisationEmail"
                           placeholder="{{ trans('setup.detail.platform.fields.email.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('platformOrganisationEmail')) {
                               echo Request::old('platformOrganisationEmail');
                           } else {
                               echo $data["platformOrganisationEmail"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.platform.fields.email.info') }}
                    </span>
                </div>

            <hr/>

            <a class="btn4 btn-sm" href="{{ URL::route('setup::step', 1) }}">&larr; {{ trans('setup.generic.back') }}</a>
            <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
            </form>

        </div>
    </div>
@endsection