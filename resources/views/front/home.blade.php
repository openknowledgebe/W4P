@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">

        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="row home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');">
            </div>
        @endif
        <div class="row goals">
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
                    <!-- TODO: Section for custom categories -->
                </section>
            </div>
            <div class="col-md-5 numbers-container">
                <section class="numbers">
                    <!-- TODO: replace number of backers, percentage complete, link to pledge -->
                    <div class="row">
                        <div class="col-md-12">
                            <span class="number-lg">€900</span><br/>
                            <span class="number-sm">{{ trans('home.of') }} €2000</span>
                        </div>
                        <div class="col-md-4">
                            <span class="number-lg">19</span><br/>
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
                    <a href="" class="btn-support">{{ trans('home.support') }}</a>
                </section>
            </div>
        </div>
        <div class="row about">
            <div class="col-md-6">
                <section class="about-video">
                    <h2>{{ trans('home.aboutproject') }}</h2>
                    <br/>
                    @if ($project->videoProvider == "vimeo")
                        <iframe src="https://player.vimeo.com/video/{{ $video_id }}?color=FFFFFF"
                                width="500" height="420" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen>
                        </iframe>
                    @elseif ($project->videoProvider == "youtube")
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
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{ trans("home.story") }}</a></li>
            <li role="presentation"><a href="#updates" aria-controls="updates" role="tab" data-toggle="tab">{{ trans("home.updates") }}</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
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
@endsection