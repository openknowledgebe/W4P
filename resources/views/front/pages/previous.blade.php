@extends('layouts.core')

@section('title', trans('front.previous'))

@section('meta')
    @include('partials.meta.default')
@endsection

@section('content')

    <div class="project">
        <div class="home-banner">
            <span class="banner-text">
                <h1>{{ trans('generic.previous') }}</h1>
            </span>
        </div>
        <div class="container">

            @foreach ($previous as $project)
            <div nlass="row">

                <div class="col-md-4">
                    <br/>
                    VIDEO HERE
                </div>
                <div class="col-md-8">
                    <h2>{{ $project->title }}</h2>
                     <span>
                         <i class="icon icon-person icon-align-text"></i>
                         {{ trans('home.projectby') }}
                         <strong>
                             {{ json_decode($project->meta)->organisation->name }}
                         </strong>
                     </span>
                    <span>
                        <i class="icon icon-calendar icon-align-text"></i>
                        {{ trans('home.ended_at') }}
                        <strong>
                            {{ $project->ends_at->format("F j, Y") }}
                        </strong>
                    </span>

                    <?php
                        $donationTypes = json_decode($project->meta)->donation_types;
                        $percentages = json_decode($project->meta)->percentages;
                        $donationKinds = \W4P\Models\DonationKind::all();
                    ?>

                    <br/><br/>
                    <div class="wrap">
                        @foreach ($donationKinds as $kind)
                            @if (isset($donationTypes->$kind) && count($donationTypes->$kind) > 0)
                                <div class="progress-radial progress-{{ round($percentages->$kind->percentage) }}">
                                    <div class="overlay">
                                        <i class="icon icon-progress-{{$kind}} icon-lg"></i><br/>
                                        <span class="about">{{ trans("backoffice." . $kind) }}</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
@endsection
