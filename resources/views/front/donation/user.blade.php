@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');"></div>
        @endif
        <!-- Donation page -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Donation header block -->
                    <h1>{{ trans('donation.confirm.title') }}</h1>
                    <p>{{ trans('donation.confirm.description') }}</p>
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <p>{{ trans('You pledged:') }}</p>
                    @foreach ($types as $type)
                        <strong>{{ trans('backoffice.' . $type['kind']) }}</strong><br/>
                        {{ $type['amount'] }}x {{ $type['name'] }}<br/>
                    @endforeach
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <form method="POST" action="{{ URL::route('donate::confirm') }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST">
                        <input name="_pledge" type="hidden" value="{{ json_encode($types) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="firstName">
                                {{ trans('donation.user.first_name.title') }}
                            </label>
                            <input type="text" class="form-control" name="firstName"
                                   placeholder="{{ trans('donation.user.first_name.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('firstName')) {
                                       echo Request::old('firstName');
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('donation.user.first_name.info') }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="lastName">
                                {{ trans('donation.user.last_name.title') }}
                            </label>
                            <input type="text" class="form-control" name="lastName"
                                   placeholder="{{ trans('donation.user.last_name.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('lastName')) {
                                       echo Request::old('lastName');
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('donation.user.last_name.info') }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                {{ trans('donation.user.email.title') }}
                            </label>
                            <input type="text" class="form-control" name="email"
                                   placeholder="{{ trans('donation.user.email.placeholder') }}"
                                   value=
                                   "<?php
                                   if (Request::old('email')) {
                                       echo Request::old('email');
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('donation.user.email.info') }}
                            </span>
                        </div>

                        <button type="submit" class="btn4 pull-right">{{ trans('donation.buttons.confirm') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection