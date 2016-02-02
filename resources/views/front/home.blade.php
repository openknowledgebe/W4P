@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');"></div>
            @endif
                    <!-- Goals -->
            <div class="container">
                <div class="row goals">
                    <!-- Goals left column (with progress) -->
                    <div class="col-md-7 meta-container">
                        <section class="meta">
                            <h1>{{ $project->title }}</h1>
                    <span>
                        <img src="{{ URL::to('/img/icon_user.png') }}" width="30" height="30"/>
                        {{ trans('home.projectby') }}
                        <strong>
                            {{ $data['organisation.name'] }}
                        </strong>
                    </span>
                    <span>
                        <img src="{{ URL::to('/img/icon_calendar.png') }}" width="30" height="30" />
                        {{ trans('home.startedon') }}
                        <strong>
                            {{ $project->starts_at->format("F j, Y") }}
                        </strong>
                    </span>
                            <hr/>
                            <!-- Possible donation types -->
                            <ul>
                                @foreach ($donationKinds as $kind)
                                    @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                                        <li>
                                            {{ trans("backoffice." . $kind) }}
                                        </li>
                                    @endif
                                @endforeach
                                @if ($project->currency > 0)
                                    <li>
                                        {{ trans("backoffice.currency") }}
                                    </li>
                                @endif
                            </ul>
                        </section>
                    </div>
                    <!-- Goals right column (blue) -->
                    <div class="col-md-5 numbers-container">
                        <section class="numbers">
                            <!-- TODO: replace number of backers, percentage complete, link to pledge -->
                            <div class="row">
                                @if ($project->currency > 0)
                                    <div class="col-md-12">
                                        <span class="number-lg">€{{ $contributed }}</span><br/>
                                        <span class="number-sm">{{ trans('home.of') }} €{{ round($project->currency) }}</span>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <span class="number-lg">{{ $donorCount }}</span><br/>
                                    <span class="number-sm">{{ trans('home.backers') }}</span>
                                </div>
                                <div class="col-md-4">
                                    @if ($hoursleft < 24)
                                        <span class="number-lg">{{ $hoursleft }}</span><br/>
                                        <span class="number-sm">{{ trans('home.hoursleft') }}</span>
                                    @else
                                        <span class="number-lg">{{ $daysleft }}</span><br/>
                                        <span class="number-sm">{{ trans('home.daysleft') }}</span>
                                    @endif
                                </div>
                            </div>
                            <a href="{{ URL::route('donate') }}" class="btn-support">{{ trans('home.support') }}</a>
                        </section>
                    </div>
                </div>
            </div>
            <!-- About this company -->
            <div class="about">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <section class="about-video">
                                <h2>{{ trans('home.aboutproject') }}</h2>
                                <br/>
                                @if ($video_provider == "vimeo")
                                    <iframe src="https://player.vimeo.com/video/{{ $video_id }}?color=FFFFFF"
                                            width="500" height="420" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen>
                                    </iframe>
                                @elseif ($video_provider == "youtube")
                                    <iframe width="500" height="420" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen
                                            src="http://www.youtube.com/embed/{{ $video_id }}?autoplay=0">
                                    </iframe>
                                @endif
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
                </div>
            </div>
            <!-- Story & updates -->
            <div class="story">
                <div class="container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <!-- First tab control -->
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ trans("home.story") }}</a></li>
                        <!-- Second tab control -->
                        <li role="presentation"><a href="#updates" aria-controls="updates" role="tab" data-toggle="tab">{{ trans("home.updates") }}</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- First tab with information about the project -->
                        <div role="tabpanel" class="tab-pane active" id="home">
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
                        <!-- Second tab with updates -->
                        <div role="tabpanel" class="tab-pane updates" id="updates">
                            @if (count($posts) == 0)
                                <p>The project's makers have not posted any updates yet!</p>
                            @endif
                            <?php
                            $n = 0;
                            foreach($posts as $post): $n++;?>
                            <div class="date-flag">
                                <img src="{{ URL::to('img/icon_flag.png') }}" width="35"/>
                                <p class="date">{{ $post->created_at->format("F j, Y") }}</p>
                            </div>
                            <div class="row">
                                <article class="<?php echo ($n%2) ? 'col-md-5' : 'col-md-push-7 col-md-5' ?>">

                                    <h3>{{ $post->title }}</h3>
                                    <div>
                                        {!! Markdown::convertToHtml( $post->content) !!}
                                    </div>
                                    <a href="#">Read more</a>
                                </article>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Extra tabs for donation kinds (manpower, coaching, etc) -->
            <div class="tabanddonations">
                <div class="container">
                    <!-- Tabs per extra category (coaching, etc) -->
                    <ul class="nav nav-tabs" role="tablist">
                        <!-- Generate a tab for each -->
                        @foreach ($donationKinds as $kind)
                            @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                                <li role="presentation">
                                    <a href="#{{ $kind }}" aria-controls="{{ $kind }}" role="tab" data-toggle="tab">{{ trans("backoffice." . $kind) }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Tab panes for extra categories -->
                    <div class="tab-content">
                        @foreach ($donationKinds as $kind)
                            @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                            <!-- Generate a tab for each -->
                            <div role="tabpanel" class="tab-pane" id="{{ $kind }}">
                                <!-- TODO: List how many of each we still need -->
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- How does it work & previous projects -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn-light">
                            {{ trans('home.howdoesitwork') }}
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn-light">
                            {{ trans('home.previousprojects') }}
                        </a>
                    </div>
                </div>
            </div>
    </div>
@endsection