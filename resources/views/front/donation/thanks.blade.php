@extends('layouts.core')

@section('title', trans('generic.donation_thanks'))

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
                    <h1>{{ trans('donation.thanks.title') }}</h1>
                    <hr/>
                    {!! trans('donation.thanks.description') !!}
                </div>
            </div>
        </div>
    </div>
@endsection