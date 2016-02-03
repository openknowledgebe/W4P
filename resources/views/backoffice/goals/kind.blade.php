@extends('layouts.backoffice')

@section('title', trans('backoffice.goals'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <br/>
            <ol class="breadcrumb">
                <li><a href="{{ URL::route('admin::goals') }}">{{ trans('backoffice.goals') }}</a></li>
                <li class="active">{{ trans('backoffice.' . $kind) }}</li>
            </ol>
            <hr/>
            <h1>{{ trans('backoffice.' . $kind) }}</h1>
            <p>{{ trans('backoffice.page.goal_kind.about') }}</p>
            <hr/>
            <a href="{{ URL::route('admin::goalsTypeCreate', $kind) }}" class="btn-default btn btn-sm">{{ trans('backoffice.create') }}</a>
            <hr/>
            @if(Session::has('info'))
                <div class="alert alert-info" role="alert">
                    {{ Session::get('info') }}
                </div>
            @endif
            <section>
                @foreach ($donationTypes as $type)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                        {{ $type->name }}
                        </h3>
                        <a href="{{ URL::route('admin::goalsTypeEdit', [$kind, $type->id]) }}" class="pull-right btn-default btn btn-sm">Edit</a>
                    </div>
                    <div class="panel-body">
                        <strong>{{ trans('backoffice.page.goals.desc') }}</strong>
                        <p>{{ $type->description }}</p>
                        <strong>{{ trans('backoffice.page.goals.unit_desc') }}</strong>
                        <p>{{ $type->unit_description }}</p>
                        <strong>{{ trans('backoffice.page.goals.required_amount') }}</strong>
                        <p>{{ $type->required_amount }}x</p>
                    </div>
                </div>
                @endforeach
            </section>
        </div>
    </div>

@endsection