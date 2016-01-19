@extends('layouts.backoffice')

@section('title', '')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>{{ trans('backoffice.project') }}</h1>
            <p>{{ trans('backoffice.page.project.about') }}</p>
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

            <form method="POST" action="{{ URL::route('admin::project') }}" files="true" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="projectTitle">
                        {{ trans('setup.detail.project.fields.title.name') }}
                    </label>
                    <input type="text" class="form-control" name="projectTitle"
                           placeholder="{{ trans('setup.detail.project.fields.title.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('projectTitle')) {
                               echo Request::old('projectTitle');
                           } else if (isset($data["project"]->title)) {
                               echo $data["project"]->title;
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.project.fields.title.info') }}</span>
                </div>
                <div class="form-group">
                    <label for="projectBrief">{{ trans('setup.detail.project.fields.brief.name') }}</label>
                    <input type="text" class="form-control" name="projectBrief"
                           placeholder="{{ trans('setup.detail.project.fields.brief.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('projectBrief')) {
                               echo Request::old('projectBrief');
                           } else if (isset($data["project"]->brief)){
                               echo $data["project"]->brief;
                           }?>"
                    >
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.project.fields.brief.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="projectStartDate">
                        {{ trans('setup.detail.project.fields.startdate.name') }}
                    </label>
                    <input type="text" class="form-control dtp" name="projectStartDate"
                           placeholder="{{ trans('setup.detail.project.fields.startdate.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('projectStartDate')) {
                               echo Request::old('projectStartDate');
                           } else if (isset($data["project"]->starts_at)) {
                               echo date('Y-m-d H:i', strtotime($data["project"]->starts_at));
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.project.fields.startdate.info') }}</span>
                </div>
                <div class="form-group">
                    <label for="projectEndDate">
                        {{ trans('setup.detail.project.fields.enddate.name') }}
                    </label>
                    <input type="text" class="form-control dtp" name="projectEndDate"
                           placeholder="{{ trans('setup.detail.project.fields.enddate.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('projectEndDate')) {
                               echo Request::old('projectEndDate');
                           } else if (isset($data["project"]->ends_at)) {
                               echo date('Y-m-d H:i', strtotime($data["project"]->ends_at));
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">{{ trans('setup.detail.project.fields.enddate.info') }}</span>
                </div>
                <div class="form-group">
                    <label for="projectDescription">
                        {{ trans('backoffice.page.project.fields.description.name') }}
                    </label>
            <textarea class="form-control markdown allowsinline" rows="10" name="projectDescription"
                      placeholder="{{ trans('backoffice.page.project.fields.description.placeholder') }}"><?php if (Request::old('projectDescription')) { echo Request::old('projectDescription');
                } else if (isset($data["project"]->description)) { echo $data["project"]->description; } ?></textarea>
                    <span id="helpBlock" class="help-block">{{ trans('backoffice.page.project.fields.description.info') }}</span>
                </div>
                <div class="form-group">
                    <label for="projectLogo">
                        {{ trans('backoffice.page.project.fields.logo.name') }}
                    </label>
                    @if (file_exists(public_path() . "/project/logo.png"))
                        <br/>
                        <img class="logo" src="{{ URL::to("/project/logo.png") }}" width="100" height="100" />
                        <span id="helpBlock" class="help-block">{{ trans('backoffice.page.project.fields.logo.existing') }}</span>
                    @endif
                    <input type="file" class="form-control" name="projectLogo" id="projectLogo">
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page.project.fields.logo.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="projectBanner">
                        {{ trans('backoffice.page.project.fields.banner.name') }}
                    </label>
                    @if (file_exists(public_path() . "/project/banner.png"))
                        <br/>
                        <img class="banner" src="{{ URL::to("/project/banner.png") }}" width="500" height="100" />
                        <span id="helpBlock" class="help-block">{{ trans('backoffice.page.project.fields.banner.existing') }}</span>
                    @endif
                    <input type="file" class="form-control" name="projectBanner" id="projectBanner">
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page.project.fields.banner.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="projectVideoProvider">
                        {{ trans('backoffice.page.project.fields.video.name') }}
                    </label>
                    <select class="form-control" name="projectVideoProvider">
                        <option value="vimeo" @if ($data["project"]->videoProvider == "vimeo") selected @endif>Vimeo</option>
                        <option value="youtube" @if ($data["project"]->videoProvider == "youtube") selected @endif>YouTube</option>
                        <option value="null" @if ($data["project"]->videoProvider == null || $data["project"]->videoProvider == "null") selected @endif>No video</option>
                    </select>
            <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page.project.fields.video.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="projectVideo">
                        {{ trans('backoffice.page.project.fields.video-url.name') }}
                    </label>
                    <input type="text" class="form-control" name="projectVideo"
                           placeholder="{{ trans('backoffice.page.project.fields.video-url.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('projectVideo')) {
                               echo Request::old('projectVideo');
                           } else if (isset($data["project"]->videoUrl)){
                               echo $data["project"]->videoUrl;
                           }?>"
                    >
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page.project.fields.video-url.info') }}
                    </span>
                </div>
                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>
            </form>
        </div>
    </div>
@endsection