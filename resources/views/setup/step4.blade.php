@extends('layouts.setup')

@section('title', trans('setup.steps.project') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-push-3">

            <h1>
                {{ trans('setup.detail.project.title') }}
            </h1>
            <hr/>
            <p>
                {{ trans('setup.detail.project.paragraph') }}
            </p>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="{{ URL::route('setup::step', 4) }}" files="true" enctype="multipart/form-data">
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
                           } else {
                               echo $data["projectTitle"];
                           }
                           ?>"
                           maxlength="255">
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
                           } else {
                               echo $data["projectBrief"];
                           }?>"
                           maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.project.fields.brief.info') }}
                    </span>
                </div>
            <hr/>

            <a class="btn4" href="{{ URL::route('setup::step', 3) }}">&larr; {{ trans('setup.generic.back') }}</a>
            <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
            </form>

        </div>
    </div>
@endsection