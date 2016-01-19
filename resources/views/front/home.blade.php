@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">

        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="row home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');">
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <section class="meta">
                    <h1>{{ $project->title }}</h1>
                    <span>
                        <img src="icon/date.png" width="20" height="20"/> <!-- TODO: add icon -->
                        {{ trans('home.projectby') }}
                        <a href="{{ $data['organisation.website'] }}">
                            {{ $data['organisation.name'] }}
                        </a>
                    </span>
                    <span>
                        <img src="icon/date.png" width="20" height="20" /> <!-- TODO: add icon -->
                        {{ trans('home.startedon') }}
                        {{ $project->starts_at->format("F j, Y") }}
                    </span>
                    <!-- TODO: Section for custom categories -->
                </section>
            </div>
            <div class="col-md-6">
                <section class="numbers">
                    <!-- TODO: replace number of backers, percentage complete, link to pledge -->
                    <span>
                        X <br/>
                        {{ trans('home.backers') }}
                    </span><br/>
                    <span>X% <br/>
                        {{ trans('home.funded') }}
                    </span><br/>
                    <a href="">{{ trans('home.support') }}</a>
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <section class="about-video">
                    <h2>{{ trans('home.aboutproject') }}</h2>
                    <span>{{ trans('home.timeleft', ['left' => $left]) }}</span>
                    <br/>
                    <!-- TODO: add video depending on provider -->
                </section>
            </div>
            <div class="col-md-6">
                <section class="about-organisation">
                    <h2>{{ $data['organisation.name'] }}</h2>
                    <p>{!! nl2br($data['organisation.description']) !!}</p>
                    <a href="{{ $data['organisation.website'] }}">
                        Website
                    </a>
                </section>
                <section class="custom">
                    <!-- Allow for some more custom html for e.g. sponsors -->
                </section>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                {!! Markdown::convertToHtml($project->description) !!}
            </div>
            <div class="col-md-3">
                <h2>{{ trans('home.rewards') }}</h2>
                @foreach ($tiers as $tier)
                    <div class="panel panel-default">
                        <div class="panel-body support-panel">
                            <span>
                                <strong>
                                    {{ trans('home.tier.pledge', [
                                     "currency" => "€",
                                     "pledgeAmount" => $tier->pledge
                                     ]) }}
                                </strong>
                            </span><br/>
                            <span class="backer-count">X {{ trans('home.backers') }}</span><br/>
                            <div class="description">
                                {!! nl2br(htmlspecialchars($tier->description)) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection