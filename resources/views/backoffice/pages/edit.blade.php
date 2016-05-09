@extends('layouts.backoffice')

@section('title', trans('backoffice.posts'))

@section('content')
    <div class="row">
        <div class="col-md-push-1 col-md-10">

            <h1>{{ trans('backoffice.edit_page.title') }}</h1>
            <p>{{ trans('backoffice.edit_page.about') }}</p>
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

                <form method="POST" action="{{ URL::route('admin::updatePage', $page->slug) }}" enctype="multipart/form-data">

                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}

                @if ($page->default)
                        <div class="form-group">
                            <label for="title"> {{ trans('backoffice.page_form.title.name') }}: "{{ trans('generic.' . $page->title) }}"</label>
                            <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page_form.title.why_fixed') }}
                    </span>
                        </div>
                @else
                        <div class="form-group">
                            <label for="title">
                                {{ trans('backoffice.page_form.title.name') }}
                            </label>
                            <input type="text" class="form-control" name="title"
                                   placeholder="{{ trans('backoffice.page_form.title.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('title')) {
                                       echo Request::old('title');
                                   } else if (isset($page->title)) {
                                       echo $page->title;
                                   }
                                   ?>"
                                   maxlength="255">
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page_form.title.info') }}
                    </span>
                </div>
                @endif

                <div class="form-group">
                    <label for="content">
                        {{ trans('backoffice.page_form.content.name') }}
                    </label>
                    <textarea data-provide="markdown" class="form-control markdown allowsinline" rows="20" name="content"
                              placeholder="{{ trans('backoffice.page_form.content.placeholder') }}"><?php if (Request::old('content')) { echo Request::old('content');
                        } else if (isset($page->content)) { echo $page->content; } ?></textarea>
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.page_form.content.info') }}
                    </span>
                </div>
                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>
            </form>
        </div>
    </div>
@endsection