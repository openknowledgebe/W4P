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