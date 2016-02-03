@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');"></div>
        @endif
        <!-- Donation page -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Donation header block -->
                    <h1>{{ trans('donation.confirmed.title') }}</h1>
                    <hr/>
                </div>
                <div class="col-md-12">
                    <p>{{ trans('donation.confirmed.description') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection