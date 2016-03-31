{{-- Template for projects exported with version 2016.3 --}}

<div class="row">
    <div class="col-md-5">
        {{-- About video --}}
        <section class="about-video">
            <br/>
            <div class="video-container">
                <?php
                $project_video_provider = $project->getVideoProvider();
                $project_video_id = $project->getVideoId();
                ?>
                {{-- Based on the provider, the output differs --}}
                @if ($project_video_provider == "vimeo")
                    {{-- VIMEO --}}
                    <iframe src="https://player.vimeo.com/video/{{ $project_video_id }}?color=FFFFFF&title=0&byline=0&portrait=0"
                            width="585" height="329" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen>
                    </iframe>
                @elseif ($project_video_provider == "youtube")
                    {{-- YOUTUBE --}}
                    <iframe width="585" height="329" frameborder="0" webkitallowfullscreen  mozallowfullscreen allowfullscreen
                            src="http://www.youtube.com/embed/{{ $project_video_id }}?autoplay=0">
                    </iframe>
                @endif
            </div>
        </section>
    </div>
    <div class="col-md-7">
        <h2>{{ $project->title }}</h2>
                     <span>
                         <i class="icon icon-person icon-align-text"></i>
                         {{ trans('home.projectby') }}
                         <strong>
                             {{ json_decode($project->meta)->organisation->name }}
                         </strong>
                     </span>
                    <span class="pull-right">
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
        $meta = json_decode($project->meta);
        ?>

        <hr/>

        <div class="container">
            <div class="row">
                @if ($meta->goal > 0)
                    <div class="progress-radial progress-{{ round($percentages->currency->percentage) }}">
                        <div class="overlay">
                            <i class="icon icon-progress-currency icon-lg"></i><br/>
                            <span class="about">{{ trans("backoffice.currency") }}</span>
                        </div>
                    </div>
                @endif
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

        <br/>
        <hr/>

        <div class="row">
            <div class="col-md-4">
                <strong>{{ $meta->total_percentage }}% {{ trans('generic.reached') }}</strong>
            </div>
            <div class="col-md-4">
                <strong>{{ $meta->total_donors }} {{ trans('generic.donors') }}</strong>
            </div>
            <div class="col-md-4">
                <strong>€ {{ $meta->contributed }} / € {{ $meta->goal }} {{ trans('generic.raised') }}</strong>
            </div>
        </div>

        <hr/>

    </div>
</div>