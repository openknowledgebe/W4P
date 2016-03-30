@extends('layouts.backoffice')

@section('title', trans('backoffice.posts'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>{{ trans('backoffice.previous_projects') }}</h1>
            <p>
                {{ trans('backoffice.page.previous_projects.about') }}
            </p>
            <hr/>
            @if(count($archived) == 0)
                <div class="alert alert-info" role="alert">
                    {{ trans('backoffice.warnings.no_archived') }}
                </div>
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

            <a class="btn btn-primary btn-lg" href="{{ URL::route('admin::importProject') }}">{{ trans('backoffice.import_previous_project') }}</a>
            <hr/>
            @foreach ($archived as $archived)
                <div class="panel panel-default post-brief">
                    <div class="panel-body support-panel">
                            <a href="{{ URL::route('admin::previousDelete', $archived->id) }}" class="btn btn-danger btn-sm pull-right">
                                {{ trans('backoffice.delete') }}
                            </a>
                        <h4>{{ $archived->title }}</h4>
                        <div class="description">
                            {{ $archived->description }}
                        </div>
                        <div>Completed: @if ($archived->success) YES @else NO @endif</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection