@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        <div class="home-banner"
             @if (file_exists(public_path() . "/project/banner.png")) style="background-image: url('{{ URL::to("/project/banner.png") }}');" @endif>
        </div>
        <!-- Donation page -->
        <div class="container">
            <div class="row">
                @if ($tier != null || $userMessage != "")
                <div class="col-md-8 col-md-push-2">
                    <h1>{{ trans('donation.your_donation') }}</h1>
                    <hr/>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-md-4 @if ($tier == null && $userMessage == "") col-md-push-4 @else col-md-push-2 @endif">
                    @if ($tier == null && $userMessage == "")
                        <h1>{{ trans('donation.your_donation') }}</h1>
                        <hr/>
                    @endif
                    <h4>{{ trans('donation.personal_data') }}</h4>
                    <hr/>
                    <p>
                        <strong>Your name:</strong> {{ $name }}<br/>
                        <strong>Your email address:</strong> {{ $email }}
                    </p>
                    <hr/>
                    <h4>{{ trans('donation.your_details') }}</h4>
                    <hr/>
                    @if ($amount > 0)
                        <strong>{{ trans('backoffice.currency') }}</strong><br/>
                        {{ trans('donation.money_pledge') }} €{{ $amount }}<br/>
                    @endif
                    @if (count($donationContents) > 0)
                        @foreach ($donationContents as $kind => $kindContent)
                            <strong>{{ trans('backoffice.' . $kind) }}</strong><br/>
                            @foreach ($kindContent as $item)
                                {{ $item["count"] }}x {{ $item["name"] }}<br/>
                            @endforeach
                        @endforeach
                    @endif
                </div>
                @if ($tier != null || $userMessage != "")
                <div class="col-md-4 col-md-push-2">
                    @if ($tier != null)
                        <h4>{{ trans('donation.tier') }}</h4>
                        <hr/>
                        <div class="panel panel-default">
                            <div class="panel-body support-panel">
                                <span>
                                                    <strong>
                                                        {{ trans('home.tier.pledge', [
                                                         "currency" => "€",
                                                         "pledgeAmount" => $tier->pledge
                                                         ]) }}
                                                    </strong>
                                                </span><br/>
                                <div class="description">
                                    {!! nl2br(htmlspecialchars($tier->description)) !!}
                                </div>
                            </div>
                        </div>
                        <hr/>
                    @endif
                    @if ($userMessage != "")
                    <h4>{{ trans('donation.message') }}</h4>
                    <hr/>
                    <pre>{!! nl2br(htmlspecialchars($userMessage)) !!}</pre>
                    @endif
                </div>
                @endif
            </div>
        </div>
@endsection