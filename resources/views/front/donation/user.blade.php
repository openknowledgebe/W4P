@extends('layouts.core')

@section('title', trans('generic.donation_detail'))

@section('content')
    <div class="project" id="donation__details">
        <!-- Banner -->
        <div class="home-banner"
             @if (file_exists(public_path() . "/project/banner.png")) style="background-image: url('{{ URL::to("/project/banner.png") }}');" @endif>
        </div>
        <!-- Donation page -->
        <div class="container-fluid" id="donation__details-title">
            <div class="row">
                <div class="col-md-12">
                    <!-- Donation header block -->
                    <h1>{{ trans('donation.confirm.title') }}</h1>
                            <p>{{ trans('donation.you_pledged') }}</p>
                            @foreach ($types as $type)
                                @if (is_array($type))
                                    <strong>{{ trans('backoffice.' . $type['kind']) }}</strong><br/>
                                    {{ $type['amount'] }}x {{ $type['name'] }}<br/>
                                @endif
                            @endforeach
                            @if (isset($types['currency']))
                                <p>{{ trans('donation.money_pledge') }} €{{ $types['currency'] }}</p>
                            @endif
                    <hr/>
                    <p>{{ trans('donation.confirm.description') }}</p>
                    <hr/>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="donation__details-options">
            <div class="row">
                <div class="col-md-8 col-md-push-2">

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ trans('setup.generic.oops') }}</strong>
                            {{$errors->first()}}
                        </div>
                    @endif
                    <div class="col-md-12">
                    <form method="POST" action="{{ URL::route('donate::confirm') }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST">
                        <input name="_pledge" type="hidden" value="{{ json_encode($types) }}">

                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="firstName">
                                        {{ trans('donation.user.first_name.title') }}
                                    </label>
                                    <input type="text" class="form-control" name="firstName"
                                           placeholder="{{ trans('donation.user.first_name.placeholder') }}"
                                           value=
                                           "<?php
                                           if (isset($input['firstName'])) {
                                               echo $input['firstName'];
                                           }
                                           ?>"
                                           maxlength="255">
                                    <span id="helpBlock" class="help-block">
                                        {{ trans('donation.user.first_name.info') }}
                                    </span>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="lastName">
                                        {{ trans('donation.user.last_name.title') }}
                                    </label>
                                    <input type="text" class="form-control" name="lastName"
                                           placeholder="{{ trans('donation.user.last_name.placeholder') }}"
                                           value=
                                           "<?php
                                           if (isset($input['lastName'])) {
                                               echo $input['lastName'];
                                           }
                                           ?>"
                                           maxlength="255">
                                    <span id="helpBlock" class="help-block">
                                        {{ trans('donation.user.last_name.info') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">
                                {{ trans('donation.user.email.title') }}
                            </label>
                            <input type="text" class="form-control" name="email"
                                   placeholder="{{ trans('donation.user.email.placeholder') }}"
                                   value=
                                   "<?php
                                   if (isset($input['email'])) {
                                       echo $input['email'];
                                   }
                                   ?>"
                                   maxlength="255">
                            <span id="helpBlock" class="help-block">
                                {{ trans('donation.user.email.info') }}
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="message">
                                {{ trans('donation.user.message.title') }}
                            </label>
                            <textarea class="form-control" name="message" cols="30" rows="10"
                                      placeholder="{{ trans('donation.user.message.placeholder') }}"><?php if (isset($input['message'])) { echo $input['message']; } ?></textarea>
                            <span id="helpBlock" class="help-block">
                                {{ trans('donation.user.message.info') }}
                            </span>
                        </div>
                        <div class="form-group">
                            <input checked="checked" name="visibility" type="checkbox" value="1"> {{ trans('donation.user.visibility.description') }}<br>

                            <span id="helpBlock" class="help-block">
                                {{ trans('donation.user.visibility.info') }}
                            </span>
                        </div>

                        <button type="submit" class="btn4 pull-right">{{ trans('donation.buttons.confirm') }}</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection