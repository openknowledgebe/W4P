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
                    <!-- Donation header block -->
                    @if (isset($paid) && $paid)
                        <h1>{{ trans('donation.thanks.title_paid') }}</h1>
                    @else
                        <h1>{{ trans('donation.thanks.title') }}</h1>
                    @endif
                    <hr/>
                </div>
                <div class="col-md-12">
                    {!! trans('donation.thanks.description') !!}
                </div>
            </div>
        </div>
    </div>
@endsection