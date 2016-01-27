@extends('layouts.backoffice')

@section('title', trans('backoffice.goals'))

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-push-3">
            <br/>
            <ol class="breadcrumb">
                <li class="active">{{ trans('backoffice.goals') }}</li>
            </ol>
           <h1>{{ trans('backoffice.goals') }}</h1>
            <p>{{ trans('backoffice.page.goals.about') }}</p>
            <hr/>
            <ul>
                <li>
                    <a href="{{ URL::route('admin::goalsCurrency') }}">
                        {{ trans("backoffice.currency") }}
                    </a>
                    [Amount: € {{ $currency }}]
                </li>
                @foreach ($donationKinds as $kind)
                    @if ($kind != "currency")
                    <li>
                        <a href="{{ URL::route('admin::goalsDetail', $kind) }}">{{ trans("backoffice." . $kind) }}</a>
                        @if (isset($donationTypes[$kind]))
                            [{{ count($donationTypes[$kind]) }}
                            {{ Lang::choice('backoffice.types', count($donationTypes[$kind])) }}]
                        @else
                            [0 {{ Lang::choice('backoffice.types', 0) }}]
                        @endif
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

@endsection