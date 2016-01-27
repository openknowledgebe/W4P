@extends('layouts.backoffice')

@section('title', trans('backoffice.goals'))

@section('content')
    <div class="row">
        <div class="col-md-push-3 col-md-6">

            <h1>{{ trans('backoffice.currency_goal.title') }}</h1>
            <p>{{ trans('backoffice.currency_goal.about') }}</p>
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
                    <form method="POST" action="{{ URL::route('admin::goalsCurrency') }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name">
                                {{ trans('backoffice.currency_form.value.name') }}
                            </label>
                            <br/>
                            <input type="text" class="form-control" name="currency"
                                   placeholder="{{ trans('backoffice.currency_form.value.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('currency')) {
                                       echo Request::old('currency');
                                   } else if (isset($currency)) {
                                       echo $currency;
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('backoffice.currency_form.value.info') }}
                            </span>
                        </div>

                <hr/>
                <button type="submit" class="btn btn-primary pull-right">{{ trans('backoffice.save') }}</button>
            </form>
        </div>
    </div>
@endsection