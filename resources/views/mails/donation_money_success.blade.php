@extends('layouts.mails.default')

@section('subject')
    {{ trans('mails.donation_money_success.subject') }} | {{ $projectTitle }}
@endsection

@section('teaser')
    {{ trans('mails.donation_money_success.teaser') }}
@endsection

@section('content')
    <h1>{{ trans('mails.donation_money_success.content.header') }}</h1>
    <p>{!! trans('mails.donation_money_success.content.intro', ['name' => $name, 'project' => $projectTitle, 'amount' => $amount]) !!}</p>
    @if (count($donationContents) > 0)
    <p> {{ trans('mails.donation_money_success.content.additional_pledge') }}</p>
    <hr/>
    @foreach ($donationContents as $kind => $kindContent)
        <strong>{{ trans('backoffice.' . $kind) }}</strong><br/>
        @foreach ($kindContent as $item)
            {{ $item["count"] }}x {{ $item["name"] }}<br/>
        @endforeach
    @endforeach
    <hr/>
    <p> {{ trans('mails.donation_money_success.content.additional_pledge_disclaimer') }} </p>
    @endif
    <p> {{ trans('mails.donation_money_success.content.confirm') }}</p>
    <a href="{{ URL::route('donate::info', ['code' => $secretUrl, 'email' => $email]) }}" class="btn4">{{ trans('mails.donation_money_success.content.confirm_action') }}</a>
@endsection