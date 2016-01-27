@extends('layouts.backoffice')

@section('title', trans('backoffice.tiers'))

@section('content')
    <div class="row">
        <div class="col-md-push-3 col-md-6">

            @if ($new)
                <h1>{{ trans('backoffice.new_tier.title') }}</h1>
                <p>{{ trans('backoffice.new_tier.about') }}</p>
                <hr/>
            @else
                <h1>{{ trans('backoffice.edit_tier.title') }}</h1>
                <p>{{ trans('backoffice.edit_tier.about') }}</p>
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
                    <form method="POST" action="{{ URL::route('admin::storeTier') }}" enctype="multipart/form-data">
                @else
                    <form method="POST" action="{{ URL::route('admin::updateTier', $id) }}" enctype="multipart/form-data">
                @endif

                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="tierValue">
                        {{ trans('backoffice.tier_form.value.name') }}
                    </label>
                    <input type="text" class="form-control" name="tierValue"
                           placeholder="{{ trans('backoffice.tier_form.value.placeholder') }}"
                           value=
                           "<?php
                           if (Request::old('tierValue')) {
                               echo Request::old('tierValue');
                           } else if (isset($data["tierValue"])) {
                               echo $data["tierValue"];
                           }
                           ?>"
                    >
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.tier_form.value.info') }}
                    </span>
                </div>
                <div class="form-group">
                    <label for="tierDescription">
                        {{ trans('backoffice.tier_form.description.name') }}
                    </label>
                    <textarea class="form-control" rows="3" name="tierDescription"
                              placeholder="{{ trans('backoffice.tier_form.description.placeholder') }}"><?php if (Request::old('tierDescription')) { echo Request::old('tierDescription');
                        } else if (isset($data["tierDescription"])) { echo $data["tierDescription"]; } ?></textarea>
                    <span id="helpBlock" class="help-block">
                        {{ trans('backoffice.tier_form.description.info') }}
                    </span>
                </div>
                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>

            </form>
            @if (!$new)
                <form method="POST" action="{{ URL::route('admin::deleteTier', $id) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="DELETE">
               {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{ trans('backoffice.delete') }}</button>
            @endif
        </div>
    </div>
@endsection