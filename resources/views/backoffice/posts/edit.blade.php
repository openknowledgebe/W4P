@extends('layouts.backoffice')

@section('title', '')

@section('content')
    <div class="row">
        <div class="col-md-push-3 col-md-6">

            @if ($new)
                <h1>{{ trans('backoffice.new_post.title') }}</h1>
                <p>{{ trans('backoffice.new_post.about') }}</p>
                <hr/>
            @else
                <h1>{{ trans('backoffice.edit_post.title') }}</h1>
                <p>{{ trans('backoffice.edit_post.about') }}</p>
                <hr/>
            @endif

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

                @if ($new)
                    <form method="POST" action="{{ URL::route('admin::storePost') }}" enctype="multipart/form-data">
                @else
                    <form method="POST" action="{{ URL::route('admin::updatePost', $id) }}" enctype="multipart/form-data">
                @endif

                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">
                        {{ trans('backoffice.post_form.title.name') }}
                    </label>
                    <input type="text" class="form-control" name="title"
                           placeholder="{{ trans('backoffice.post_form.title.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('title')) {
                               echo Request::old('title');
                           } else if (isset($data["title"])) {
                               echo $data["title"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.post_form.title.info') }}
                    </span>
                </div>

                <div class="form-group">
                    <label for="content">
                        {{ trans('backoffice.post_form.content.name') }}
                    </label>
                    <textarea class="form-control markdown allowsinline" rows="3" name="content"
                              placeholder="{{ trans('backoffice.post_form.content.placeholder') }}"><?php if (Request::old('content')) { echo Request::old('content');
                        } else if (isset($data["content"])) { echo $data["content"]; } ?></textarea>
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.post_form.content.info') }}
                    </span>
                </div>
                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>

            </form>
            @if (!$new)
                <form method="POST" action="{{ URL::route('admin::deletePost', $id) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="DELETE">
               {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{ trans('backoffice.delete') }}</button>
            @endif
        </div>
    </div>
@endsection