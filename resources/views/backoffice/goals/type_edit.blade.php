@extends('layouts.backoffice')

@section('title', '')

@section('content')
    <div class="row">
        <div class="col-md-push-3 col-md-6">

            @if ($new)
                <h1>{{ trans('backoffice.new_goalType.title') }}</h1>
                <p>{{ trans('backoffice.new_goalType.about') }}</p>
                <hr/>
            @else
                <h1>{{ trans('backoffice.edit_goalType.title') }}</h1>
                <p>{{ trans('backoffice.edit_goalType.about') }}</p>
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
                    <form method="POST" action="{{ URL::route('admin::goalsTypeCreate', $kind) }}" enctype="multipart/form-data">
                @else
                    <form method="POST" action="{{ URL::route('admin::goalsTypeEdit', [$kind, $id]) }}" enctype="multipart/form-data">
                @endif
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}



                        <div class="form-group">
                            <label for="name">
                                {{ trans('backoffice.goalType_form.name.name') }}
                            </label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="{{ trans('backoffice.goalType_form.name.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('name')) {
                                       echo Request::old('name');
                                   } else if (isset($data["name"])) {
                                       echo $data["name"];
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('backoffice.goalType_form.name.info') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="description">
                                {{ trans('backoffice.goalType_form.description.name') }}
                            </label>
                            <input type="text" class="form-control" name="description"
                                   placeholder="{{ trans('backoffice.goalType_form.description.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('description')) {
                                       echo Request::old('description');
                                   } else if (isset($data["description"])) {
                                       echo $data["description"];
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('backoffice.goalType_form.description.info') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="unit_description">
                                {{ trans('backoffice.goalType_form.unit_description.name') }}
                            </label>
                            <input type="text" class="form-control" name="unit_description"
                                   placeholder="{{ trans('backoffice.goalType_form.title.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('unit_description')) {
                                       echo Request::old('unit_description');
                                   } else if (isset($data["unit_description"])) {
                                       echo $data["unit_description"];
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('backoffice.goalType_form.unit_description.info') }}
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="required_amount">
                                {{ trans('backoffice.goalType_form.required_amount.name') }}
                            </label>
                            <input type="text" class="form-control" name="required_amount"
                                   placeholder="{{ trans('backoffice.goalType_form.required_amount.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('required_amount')) {
                                       echo Request::old('required_amount');
                                   } else if (isset($data["required_amount"])) {
                                       echo $data["required_amount"];
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('backoffice.goalType_form.required_amount.info') }}
                            </span>
                        </div>



                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>
            </form>
            @if (!$new)
                <form method="POST" action="{{ URL::route('admin::goalsTypeDelete', [$kind, $id]) }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="DELETE">
               {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{ trans('backoffice.delete') }}</button>
            @endif
        </div>
    </div>
@endsection