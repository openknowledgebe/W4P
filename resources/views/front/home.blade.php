@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        <div class="home-banner"
             @if (file_exists(public_path() . "/project/banner.png")) style="background-image: url('{{ URL::to("/project/banner.png") }}');" @endif>
        </div>
        <!-- Goals -->
            <div class="container">
                <div class="row goals">
                    <!-- Goals left column (with progress) -->
                    <div class="col-md-7 meta-container">
                        <section class="meta">
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
                            {{ $project->ends_at->format("F j, Y") }}
                        </strong>
                    </span>
                            <hr/>
                            <div class="wrap">
                            <!-- Possible donation types -->
                                @if ($project->currency > 0)
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
                    <!-- Goals right column (blue) -->
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
                                    <span class="number-lg">{{ $donorCount }}</span><br/>
                                    <span class="number-sm">{{ trans('home.donors') }}</span>
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
                            <a href="{{ URL::route('donate::start') }}" class="btn-support">{{ trans('home.support') }}</a>
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
                                <h3>{{ $data['organisation.name'] }}</h3>
                                <p>{!! nl2br($data['organisation.description']) !!}</p>
                                <a href="{{ $data['organisation.website'] }}">
                                    Website
                                </a>
                            </section>
                            <section class="custom">
                            <!-- Allow for some more custom html for e.g. sponsors -->
                            </section>
                            <!-- Share dialogs -->
                            <section class="share">
                                <h3>{{ trans('home.share') }}</h3>
                                <a class="share-btn share-fb" href="https://www.facebook.com/sharer/sharer.php?u={{URL::route('home')}}" target="_blank" title="Share on Facebook">
                                </a>
                                <a class="share-btn share-gp" href="https://plus.google.com/share?url={{URL::route('home')}}" target="_blank" title="Share on Google+">
                                </a>
                                <a class="share-btn share-tw" href="http://twitter.com/share?text=I just donated to this fundraising campaign&url={{URL::route('home')}}" target="_blank" title="Share on Twitter">
                                </a>
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
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                                <i class="icon icon-story"></i>
                                {{ trans("home.story") }}
                            </a></li>
                        <!-- Second tab control -->
                        <li role="presentation"><a href="#updates" aria-controls="updates" role="tab" data-toggle="tab">
                                <i class="icon icon-updates"></i>
                                {{ trans("home.updates") }} (<strong>{{ count($posts) }}</strong>)
                            </a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- First tab with information about the project -->
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class="row">
                                <div class="col-md-9">
                                    {!! Markdown::convertToHtml($project->description) !!}
                                </div>
                                @if ($project->currency > 0)
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
                                @endif
                            </div>
                        </div>
                        <!-- Second tab with updates -->
                        <div role="tabpanel" class="tab-pane updates" id="updates">
                            @if (count($posts) == 0)
                                <div class="no-updates">
                                    <p>The project's makers have not posted any updates yet!</p>
                                </div>
                            @else
                            <div class="list">
                                <?php
                                $n = 0;
                                foreach($posts as $post): $n++;?>
                                <div class="row">
                                    @if ($n%2 == false)
                                        <div class="col-md-offset-5 col-md-2 date-flag hidden-xs hidden-sm">
                                            <i class="icon icon-flag"></i>
                                            <p class="date">{{ $post->created_at->format("d/m/Y") }}</p>
                                        </div>
                                    @endif
                                    <div class="col-md-5 post">
                                        <h3>{{ $post->title }}</h3>
                                        <div>
                                            {!! Markdown::convertToHtml( $post->content) !!}
                                        </div>
                                        <a href="#">Read more</a>
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
            <!-- Extra tabs for donation kinds (manpower, coaching, etc) -->
            <div class="tabanddonations">
                <div class="container">
                    <!-- Tabs per extra category (coaching, etc) -->
                    <ul class="nav nav-tabs" role="tablist">
                        <!-- Generate a tab for each -->
                        @foreach ($donationKinds as $count => $kind)
                            @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                                <li role="presentation" @if ($count == 0) class="active" @endif>
                                    <a href="#{{ $kind }}" aria-controls="{{ $kind }}" role="tab" data-toggle="tab">
                                        <i class="icon icon-{{$kind}}"></i>
                                        {{ trans("backoffice." . $kind) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Tab panes for extra categories -->
                    <div class="tab-content">
                        @foreach ($donationKinds as $count => $kind)
                            @if ($kind != "currency" && isset($donationTypes[$kind]) && count($donationTypes[$kind]) > 0)
                            <!-- Generate a tab for each -->
                            <div role="tabpanel" class="tab-pane-donation tab-pane @if ($count == 0) active @endif tab-{{ $kind }}" id="{{ $kind }}">
                                <h3>What we need</h3>
                                <div class="row">
                                    @foreach ($donationTypes[$kind] as $key => $donation_item)
                                    <div class="col-md-3 donor-box">
                                        {{ $donation_item->required_amount }} x<br/>
                                        <h4>{{ $donation_item->name }}</h4>
                                        <span class="orange">
                                            {{ $percentages[$kind]["items"][$key]['required'] }} more required
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                                <a href="#" class="btn4 white center">Support this project</a>
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