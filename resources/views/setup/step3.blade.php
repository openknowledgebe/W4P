@extends('layouts.core')

@section('title', trans('setup.steps.project') . " | " . trans('setup.generic.wizard'))

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include('setup.progress')
        </div>
        <div class="col-md-6">

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

            <form method="POST" action="{{ URL::route('setup::step', 3) }}" files="true" enctype="multipart/form-data">
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
                           } else {
                               echo $data["projectBrief"];
                           }?>"
                    >
                    <span id="helpBlock" class="help-block">
                        {{ trans('setup.detail.project.fields.brief.info') }}
                    </span>
                </div>
            <hr/>

            <a class="btn btn-primary btn-sm" href="{{ URL::route('setup::step', 2) }}">&larr; {{ trans('setup.generic.back') }}</a>
            <button type="submit" class="btn btn-primary btn-sm pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
            </form>

        </div>
    </div>
@endsection