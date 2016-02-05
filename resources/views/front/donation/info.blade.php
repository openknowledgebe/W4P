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
                <div class="col-md-6 col-md-push-3">
                    <h1>{{ trans('donation.your_donation') }}</h1>
                    <hr/>
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
                    <hr/>
                    <h4>{{ trans('donation.message') }}</h4>
                    {!! nl2br(htmlspecialchars($userMessage)) !!}
                </div>
            </div>
        </div>
    </div>
@endsection