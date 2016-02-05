@extends('layouts.mails.default')

@section('subject')
    {{ trans('mails.notification_donation_confirmed.subject') }} | {{ $projectTitle }}
@endsection

@section('teaser')
    {{ trans('mails.notification_donation_confirmed.teaser') }}
@endsection

@section('content')
    <h1>{{ trans('mails.notification_donation_confirmed.content.header') }}</h1>
    {!! trans('mails.notification_donation_confirmed.content.intro', ['project' => $projectTitle]) !!}
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
    @if ($message != null && $message != "")
        {{ trans('mails.notification_donation_confirmed.content.message', ['name' => $name]) }}:
        {!! nl2br(htmlspecialchars($message)) !!}
    @endif
    <p> {{ trans('mails.notification_donation_confirmed.content.closing', ['name' => $name]) }}: <a href="mailto:{{$email}}">{{ $email }}</a>.</p>
@endsection