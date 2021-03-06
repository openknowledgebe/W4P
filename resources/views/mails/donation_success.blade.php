@extends('layouts.mails.default')

@section('subject')
    {{ trans('mails.donation_confirm.subject') }} | {{ $projectTitle }}
@endsection

@section('teaser')
    {{ trans('mails.donation_confirm.teaser') }}
@endsection

@section('content')
    <h1>{{ trans('mails.donation_success.content.header') }}</h1>
    <p>{!! trans('mails.donation_success.content.intro', ['name' => $name, 'project' => $projectTitle]) !!}</p>
    <p>{{ trans('mails.donation_success.content.confirm') }} </p>
    <a href="{{ URL::route('donate::info', ['code' => $secretUrl, 'email' => $email]) }}" class="btn4">{{ trans('mails.donation_success.content.confirm_action') }}</a>
@endsection