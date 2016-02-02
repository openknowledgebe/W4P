@extends('layouts.core')

@section('title', trans('generic.homepage'))

@section('content')
    <div class="project">
        <!-- Banner -->
        @if (file_exists(public_path() . "/project/banner.png"))
            <div class="home-banner" style="background-image: url('{{ URL::to("/project/banner.png") }}');"></div>
        @endif
        <!-- Donation page -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Donation header block -->
                    <h1>{{ trans('donation.title') }}</h1>
                    <p>{{ trans('donation.description') }}</p>
                    <hr/>
                </div>
                <div class="col-md-6 col-md-push-3">
                    <form method="POST" action="{{ URL::route('donate') }}" enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="POST">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <!-- Donation options -->
                            @foreach ($donationTypes as $donationType)
                                    <!-- Donation type -->
                            @foreach ($donationType as $option)
                                <label for="password">
                                    {{ $option['name'] }} ({{ $option['kind'] }})
                                </label>
                                <p>
                                    <strong>Description</strong>: {{ $option['description'] }}<br/>
                                </p>
                                I am able to provide <input type="number" class="form-control" id="pledge_{{str_slug($option['id'])}}" name="pledge_{{str_slug($option['id'])}}"
                                        placeholder="Pledge amount" min="0"> units.
                            <p>
                                <strong>1 unit</strong>: {{ $option['unit_description'] }}
                            </p>
                            @endforeach
                            @endforeach
                            <button type="submit" class="btn4 pull-right">{{ trans('setup.generic.next') }} &rarr;</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection