@extends('layouts.backoffice')

@section('title', trans('backoffice.socialmedia'))

@section('content')
    <div class="row">
        <div class="col-md-push-3 col-md-6">
            <h1>{{ trans('backoffice.socialmedia') }}</h1>
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

            <form method="POST" action="{{ URL::route('admin::social') }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="social_twitter_handle">
                        {{ trans('setup.detail.social.fields.twitter_handle.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_twitter_handle"
                           placeholder="{{ trans('setup.detail.social.fields.twitter_handle.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_twitter_handle')) {
                               echo Request::old('social_twitter_handle');
                           } else {
                               if (array_has($data, "social.twitter_handle"))
                                   echo $data["social.twitter_handle"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.twitter_handle.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="social_twitter_message">
                        {{ trans('setup.detail.social.fields.twitter_message.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_twitter_message"
                           placeholder="{{ trans('setup.detail.social.fields.twitter_message.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_twitter_message')) {
                               echo Request::old('social_twitter_message');
                           } else {
                               if (array_has($data, "social.twitter_message"))
                                   echo $data["social.twitter_message"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.twitter_message.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="social_facebook_page_url">
                        {{ trans('setup.detail.social.fields.facebook_page_url.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_facebook_page_url"
                           placeholder="{{ trans('setup.detail.social.fields.facebook_page_url.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_facebook_page_url')) {
                               echo Request::old('social_facebook_page_url');
                           } else {
                               if (array_has($data, "social.facebook_page_url"))
                                   echo $data["social.facebook_page_url"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.facebook_page_url.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="social_facebook_message">
                        {{ trans('setup.detail.social.fields.facebook_message.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_facebook_message"
                           placeholder="{{ trans('setup.detail.social.fields.facebook_message.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_facebook_message')) {
                               echo Request::old('social_facebook_message');
                           } else {
                               if (array_has($data, "social.facebook_message"))
                                   echo $data["social.facebook_message"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.facebook_message.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="social_seo_title">
                        {{ trans('setup.detail.social.fields.seo_title.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_seo_title"
                           placeholder="{{ trans('setup.detail.social.fields.seo_title.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_seo_title')) {
                               echo Request::old('social_seo_title');
                           } else {
                               if (array_has($data, "social.seo_title"))
                                   echo $data["social.seo_title"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.seo_title.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="social_seo_description">
                        {{ trans('setup.detail.social.fields.seo_description.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_seo_description"
                           placeholder="{{ trans('setup.detail.social.fields.seo_description.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_seo_description')) {
                               echo Request::old('social_seo_description');
                           } else {
                               if (array_has($data, "social.seo_description"))
                                   echo $data["social.seo_description"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.seo_description.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="social_seo_image">
                        {{ trans('setup.detail.social.fields.seo_image.name') }}
                    </label>
                    <input type="text" class="form-control" name="social_seo_image"
                           placeholder="{{ trans('setup.detail.social.fields.seo_image.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('social_seo_image')) {
                               echo Request::old('social_seo_image');
                           } else {
                               if (array_has($data, "social.seo_image"))
                                   echo $data["social.seo_image"];
                           }
                           ?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.social.fields.seo_image.info') }}
                    </span>
                </div>

                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>
            </form>
        </div>
    </div>
@endsection