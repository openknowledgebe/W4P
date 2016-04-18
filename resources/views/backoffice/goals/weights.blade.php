@extends('layouts.backoffice')

@section('title', trans('backoffice.goals'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <br/>
            <ol class="breadcrumb">
                <li><a href="{{ URL::route('admin::goals') }}">{{ trans('backoffice.goals') }}</a></li>
                <li class="active"> {{ trans('backoffice.weight') }}</li>
            </ol>
           <h1>{{ trans('backoffice.goals_weight') }}</h1>
            <p>{{ trans('backoffice.page.goals_weight.about') }}</p>
            <hr/>

            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <strong>{{ trans('setup.generic.oops') }}</strong>
                    {{$errors->first()}}
                </div>
            @endif

            <form method="POST" action="{{ URL::route('admin::goalsWeight') }}" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="POST">
                {{ csrf_field() }}

                @foreach ($donationKinds as $kind)
                    <div class="form-group">
                        <label for="name">
                            <strong>{{ trans('backoffice.' . $kind) }}</strong>
                        </label>
                        <input type="number" class="form-control" name="weight_{{$kind}}"
                               placeholder="0-10000"
                               value=
                               "<?php
                               if (Request::old("weight_" . $kind)) {
                                   echo Request::old("weight_" . $kind);
                               } else if (array_key_exists("weight." . $kind, $weights) && $weights["weight." . $kind] != null) {
                                   echo $weights["weight." . $kind];
                               }
                               ?>"
                               min="0" max="10000" step="1">
                    </div>

                @endforeach

                <button type="submit" class="btn btn-default">{{ trans('backoffice.save') }}</button>

            </form>

        </div>
    </div>

@endsection