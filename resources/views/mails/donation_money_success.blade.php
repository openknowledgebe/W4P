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
    <a href="#" class="btn4">{{ trans('mails.donation_money_success.content.confirm_action') }}</a>
@endsection