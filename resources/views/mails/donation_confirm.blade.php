@extends('layouts.mails.default')

@section('subject')
    {{ trans('mails.donation_confirm.subject') }} | {{ $projectTitle }}
@endsection

@section('teaser')
    {{ trans('mails.donation_confirm.teaser') }}
@endsection

@section('content')
    <h1>{{ trans('mails.donation_confirm.content.header') }}</h1>
    <p>{!! trans('mails.donation_confirm.content.intro', ['name' => $name, 'project' => $projectTitle]) !!}</p>
    <hr/>
    @foreach ($types as $type)
        @if (is_array($type))
            <strong>{{ trans('backoffice.' . $type['kind']) }}</strong><br/>
            {{ $type['amount'] }}x {{ $type['name'] }}<br/>
        @endif
    @endforeach
    @if (isset($types['currency']))
        <strong>{{ trans('backoffice.currency') }}</strong><br/>
        {{ trans('donation.money_pledge') }} €{{ $types['currency'] }}<br/>
    @endif
    <hr/>
    <p>{{ trans('mails.donation_confirm.content.confirm') }}</p>
    <a href="{{ URL::route('donate::emailConfirm', [$confirm_url, $email]) }}">{{ trans('mails.donation_confirm.content.confirm_action') }}</a>
@endsection