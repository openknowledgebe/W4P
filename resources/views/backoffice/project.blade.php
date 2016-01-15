@extends('layouts.backoffice')

@section('title', '')

@section('content')
    <h1>{{ trans('backoffice.project') }}</h1>
    <p>{{ trans('backoffice.page.project.about') }}</p>
    <hr/>
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
            <label for="projectDescription">
                {{ trans('backoffice.page.project.fields.description.name') }}
            </label>
            <textarea class="form-control" rows="10" name="projectDescription"
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
            <label for="projectLogo">
                {{ trans('backoffice.page.project.fields.video.name') }}
            </label>
            @if (file_exists(public_path() . "/project/video.mp4"))
                <br/>
                <video controls src="{{ URL::to('project/video.mp4') }}" width="50%"></video>
                <span id="helpBlock" class="help-block">{{ trans('backoffice.page.project.fields.video.existing') }}</span>
            @endif
            <input type="file" class="form-control" name="projectLogo" id="projectLogo">
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page.project.fields.video.info') }}
                    </span>
        </div>


        <hr/>
        <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>
    </form>

@endsection