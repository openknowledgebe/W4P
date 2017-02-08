@extends('layouts.backoffice')

@section('title', trans('backoffice.tiers'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <h1>{{ trans('backoffice.tiers') }}</h1>
            <p>
                {{ trans('backoffice.page.tiers.about') }}
            </p>
            <hr/>
            @if(count($tiers) == 0)
                <div class="alert alert-info" role="alert">
                    {{ trans('backoffice.warnings.no_tiers') }}
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

            <a class="btn btn-primary btn-lg" href="{{ URL::route('admin::createTier') }}">{{ trans('backoffice.create_tier') }}</a>
            <hr/>
            @foreach ($tiers as $tier)
                <div class="panel panel-default">
                    <div class="panel-body support-panel">
                            <a href="{{ URL::route('admin::editTier', $tier->id) }}" class="btn btn-default btn-sm pull-right">
                                {{ trans('backoffice.edit') }}
                            </a>
                            <span>
                                <strong>
                                    {{ trans('home.tier.pledge', [
                                     "currency" => "€",
                                     "pledgeAmount" => $tier->pledge
                                     ]) }}
                                    {{ trans('generic.or_more') }}
                                </strong>
                            </span><br/>
                        <div class="description">
                            {!! nl2br(htmlspecialchars($tier->description)) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection