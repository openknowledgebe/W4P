@extends('layouts.core')

@if ($settings->social->seo_title)
    {{-- Use SEO title --}}
    @section('title', $settings->social->seo_title)
@else
    @section('title', $project->title)
@endif

@section('content')
    <div class="project">
        {{-- Banner --}}
        <div class="home-banner"
             @if (file_exists(public_path() . "/project/banner.png"))
                style="background-image: url('{{ URL::to("/project/banner.png") }}');"
            @endif>
        </div>

        {{-- Goals --}}
        <div class="goals-container">
            <div class="container goals">
                <div class="row">
                    {{-- Goals left column (with progress) --}}
                    <div class="col-md-7 meta-container">
                        <section class="meta project-meta">
                            <h1>{{ $project->title }}</h1>
                            <span>
                                <i class="icon icon-person icon-align-text"></i>
                                {{ trans('home.projectby') }}
                                <strong>
                                    {{ $data['organisation.name'] }}
                                </strong>
                            </span>
                            <span>
                                <i class="icon icon-calendar icon-align-text"></i>
                                {{ trans('home.ends_at') }}
                                <strong>
                                    {{ $project->ends_at->format("j F Y") }}
                                </strong>
                            </span>
                        </section>
                        <section class="meta">
                            <div class="percentage">
                                <span class="number">{{$totalPercentage}}</span><!--
                             --><span class="percent">%</span><br/>
                                <span class="reached">reached</span>
                            </div>
                            <div class="progress-radials">
                                @if ($project->currency > 0 && count($donationTypes) > 0)
                                    <div class="progress-radial @if($contributedPercentage > 100) progress-100 @else progress-{{round($contributedPercentage)}} @endif">
                                        <div class="overlay">
                                            <i class="icon icon-progress-currency icon-lg"></i><br/>
                                            <span class="about">{{ trans("backoffice.currency") }}</span>
                                        </div>
                                    </div>
                                @endif
                                @foreach ($donationKinds as $kind)
                                    @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                                        <div class="progress-radial progress-{{ round($percentages[$kind]["percentage"]) }}">
                                            <div class="overlay">
                                                <i class="icon icon-progress-{{$kind}} icon-lg"></i><br/>
                                                <span class="about">{{ trans("backoffice." . $kind) }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </section>
                    </div>
                    {{-- Goals right column --}}
                    <div class="col-md-5 numbers-container">
                        <section class="numbers">
                            <div class="row">
                                @if ($project->currency > 0)
                                    <div class="col-md-12">
                                        <span class="number-lg">€{{ $contributed }}</span><br/>
                                        <span class="number-sm">{{ trans('home.of') }} €{{ round($project->currency) }}</span>
                                    </div>
                                @endif
                                <div class="col-md-4">
                                    <span class="number-md">{{ $donorCount }}</span><br/>
                                    <span class="number-sm">{{ trans('home.donors') }}</span>
                                </div>
                                <div class="col-md-4">
                                    @if ($hoursleft < 24)
                                            @if ($hoursleft <= 2)
                                                <span class="number-md">{{ $minutesleft }}</span><br/>
                                                <span class="number-sm">{{ trans('home.minutesleft') }}</span>
                                            @else
                                                <span class="number-md">{{ $hoursleft }}</span><br/>
                                                <span class="number-sm">{{ trans('home.hoursleft') }}</span>
                                            @endif
                                    @else
                                        <span class="number-md">{{ $daysleft }}</span><br/>
                                        <span class="number-sm">{{ trans('home.daysleft') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if ($minutesleft > 0)
                                <a href="{{ URL::route('donate::start') }}" class="btn-support">{{ trans('home.support') }}<span>&rarr;</span></a>
                            @else
                                <p class="campaign-over">{{ trans('home.over') }}</p>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>

        {{-- About this company --}}
        <div class="about">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        {{-- About video --}}
                        <section class="about-video">
                            <h2>{{ trans('home.aboutproject') }}</h2>
                            <br/>
                            <div class="video-container">
                            {{-- Based on the provider, the output differs --}}
                            @if ($video_provider == "vimeo")
                                {{-- VIMEO --}}
                                <iframe src="https://player.vimeo.com/video/{{ $video_id }}?color=FFFFFF&title=0&byline=0&portrait=0"
                                        width="585" height="329" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen>
                                </iframe>
                            @elseif ($video_provider == "youtube")
                                {{-- YOUTUBE --}}
                                <iframe width="585" height="329" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen
                                        src="http://www.youtube.com/embed/{{ $video_id }}?autoplay=0">
                                </iframe>
                            @endif
                            </div>
                        </section>
                    </div>
                    <div class="col-md-5">
                        {{-- About organisation --}}
                        <section class="about-organisation">
                            <h3>{{ $data['organisation.name'] }}</h3>
                            <p>{!! nl2br($data['organisation.description']) !!}</p>
                            <a href="{{ $data['organisation.website'] }}">
                                Website
                            </a>
                        </section>
                        {{-- Custom HTML support --}}
                        <section class="custom">
                        </section>
                        {{-- Share options (buttons) --}}
                        <section class="share">
                            <h3>{{ trans('home.share') }}</h3>
                            {{-- Facebook share button --}}
                            <a class="share-btn share-fb" href="https://www.facebook.com/sharer/sharer.php?u={{URL::route('home')}}" target="_blank" title="Share on Facebook">
                            </a>
                            {{-- G+ share button --}}
                            <a class="share-btn share-gp" href="https://plus.google.com/share?url={{URL::route('home')}}" target="_blank" title="Share on Google+">
                            </a>
                            {{-- Twitter share button --}}
                            @if ($settings->social->twitter_message)
                                {{-- Custom message --}}
                                <a class="share-btn share-tw" href="
                                <?php echo 'http://www.twitter.com/share?' .
                                        http_build_query
                                        (array(
                                                'url' => URL::route('home'),
                                                'text' => $settings->social->twitter_message
                                        ));
                                ?>" target="_blank" title="Share on Twitter">
                                </a>
                            @else
                            <a class="share-btn share-tw" href="http://twitter.com/share?text=I just donated to this fundraising campaign&url={{URL::route('home')}}" target="_blank" title="Share on Twitter">
                            </a>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
        {{-- Story and updates --}}
        <div class="story">
            <div class="container">
                {{-- Navigation: multiple tabs --}}
                <ul class="nav nav-tabs" role="tablist">
                    {{-- Story tab --}}
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                            <i class="icon icon-story"></i>
                            {{ trans("home.story") }}
                        </a></li>
                    {{-- Updates tab --}}
                    <li role="presentation"><a href="#updates" aria-controls="updates" role="tab" data-toggle="tab">
                            <i class="icon icon-updates"></i>
                            {{ trans("home.updates") }} (<strong>{{ count($posts) }}</strong>)
                        </a></li>
                </ul>

                {{-- Actual tab panes --}}
                <div class="tab-content">
                    {{-- Story tab page; this tab pane contains Markdown transformed to HTML. --}}
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <div class="row">
                            @if ($project->description != null || $project->description != "")
                            {{-- Left column (9/12): MARKDOWN STORY --}}
                            <div class="col-md-9">
                                {!! Markdown::convertToHtml($project->description) !!}
                            </div>
                            @else
                            <div class="col-md-9">
                                <div class="no-updates">
                                    <p>{{ trans('generic.no_story') }}</p>
                                </div>
                            </div>
                            @endif
                            {{--
                            Right column (3/12): REWARD TIERS
                            (Only visible if there is a monetary goal and if there are any tiers that have
                            been configured.)
                            --}}
                            @if ($project->currency > 0 && count($tiers) > 0)
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
                                            <span class="backer-count">{{ $tierCounts[$tier->id] }} {{ trans('home.donations') }}</span><br/>
                                            <div class="description">
                                                {!! nl2br(htmlspecialchars($tier->description)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{-- END OF REWARD TIERS --}}
                            @else
                            <div class="col-md-3">
                                <br/>
                                <p>
                                    {{ trans('generic.no_tiers') }}
                                </p>
                            </div>
                            @endif
                        </div>
                    </div>
                    {{-- Second tab page; this one contains the updates left by the project creators --}}
                    <div role="tabpanel" class="tab-pane updates" id="updates">
                        {{-- Check if there are 0 posts --}}
                        @if (count($posts) == 0)
                            <div class="no-updates">
                                <p>{{ trans('generic.no_updates') }}</p>
                            </div>
                        @else
                        {{-- If posts have been created, list them here --}}
                        <div class="list">
                            <?php
                            $n = 0;
                            foreach($posts as $post): $n++;?>
                            <div class="row">
                                {{-- Depending on the result of this modulo, the flag will be on the left
                                     or on the right.--}}
                                @if ($n%2 == false)
                                    <div class="col-md-offset-5 col-md-2 date-flag hidden-xs hidden-sm">
                                        <i class="icon icon-flag"></i>
                                        <p class="date">{{ $post->created_at->format("d/m/Y") }}</p>
                                    </div>
                                @endif
                                <div class="col-md-5 post">
                                    <h3>{{ $post->title }}</h3>
                                    <div>
                                        {!! $post->markdownBrief() !!}
                                    </div>
                                    <a href="{{ URL::route('post::detail', $post->id) }}">{{ trans('generic.read_more') }}</a>
                                </div>
                                @if ($n%2 == true)
                                    <div class="col-md-2 date-flag hidden-xs hidden-sm">
                                        <i class="icon icon-flag"></i>
                                        <p class="date">{{ $post->created_at->format("d/m/Y") }}</p>
                                    </div>
                                @endif
                            </div>
                            <?php endforeach;?>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Extra tabs for donation kinds (manpower, coaching, etc) --}}
        <div class="tab-donations">
            <div class="container">
                {{-- Tabs per extra category (coaching, etc) --}}
                <ul class="nav nav-tabs" role="tablist">
                    {{-- Generate a tab for each --}}
                    <?php $count = 0; ?>
                    @foreach ($donationKinds as $kind)
                        @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                            <li role="presentation" @if ($count == 0) class="active" @endif>
                                <a href="#{{ $kind }}" aria-controls="{{ $kind }}" role="tab" data-toggle="tab">
                                    <i class="icon icon-{{$kind}}"></i>
                                    {{ trans("backoffice." . $kind) }}
                                </a>
                            </li>
                            <?php $count++ ?>
                        @endif
                    @endforeach
                </ul>
            </div>

            {{-- Tab panes for extra categories --}}
            <div class='tabs'>
                <div class="container">
                    <h3>What we need</h3>

                    <?php $count = 0; ?>
                    <div class='tab-content clearfix'>
                    @foreach ($donationKinds as $kind)
                        @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                        {{-- Generate a tab for each --}}
                        <div role="tabpanel" class="tab-pane-donation tab-pane @if ($count == 0) active @endif tab-{{ $kind }}" id="{{ $kind }}">
                            @foreach ($donationTypes[$kind] as $key => $donation_item)
                            <div class="col-md-3 donor-box">
                                <div>
                                    {{ $donation_item->required_amount }} x<br/>
                                    <h4>{{ $donation_item->name }}</h4>
                                    <span class="orange">
                                        {{ $percentages[$kind]["items"][$key]['required'] }} more required
                                    </span>
                                </div>
                            </div>
                            <?php $count++ ?>
                            @endforeach
                        </div>
                        @endif
                    @endforeach
                    </div>

                    <div class='text-center'>
                        <a href="{{ URL::route('donate::start') }}" class="btn4 white center">
                            Support this project <span>&rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- How does it work & Previous projects buttons --}}
        <div class="container">
            <div class="row">
                <div @if ($archived_count > 0) class="col-md-6" @else class="col-md-12" @endif >
                    <div class="padded-panel">
                        <a href="{{ URL::route('how') }}" class="btn4 main center">
                            {{ trans('home.howdoesitwork') }}
                        </a>
                    </div>
                </div>
                @if ($archived_count > 0)
                <div class="col-md-6">
                    <div class="padded-panel">
                    <a href="{{ URL::route('previous') }}" class="btn4 main center">
                        {{ trans('home.previousprojects') }}
                    </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
