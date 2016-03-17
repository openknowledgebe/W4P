@extends('layouts.core')

@section('title', trans('generic.donate'))

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
                    <hr/>
                    <section class="share">
                        <h3>{{ trans('home.share') }}</h3>
                        <a class="share-btn share-fb" href="https://www.facebook.com/sharer/sharer.php?u={{URL::route('home')}}" target="_blank" title="Share on Facebook">
                        </a>
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
@endsection