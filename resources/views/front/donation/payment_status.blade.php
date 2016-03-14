@extends('layouts.core')

@section('title', trans('generic.payment_status'))

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
                    <!-- Donation header block -->
                    <h1>{{ trans('donation.payment_status_page.title') }}</h1>
                    {!! trans('donation.payment_status_page.description', ['status' => trans('donation.payment_status.' . $paymentStatus)]) !!}
                </div>
            </div>
        </div>
    </div>
@endsection